<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DepartmentPolicy
{
   //------------------------------------------------------------------
    public function viewAny(User $user): bool
    {
        return $user->can('departments.view');
    }
//----------------------------------------------------------------
    public function view(User $user, Department $department): bool
    {
        return $user->tenant_id === $department->tenant_id && $user->can('departments.view');

    }
//----------------------------------------------------------------------------------------------
    public function create(User $user): bool
    {
        return $user->can('departments.create');
    }
    //-----------------------------------------------------------------------------------------
    public function update(User $user, Department $department): bool
    {
        return $user->tenant_id === $department->tenant_id && $user->can('departments.update');
    }
//------------------------------------------------------------------------------------------------
    public function delete(User $user, Department $department): bool
    {
        return $user->tenant_id === $department->tenant_id && $user->can('departments.deactivate');
    }
//-------------------------------------------------------------------------------------------------------
    public function restore(User $user, Department $department): bool
    {
        return false;
    }

    public function forceDelete(User $user, Department $department): bool
    {
        return false;
    }
}
