<?php

namespace App\Actions\Department;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;

class DeleteDepartmentAction
{
    public function __construct(protected DepartmentRepositoryInterface $department_repository){ }

    public function execute(Department $department): bool
    {
       return $this->department_repository->delete($department);
    }
}
