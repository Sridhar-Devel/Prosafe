<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Tennure;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TennurePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_TENNURES);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tennure $tennure): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_TENNURES);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_TENNURES);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tennure $tennure): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_TENNURES);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tennure $tennure): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_TENNURES);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete tennures.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tennure $tennure): Response
    {
        return Response::deny('You cannot restore a tennure.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tennure $tennure): Response
    {
        return Response::deny('You cannot force delete a tennure.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Tennure $tennure): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_TENNURES);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Tennure $tennure): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_TENNURES);
    }
}
