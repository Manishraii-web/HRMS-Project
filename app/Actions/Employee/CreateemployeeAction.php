<?php

namespace App\Actions\Employee;

use App\DTOs\EmployeeDTO;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CreateemployeeAction
{
    public function __construct(protected EmployeeRepositoryInterface $employee_repository){}

    public function execute(EmployeeDTO $data): Employee
    {
      return $this->employee_repository->create([
        ...$data->toArray(),
        'tenant_id' => $data->tenantId ?? Auth::user()->tenant_id
      ]);
    }

}
