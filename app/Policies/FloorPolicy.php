<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Floor;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FloorPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_FLOORS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Floor $floor): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_FLOORS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_FLOORS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Floor $floor): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_FLOORS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Floor $floor): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_FLOORS);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete floors.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Floor $floor): Response
    {
        return Response::deny('You cannot restore a floor.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Floor $floor): Response
    {
        return Response::deny('You cannot permanently delete a floor.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Floor $floor): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_FLOORS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Floor $floor): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_FLOORS);
    }
}
