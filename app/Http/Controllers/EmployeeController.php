<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {   $employees = Employee::all();
        return view('pages.employees.index', compact('employees'));
    }
    public function create()
    {
        return view('pages.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
    'name_ar' => ['required', 'string', 'max:100'],
    'name_en' => ['nullable', 'string', 'max:100'],
    'email' => ['nullable', 'email', 'max:100', Rule::unique('employees', 'email')],
    'national_id' => ['required', 'string', 'max:20', Rule::unique('employees', 'national_id')],
    'national_id_type' => ['required', Rule::in(['national_id', 'passport', 'residence_id'])],
    'job_title' => ['required', 'string', 'max:100'],
    'department' => ['required', Rule::in(['admin', 'teaching', 'support'])],
    'qualification' => ['nullable', 'string', 'max:100'],
    'graduation_year' => ['nullable', 'integer', 'min:1900', 'max:' . date('Y')],
    'phone' => ['nullable', 'string', 'max:20'],
    'salary' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
    'is_active' => ['boolean'],
    'weekly_classes' => ['nullable', 'integer', 'min:0'],
    'subjects' => ['nullable', 'array'],
    'subjects.*' => ['nullable', 'string'],
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



    try {
        $validated = $validator->validated();
        $employeeData = [
            'name_ar' => $validated['name_ar'],
            'name_en' => $validated['name_en'] ?? null,
            'email' => $validated['email'] ?? null,
            'national_id' => $validated['national_id'],
            'national_id_type' => $validated['national_id_type'],
            'job_title' => $validated['job_title'],
            'department' => $validated['department'],
            'qualification' => $validated['qualification'] ?? null,
            'graduation_year' => $validated['graduation_year'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ];

        if ($validated['department'] === 'teaching') {
            $employeeData['weekly_classes'] = $validated['weekly_classes'] ?? 0;
            
            if (!empty($validated['subjects'])) {
                $employeeData['subjects'] = json_encode($validated['subjects']);
            }
        } else {
            $employeeData['weekly_classes'] = 0;
            $employeeData['subjects'] = null;
        }
        $employee = Employee::create($employeeData);
        return redirect()->route('employees.index')
            ->with('success', true)
            ->with('success_title', 'تمت العملية بنجاح!')
            ->with('success_message', 'تم إضافة الموظف بنجاح.')
            ->with('success_buttonText', 'حسناً');

    } catch (\Exception $e) {
        
        return redirect()->back()
                    ->withInput()
                    ->with('error', true)
                    ->with('error_title', 'حدث خطأ!')
                    ->with('error_message', $e->getMessage())
                    ->with('error_buttonText', 'حسناً');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}