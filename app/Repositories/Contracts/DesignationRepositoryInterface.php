<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface DesignationRepositoryInterface extends BaseRepositoryInterface
{
    public function options(int $tnenantId): Collection;
}


