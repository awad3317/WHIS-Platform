<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassModel;
use Carbon\Carbon;

class ClassModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = now()->year;
        $academicYear = "{$currentYear}-" . ($currentYear + 1);
        
        $classes = [
            [
                'name_ar' => 'الصف الأول - أ',
                'name_en' => 'First Grade - A',
                'grade_level' => 1,
                'section' => 'A',
                'capacity' => 30,
                'academic_year' => $academicYear,
                'is_active' => true,
            ],
            [
                'name_ar' => 'الصف الأول - ب',
                'name_en' => 'First Grade - B',
                'grade_level' => 1,
                'section' => 'B',
                'capacity' => 25,
                'academic_year' => $academicYear,
                'is_active' => true,
               
            ],
            [
                'name_ar' => 'الصف الثاني - أ',
                'name_en' => 'Second Grade - A',
                'grade_level' => 2,
                'section' => 'A',
                'capacity' => 28,
                'academic_year' => $academicYear,
                'is_active' => true,
                
            ],
            [
                'name_ar' => 'الصف الثاني - ب',
                'name_en' => 'Second Grade - B',
                'grade_level' => 2,
                'section' => 'B',
                'capacity' => 32,
                'academic_year' => $academicYear,
                'is_active' => true,
               
            ],
            [
                'name_ar' => 'الصف الثالث - أ',
                'name_en' => 'Third Grade - A',
                'grade_level' => 3,
                'section' => 'A',
                'capacity' => 26,
                'academic_year' => $academicYear,
                'is_active' => true,
                
            ],
            [
                'name_ar' => 'الصف الرابع - أ',
                'name_en' => 'Fourth Grade - A',
                'grade_level' => 4,
                'section' => 'A',
                'capacity' => 29,
                'academic_year' => $academicYear,
                'is_active' => false,
                
            ],
            [
                'name_ar' => 'الصف الخامس - أ',
                'name_en' => 'Fifth Grade - A',
                'grade_level' => 5,
                'section' => 'A',
                'capacity' => 27,
                'academic_year' => $academicYear,
                'is_active' => true,
                
            ],
            [
                'name_ar' => 'الصف السادس - أ',
                'name_en' => 'Sixth Grade - A',
                'grade_level' => 6,
                'section' => 'A',
                'capacity' => 31,
                'academic_year' => $academicYear,
                'is_active' => true,
            ],
        ];
        foreach ($classes as $class) {
            ClassModel::create($class);
        }
    }
}