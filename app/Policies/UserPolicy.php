<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_USERS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_USERS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_USERS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_USERS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_USERS);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_USERS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, User $model): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_USERS);
    }
}
