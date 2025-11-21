<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassStudent extends Model
{
    use HasFactory;

    protected $table = 'class_students';
    protected $fillable = [
        'class_id',
        'student_id',
        'academic_year',
        'status',
        'enrollment_date',
        'leave_date',
        'notes',
    ];
    protected $casts = [
        'enrollment_date' => 'date',
        'leave_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];
    protected $attributes = [
        'status' => 'active'
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scopeForAcademicYear($query, $academicYear)
    {
        return $query->where('academic_year', $academicYear);
    }
        public function scopeForClass($query, $classId)
    {
        return $query->where('class_id', $classId);
    }
    public function scopeForStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }
    public function transferToClass($newClassId, $notes = null)
    {
        $this->update([
            'status' => 'transferred',
            'leave_date' => now(),
            'notes' => $notes ?: "تم النقل إلى فصل جديد"
        ]);

        return $this;
    }
    public function graduate($notes = null)
    {
        $this->update([
            'status' => 'graduated',
            'leave_date' => now(),
            'notes' => $notes ?: "تم التخرج"
        ]);

        return $this;
    }


}