<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ParentModel;
use App\Models\StudentParent;
use App\Models\ClassStudent;
use App\Models\StudentFile;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class StudentsRegisterController extends Controller
{
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

        /* ======================
           VALIDATION
        ====================== */

        $request->validate([

            /** Student **/
            'academic_no'       => ['required','string','max:50','unique:students,academic_no'],
            'name_ar'           => ['required','string','max:100'],
            'name_en'           => ['required','string','max:100'],
            'birth_date'         => ['nullable','date'],
            'gender'            => ['required', Rule::in(['male','female'])],
            'national_id'        => ['nullable','string','max:20'],
            'national_id_type'  => ['required', Rule::in(['national_id','passport','residence_id'])],
            'nationality'        => ['required','string','max:100'],
            'previous_school'    => ['nullable','string','max:200'],
            'class_id'           => ['required','exists:class_models,id'],
            'enrollment_date'    => ['required','date'],

            /** Father **/
            'father_name_ar'     => ['required','string','max:100'],
            'father_phone'       => ['required','string','max:20','unique:parent_models,phone'],
            'father_national_id' => ['required','string','max:20','unique:parent_models,national_id'],
            'father_email'        => ['nullable','email'],
            'father_job'          => ['nullable','string','max:100'],
            'father_workplace'    => ['nullable','string','max:150'],

            /** Mother **/
            'mother_name_ar'     => ['required','string','max:100'],
            'mother_phone'       => ['required','string','max:20','unique:parent_models,phone'],
            'mother_national_id' => ['required','string','max:20','unique:parent_models,national_id'],
            'mother_email'        => ['nullable','email'],
            'mother_job'          => ['nullable','string','max:100'],
            'mother_workplace'    => ['nullable','string','max:150'],

            /** Files **/
            'files.*' => ['nullable','file','mimes:jpg,jpeg,png,pdf','max:4096'],

        ]);


        DB::beginTransaction();

        try {

            /* =======================
               CHECK CLASS CAPACITY
            ======================= */

            $class = ClassModel::findOrFail($request->class_id);

            $count = ClassStudent::where('class_id', $class->id)
                ->where('academic_year', $class->academic_year)
                ->count();

            if ($count >= $class->capacity) {
                return back()->withErrors(['class_id' => 'This class is already full'])->withInput();
            }


            /* =======================
               CREATE STUDENT
            ======================= */

            $student = Student::create([
                'academic_no'       => $request->academic_no,
                'name_ar'            => $request->name_ar,
                'name_en'            => $request->name_en,
                'birth_date'          => $request->birth_date,
                'gender'             => $request->gender,
                'national_id'        => $request->national_id,
                'national_id_type'   => $request->national_id_type,
                'nationality'        => $request->nationality,
                'previous_school'    => $request->previous_school,
                'enrollment_date'     => now(),
                'is_active'          => true,
            ]);


            /* =======================
               CREATE FATHER
            ======================= */

            $father = ParentModel::create([
                'name_ar'     => $request->father_name_ar,
                'phone'       => $request->father_phone,
                'national_id' => $request->father_national_id,
                'email'       => $request->father_email,
                'job_title'   => $request->father_job,
                'workplace'   => $request->father_workplace,
                'is_active'   => 1
            ]);

            StudentParent::create([
                'student_id'   => $student->id,
                'parent_id'    => $father->id,
                'relationship' => 'father',
                'is_primary'   => true
            ]);


            /* =======================
               CREATE MOTHER
            ======================= */

            $mother = ParentModel::create([
                'name_ar'     => $request->mother_name_ar,
                'phone'       => $request->mother_phone,
                'national_id' => $request->mother_national_id,
                'email'       => $request->mother_email,
                'job_title'   => $request->mother_job,
                'workplace'   => $request->mother_workplace,
                'is_active'   => 1
            ]);

            StudentParent::create([
                'student_id'   => $student->id,
                'parent_id'    => $mother->id,
                'relationship' => 'mother',
                'is_primary'   => false
            ]);


            /* =======================
               ADD TO CLASS
            ======================= */

            ClassStudent::create([
                'student_id'      => $student->id,
                'class_id'        => $class->id,
                'academic_year'   => $class->academic_year,
                'status'          => 'active',
                'enrollment_date' => now()
            ]);


            /* =======================
               FILE UPLOAD
            ======================= */

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {

                    $path = $file->store('students/' . $student->academic_no);

                    StudentFile::create([
                        'student_id'  => $student->id,
                        'file_type'   => 'document',
                        'file_name'   => $file->getClientOriginalName(),
                        'file_path'   => $path,
                        'description' => 'Student document',
                        'uploaded_by' => 1
                    ]);
                }
            }


            DB::commit();

            return redirect()
                ->route('students.create')
                ->with('success', 'Student registered successfully ✅');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withErrors($e->getMessage())
                ->withInput();
        }
    }
}