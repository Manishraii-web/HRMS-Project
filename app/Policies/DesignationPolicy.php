<?php

namespace App\Policies;

use App\Models\Designation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DesignationPolicy
{

    public function viewAny(User $user): bool
    {
        return $user->can('designations.view');
    }


    public function view(User $user, Designation $designation): bool
    {
        return $user->can('designations.view') &&  $this->sameTenant($user, $designation);
    }


    public function create(User $user): bool
    {
        return $user->can('designations.create');
    }


    public function update(User $user, Designation $designation): bool
    {
        return $user->can('designations.update') && $this->sameTenant($user, $designation);
    }

    public function delete(User $user, Designation $designation): bool
    {
        return $user->can('designations.deactivate') && $this->sameTenant($user, $designation);
    }

    protected function sameTenant(User $user, Designation $designation){
        return $user->tenant_id === $designation->tenant_id;
    }


    public function restore(User $user, Designation $designation): bool
    {
        return false;
    }


    public function forceDelete(User $user, Designation $designation): bool
    {
        return false;
    }
}
