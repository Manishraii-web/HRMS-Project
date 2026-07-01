<?php

namespace App\Services\EmployeeDesignation;

use App\Actions\EmployeeDesignation\AssignDesignationAction;

class EmployeeDesignationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected AssignDesignationAction $assign_designation_action)
    { }

    public function execute(int $employeeId, int $designationId)
    {
        return $this->assign_designation_action->execute($employeeId, $designationId);
    }
}
