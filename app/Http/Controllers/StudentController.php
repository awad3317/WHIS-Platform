<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Services\StudentFileService;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function __construct(private StudentFileService  $studentFileService)
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
        'name_en' => ['required', 'string', 'max:255'],
        'name_ar' => ['required', 'string', 'max:255'],
        'birth_date' => ['required', 'date'],
        'nationality' => ['required', 'string', 'max:100'],
        'previous_school' => ['required', 'string', 'max:255'],
        'class_id' => ['required',Rule::exists('class_models','id')],
        'Personal_photo'=> ['required', 'file', 'mimes:jpg,jpeg,png', 'max:2048'],
        'birth_certificate'=> ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:2048'],
    ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        } 

        // $filepath=$this->studentFileService->createStudentFolder($request->student);
        // dd($filepath);

        
    }
}