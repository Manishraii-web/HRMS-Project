<?php
namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface
{
     public function options(int $tenantId): Collection;
}


