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
        return view('pages.studentes.index');
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
        'name_en' => ['required', 'string', 'max:255'],
        'name_ar' => ['required', 'string', 'max:255'],
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
                    $currentStudents = $class->students()->wherePivot('status', 'active') ->count();
                    if ($currentStudents >= $class->capacity) {
                        $fail('هذا الفصل ممتلئ. لا يمكن إضافة المزيد من الطلاب.');
                    }

                }
            }
        ],

        // =====  Files Validation ===== //
        'Personal_photo'=> ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
        'birth_certificate'=> ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
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
            'is_active' => true,
        ]);
        if($request->filled('parent_id')){
            $student->parents()->attach($request->parent_id, [
                'relationship' => 'father',
                'is_primary' => true
            ]);
        }
        if($request->filled('mother_id')){
            $student->parents()->attach($request->mother_id, [
                'relationship' => 'mother',
                'is_primary' => false
            ]);
        }
        

        // $filepath=$this->studentFileService->createStudentFolder($request->student);
        // dd($filepath);

        
    }
}