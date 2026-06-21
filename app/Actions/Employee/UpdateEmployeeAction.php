<?php

namespace App\Actions\Employee;

use App\DTOs\EmployeeData;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class UpdateEmployeeAction
{
    public function __construct(protected EmployeeRepositoryInterface $employee_repository){}
    public function execute(Employee $employee, EmployeeData $data): Employee{
        return $this->employee_repository->update($employee, $data->toArray());
    }
}
