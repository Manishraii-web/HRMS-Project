<?php

namespace App\DTOs;

use App\Enums\DepartmentStatus;

class DepartmentData
{
    public function __construct(
        public readonly string $name,
        public readonly string $code,
        public readonly ?string $description = null,
        public readonly DepartmentStatus $status = DepartmentStatus::Active,
        public readonly ?int $tenantId = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            code: $data['code'],
            description: $data['description'] ?? null,
            status: isset($data['status'])
                ? DepartmentStatus::from($data['status'])
                : DepartmentStatus::Active,
            tenantId: $data['tenant_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        $result = [
            'name'        => $this->name,
            'code'        => $this->code,
            'description' => $this->description,
            'status'      => $this->status->value,
        ];

        if ($this->tenantId !== null) {
            $result['tenant_id'] = $this->tenantId;
        }

        return $result;
    }
}
