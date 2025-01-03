<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_DOCUMENTS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Document $document): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_DOCUMENTS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_DOCUMENTS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Document $document): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_DOCUMENTS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Document $document): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_DOCUMENTS);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user, Document $document): Response
    {
        return Response::deny('You cannot bulk delete documents.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Document $document): Response
    {
        return Response::deny('You cannot restore a document');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Document $document): Response
    {
        return Response::deny('You cannot force delete a document.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Document $document): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_DOCUMENTS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Document $document): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_DOCUMENTS);
    }
}
