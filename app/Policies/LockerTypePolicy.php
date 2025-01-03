<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\LockerType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LockerTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, LockerType $lockerType): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LockerType $lockerType): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LockerType $lockerType): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete locker types.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, LockerType $lockerType): Response
    {
        return Response::deny('You cannot restore a locker type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, LockerType $lockerType): Response
    {
        return Response::deny('You cannot force delete a locker type.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, LockerType $lockerType): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_LOCKER_TYPES);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, LockerType $lockerType): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_LOCKER_TYPES);
    }
}
