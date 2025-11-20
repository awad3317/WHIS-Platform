<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'class_models';
    protected $fillable = [
        'name_ar',
        'name_en',
        'grade_level',
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_student')
                    ->using(class_student::class)
                    ->withPivot('academic_year', 'status', 'enrollment_date', 'leave_date', 'notes')
                    ->withTimestamps();
    }
    // public function currentStudents()
    // {
    //     $currentYear = now()->year;
    //     $academicYear = "{$currentYear}-" . ($currentYear + 1);
        
    //     return $this->students()
    //                 ->wherePivot('academic_year', $academicYear)
    //                 ->wherePivot('status', 'active');
    // }

    public function enrollments()
    {
        return $this->hasMany(Class_student::class, 'class_id');
    }


}
