<?php

namespace App\Http\Controllers\Employee;

use App\DTOs\EmployeeData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Services\Employee\EmployeeService;
use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $employeeService,
        protected DepartmentService $departmentService,
    ) {}

    public function index(Request $request)
    {
        $this->authorize('viewAny', Employee::class);

        $employees = $this->employeeService->list(
            search: $request->string('search')->toString(),
            departmentId: $request->integer('department_id') ?: null,
            perPage: 10,
        );

        return Inertia::render('Employees/Index', [
            'employees'   => EmployeeResource::collection($employees),
            'departments' => $this->departmentService->options($request->user()->tenant_id),
            'filters'     => [
                'search'        => $request->input('search', ''),
                'department_id' => $request->input('department_id', ''),
            ],
        ]);
    }

    public function create()
    {
        $this->authorize('create', Employee::class);

        return Inertia::render('Employees/Create', [
            'departments' => $this->departmentService->options(Auth::user()->tenant_id),
        ]);
    }

    public function store(StoreEmployeeRequest $request)
    {
          $dto = EmployeeData::fromArray(array_merge(
            $request->validated(),
            ['tenant_id' => $request->user()->tenant_id],
        ));

        $this->employeeService->store($dto);
        return redirect()->route('employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(int $id)
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('view', $employee);

        return Inertia::render('Employees/Show', [
            'employee' => new EmployeeResource($employee),
        ]);
    }

    public function edit(int $id)
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('update', $employee);

        return Inertia::render('Employees/Edit', [
            'employee'    => new EmployeeResource($employee),
            'departments' => $this->departmentService->options(Auth::user()->tenant_id),
        ]);
    }

    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('update', $employee);

        $dto = EmployeeData::fromArray(array_merge(
            $request->validated(),
            ['tenant_id' => $request->user()->tenant_id],
        ));

        $this->employeeService->update($employee, $dto);

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(int $id)
    {
        $employee = $this->employeeService->find($id);
        $this->authorize('delete', $employee);

        $this->employeeService->delete($employee);

        return redirect()->route('employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
