<?php

namespace App\Enums;

enum RolesEnum: string
{
    // Super Admin Role
    public const SUPER_ADMIN = 'Super Admin';

    // Manager Role
    public const MANAGER = 'Manager';

    // Operator Role
    public const OPERATOR = 'Operator';

    // Users Roles
    public const USER_USER = 'User User';

    public const USER_MANAGER = 'User Manager';

    public const USER_ADMIN = 'User Admin';

    // Roles Roles
    public const ROLE_USER = 'Role User';

    public const ROLE_MANAGER = 'Role Manager';

    public const ROLE_ADMIN = 'Role Admin';

    // Permissions Roles
    public const PERMISSION_USER = 'Permission User';

    public const PERMISSION_MANAGER = 'Permission Manager';

    public const PERMISSION_ADMIN = 'Permission Admin';

    // Customers Roles
    public const CUSTOMER_USER = 'Customer User';

    public const CUSTOMER_MANAGER = 'Customer Manager';

    public const CUSTOMER_ADMIN = 'Customer Admin';

    // Lockers Roles
    public const LOCKER_USER = 'Locker User';

    public const LOCKER_MANAGER = 'Locker Manager';

    public const LOCKER_ADMIN = 'Locker Admin';

    // Floors Roles
    public const FLOOR_USER = 'Floor User';

    public const FLOOR_MANAGER = 'Floor Manager';

    public const FLOOR_ADMIN = 'Floor Admin';

    // Statuses Roles
    public const STATUS_USER = 'Status User';

    public const STATUS_MANAGER = 'Status Manager';

    public const STATUS_ADMIN = 'Status Admin';

    // States Roles
    public const STATE_USER = 'State User';

    public const STATE_MANAGER = 'State Manager';

    public const STATE_ADMIN = 'State Admin';

    // Visits Roles
    public const VISIT_USER = 'Visit User';

    public const VISIT_MANAGER = 'Visit Manager';

    public const VISIT_ADMIN = 'Visit Admin';

    // Proof Type Roles
    public const PROOF_TYPE_USER = 'Proof Type User';

    public const PROOF_TYPE_MANAGER = 'Proof Type Manager';

    public const PROOF_TYPE_ADMIN = 'Proof Type Admin';

    // Document Roles
    public const DOCUMENT_USER = 'Document User';

    public const DOCUMENT_MANAGER = 'Document Manager';

    public const DOCUMENT_ADMIN = 'Document Admin';

    // Agreement Roles
    public const AGREEMENT_USER = 'Agreement User';

    public const AGREEMENT_MANAGER = 'Agreement Manager';

    public const AGREEMENT_ADMIN = 'Agreement Admin';

    // Tennure Roles
    public const TENNURE_USER = 'Tennure User';

    public const TENNURE_MANAGER = 'Tennure Manager';

    public const TENNURE_ADMIN = 'Tennure Admin';

    // Locker Type Roles
    public const LOCKER_TYPE_USER = 'Locker Type User';

    public const LOCKER_TYPE_MANAGER = 'Locker Type Manager';

    public const LOCKER_TYPE_ADMIN = 'Locker Type Admin';
}
