<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Locker;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LockerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_LOCKERS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Locker $locker): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_LOCKERS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_LOCKERS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Locker $locker): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_LOCKERS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Locker $locker): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_LOCKERS);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete lockers.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Locker $locker): Response
    {
        return Response::deny('You cannot restore a locker.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Locker $locker): Response
    {
        return Response::deny('You cannot force delete a locker.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Locker $locker): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_LOCKERS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Locker $locker): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_LOCKERS);
    }
}
