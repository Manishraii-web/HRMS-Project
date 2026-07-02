<?php

namespace App\Http\Resources\Designation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DesignationResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
           'level' => $this->level,
           'description' => $this->description,
           'status' => $this->status,
           'employees_count' => $this->employees_count ,
           'created_at' => $this->created_at,
        ];
    }
}
