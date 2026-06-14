<?php

namespace App\DTOs;

use App\Enums\DepartmentStatus;

class DepartmentData {
    public function __construct(
        public readonly int $tenant_id,
        public readonly string $name,
        public readonly string $code,
        public readonly ?string $description = null,
        public readonly DepartmentStatus $status = DepartmentStatus::Active,) { }

        public static function fromArray(array $data):self
}
