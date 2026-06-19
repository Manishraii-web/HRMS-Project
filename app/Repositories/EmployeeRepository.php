<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;


class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(protected Employee $model) {}

    public function paginate(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->newQuery()->with('department')->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_code', 'like', "%{$search}%");
            });
        })
        ->when($filters['department_id']?? null, fn($q, $id)=> $q->where('department_id', $id))
        ->when($filters['status'] ?? null, fn($q, $status) => $q->where('status', $status))
        ->latest()->paginate($perPage)->withQueryString();
    }
    public function find(int $id): ?Model {
        return $this->model->with('department')->find($id);
    }
    public function findOrFail(int $id): Model {
        return $this->model->with('department')->findOrFail($id);
    }

    public function create(array $data): Model {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->fresh();
    }

    public function delete(Model $model): bool
    {
        return (bool) $model->delete();
    }


}
