<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'students';
    protected $fillable = [
        'academic_no',
        'name_ar',
        'name_en',
        'birth_date',
        'gender',
        'national_id',
        'national_id_type',
        'nationality',
        'previous_school',
        'enrollment_date',
        'is_active',
        'folder_name',
    ];
    
    public function classes()
    {
        return $this->belongsToMany(ClassModel::class, 'class_students', 'student_id', 'class_id')
            ->using(ClassStudent::class)
            ->withPivot('academic_year', 'status', 'enrollment_date', 'leave_date', 'notes')
            ->withTimestamps();
    }
    

    public function files()
    {
        return $this->hasMany(StudentFile::class);
    }

    public function parents()
    {
        return $this->belongsToMany(ParentModel::class, 'student_parents', 'student_id', 'parent_id')
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
    public function getGenderAttribute($value)
    {
        return trans("messages.gender.{$value}");
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
        return $this->hasMany(ClassStudent::class);
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
}
