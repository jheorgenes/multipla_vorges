<?php

namespace App\Policies;

use App\Models\Tracker;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class TrackerPolicy
{

    use HasPermissionTrait;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'tracker', 'viewAny');
        // return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tracker $tracker): bool
    {
        return $this->hasPermission($user, 'tracker', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'tracker', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tracker $tracker): bool
    {
        return $this->hasPermission($user, 'tracker', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tracker $tracker): bool
    {
        return $this->hasPermission($user, 'tracker', 'delete');
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Tracker $tracker): bool
    // {
    //     return true;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Tracker $tracker): bool
    // {
    //     return true;
    // }
}