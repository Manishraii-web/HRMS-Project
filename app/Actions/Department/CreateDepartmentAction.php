<?php

namespace App\Actions\Department;

use App\DTOs\DepartmentData;
use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;

class CreateDepartmentAction
{
    public function __construct(protected DepartmentRepositoryInterface $department_repository) { }

    public function execute(DepartmentData $data): Department
    {
        return $this->department_repository->create($data->toArray());
    }
}

