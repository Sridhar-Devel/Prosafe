<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\State;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StatePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_STATES);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, State $state): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_STATES);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_STATES);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, State $state): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_STATES);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, State $state): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_STATES);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user, State $state): Response
    {
        return Response::deny('You cannot bulk delete states.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, State $state): Response
    {
        return Response::deny('You cannot restore a state.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, State $state): Response
    {
        return Response::deny('You cannot force delete a state.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, State $state): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_STATES);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, State $state): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_STATES);
    }
}
