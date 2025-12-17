<?php

namespace App\Models;

use App\Traits\HasUserAccount;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes, HasUserAccount;
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
        'national_id_type',
        'weekly_classes',
        'subjects',
        'is_active',
        'image',
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
        return $query->where('is_active', true)->whereNull('deleted_at');
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

    protected function createUserData(): array
    {
        return [
            'name'=>$this->name_ar,
            'phone' => $this->phone,
            'user_type' => 'employee',
            'is_active' => $this->is_active,
            'password' => $this->phone,
        ];
    }
    protected function updateUserData(): array
    {
        return [
            'name'=>$this->name_ar,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
        ];
    }

}
