<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EmployeePolicy
{
    //---------------------------------------------------------------------
    public function viewAny(User $user): bool
    {
        return $user->can('employees.view');
    }

    //------------------------------------------------------------------------
    public function view(User $user, Employee $employee): bool
    {
        if($user->tenant_id != $employee->tenant_id ){
            return false;
        }
        if( $user->hasRole('employee')) {
            return $employee->user_id === $user->id;
         }
         return $user->can('employees.view');
    }

    //-------------------------------------------------------------------------
    public function create(User $user): bool
    {
        return $user->can('employees.create');
    }

   //-------------------------------------------------------------------
    public function update(User $user, Employee $employee): bool
    {
        return $user->tenant_id === $employee->tenant_id
        && $user->can('employees.update');
    }

   //----------------------------------------------------------------------
    public function delete(User $user, Employee $employee): bool
    {
        return $user->tenant_id === $employee->tenant_id
        && $user->can('employees.deactivate');
    }

    //---------------------------------------------------------------------
    public function restore(User $user, Employee $employee): bool
    {
        return false;
    }


    public function forceDelete(User $user, Employee $employee): bool
    {
        return false;
    }
}
