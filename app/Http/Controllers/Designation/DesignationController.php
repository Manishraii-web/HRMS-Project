<?php

namespace App\Http\Controllers\Designation;

use App\DTOs\DesignationData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Designation\StoreDesignationRequest;
use App\Http\Requests\Designation\UpdateDesignationRequest;
use App\Http\Resources\Designation\DesignationResource;
use App\Models\Designation;
use App\Services\Designation\DesignationService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DesignationController extends Controller
{
   public function __construct(protected DesignationService $designation_service)
   {}

   public function index(Request $request){
    $this->authorize('viewAny', Designation::class);

    $designations = $this->designation_service->list(search: $request->string('search')->toString(), perPage : 10,);
    return Inertia::render('Designations/Index', [
        'designations' => DesignationResource::collection($designations),
        'filters' => ['search' => $request->input('search', '')],
    ]);
    }
    //-----------------------------------------------------------------------------------------------------------------------------
    public function create() {
        $this->authorize('create', Designation::class);
        return Inertia::render('Designations/Create');
    }
    //-----------------------------------------------------------------------------
    public function store(StoreDesignationRequest $request) {
        $dto = DesignationData::fromArray(array_merge(
            $request->validated(),
            ['tenant_id' => $request->user()->tenant_id],
        ));
        $this->designation_service->create($dto);
        return redirect()->route('designations.index')->with('success','Designation Created Successfullyy..');
    }
    //----------------------------------------------------------------------------------------------------------------------
    public function show(int $id) {
        $designation = $this->designation_service->find($id);
        $this->authorize('view', $designation);

        return Inertia::render('Designations/Show',[
            'designation' => new DesignationResource($designation),
        ]);
    }
    //--------------------------------------------------------------------------------------------------------------------

    public function edit(int $id): Response {
        $designation = $this->designation_service->find($id);
        $this->authorize('update', $designation);

        return Inertia::render('Designations/Edit',[
            'designation' => new DesignationResource($designation),
        ]);
    }
    //-------------------------------------------------------------------------------
    public function update(UpdateDesignationRequest $request, int $id) {
        // dd('controller reached');
        $designation = $this->designation_service->find($id);
        $this->authorize('update',$designation);

        $dto = DesignationData::fromArray(array_merge(
            $request->validated(),
            ['tenant_id' => $request->user()->tenant_id],
        ));
        $this->designation_service->update($dto, $designation);
        return redirect()->route('designations.index')->with('success', ' Updation Successfull. ');
    }
    //------------------------------------------------------------------------------------------
    public function destroy(int $id){
        $designation = $this->designation_service->find($id);
        $this->authorize('delete', $designation);

        $this->designation_service->delete($designation);
        return redirect()->route('designations.index')->with('success', 'Delete Successfull');
    }
}
