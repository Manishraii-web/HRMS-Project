<?php

namespace App\DTOs;

use App\Models\Department;
use App\Enums\DepartmentStatus;

class DesignationData
{
    public function __construct(

    public readonly ?int $tenantId ,
    public readonly string $name,
    public readonly ?int $level,
    public readonly ?string $description ,
    public readonly DepartmentStatus $status = DepartmentStatus::Active,
    ) {}

    public static function fromArray( array $data): self{
        return new self(
            tenantId: $data['tenant_id'] ?? null,
            name: $data['name'],
            level: $data['level'],
            description: $data['description'],
              status: isset($data['status'])
                ? DepartmentStatus::from($data['status'])
                : DepartmentStatus::Active,
        );
    }
        public function toArray(): array{
            $result = [
                'name' => $this->name,
                'level'=> $this->level,
                'description' => $this->description,
                'status' => $this->status->value,
            ];
            if($this->tenantId !== null) {
                $result['tenant_id'] = $this->tenantId;
            }
            return $result;
        }
}




