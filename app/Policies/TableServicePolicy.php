<?php

namespace App\Policies;

use App\Models\TableService;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class TableServicePolicy
{

    use HasPermissionTrait;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'tableservice', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TableService $tableService): bool
    {
        return $this->hasPermission($user, 'tableservice', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'tableservice', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TableService $tableService): bool
    {
        return $this->hasPermission($user, 'tableservice', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TableService $tableService): bool
    {
        return $this->hasPermission($user, 'tableservice', 'delete');
    }
}
