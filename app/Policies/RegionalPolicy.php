<?php

namespace App\Policies;

use App\Models\Regional;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class RegionalPolicy
{
    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'regional', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Regional $regional): bool
    {
        return $this->hasPermission($user, 'regional', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'regional', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Regional $regional): bool
    {
        return $this->hasPermission($user, 'regional', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Regional $regional): bool
    {
        return $this->hasPermission($user, 'regional', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Regional $regional): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Regional $regional): bool
    {
        return true;
    }
}
