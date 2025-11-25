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
        'section',
        'capacity',
        'academic_year',
        'is_active',
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'class_students')
                    ->using(ClassStudent::class)
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
        return $this->hasMany(ClassStudent::class, 'class_id');
    }


}