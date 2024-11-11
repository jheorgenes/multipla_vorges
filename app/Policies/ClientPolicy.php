<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class ClientPolicy
{
    /* As funções abaixo verificam (através do método hasPermission) se o usuario possui a permissão desejada para o recurso desejado */

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

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Client $client): bool
    // {
    //     //
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Client $client): bool
    // {
    //     //
    // }

    private function hasPermission(User $user, string $recurso, string $permission): bool
    {
        // Obtém as permissões do usuário relacionadas ao recurso especificado
        $permissionRecord = $user->permissions()->where('recurso', $recurso)->first();

        // Verifica se o registro existe e se a permissão desejada está marcada como true
        if ($permissionRecord && isset($permissionRecord->permissions[$permission])) {
            return $permissionRecord->permissions[$permission] === true;
        }

        return false;
    }
}
