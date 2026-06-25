<?php

namespace App\Actions\Designation;

use App\DTOs\DesignationData;
use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;


class UpdateDesignationAction
{
    public function __construct(protected DesignationRepositoryInterface $designation_repository)
    {}
        public function execute(DesignationData $data, Designation $designation): Designation{

        return $this->designation_repository->update($designation, $data->toArray());
        }

}
