<?php

namespace App\Models;

use App\Traits\HasUserAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentModel extends Model
{
    use HasFactory, SoftDeletes, HasUserAccount;
    protected $table = 'parent_models';
    protected $fillable = [
        'name_ar',
        'name_en',
        'phone',
        'email',
        'national_id',
        'job_title',
        'workplace',
        'mobile',
        'is_active',
        'user_id',
        'gender',
        'image',
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_parents')
                    ->withPivot('relationship', 'is_primary')
                    ->withTimestamps();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeActive($query)
    {
        return $query->whereNull('deleted_at');
    }
    protected function createUserData(): array
    {
        return [
            'name' => $this->name_ar,
            'phone' => $this->phone,
            'password' => $this->phone,
            'user_type' => 'parent',
            'is_active' => $this->is_active,
        ];
    }
    protected function updateUserData(): array
    {
        return [
            'name' => $this->name_ar,
            'phone' => $this->phone,
            'is_active' => $this->is_active,
        ];
    }
}
