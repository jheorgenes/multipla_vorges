<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Permission;
use App\Models\User;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class ClientPolicy
{
    /* As funções abaixo verificam (através do método hasPermission) se o usuario possui a permissão desejada para o recurso desejado */
    use HasPermissionTrait;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'client', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $client): bool
    {
        return $this->hasPermission($user, 'client', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'client', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        return $this->hasPermission($user, 'client', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $client): bool
    {
        return $this->hasPermission($user, 'client', 'delete');
    }
}
