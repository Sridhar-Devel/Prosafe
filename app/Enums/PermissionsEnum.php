<?php

namespace App\Enums;

enum PermissionsEnum: string
{
    // Users
    public const CAN_VIEW_ANY_USERS = 'viewAny users';

    public const CAN_VIEW_USERS = 'view users';

    public const CAN_CREATE_USERS = 'create users';

    public const CAN_UPDATE_USERS = 'edit users';

    public const CAN_DELETE_USERS = 'delete users';

    public const CAN_VIEW_AUDIT_USERS = 'audit users';

    public const CAN_RESTORE_AUDIT_USERS = 'audit_restore users';

    // Roles
    public const CAN_VIEW_ANY_ROLES = 'viewAny roles';

    public const CAN_VIEW_ROLES = 'view roles';

    public const CAN_CREATE_ROLES = 'create roles';

    public const CAN_UPDATE_ROLES = 'edit roles';

    public const CAN_DELETE_ROLES = 'delete roles';

    // Permissions
    public const CAN_VIEW_ANY_PERMISSIONS = 'viewAny permissions';

    public const CAN_VIEW_PERMISSIONS = 'view permissions';

    public const CAN_CREATE_PERMISSIONS = 'create permissions';

    public const CAN_UPDATE_PERMISSIONS = 'edit permissions';

    public const CAN_DELETE_PERMISSIONS = 'delete permissions';

    // Lockers
    public const CAN_VIEW_ANY_LOCKERS = 'viewAny lockers';

    public const CAN_VIEW_LOCKERS = 'view lockers';

    public const CAN_CREATE_LOCKERS = 'create lockers';

    public const CAN_UPDATE_LOCKERS = 'edit lockers';

    public const CAN_DELETE_LOCKERS = 'delete lockers';

    public const CAN_VIEW_AUDIT_LOCKERS = 'audit lockers';

    public const CAN_RESTORE_AUDIT_LOCKERS = 'audit_restore lockers';

    // Floors
    public const CAN_VIEW_ANY_FLOORS = 'viewAny floors';

    public const CAN_VIEW_FLOORS = 'view floors';

    public const CAN_CREATE_FLOORS = 'create floors';

    public const CAN_UPDATE_FLOORS = 'edit floors';

    public const CAN_DELETE_FLOORS = 'delete floors';

    public const CAN_VIEW_AUDIT_FLOORS = 'audit floors';

    public const CAN_RESTORE_AUDIT_FLOORS = 'audit_restore floors';

    // Statuses
    public const CAN_VIEW_ANY_STATUSES = 'viewAny statuses';

    public const CAN_VIEW_STATUSES = 'view statuses';

    public const CAN_CREATE_STATUSES = 'create statuses';

    public const CAN_UPDATE_STATUSES = 'edit statuses';

    public const CAN_DELETE_STATUSES = 'delete statuses';

    public const CAN_VIEW_AUDIT_STATUSES = 'audit statuses';

    public const CAN_RESTORE_AUDIT_STATUSES = 'audit_restore statuses';

    // States
    public const CAN_VIEW_ANY_STATES = 'viewAny states';

    public const CAN_VIEW_STATES = 'view states';

    public const CAN_CREATE_STATES = 'create states';

    public const CAN_UPDATE_STATES = 'edit states';

    public const CAN_DELETE_STATES = 'delete states';

    public const CAN_VIEW_AUDIT_STATES = 'audit states';

    public const CAN_RESTORE_AUDIT_STATES = 'audit_restore states';

    // Visits
    public const CAN_VIEW_ANY_VISITS = 'viewAny visits';

    public const CAN_VIEW_VISITS = 'view visits';

    public const CAN_CREATE_VISITS = 'create visits';

    public const CAN_UPDATE_VISITS = 'edit visits';

    public const CAN_DELETE_VISITS = 'delete visits';

    public const CAN_VIEW_AUDIT_VISITS = 'audit visits';

    public const CAN_RESTORE_AUDIT_VISITS = 'audit_restore visits';

    // Customers
    public const CAN_VIEW_ANY_CUSTOMERS = 'viewAny customers';

    public const CAN_VIEW_CUSTOMERS = 'view customers';

    public const CAN_CREATE_CUSTOMERS = 'create customers';

    public const CAN_UPDATE_CUSTOMERS = 'edit customers';

    public const CAN_DELETE_CUSTOMERS = 'delete customers';

    public const CAN_VIEW_AUDIT_CUSTOMERS = 'audit customers';

    public const CAN_RESTORE_AUDIT_CUSTOMERS = 'audit_restore customers';

    // ProofTypes
    public const CAN_VIEW_ANY_PROOF_TYPES = 'viewAny proof_types';

    public const CAN_VIEW_PROOF_TYPES = 'view proof_types';

    public const CAN_CREATE_PROOF_TYPES = 'create proof_types';

    public const CAN_UPDATE_PROOF_TYPES = 'edit proof_types';

    public const CAN_DELETE_PROOF_TYPES = 'delete proof_types';

    public const CAN_VIEW_AUDIT_PROOF_TYPES = 'audit proof_types';

    public const CAN_RESTORE_AUDIT_PROOF_TYPES = 'audit_restore proof_types';

    // Documents
    public const CAN_VIEW_ANY_DOCUMENTS = 'viewAny documents';

    public const CAN_VIEW_DOCUMENTS = 'view documents';

    public const CAN_CREATE_DOCUMENTS = 'create documents';

    public const CAN_UPDATE_DOCUMENTS = 'edit documents';

    public const CAN_DELETE_DOCUMENTS = 'delete documents';

    public const CAN_VIEW_AUDIT_DOCUMENTS = 'audit documents';

    public const CAN_RESTORE_AUDIT_DOCUMENTS = 'audit_restore documents';

    // Agreements
    public const CAN_VIEW_ANY_AGREEMENTS = 'viewAny agreements';

    public const CAN_VIEW_AGREEMENTS = 'view agreements';

    public const CAN_CREATE_AGREEMENTS = 'create agreements';

    public const CAN_UPDATE_AGREEMENTS = 'edit agreements';

    public const CAN_DELETE_AGREEMENTS = 'delete agreements';

    public const CAN_VIEW_AUDIT_AGREEMENTS = 'audit agreements';

    public const CAN_RESTORE_AUDIT_AGREEMENTS = 'audit_restore agreements';

    // Tennures
    public const CAN_VIEW_ANY_TENNURES = 'viewAny tennures';

    public const CAN_VIEW_TENNURES = 'view tennures';

    public const CAN_CREATE_TENNURES = 'create tennures';

    public const CAN_UPDATE_TENNURES = 'edit tennures';

    public const CAN_DELETE_TENNURES = 'delete tennures';

    public const CAN_VIEW_AUDIT_TENNURES = 'audit tennures';

    public const CAN_RESTORE_AUDIT_TENNURES = 'audit_restore tennures';

    // LockerTypes
    public const CAN_VIEW_ANY_LOCKER_TYPES = 'viewAny locker_types';

    public const CAN_VIEW_LOCKER_TYPES = 'view locker_types';

    public const CAN_CREATE_LOCKER_TYPES = 'create locker_types';

    public const CAN_UPDATE_LOCKER_TYPES = 'edit locker_types';

    public const CAN_DELETE_LOCKER_TYPES = 'delete locker_types';

    public const CAN_VIEW_AUDIT_LOCKER_TYPES = 'audit locker_types';

    public const CAN_RESTORE_AUDIT_LOCKER_TYPES = 'audit_restore locker_types';
}
