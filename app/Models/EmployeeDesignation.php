<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDesignation extends Pivot
{
    use SoftDeletes;
    protected $table = 'employee_designations';
    public $incrementing = true;


    protected $fillable = [
        'tenant_id',
        'employee_id',
        'designation_id',
        'from_date',
        'to_date'
    ];

    protected $casts = [
        'from_date' =>  'date',
        'to_date' => 'date'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }
}
