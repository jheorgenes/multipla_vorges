<?php

namespace App\Policies;

use App\Models\Installer;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class InstallerPolicy
{

    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'installer', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Installer $installer): bool
    {
        return $this->hasPermission($user, 'installer', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'installer', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Installer $installer): bool
    {
        return $this->hasPermission($user, 'installer', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Installer $installer): bool
    {
        return $this->hasPermission($user, 'installer', 'delete');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Installer $installer): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Installer $installer): bool
    // {
    //     return false;
    // }
}
