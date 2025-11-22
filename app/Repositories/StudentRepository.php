<?php 

namespace App\Repositories;

use App\Interfaces\RepositoriesInterface;
use App\Models\Student;

class StudentRepository implements RepositoriesInterface
{
/**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Student::paginate(10);
    }

    public function getById($id): Student
    {
        return Student::findOrFail($id);
    }

    public function store(array $data): Student
    {
        return Student::create($data);
    }

    public function update(array $data, $id): Student
    {
        $Student = Student::findOrFail($id);
        $Student->update($data);
        return $Student;
    }
    public function delete($id): bool
    {
        return Student::where('id', $id)->delete() > 0;
    }

    public function getByUserIdAndDriverId($userId, $driverId): ?Student
    {
        return Student::where('user_id', $userId)
            ->where('driver_id', $driverId)
            ->first();
    }
    public function generateAcademicNumber(): string
{
    $currentYear = date('Y');
    $currentMonth = date('m');
    
    $lastStudent = Student::where('academic_no', 'like', "{$currentYear}{$currentMonth}%")
                        ->orderBy('academic_no', 'desc')
                        ->first();

    if ($lastStudent) {
        $lastNumber = (int)substr($lastStudent->academic_no, -4);
        $sequence = $lastNumber + 1;
    } else {
        $sequence = 1;
    }

    return $currentYear . $currentMonth . str_pad($sequence, 4, '0', STR_PAD_LEFT);
}

}