<?php

namespace App\Policies;

use App\Models\Operator;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class OperatorPolicy
{

    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'operator', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Operator $operator): bool
    {
        return $this->hasPermission($user, 'operator', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'operator', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Operator $operator): bool
    {
        return $this->hasPermission($user, 'operator', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Operator $operator): bool
    {
        return $this->hasPermission($user, 'operator', 'delete');
    }

    // public function attachAnySimCard(User $user, Operator $operator)
    // {
    //     return false;
    // }

    public function addSimCard(User $user, Operator $operator)
    {
        return false;
    }
}
