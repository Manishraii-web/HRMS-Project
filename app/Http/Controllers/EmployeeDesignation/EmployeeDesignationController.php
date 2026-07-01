<?php

namespace App\Http\Controllers\EmployeeDesignation;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeDesignation\AssignDesignationRequest;
use App\Services\EmployeeDesignation\EmployeeDesignationService;

class EmployeeDesignationController extends Controller
{
    public function __construct(protected EmployeeDesignationService $service)
    {}

    public function store(AssignDesignationRequest $request, int $employeeId)
    {
        $this->authorize('employees.update');
        $this->service->execute($employeeId, $request->integer('designation_id'));

        return redirect()->back()->with('success', 'Designation assigned successfully.');
    }
}
