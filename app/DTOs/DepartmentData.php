<?php

namespace App\DTOs;

use App\Enums\DepartmentStatus;

class DepartmentData {
    public function __construct(
        public readonly int $tenantId,
        public readonly string $name,
        public readonly string $code,
        public readonly ?string $description = null,
        public readonly DepartmentStatus $status = DepartmentStatus::Active,) { }

        public static function fromArray(array $data):self  {
            return new self(
                tenantId: $data['tenant_id'],
                name: $data['name'],
                code : $data['code'],
                description: $data['description'] ??null,
                status: isset($data['status'])
                  ? DepartmentStatus::from($data['status']) : DepartmentStatus::Active,
                );
        }
        public function toArray(): array
        {
            return [
            'tenant_id' => $this->tenantId,
            'name' => $this->name,
            'code' =>$this->code,
            'description' => $this->description,
            'status' => $this->status->value,
            ];
        }
}
