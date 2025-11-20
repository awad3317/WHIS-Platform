<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    
    protected $table = 'attendances';

    protected $fillable = [
        'student_id',
        'employee_id',
        'date',
        'status',
        'notes',
        'recorded_by',
    ];
     protected $casts = [
        'date' => 'date',
        'student_id' => 'integer',
        'employee_id' => 'integer',
        'recorded_by' => 'integer'
    ];
     protected $hidden = [
        'created_at',
        'updated_at'
    ];
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
     public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'present' => 'حاضر',
            'absent' => 'غائب',
            'late' => 'متأخر',
            'excused' => 'معذور',
            default => 'غير محدد'
        };
    }
    public function scopeStudents($query)
    {
        return $query->whereNotNull('student_id');
    }
    public function scopeEmployees($query)
    {
        return $query->whereNotNull('employee_id');
    }
    public function scopeForDate($query, $date)
    {
        return $query->where('date', $date);
    }
    public function scopeWithStatus($query, $status)
    {
        return $query->where('status', $status);
    }
    public function scopeBetweenDates($query, $startDate, $endDate)
    {
        return $query->whereBetween('date', [$startDate, $endDate]);
    }

}
