<?php 

namespace App\Repositories;

use App\Interfaces\RepositoriesInterface;
use App\Models\ClassModel;

class ClassModelRepository implements RepositoriesInterface
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
        return ClassModel::paginate(10);
    }

    public function getById($id): ClassModel
    {
        return ClassModel::findOrFail($id);
    }

    public function store(array $data): ClassModel
    {
        return ClassModel::create($data);
    }

    public function update(array $data, $id): ClassModel
    {
        $ClassModel = ClassModel::findOrFail($id);
        $ClassModel->update($data);
        return $ClassModel;
    }
    public function delete($id): bool
    {
        return ClassModel::where('id', $id)->delete() > 0;
    }    

}