<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'academic_no',
        'name_ar',
        'name_en',
        'birth_date',
        'gender',
        'national_id',
        'enrollment_date',
        'is_active',
    ];
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_student')
                    ->using(Class_student::class)
                    ->withPivot('academic_year', 'status', 'enrollment_date', 'leave_date', 'notes')
                    ->withTimestamps();
    }

    public function files()
    {
        return $this->hasMany(Student_file::class);
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'student_parents')
                    ->withPivot('relationship', 'is_primary')
                    ->withTimestamps();
    }
    public function primaryParent()
    {
        return $this->parents()
                    ->wherePivot('is_primary', true)
                    ->first();
    }
    public function father()
    {
        return $this->parents()
                    ->wherePivot('relationship', 'father')
                    ->first();
    }
    public function mother()
    {
        return $this->parents()
                    ->wherePivot('relationship', 'mother')
                    ->first();
    }
    // public function currentClass()
    // {
    //     $currentYear = now()->year;
    //     $academicYear = "{$currentYear}-" . ($currentYear + 1);
        
    //     return $this->classes()
    //                 ->wherePivot('academic_year', $academicYear)
    //                 ->wherePivot('status', 'active')
    //                 ->first();
    // }
    public function enrollmentHistory()
    {
        return $this->hasMany(Class_student::class);
    }

}
