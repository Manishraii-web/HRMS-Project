<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\DepartmentStatus;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'tenant_id',
        'name',
        'code',
        'description',
        'status'

    ];
    protected function casts(): array {
        return [
        'status' => DepartmentStatus::class,
        ];
    }
    public function tenant(): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
}
