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
    //---------------------------------------------------------------------------------------------------------------
    public function index(Request $request)
    {
        $this->authorize('viewAny', Department::class);

        $departments= $this->department_service->list(search: $request->string('search')->toString(), perPage : 10,);

        return Inertia::render('Departments/Index', [
        'departments'=> DepartmentResources::collection($departments),
        'filters' => ['search' => $request->input('search','')],
        ]);

    }
//----------------------------------------------------------------------------------------------------------------------------
    public function create(): Response
    {
        $this->authorize('create',Department::class);
        return Inertia::render('Departments/Create');
    }
//-----------------------------------------------------------------------------------------------------------------------
   public function store(StoreDepartmentRequest $request)
{
    $dto = DepartmentData::fromArray(array_merge(
        $request->validated(),
        ['tenant_id' => $request->user()->tenant_id],
    ));

    $this->department_service->create($dto);
    return redirect()->route('departments.index')->with('success', 'Department created successfully.');
}
//---------------------------------------------------------------------------------------------------------------------
    public function show(int $id)
    {
       $department = $this->department_service->find($id);
       $this->authorize('view',$department);

       return Inertia::render('Departments/Show',[
        'department' => new DepartmentResources($department),
       ]);

    }
//--------------------------------------------------------------------------------------------------------------------------
    public function edit( int $id): Response
    {

        $department = $this->department_service->find($id);

        $this->authorize('update', $department);

        return Inertia::render('Departments/Edit', [
            'department' => new DepartmentResources($department),
        ]);
    }
//----------------------------------------------------------------------------------------------------------------------------------------------
    public function update(UpdateDepartmentRequest $request,  int $id)
    {
       $department = $this->department_service->find($id);
         $this->authorize('update', $department);

       $dto = DepartmentData::fromArray(array_merge(
        $request->validated(), ['tenant_id' => $request->user()->tenant_id],
       ));

       $this->department_service->update($department, $dto);
        return redirect()->route('departments.index')->with('success','Data Update Successfully');

    }
//------------------------------------------------------------------------------------------------------------------------------------------------
    public function destroy($id)
    {
       $department= $this->department_service->find($id);
       $this->authorize('delete', $department);

     $this->department_service->delete($department);
     return redirect()->route('departments.index')->with('success','Data delete Sucessfull');
    }
}
//--------------------------------------------------------------------------------------------------------------------------------

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
