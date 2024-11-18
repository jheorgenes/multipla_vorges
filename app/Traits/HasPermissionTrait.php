<?php

namespace App\Traits;

use App\Models\User;

trait HasPermissionTrait
{
    public function hasPermission(User $user, string $recurso, string $permission): bool
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

