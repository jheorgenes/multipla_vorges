<?php

namespace App\Policies;

use App\Models\ServiceOrder;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class ServiceOrderPolicy
{
    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'serviceorder', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ServiceOrder $serviceOrder): bool
    {
        return $this->hasPermission($user, 'serviceorder', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'serviceorder', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ServiceOrder $serviceOrder): bool
    {
        return $this->hasPermission($user, 'serviceorder', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ServiceOrder $serviceOrder): bool
    {
        return $this->hasPermission($user, 'serviceorder', 'delete');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, ServiceOrder $serviceOrder): bool
    // {
    //     return $this->hasPermission($user, 'serviceorder', 'restore');
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, ServiceOrder $serviceOrder): bool
    // {
    //     return true;
    // }
}
