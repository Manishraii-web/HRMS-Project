<?php

namespace App\Repositories\Contracts;

use App\Models\EmployeeDesignation;

interface DesignationRepositoryInterface
{
    public function findCurrentForEmployee(int $employeeId): ? EmployeeDesignation;
    public function close(EmployeeDesignation $row, \DateTimeInterface $closedAt): EmployeeDesignation;
    public function create(array $data): EmployeeDesignation;
}
