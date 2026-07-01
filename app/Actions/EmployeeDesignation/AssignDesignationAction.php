<?php

namespace App\Actions\EmployeeDesignation;

use App\Models\EmployeeDesignation;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use App\Repositories\Contracts\EmployeeDesignationRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class AssignDesignationAction
{
    public function __construct(
        protected EmployeeDesignationRepositoryInterface $pivot_repository,
        protected EmployeeRepositoryInterface $employee_repository,
        protected DesignationRepositoryInterface $designation_repository
    )
    {}

    public function execute(int $employeeId, int $designationId) : EmployeeDesignation
    {
        $employee = $this->employee_repository->find($employeeId);
        $designation = $this->designation_repository->find($designationId);

        if( $employee->tenant_id  !== $designation->tenant_id) {
            throw ValidationException::withMessages([
                'designation_id' => ['The selected designation does not belong to the same tenant as the employee.'],
            ]);

        }
        return DB::transaction(function () use ($employee, $designation   ) {
            $currentDesignation = $this->pivot_repository->findCurrentForEmployee($employee->id);
            if ($currentDesignation && $currentDesignation->designation_id === $designation->id) {
                return $currentDesignation;
            }
             if ($currentDesignation) {
                $this->pivot_repository->close($currentDesignation, now());
            }

            return $this->pivot_repository->create([
                'tenant_id' => $employee->tenant_id,
                'employee_id' => $employee->id,
                'designation_id' => $designation->id,
                'from_date' => now(),
                'to_date' => null
            ]);
        });


    }


}

