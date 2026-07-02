<?php

namespace App\Http\Controllers\EmployeeDesignation;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeDesignation\AssignDesignationRequest;
use App\Services\Employee\EmployeeService;
use App\Services\EmployeeDesignation\EmployeeDesignationService;

class EmployeeDesignationController extends Controller
{
    public function __construct(
        protected EmployeeDesignationService $service,
        protected EmployeeService $employeeService)
    {}

    public function store(AssignDesignationRequest $request, int $employee)
    {
        $employeeModel = $this->employeeService->find($employee);
        $this->authorize('update', $employeeModel);
        $this->service->execute($employee, $request->integer('designation_id'));

        return redirect()->back()->with('success', 'Designation assigned successfully.');
    }
}
