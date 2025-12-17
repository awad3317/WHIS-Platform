<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\StudentService;
use App\Classes\WebResponseClass;
use Illuminate\Support\Facades\DB;
use App\Services\StudentFileService;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ClassModelRepository;


class StudentController extends Controller
{
    public function __construct(
        private StudentFileService $studentFileService,
        private StudentRepository $studentRepository,
        private StudentService $studentService,
        private ClassModelRepository $classModelRepository)
    {
        
    }
    public function index()
{
    if(!Auth::user()->hasPermission('view_students')) {
        return WebResponseClass::sendError('ليس لديك صلاحية عرض الطلاب.', 'صلاحية مفقودة!');
    }
    $students = $this->studentRepository->index();
    
    $photos = [];
    foreach ($students as $student) {
        $photo = $student->files->where('file_type', 'photo')->first();
        
        if ($photo) {
            
                $fileData = $this->studentFileService->downloadFile($photo);
                $imageContent = file_get_contents($fileData['path']);
                $base64 = 'data:image/jpeg;base64,' . base64_encode($imageContent);
                
                $photos[$student->id] = [
                    'data' => $base64,
                    'has_photo' => true,
                ];
        } 
    }
    
    return view('pages.studentes.index', compact('students', 'photos'));
}

    public function create()
    {
        if(!Auth::user()->hasPermission('create_student')) {
            return WebResponseClass::sendError('ليس لديك صلاحية إضافة طالب جديد.', 'صلاحية مفقودة!');
        }
        $classes = ClassModel::where('is_active', 1)->get();

        return view('pages.studentes.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        // =====  Student Info Validation ===== //
        'name_en' => ['required', 'string', 'max:255',Rule::unique('students','name_en')],
        'name_ar' => ['required', 'string', 'max:255',Rule::unique('students','name_ar')],
        'birth_date' => ['required', 'date'],
        'nationality' => ['required', 'string', 'max:100'],
        'national_id' => ['required', 'string', 'max:20',Rule::unique('students','national_id')],
        'national_id_type'=> ['required', Rule::in(['national_id', 'passport', 'residence_id'])],
        'gender' => ['required', Rule::in(['male', 'female'])],
        'previous_school' => ['required', 'string', 'max:255'],
        'class_id' => ['required',Rule::exists('class_models','id'),
                function ($attribute, $value, $fail) {
                $class = $this->classModelRepository->getById($value);
                if ($class) {
                   $currentStudents = $class->enrollments()
                                    ->where('status', 'active')
                                    ->count();
                    if ($currentStudents >= $class->capacity) {
                        $fail('هذا الفصل ممتلئ. لا يمكن إضافة المزيد من الطلاب.');
                    }

                }
            }
        ],
        'father_id'=>['required',Rule::exists('parent_models','id')],
        'mother_id'=>['required',Rule::exists('parent_models','id')],

        // =====  Files Validation ===== //
        'student_image'=> ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
        'student_certificate'=> ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
        'additional_files' => ['sometimes','array'],
        'additional_files.*'=> ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
        'additional_files_name' => 'sometimes|array',
        'additional_files_name.*' => 'required_with:additional_files.*|string|max:255'

    ]);
        if ($validator->fails()) {
        return WebResponseClass::sendValidationError($validator);
    }
        $academic_no=$this->studentService->generateAcademicNumber();
        $student = Student::create([
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'academic_no' => $academic_no,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'national_id' => $request->national_id,
            'national_id_type' => $request->national_id_type,
            'nationality' => $request->nationality,
            'previous_school' => $request->previous_school,
            'enrollment_date' => now()->format('Y-m-d'),
            'is_active' => true,
            'folder_name' => $academic_no,
        ]);
        $student->parents()->attach($request->father_id, [
            'relationship' => 'father',
            'is_primary' => true 
        ]);
        $student->parents()->attach($request->mother_id, [
            'relationship' => 'father',
            'is_primary' => false 
        ]);
        if ($request->hasFile('student_image')) {
            $this->studentFileService->uploadFile(
                $student,
                $request->file('student_image'),
                 'photo',
                 'صورة الطالب',
                 auth()->user()->id,
                 'الصورة الشخصية للطالب'
            );
        }
        if($request->hasFile('student_certificate')){
            $this->studentFileService->uploadFile(
                $student,
                $request->file('student_certificate'),
                 'document',
                 'شهادة الطالب',
                 auth()->user()->id,
                 'شهادة الطالب الدراسية'
            );
        }

        if ($request->has('additional_files')) {
            foreach ($request->file('additional_files') as $index => $file) {
                if ($file) {
                    $fileName = $request->input("additional_files_name.{$index}", 'file_' . $index);
                    $this->studentFileService->uploadFile(
                        $student,
                        $file,
                        'other',
                        $fileName,
                        auth()->user()->id,
                        null
                    );
                }
            }
        }
        return WebResponseClass::sendResponse('تمت العملية بنجاح!' ,'تم إضافة الطالب بنجاح.',);
        
    }
    
}