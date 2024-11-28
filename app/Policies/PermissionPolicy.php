<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'gestor']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Permission $permission): bool
    {
        return $user->id === $permission->user_id || in_array($user->role, ['admin', 'gestor']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Permission $permission): bool
    {
        // Verificar se o usuário tem permissão para criar
        if (!in_array($user->role, ['admin', 'gestor'])) {
            return false;
        }

        // Verificar se já existe um registro com o mesmo user_id e recurso
        $exists = Permission::where('user_id', $permission->user_id)
                            ->where('recurso', $permission->recurso)
                            ->exists();

        return !$exists; // Permitir criar apenas se não existir duplicado
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Permission $permission): bool
    {
        // Verificar se o usuário tem permissão para atualizar
        if (!in_array($user->role, ['admin', 'gestor'])) {
            return false;
        }

        // Permitir atualização se o registro pertencer ao usuário
        if ($permission->user_id === $user->id) {
            return true;
        }

        // Verificar se já existe outro registro com o mesmo user_id e recurso
        $exists = Permission::where('user_id', $permission->user_id)
                            ->where('recurso', $permission->recurso)
                            ->where('id', '!=', $permission->id) // Ignorar o registro atual
                            ->exists();

        return !$exists; // Permitir atualizar apenas se não existir duplicado
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Permission $permission): bool
    {
        return in_array($user->role, ['admin', 'gestor']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission): bool
    {
        return in_array($user->role, ['admin', 'gestor']);
    }

    protected function permissionAlreadyExists($userId, $recurso, $permissionId = null): bool
    {
        $query = Permission::where('user_id', $userId)
                            ->where('recurso', $recurso);

        if ($permissionId) {
            $query->where('id', '!=', $permissionId);
        }

        return $query->exists();
    }
}
