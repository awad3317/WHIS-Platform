<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'national_id',
        'job_title',
        'department',
        'qualification',
        'graduation_year',
        'phone',
        'salary',
        'id_type',
        'weekly_classes',
        'subjects',
        'is_active',
        'user_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $attributes = [
        'is_active' => true,
        'id_type' => 'national_id',
        'weekly_classes' => 0
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function getDepartmentNameAttribute()
    {
        return match($this->department) {
            'admin' => 'إداري',
            'teaching' => 'تدريسي',
            'support' => 'دعم فني',
            default => 'غير محدد'
        };
    }
    public function getIdTypeTextAttribute()
    {
        return match($this->id_type) {
            'national_id' => 'هوية وطنية',
            'passport' => 'جواز سفر',
            'residence_id' => 'إقامة',
            default => 'غير محدد'
        };
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeInDepartment($query, $department)
    {
        return $query->where('department', $department);
    }
    public function addSubject(string $subject)
    {
        $subjects = $this->subjects ?? [];
        if (!in_array($subject, $subjects)) {
            $subjects[] = $subject;
            $this->update(['subjects' => $subjects]);
        }
    }
    public function removeSubject(string $subject)
    {
        $subjects = $this->subjects ?? [];
        $key = array_search($subject, $subjects);
        if ($key !== false) {
            unset($subjects[$key]);
            $this->update(['subjects' => array_values($subjects)]);
        }
    }

}
