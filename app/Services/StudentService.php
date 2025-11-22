<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentService
{
    public function __construct()
    {
        //
    }

    public function generateAcademicNumber(): string
    {
        $currentYear = date('Y');
        $currentMonth = date('m');
    
        $lastStudent = Student::where('academic_no', 'like', "{$currentYear}{$currentMonth}%")
                        ->orderBy('academic_no', 'desc')
                        ->first();

        if ($lastStudent) {
            $lastNumber = (int)substr($lastStudent->academic_no, -4);
            $sequence = $lastNumber + 1;
        } else {
            $sequence = 1;
        }

        return $currentYear . $currentMonth . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    
}
