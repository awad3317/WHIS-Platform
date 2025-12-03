<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Services\StudentService;
use Illuminate\Support\Facades\DB;
use App\Services\StudentFileService;
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
        $students = $this->studentRepository->index();
        return view('pages.studentes.index', compact('students'));
    }

    public function create()
    {
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
        $firstError = $validator->errors()->first();
        return redirect()->back()
                    ->withInput()
                    ->withErrors($validator)
                    ->with('error', true)
                    ->with('error_title', 'حدث خطأ!')
                    ->with('error_message', $firstError)
                    ->with('error_buttonText', 'حسناً');
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

        return redirect()->route('students.index')
            ->with('success', true)
            ->with('success_title', 'تمت العملية بنجاح!')
            ->with('success_message', 'تم إضافة الطالب بنجاح.')
            ->with('success_buttonText', 'حسناً');
        

        // $filepath=$this->studentFileService->createStudentFolder($request->student);
        // dd($filepath);

        
    }
}