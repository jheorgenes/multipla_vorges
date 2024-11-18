<?php

namespace App\Policies;

use App\Models\Brand;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class BrandPolicy
{
    // Usando uma trait própria
    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'brand', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Brand $brand): bool
    {
        return $this->hasPermission($user, 'brand', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'brand', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Brand $brand): bool
    {
        return $this->hasPermission($user, 'brand', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Brand $brand): bool
    {
        return $this->hasPermission($user, 'brand', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    // public function restore(User $user, Brand $brand): bool
    // {
    //     return $this->hasPermission($user, 'brand', 'restore');
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Brand $brand): bool
    // {
    //     //
    // }

}
