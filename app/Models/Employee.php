<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable =[
        'tenant_id',
        'department_id',
        'user_id',
        'employee_code',
        'firstname',
        'lastname',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'nationality',
        'address',
        'avatar',
        'job_title',
        'employment_type',
        'hire_date',
        'termination_date',
        'status',
        'basic_salary',
        'bank_name',
        'bank_account_number',
        'nid_number',
        'pan_number'
    ];

    protected $casts =[
        'date_of_birth' => 'datetime',
        'hire_date' => 'datetime',
        'termination_date'=>'datetime',
        'basic_salary' => 'decimal:2'
    ];

    public function department() : BelongsTo {
        return $this->belongsTo(Department::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function tenant() : BelongsTo {
        return $this->belongsTo(Tenant::class);
    }

    public function designations() : BelongsToMany {
        return $this->belongsToMany(Designation::class, 'employee_designations')
        ->using(EmployeeDesignation::class)
        ->withPivot(['id', 'tenant_id', 'from_date', 'to_date'])->withTimestamps();

    }

    public function currentDesignation(): BelongsToMany {
        return $this->desinations()->wherePivot('to_date', null);
    }


}
