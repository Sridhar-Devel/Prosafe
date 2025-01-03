<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Auth\Access\Response;

class VisitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_VISITS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Visit $visit): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_VISITS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_VISITS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Visit $visit): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_VISITS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Visit $visit): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_VISITS);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete a visit.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Visit $visit): Response
    {
        return Response::deny('You cannot restore a visit.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Visit $visit): Response
    {
        return Response::deny('You cannot permanently delete a visit.');

    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Visit $visit): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_VISITS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Visit $visit): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_VISITS);
    }
}
