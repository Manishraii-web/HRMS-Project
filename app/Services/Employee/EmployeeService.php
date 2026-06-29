<?php

namespace App\Services\Employee;

use App\Actions\Employee\UpdateEmployeeAction;
use App\Actions\Employee\CreateEmployeeAction;
use App\Actions\Employee\DeleteEmployeeAction;
use App\DTOs\EmployeeData;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepositoryInterface $employee_repository,
        protected CreateEmployeeAction $createEmployeeAction,
        protected UpdateEmployeeAction $updateEmployeeAction,
        protected DeleteEmployeeAction $deleteEmployeeAction
    ) {}

    public function list(string $search = '', ?int  $departmentId = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->employee_repository->paginate(
            filters: [
                'search' => $search,
                'department_id' => $departmentId,
            ],
            perPage: $perPage,
        );
    }
    public function find(int $id): Employee
    {
        return $this->employee_repository->findOrFail($id);
    }
    public function store(EmployeeData $data)
    {
        try {
            $employee = $this->createEmployeeAction->execute($data);
            return new EmployeeResource($employee);
        } catch (Exception $e) {
            throw $e;
            return false;
        }
    }

    public function update(Employee $employee, EmployeeData $data): Employee
    {
        return $this->updateEmployeeAction->execute($employee, $data);
    }

    public function delete(Employee $employee)
    {
        return $this->deleteEmployeeAction->execute($employee);
    }
}
