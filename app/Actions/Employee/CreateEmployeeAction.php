<?php

namespace App\Actions\Employee;

use App\DTOs\EmployeeData;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CreateEmployeeAction
{
    public function __construct(protected EmployeeRepositoryInterface $employee_repository){}

    public function execute(EmployeeData $data): Employee
    {
      return $this->employee_repository->create([
        ...$data->toArray(),
        'tenant_id' => $data->tenantId ?? Auth::user()->tenant_id
      ]);
    }

}
