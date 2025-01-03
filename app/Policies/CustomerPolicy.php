<?php

namespace App\Policies;

use App\Enums\PermissionsEnum;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CustomerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Customer $customer): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_CUSTOMERS);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can(PermissionsEnum::CAN_CREATE_CUSTOMERS);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Customer $customer): bool
    {
        return $user->can(PermissionsEnum::CAN_UPDATE_CUSTOMERS);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Customer $customer): bool
    {
        return $user->can(PermissionsEnum::CAN_DELETE_CUSTOMERS);
    }

    /**
     * Determine whether the user can bulk delete the model.
     */
    public function deleteAny(User $user): Response
    {
        return Response::deny('You cannot bulk delete customers.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Customer $customer): Response
    {
        return Response::deny('You cannot restore a customer.');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Customer $customer): Response
    {
        return Response::deny('You cannot force delete a customer.');
    }

    /**
     * Determine whether the user can see the audit log for the model.
     */
    public function audit(User $user, Customer $customer): bool
    {
        return $user->can(PermissionsEnum::CAN_VIEW_AUDIT_CUSTOMERS);
    }

    /**
     * Determine whether the user can restore changes from audit log for the model.
     */
    public function restoreAudit(User $user, Customer $customer): bool
    {
        return $user->can(PermissionsEnum::CAN_RESTORE_AUDIT_CUSTOMERS);
    }
}
