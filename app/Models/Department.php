<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\DepartmentStatus;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'tenant_id',
        'name',
        'code',
        'description',
        'status',
        // 'head_employee_id'
    ];
    protected function casts(): array {
        return [
        'status' => DepartmentStatus::class,
        'tenant_id' => 'integer',
        ];
    }
    public function tenant(): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
    public function employees(): HasMany{
        return $this->hasMany(Employee::class);
    }


    // public function head(): BelongsTo
    // {
    //     return $this->belongsTo(Employee::class,'head_employee_id');
    // }
}
