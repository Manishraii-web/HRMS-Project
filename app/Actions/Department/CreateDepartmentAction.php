<?php

namespace App\Actions\Department;

use App\DTOs\DepartmentData;
use App\Models\Department;
use App\Repositories\Contracts\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CreateDepartmentAction
{
    public function __construct(protected DepartmentRepositoryInterface $department_repository) { }

    public function execute(DepartmentData $data): Department
    {
        return $this->department_repository->create([...$data->toArray(),
        'tenant_id' => $data->tenantId ??  Auth::user()->tenant_id ?? 1,
       ]);
    }
}

