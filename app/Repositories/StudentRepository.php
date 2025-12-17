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
            return Student::with(['classes','parents','files'])->paginate(10);
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
    

}