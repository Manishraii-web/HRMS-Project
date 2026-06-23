<?php

namespace App\Http\Controllers\Employee;

use App\Actions\Employee\UpdateEmployeeAction;
use App\DTOs\EmployeeData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Department;
use App\Models\Employee;
use App\Services\Employee\EmployeeService;
use Illuminate\Http\Request;
use Inertia\Inertia;


class EmployeeController extends Controller
{

   public function __construct(protected EmployeeService $employeeService){}
   public function index(Request $request) {
    $this->authorize('viewAny','Employee::class');

    $employees = $this->employeeService->list(
        search: $request->string('search')->toString(),
        departmentId: $request->integer('department_id') ?: null,
         perPage: 10,);

    return Inertia::render('Employees/Index', [
        'employees' => EmployeeResource::collection($employees),
        'departments' =>Department::query()->select('id','name')->orderBy('name')->get(),
        'filters' => [
            'search' => $request->input('search',''),
            'department_id' => $request->input('department_id',''),
           ],
    ]);

   }
   //-------------------------------------------------------------------------------------------------
   public function create()
   {
    $this->authorize('create','Employee::class');
    return Inertia::render('Employees/Create',[
        'departments'=> Department::query()->select('id','name')->orderBy('name')->get(),
    ]);
   }

   public function store(StoreEmployeeRequest $request)
   {
    $this->employeeService->create(EmployeeData::fromArray($request->validated()));
    return redirect()
    ->route('employees.index')->with('success','Employeee created Succssfully');
   }

   public function show(Employee $employee)
   {
    $this->authorize('view','Employee::class');
    return Inertia::render('Employees/Show',
    ['employee' => new EmployeeResource($employee->load('department')),
    ]);
   }

   public function edit(Employee $employee){
    $this->authorize('update','Employee::class');
    return Inertia::render('Employees/Edit', [
        'employee' => new EmployeeResource($employee->load('department')),
                'departments'=> Department::query()->select('id','name')->orderBy('name')->get(),

    ]);
   }

   public function update(UpdateEmployeeRequest $request, Employee $employee)
   {
    $this->employeeService->update($employee, EmployeeData::fromArray($request->validated()));
    return redirect()->route('employees.index')->with('success',' Employee Data update Successfully..');
   }

   public function destroy(Employee $employee)
   {
    $this->authorize('delete','Employee::class');
     $this->employeeService->delete($employee);
     return redirect()->route('employees.index')->with('success', 'Data Deleted Successfully');
   }

}

