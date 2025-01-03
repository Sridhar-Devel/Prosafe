<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\ProofType;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProofTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_PROOF_TYPES);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ProofType $proofType): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_PROOF_TYPES);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_PROOF_TYPES);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ProofType $proofType): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_PROOF_TYPES);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ProofType $proofType): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_PROOF_TYPES);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user, ProofType $proofType): Response
    {
        return Response::deny('You cannot bulk delete proof types.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ProofType $proofType): Response
    {
        return Response::deny('You cannot restore a proof type.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ProofType $proofType): Response
    {
        return Response::deny('You cannot force delete a proof types.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, ProofType $proofType): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_PROOF_TYPES);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, ProofType $proofType): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_PROOF_TYPES);
    }
}
