<?php

namespace App\Policies;

use App\Models\SimCard;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class SimCardPolicy
{
    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'simcard', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SimCard $simCard): bool
    {
        return $this->hasPermission($user, 'simcard', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'simcard', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SimCard $simCard): bool
    {
        return $this->hasPermission($user, 'simcard', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SimCard $simCard): bool
    {
        return $this->hasPermission($user, 'simcard', 'delete');
    }

    public function attachAnyTracker(User $user, SimCard $simCard): bool
    {
        return false;
    }
}
