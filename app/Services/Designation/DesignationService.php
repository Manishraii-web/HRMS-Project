<?php

namespace App\Services\Designation;

use App\Actions\Designation\DeleteDesignationAction;
use App\Actions\Designation\UpdateDesignationAction;
use App\DTOs\DesignationData;
use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use CreateDesignationAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class DesignationService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected DesignationRepositoryInterface $designation_repository,
        protected CreateDesignationAction $create_designation,
        protected UpdateDesignationAction $update_designation,
        protected DeleteDesignationAction $delete_designation,
    )
    { }

    public function list(string $search='', int $perPage) : LengthAwarePaginator
    {
        return $this->designation_repository->paginate(
            filters: ['search' => $search],
            perPage: $perPage
        );
    }
    public function find(int $id): Model
    {
    return $this->designation_repository->findOrFail($id);
    }

    public function create(DesignationData $data): Model{
        return $this->create_designation->execute($data);
    }

    public function update(DesignationData $data, Designation $model)
    {
        return $this->update_designation->execute($data, $model);
    }

    public function delete(Designation $model)
    {
        return $this->delete_designation->execute($model);
    }



}
