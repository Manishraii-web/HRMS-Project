<?php

namespace App\Policies;

use App\Models\Department;
use App\Models\User;

class DepartmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('departments.view');
    }

    public function view(User $user, Department $department): bool
    {
        return $this->hasTenantAccess($user, $department) && $user->can('departments.view');
    }

    public function create(User $user): bool
    {
        return $user->can('departments.create');
    }

    public function update(User $user, Department $department): bool
    {
        return $this->hasTenantAccess($user, $department) && $user->can('departments.update');
    }

    public function delete(User $user, Department $department): bool
    {
        return $this->hasTenantAccess($user, $department) && $user->can('departments.deactivate');
    }

    public function restore(User $user, Department $department): bool
    {
        return false;
    }

    public function forceDelete(User $user, Department $department): bool
    {
        return false;
    }

    /**
     * A user may only act on departments belonging to their own tenant.
     * No role bypasses this — tenant isolation is absolute. Role/permission
     * checks are applied separately in each policy method via $user->can().
     */
    private function hasTenantAccess(User $user, Department $department): bool
    {
        return $user->tenant_id === $department->tenant_id;
    }
}
