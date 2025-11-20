<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = 'parent_models';
    protected $fillable = [
        'name_ar',
        'name_en',
        'email',
        'national_id',
        'job_title',
        'workplace',
        'mobile',
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
}
