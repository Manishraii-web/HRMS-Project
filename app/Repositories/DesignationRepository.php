<?php

namespace App\Repositories;

use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Override;

class DesignationRepository implements DesignationRepositoryInterface
{
    public function __construct(protected Designation $model) {}

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->newQuery()
        ->withCount('employees')
        ->when($filters['search'] ?? null, function ($query, $search){
            $query->where(function ($q) use ($search){
                $q->where('name', 'like', "%{$search}%");

            });
        })
        ->when($filters['status'] ?? null, fn($q, $status) => $q->where('status', $status))
        ->latest()
        ->orderBy('level')
        ->paginate($perPage)->withQueryString();
    }
    //------------------------------------------------------------------------------------

    public function find(int $id): ?Model
     {
        return $this->model->find($id);
    }
//-----------------------------------------------------------------------

    public function findOrFail(int $id): Model
    {
        return $this->model->findOrFail($id);
    }
    //-----------------------------------------------------------------

    public function create(array $data): Model{
        return $this->model->findOrFail($data);
    }
    //--------------------------------------------------------------------------------
    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->fresh();
    }
    //--------------------------------------------------------------------
    public function delete(Model $model): bool{
        return (bool) $model->delete();
    }
}

