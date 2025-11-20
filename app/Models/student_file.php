<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_file extends Model
{
    use HasFactory;
    protected $table = 'student_files';
    protected $fillable = [
        'student_id',
        'file_type',
        'file_name',
        'file_path',
        'description',
        'uploaded_by',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
