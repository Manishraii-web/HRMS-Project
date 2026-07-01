<?php

namespace App\Models;

use App\Enums\DepartmentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    /** @use HasFactory<\Database\Factories\DesignationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable =[
    'tenant_id',
    'name',
    'level',
    'description',
    'status'
    ];

    protected function casts(): array {
        return [
            'status' =>DepartmentStatus::class,
            'level' => 'integer'
        ];
    }

    public function tenant(): BelongsTo {
        return $this->belongsTo(Tenant::class);
    }
    public function employees(): BelongsToMany{
        return $this->belongsToMany(Employee::class, 'employee_designations')
        ->withPivot(['id','tenant_id', 'from_date', 'to_date'])->withTimestamps();
    }
}
