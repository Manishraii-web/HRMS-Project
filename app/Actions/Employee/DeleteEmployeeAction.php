<?php

namespace App\Actions\Employee;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class DeleteEmployeeAction
{
    public function __construct(protected EmployeeRepositoryInterface $employee_repository){}
    public function execute(Employee $employee)
    {
        return $this->employee_repository->delete($employee);
    }
}
