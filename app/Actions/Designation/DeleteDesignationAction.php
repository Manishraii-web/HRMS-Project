<?php

namespace App\Actions\Designation;

use App\Models\Designation;
use App\Repositories\Contracts\DesignationRepositoryInterface;

class DeleteDesignationAction
{
    public function __construct(protected DesignationRepositoryInterface $designation_repository)
    {}
        public function execute(Designation $designation){
            return $this->designation_repository->delete($designation);
        }

}
