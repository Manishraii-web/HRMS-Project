<?php

namespace App\Services\Department;

use App\Models\Department;
use App\Actions\Department\CreateDepartmentAction;
use App\Actions\Department\DeleteDepartmentAction;
use App\Actions\Department\UpdateDepartmentAction;
use App\DTOs\DepartmentData;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class DepartmentService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DepartmentRepositoryInterface $department_repository,
        protected CreateDepartmentAction $createAction,
        protected UpdateDepartmentAction $updateAction,
        protected DeleteDepartmentAction $deleteAction )
    {  }

    public function list(string $search='', int $perPage =15 ) : LengthAwarePaginator
    {
        return $this->department_repository->paginate(
            filters :['search'=> $search],
            perPage: $perPage,
        );
    }
    public function find(int $id): Department
    {
        return $this->department_repository->findOrFail($id);
    }
    public function create(DepartmentData $data):  Department
    {
        return $this->createAction->execute($data);
    }

    public function update(Department $department, DepartmentData $data) :Department
    {
      return $this->updateAction->execute($department, $data);
    }

    public function delete(Department $department): bool{
        return $this->deleteAction->execute($department);
    }


}
