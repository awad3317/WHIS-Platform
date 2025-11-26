<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'phone' => ['required','string','max:20',Rule::unique(ParentModel::class, 'phone')],
            'email' => ['nullable','email','max:255',Rule::unique(ParentModel::class, 'email')],
            'national_id' => ['nullable','string','max:20',Rule::unique(ParentModel::class, 'national_id')],
            'job_title' => 'nullable|string|max:255',
            'workplace' => 'nullable|string|max:255',
            'mobile' => 'nullable|string|max:20',
            'gender' => ['required','in:male,female'],
        ]);

        try {
            $validated['is_active'] = true;
            $parent = ParentModel::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة ولي الأمر بنجاح',
                'parent' => [
                    'id' => $parent->id,
                    'name_ar' => $parent->name_ar,
                    'name_en' => $parent->name_en,
                    'phone' => $parent->phone
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء إضافة ولي الأمر: ' . $e->getMessage()
            ], 500);
        
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
