<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Webhook;
use App\Traits\HasPermissionTrait;
use Illuminate\Auth\Access\Response;

class WebhookPolicy
{
    use HasPermissionTrait;
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $this->hasPermission($user, 'webhook', 'viewAny');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Webhook $webhook): bool
    {
        return $this->hasPermission($user, 'webhook', 'view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->hasPermission($user, 'webhook', 'create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Webhook $webhook): bool
    {
        return $this->hasPermission($user, 'webhook', 'update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Webhook $webhook): bool
    {
        return $this->hasPermission($user, 'webhook', 'delete');
    }
}
