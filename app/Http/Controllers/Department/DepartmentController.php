<?php

namespace App\Http\Controllers\Department;

use App\DTOs\DepartmentData;
use App\Http\Controllers\Controller;
use App\Services\Department\DepartmentService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\DepartmentRequest\StoreDepartmentRequest;
use App\Http\Requests\DepartmentRequest\UpdateDepartmentRequest;
use App\Http\Resources\Department\DepartmentResources;
use App\Models\Department;
use Inertia\Response;

class DepartmentController extends Controller
{
    public function __construct(protected DepartmentService $department_service)
    { }
    public function index(Request $request)
    {
        $departments= $this->department_service->list(search: $request->string('search')->toString(), perPage : 10,);

        return Inertia::render('Departments/Index', [
        'departments'=> DepartmentResources::collection($departments),
        'filters' => ['search' => $request->input('search','')],
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Departments/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $this->department_service->create(DepartmentData::fromArray($request->validated()));
        return redirect()->route('departments.index')->with('success','Department Created Successfullyy.');
            }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
       return Inertia::render('Departments/Show',['departments'=> new DepartmentResources($department)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): Response
    {
        return Inertia::render('Departments/Edit', [
            'department' => new DepartmentResources($department),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request,  Department $department)
    {
        $this->department_service->update($department, DepartmentData::fromArray($request->validated()));
        return redirect()->route('departments.index')->with('success','Data Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
     $this->department_service->delete($department);
     return redirect()->route('departments.index')->with('success','Data delete Sucessfull');
    }
}


// public function index(Request $request)   //JSON
// {
//     $departments = $this->department_service->list(
//         search: $request->string('search')->toString(),
//         perPage: 10,
//     );

//     return response()->json($departments);
// }

// public function store(StoreDepartmentRequest $request)
// {
//     $department = $this->department_service->create(
//         DepartmentData::fromArray($request->validated())
//     );

//     return response()->json($department, 201);
// }

// public function show(Department $department)
// {
//     return response()->json(new DepartmentResources($department));
// }

// public function update(UpdateDepartmentRequest $request, Department $department)
// {
//     $updated = $this->department_service->update(
//         $department->id,
//         DepartmentData::fromArray($request->validated())
//     );

//     return response()->json($updated);
// }

// public function destroy(Department $department)
// {
//     $this->department_service->delete($department->id);

//     return response()->json(['message' => 'Department deleted successfully.']);
// }
// }
