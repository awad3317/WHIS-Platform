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
use App\Models\ParentModel;



class StudentController extends Controller
{
    public function __construct(
        private StudentFileService $studentFileService,
        private StudentRepository $studentRepository,
        private StudentService $studentService,
        private ClassModelRepository $classModelRepository
    ) {}
    public function index()
    {
        if (!Auth::user()->hasPermission('view_students')) {
            return WebResponseClass::sendError('ليس لديك صلاحية عرض الطلاب.', 'صلاحية مفقودة!');
        }
        $students = $this->studentRepository->index();

        $photos = [];
        foreach ($students as $student) {
            $photo = $student->files->where('file_type', 'photo')->first();
            $studentFile = $student->files->where('file_type', 'photo')->first();
            $base64 = 'data:image/jpeg;base64,' . $this->studentFileService->getFileBase64($studentFile);
            $photos[$student->id] = [
                'data' => $base64,
                'has_photo' => true,
            ];
        }

        return view('pages.studentes.index', compact('students', 'photos'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('create_student')) {
            return WebResponseClass::sendError('ليس لديك صلاحية إضافة طالب جديد.', 'صلاحية مفقودة!');
        }
        $classes = ClassModel::where('is_active', 1)->get();

        return view('pages.studentes.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // =====  Student Info Validation ===== //
            'name_en' => ['required', 'string', 'max:255', Rule::unique('students', 'name_en')],
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('students', 'name_ar')],
            'birth_date' => ['required', 'date'],
            'nationality' => ['required', 'string', 'max:100'],
            'national_id' => ['required', 'string', 'max:20', Rule::unique('students', 'national_id')],
            'national_id_type' => ['required', Rule::in(['national_id', 'passport', 'residence_id'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'previous_school' => ['required', 'string', 'max:255'],
            'class_id' => [
                'required',
                Rule::exists('class_models', 'id'),
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
            'father_id' => ['required', Rule::exists('parent_models', 'id')],
            'mother_id' => ['required', Rule::exists('parent_models', 'id')],

            // =====  Files Validation ===== //
            'student_image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
            'student_certificate' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
            'additional_files' => ['sometimes', 'array'],
            'additional_files.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:5120'],
            'additional_files_name' => 'sometimes|array',
            'additional_files_name.*' => 'required_with:additional_files.*|string|max:255'

        ]);
        if ($validator->fails()) {
            return WebResponseClass::sendValidationError($validator);
        }
        $academic_no = $this->studentService->generateAcademicNumber();
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
            'relationship' => 'mother',
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
        if ($request->hasFile('student_certificate')) {
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
        return WebResponseClass::sendResponse('تمت العملية بنجاح!', 'تم إضافة الطالب بنجاح.',);
    }

    public function show($id)
    {
        $student = $this->studentRepository->getById($id);
        if (!$student) {
            return redirect()->back()->with('error', 'الطالب غير موجود!');
        }
        $studentFile = $student->files->where('file_type', 'photo')->first();
        $photo = 'data:image/jpeg;base64,' . $this->studentFileService->getFileBase64($studentFile);
        return view('pages.studentes.show', compact('student', 'photo'));
    }

    public function edit($id)
    {
        $student = $this->studentRepository->getById($id);
        if (!$student) {
            return redirect()->back()->with('error', 'الطالب غير موجود!');
        }
        $classes = ClassModel::where('is_active', 1)->get();
        return redirect()->back()
                ->with('openModalEdit',true)
                ->with('student', $student);
        // return view('pages.studentes.edit', compact('student', 'classes'));
    }
    public function update(Request $request, $id)
    {

        $student = $this->studentRepository->getById($id);
        if (!$student) {
            return WebResponseClass::sendError('الطالب غير موجود!', 'خطأ!');
        }

        $validator = Validator::make($request->all(), [
            // =====  Student Info Validation ===== //
            'name_en' => ['required', 'string', 'max:255', Rule::unique('students', 'name_en')->ignore($student->id)],
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('students', 'name_ar')->ignore($student->id)],
            'birth_date' => ['required', 'date'],
            'nationality' => ['required', 'string', 'max:100'],
            'national_id' => ['required', 'string', 'max:20', Rule::unique('students', 'national_id')->ignore($student->id)],
            'national_id_type' => ['required', Rule::in(['national_id', 'passport', 'residence_id'])],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'previous_school' => ['required', 'string', 'max:255'],
            'enrollment_date' => ['required', 'date'],
            'is_active' => ['required', Rule::in([0, 1])],
        ]);

        if ($validator->fails()) {
            return WebResponseClass::sendError('خطأ في إدخال البيانات!', $validator->errors()->first());
        }

        $this->studentRepository->update($request->all(), $id);

        return WebResponseClass::sendResponse('تم تحديث البيانات بنجاح!', 'تم تحديث بيانات الطالب بنجاح.');
    }


public function updateParent(Request $request, Student $student, ParentModel $parent)
{
    // ✅ تحقق أنه مرتبط بهذا الطالب
    if (!$student->parents()->whereKey($parent->id)->exists()) {
        return WebResponseClass::sendError('ولي الأمر غير مرتبط بهذا الطالب!', 'خطأ!');
    }

    $validator = Validator::make($request->all(), [
        'name_ar'      => ['required', 'string', 'max:255'],
        'name_en'      => ['nullable', 'string', 'max:255'],
        'phone'        => ['required', 'string', 'max:50'],
        'email'        => ['nullable', 'email', 'max:255'],
        'national_id'  => ['nullable', 'string', 'max:50'],
        'job_title'    => ['nullable', 'string', 'max:255'],
        'workplace'    => ['nullable', 'string', 'max:255'],
        'mobile'       => ['nullable', 'string', 'max:50'],
        'relationship' => ['nullable', Rule::in(['father','mother','guardian'])],
        'gender'       => ['nullable', Rule::in(['male','female'])],
    ]);

    if ($validator->fails()) {
        return WebResponseClass::sendError('خطأ في إدخال البيانات!', $validator->errors()->first());
    }

    // ✅ تحديث بيانات ولي الأمر
    $parent->update($request->only([
        'name_ar','name_en','phone','email','national_id','job_title','workplace','mobile','gender'
    ]));

    // ✅ تحديث العلاقة في pivot (اختياري)
    if ($request->filled('relationship')) {
        $student->parents()->updateExistingPivot($parent->id, [
            'relationship' => $request->relationship
        ]);
    }

    return WebResponseClass::sendResponse('تم تحديث ولي الأمر بنجاح!', 'تم التحديث بنجاح.');
}


// public function updateFile(Request $request, Student $student, StudentFile $file)
// {
//     if ((int) $file->student_id !== (int) $student->id) {
//         return WebResponseClass::sendError('هذا الملف لا يتبع هذا الطالب!', 'خطأ!');
//     }

//     $validator = Validator::make($request->all(), [
//         'file_type'    => ['nullable','string','max:100'],
//         'description'  => ['nullable','string','max:255'],
//         'new_file'     => ['nullable','file','max:10240'], // 10MB
//     ]);

//     if ($validator->fails()) {
//         return WebResponseClass::sendError('خطأ في إدخال البيانات!', $validator->errors()->first());
//     }

//     // تحديث البيانات النصية
//     $file->file_type   = $request->file_type;
//     $file->description = $request->description;

//     // استبدال الملف
//     if ($request->hasFile('new_file')) {
//         $uploaded = $request->file('new_file');
//         $path = $uploaded->store('students/files', 'public');

//         // أنت عندك file_name و file_path، اختر واحد
//         $file->file_name = basename($path);
//         $file->file_path = $path;
//     }

//     $file->save();

//     return WebResponseClass::sendResponse('تم تحديث الملف بنجاح!', 'تم التحديث بنجاح.');
// }

    public function downloadStudentFile($fileId)
    {
        try {
            $studentFile = $this->studentFileService->getById($fileId);

            return $this->studentFileService->downloadFile($studentFile);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء تنزيل الملف: ' . $e->getMessage());
        }
    }
    public function viewStudentFile($fileId)
    {
        try {
            $studentFile = $this->studentFileService->getById($fileId);
            if (!$studentFile) {
                return redirect()->back()->with('error', 'الملف غير موجود!');
            }

            return $this->studentFileService->viewFile($studentFile);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ أثناء عرض الملف: ' . $e->getMessage());
        }
    }
}