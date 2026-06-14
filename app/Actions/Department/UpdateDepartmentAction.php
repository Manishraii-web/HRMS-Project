<?php

namespace App\Actions\Department;

use App\DTOs\DepartmentData;
use App\Models\Department;
use App\Repositories\DepartmentRepository;

class UpdateDepartmentAction
{
    public function __construct(protected DepartmentRepository $department_repository){}

    public function execute(Department $department, DepartmentData $data): Department
    {

    return $this->department_repository->update($department, $data->toArray());
    }
}
