<?php

namespace App\Actions\Designation;

use App\DTOs\DesignationData;
use App\Repositories\Contracts\DesignationRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CreateDesignationAction
{
    public function __construct(protected DesignationRepositoryInterface $designation_repository)
    {}

    public function execute(DesignationData $data): Model
    {
      return $this->designation_repository->create($data->toArray());
    }
}
