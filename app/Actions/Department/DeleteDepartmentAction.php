<?php

namespace App\Actions\Department;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteDepartmentAction
{
    public function __construct(protected DepartmentRepositoryInterface $department_repository){ }

    public function execute(Department $department): bool
    {
        return DB::transaction(function () use ($department) {
            $department->employees()->get()->each(fn ($employee) => $employee->delete());

            return $this->department_repository->delete($department);
             });
    }
}
