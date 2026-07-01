<?php

namespace App\Repositories;

use App\Repositories\Contracts\EmployeeDesignationRepositoryInterface;
use App\Models\EmployeeDesignation;

class EmployeeDesignationRepository implements EmployeeDesignationRepositoryInterface
{
    public function findCurrentForEmployee(int $employeeId): ?EmployeeDesignation
    {
        return EmployeeDesignation::query()
            ->where('employee_id', $employeeId)
            ->whereNull('to_date')
            ->first();
    }

    public function close(EmployeeDesignation $row, \DateTimeInterface $closedAt): EmployeeDesignation
    {
        $row->update(['to_date' => $closedAt]);
        return $row;
    }

    public function create(array $data): EmployeeDesignation
    {
        return EmployeeDesignation::create($data);
    }
}
