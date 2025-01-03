<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create Permission permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_PERMISSIONS, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_PERMISSIONS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_PERMISSIONS,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_PERMISSIONS,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_PERMISSIONS,   'guard_name' => 'web']);

        // create Role permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_ROLES,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ROLES,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_ROLES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_ROLES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_ROLES,        'guard_name' => 'web']);

        // create User permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_USERS,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_USERS,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_USERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_USERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_USERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_USERS,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_USERS, 'guard_name' => 'web']);

        // create Customer permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_CUSTOMERS,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_CUSTOMERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_CUSTOMERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_CUSTOMERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_CUSTOMERS,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_CUSTOMERS, 'guard_name' => 'web']);

        // create Floor permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_FLOORS,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_FLOORS,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_FLOORS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_FLOORS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_FLOORS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_FLOORS,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_FLOORS, 'guard_name' => 'web']);

        // create Locker permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_LOCKERS,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_LOCKERS,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_LOCKERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_LOCKERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_LOCKERS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_LOCKERS,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_LOCKERS, 'guard_name' => 'web']);

        // create Status permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_STATUSES,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_STATUSES,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_STATUSES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_STATUSES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_STATUSES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_STATUSES,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_STATUSES, 'guard_name' => 'web']);

        // create Visit permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_VISITS,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_VISITS,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_VISITS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_VISITS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_VISITS,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_VISITS,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_VISITS, 'guard_name' => 'web']);

        // create ProofType permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_PROOF_TYPES,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_PROOF_TYPES,       'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_PROOF_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_PROOF_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_PROOF_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_PROOF_TYPES, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_PROOF_TYPES, 'guard_name' => 'web']);

        // create State permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_STATES,      'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_STATES,          'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_STATES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_STATES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_STATES,        'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_STATES,    'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_STATES, 'guard_name' => 'web']);

        // create Document permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_DOCUMENTS,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_DOCUMENTS,       'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_DOCUMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_DOCUMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_DOCUMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_DOCUMENTS, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_DOCUMENTS, 'guard_name' => 'web']);

        // create Agreement permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_AGREEMENTS,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AGREEMENTS,       'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_AGREEMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_AGREEMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_AGREEMENTS,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_AGREEMENTS, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_AGREEMENTS, 'guard_name' => 'web']);

        // create Tennure permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_TENNURES,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_TENNURES,       'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_TENNURES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_TENNURES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_TENNURES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_TENNURES, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_TENNURES, 'guard_name' => 'web']);

        // create LockerType permissions
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_ANY_LOCKER_TYPES,   'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_LOCKER_TYPES,       'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_CREATE_LOCKER_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_UPDATE_LOCKER_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_DELETE_LOCKER_TYPES,     'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_VIEW_AUDIT_LOCKER_TYPES, 'guard_name' => 'web']);
        Permission::create(['name' => PermissionsEnum::CAN_RESTORE_AUDIT_LOCKER_TYPES, 'guard_name' => 'web']);

        $grant_role_msg = 'Roles and Permissions granted to ';

        // create Role User with default permissions
        $user_role = Role::create(['name' => RolesEnum::ROLE_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_ROLES, PermissionsEnum::CAN_VIEW_ANY_ROLES, PermissionsEnum::CAN_CREATE_ROLES]);
        $this->command->info($grant_role_msg.RolesEnum::ROLE_USER);

        // create Role Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::ROLE_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_ROLES, PermissionsEnum::CAN_VIEW_ANY_ROLES, PermissionsEnum::CAN_CREATE_ROLES, PermissionsEnum::CAN_UPDATE_ROLES]);
        $this->command->info($grant_role_msg.RolesEnum::ROLE_MANAGER);

        // create Role Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::ROLE_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_ROLES, PermissionsEnum::CAN_VIEW_ANY_ROLES, PermissionsEnum::CAN_CREATE_ROLES, PermissionsEnum::CAN_UPDATE_ROLES, PermissionsEnum::CAN_DELETE_ROLES]);
        $this->command->info($grant_role_msg.RolesEnum::ROLE_ADMIN);

        // create Permission User with default permissions
        $user_role = Role::create(['name' => RolesEnum::PERMISSION_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PERMISSIONS, PermissionsEnum::CAN_VIEW_ANY_PERMISSIONS, PermissionsEnum::CAN_CREATE_PERMISSIONS]);
        $this->command->info($grant_role_msg.RolesEnum::PERMISSION_USER);

        // create Permission Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::PERMISSION_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PERMISSIONS, PermissionsEnum::CAN_VIEW_ANY_PERMISSIONS, PermissionsEnum::CAN_CREATE_PERMISSIONS, PermissionsEnum::CAN_UPDATE_PERMISSIONS]);
        $this->command->info($grant_role_msg.RolesEnum::PERMISSION_MANAGER);

        // create Permission Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::PERMISSION_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PERMISSIONS, PermissionsEnum::CAN_VIEW_ANY_PERMISSIONS, PermissionsEnum::CAN_CREATE_PERMISSIONS, PermissionsEnum::CAN_UPDATE_PERMISSIONS, PermissionsEnum::CAN_DELETE_PERMISSIONS]);
        $this->command->info($grant_role_msg.RolesEnum::PERMISSION_ADMIN);

        // create User User with default permissions
        $user_role = Role::create(['name' => RolesEnum::USER_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_USERS, PermissionsEnum::CAN_VIEW_ANY_USERS, PermissionsEnum::CAN_CREATE_USERS, PermissionsEnum::CAN_VIEW_AUDIT_USERS]);
        $this->command->info($grant_role_msg.RolesEnum::USER_USER);

        // create User Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::USER_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_USERS, PermissionsEnum::CAN_VIEW_ANY_USERS, PermissionsEnum::CAN_CREATE_USERS, PermissionsEnum::CAN_VIEW_AUDIT_USERS, PermissionsEnum::CAN_UPDATE_USERS]);
        $this->command->info($grant_role_msg.RolesEnum::USER_MANAGER);

        // create User Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::USER_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_USERS, PermissionsEnum::CAN_VIEW_ANY_USERS, PermissionsEnum::CAN_CREATE_USERS, PermissionsEnum::CAN_VIEW_AUDIT_USERS, PermissionsEnum::CAN_UPDATE_USERS, PermissionsEnum::CAN_DELETE_USERS, PermissionsEnum::CAN_RESTORE_AUDIT_USERS]);
        $this->command->info($grant_role_msg.RolesEnum::USER_ADMIN);

        // create Customer User with default permissions
        $user_role = Role::create(['name' => RolesEnum::CUSTOMER_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_CREATE_CUSTOMERS, PermissionsEnum::CAN_VIEW_AUDIT_CUSTOMERS]);
        $this->command->info($grant_role_msg.RolesEnum::CUSTOMER_USER);

        // create Customer Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::CUSTOMER_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_CREATE_CUSTOMERS, PermissionsEnum::CAN_VIEW_AUDIT_CUSTOMERS, PermissionsEnum::CAN_UPDATE_CUSTOMERS]);
        $this->command->info($grant_role_msg.RolesEnum::CUSTOMER_MANAGER);

        // create Customer Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::CUSTOMER_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_CREATE_CUSTOMERS, PermissionsEnum::CAN_VIEW_AUDIT_CUSTOMERS, PermissionsEnum::CAN_UPDATE_CUSTOMERS, PermissionsEnum::CAN_DELETE_CUSTOMERS, PermissionsEnum::CAN_RESTORE_AUDIT_CUSTOMERS]);
        $this->command->info($grant_role_msg.RolesEnum::CUSTOMER_ADMIN);

        // create Floor User with default permissions
        $user_role = Role::create(['name' => RolesEnum::FLOOR_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_FLOORS, PermissionsEnum::CAN_VIEW_ANY_FLOORS, PermissionsEnum::CAN_CREATE_FLOORS, PermissionsEnum::CAN_VIEW_AUDIT_FLOORS]);
        $this->command->info($grant_role_msg.RolesEnum::FLOOR_USER);

        // create Floor Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::FLOOR_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_FLOORS, PermissionsEnum::CAN_VIEW_ANY_FLOORS, PermissionsEnum::CAN_CREATE_FLOORS, PermissionsEnum::CAN_VIEW_AUDIT_FLOORS, PermissionsEnum::CAN_UPDATE_FLOORS]);
        $this->command->info($grant_role_msg.RolesEnum::FLOOR_MANAGER);

        // create Floor Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::FLOOR_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_FLOORS, PermissionsEnum::CAN_VIEW_ANY_FLOORS, PermissionsEnum::CAN_CREATE_FLOORS, PermissionsEnum::CAN_VIEW_AUDIT_FLOORS, PermissionsEnum::CAN_UPDATE_FLOORS, PermissionsEnum::CAN_DELETE_FLOORS, PermissionsEnum::CAN_RESTORE_AUDIT_FLOORS]);
        $this->command->info($grant_role_msg.RolesEnum::FLOOR_ADMIN);

        // create Locker User with default permissions
        $user_role = Role::create(['name' => RolesEnum::LOCKER_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKERS, PermissionsEnum::CAN_VIEW_ANY_LOCKERS, PermissionsEnum::CAN_CREATE_LOCKERS, PermissionsEnum::CAN_VIEW_AUDIT_LOCKERS]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_USER);

        // create Locker Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::LOCKER_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKERS, PermissionsEnum::CAN_VIEW_ANY_LOCKERS, PermissionsEnum::CAN_CREATE_LOCKERS, PermissionsEnum::CAN_VIEW_AUDIT_LOCKERS, PermissionsEnum::CAN_UPDATE_LOCKERS]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_MANAGER);

        // create Locker Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::LOCKER_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKERS, PermissionsEnum::CAN_VIEW_ANY_LOCKERS, PermissionsEnum::CAN_CREATE_LOCKERS, PermissionsEnum::CAN_VIEW_AUDIT_LOCKERS, PermissionsEnum::CAN_UPDATE_LOCKERS, PermissionsEnum::CAN_DELETE_LOCKERS, PermissionsEnum::CAN_RESTORE_AUDIT_LOCKERS]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_ADMIN);

        // create Status User with default permissions
        $user_role = Role::create(['name' => RolesEnum::STATUS_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATUSES, PermissionsEnum::CAN_VIEW_ANY_STATUSES, PermissionsEnum::CAN_CREATE_STATUSES, PermissionsEnum::CAN_VIEW_AUDIT_STATUSES]);
        $this->command->info($grant_role_msg.RolesEnum::STATUS_USER);

        // create Status Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::STATUS_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATUSES, PermissionsEnum::CAN_VIEW_ANY_STATUSES, PermissionsEnum::CAN_CREATE_STATUSES, PermissionsEnum::CAN_VIEW_AUDIT_STATUSES, PermissionsEnum::CAN_UPDATE_STATUSES]);
        $this->command->info($grant_role_msg.RolesEnum::STATUS_MANAGER);

        // create Status Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::STATUS_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATUSES, PermissionsEnum::CAN_VIEW_ANY_STATUSES, PermissionsEnum::CAN_CREATE_STATUSES, PermissionsEnum::CAN_VIEW_AUDIT_STATUSES, PermissionsEnum::CAN_UPDATE_STATUSES, PermissionsEnum::CAN_DELETE_STATUSES, PermissionsEnum::CAN_RESTORE_AUDIT_STATUSES]);
        $this->command->info($grant_role_msg.RolesEnum::STATUS_ADMIN);

        // create Visit User with default permissions
        $user_role = Role::create(['name' => RolesEnum::VISIT_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_VISITS, PermissionsEnum::CAN_VIEW_ANY_VISITS, PermissionsEnum::CAN_CREATE_VISITS, PermissionsEnum::CAN_VIEW_AUDIT_VISITS]);
        $this->command->info($grant_role_msg.RolesEnum::VISIT_USER);

        // create Visit Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::VISIT_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_VISITS, PermissionsEnum::CAN_VIEW_ANY_VISITS, PermissionsEnum::CAN_CREATE_VISITS, PermissionsEnum::CAN_VIEW_AUDIT_VISITS, PermissionsEnum::CAN_UPDATE_VISITS]);
        $this->command->info($grant_role_msg.RolesEnum::VISIT_MANAGER);

        // create Visit Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::VISIT_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_VISITS, PermissionsEnum::CAN_VIEW_ANY_VISITS, PermissionsEnum::CAN_CREATE_VISITS, PermissionsEnum::CAN_VIEW_AUDIT_VISITS, PermissionsEnum::CAN_UPDATE_VISITS, PermissionsEnum::CAN_DELETE_VISITS, PermissionsEnum::CAN_RESTORE_AUDIT_VISITS]);
        $this->command->info($grant_role_msg.RolesEnum::VISIT_ADMIN);

        //create ProofType User with default permissions
        $user_role = Role::create(['name' => RolesEnum::PROOF_TYPE_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PROOF_TYPES, PermissionsEnum::CAN_VIEW_ANY_PROOF_TYPES, PermissionsEnum::CAN_CREATE_PROOF_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_PROOF_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::PROOF_TYPE_USER);

        // create ProofType Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::PROOF_TYPE_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PROOF_TYPES, PermissionsEnum::CAN_VIEW_ANY_PROOF_TYPES, PermissionsEnum::CAN_CREATE_PROOF_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_PROOF_TYPES, PermissionsEnum::CAN_UPDATE_PROOF_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::PROOF_TYPE_MANAGER);

        // create ProofType Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::PROOF_TYPE_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_PROOF_TYPES, PermissionsEnum::CAN_VIEW_ANY_PROOF_TYPES, PermissionsEnum::CAN_CREATE_PROOF_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_PROOF_TYPES, PermissionsEnum::CAN_UPDATE_PROOF_TYPES, PermissionsEnum::CAN_DELETE_PROOF_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::PROOF_TYPE_ADMIN);

        // create State User with default permissions
        $user_role = Role::create(['name' => RolesEnum::STATE_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATES, PermissionsEnum::CAN_VIEW_ANY_STATES, PermissionsEnum::CAN_CREATE_STATES, PermissionsEnum::CAN_VIEW_AUDIT_STATES]);
        $this->command->info($grant_role_msg.RolesEnum::STATE_USER);

        // create State Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::STATE_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATES, PermissionsEnum::CAN_VIEW_ANY_STATES, PermissionsEnum::CAN_CREATE_STATES, PermissionsEnum::CAN_VIEW_AUDIT_STATES, PermissionsEnum::CAN_UPDATE_STATES]);
        $this->command->info($grant_role_msg.RolesEnum::STATE_MANAGER);

        // create State Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::STATE_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_STATES, PermissionsEnum::CAN_VIEW_ANY_STATES, PermissionsEnum::CAN_CREATE_STATES, PermissionsEnum::CAN_VIEW_AUDIT_STATES, PermissionsEnum::CAN_UPDATE_STATES, PermissionsEnum::CAN_DELETE_STATES, PermissionsEnum::CAN_RESTORE_AUDIT_STATES]);
        $this->command->info($grant_role_msg.RolesEnum::STATE_ADMIN);

        // create Document User with default permissions
        $user_role = Role::create(['name' => RolesEnum::DOCUMENT_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_DOCUMENTS, PermissionsEnum::CAN_VIEW_ANY_DOCUMENTS, PermissionsEnum::CAN_CREATE_DOCUMENTS, PermissionsEnum::CAN_VIEW_AUDIT_DOCUMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::DOCUMENT_USER);

        // create Document Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::DOCUMENT_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_DOCUMENTS, PermissionsEnum::CAN_VIEW_ANY_DOCUMENTS, PermissionsEnum::CAN_CREATE_DOCUMENTS, PermissionsEnum::CAN_VIEW_AUDIT_DOCUMENTS, PermissionsEnum::CAN_UPDATE_DOCUMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::DOCUMENT_MANAGER);

        // create Document Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::DOCUMENT_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_DOCUMENTS, PermissionsEnum::CAN_VIEW_ANY_DOCUMENTS, PermissionsEnum::CAN_CREATE_DOCUMENTS, PermissionsEnum::CAN_VIEW_AUDIT_DOCUMENTS, PermissionsEnum::CAN_UPDATE_DOCUMENTS, PermissionsEnum::CAN_DELETE_DOCUMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::DOCUMENT_ADMIN);

        // create Agreement User with default permissions
        $user_role = Role::create(['name' => RolesEnum::AGREEMENT_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_AGREEMENTS, PermissionsEnum::CAN_VIEW_ANY_AGREEMENTS, PermissionsEnum::CAN_CREATE_AGREEMENTS, PermissionsEnum::CAN_VIEW_AUDIT_AGREEMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::AGREEMENT_USER);

        // create Agreement Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::AGREEMENT_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_AGREEMENTS, PermissionsEnum::CAN_VIEW_ANY_AGREEMENTS, PermissionsEnum::CAN_CREATE_AGREEMENTS, PermissionsEnum::CAN_VIEW_AUDIT_AGREEMENTS, PermissionsEnum::CAN_UPDATE_AGREEMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::AGREEMENT_MANAGER);

        // create Agreement Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::AGREEMENT_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_AGREEMENTS, PermissionsEnum::CAN_VIEW_ANY_AGREEMENTS, PermissionsEnum::CAN_CREATE_AGREEMENTS, PermissionsEnum::CAN_VIEW_AUDIT_AGREEMENTS, PermissionsEnum::CAN_UPDATE_AGREEMENTS, PermissionsEnum::CAN_DELETE_AGREEMENTS]);
        $this->command->info($grant_role_msg.RolesEnum::AGREEMENT_ADMIN);

        // create Tennure User with default permissions
        $user_role = Role::create(['name' => RolesEnum::TENNURE_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_TENNURES, PermissionsEnum::CAN_VIEW_ANY_TENNURES, PermissionsEnum::CAN_CREATE_TENNURES, PermissionsEnum::CAN_VIEW_AUDIT_TENNURES]);
        $this->command->info($grant_role_msg.RolesEnum::TENNURE_USER);

        // create Tennure Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::TENNURE_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_TENNURES, PermissionsEnum::CAN_VIEW_ANY_TENNURES, PermissionsEnum::CAN_CREATE_TENNURES, PermissionsEnum::CAN_VIEW_AUDIT_TENNURES, PermissionsEnum::CAN_UPDATE_TENNURES]);
        $this->command->info($grant_role_msg.RolesEnum::TENNURE_MANAGER);

        // create Tennure Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::TENNURE_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_TENNURES, PermissionsEnum::CAN_VIEW_ANY_TENNURES, PermissionsEnum::CAN_CREATE_TENNURES, PermissionsEnum::CAN_VIEW_AUDIT_TENNURES, PermissionsEnum::CAN_UPDATE_TENNURES, PermissionsEnum::CAN_DELETE_TENNURES]);
        $this->command->info($grant_role_msg.RolesEnum::TENNURE_ADMIN);

        // create LockerType User with default permissions
        $user_role = Role::create(['name' => RolesEnum::LOCKER_TYPE_USER]);
        $user_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_ANY_LOCKER_TYPES, PermissionsEnum::CAN_CREATE_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_LOCKER_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_TYPE_USER);

        // create LockerType Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::LOCKER_TYPE_MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_ANY_LOCKER_TYPES, PermissionsEnum::CAN_CREATE_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_LOCKER_TYPES, PermissionsEnum::CAN_UPDATE_LOCKER_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_TYPE_MANAGER);

        // create LockerType Admin with default permissions
        $admin_role = Role::create(['name' => RolesEnum::LOCKER_TYPE_ADMIN]);
        $admin_role->givePermissionTo([PermissionsEnum::CAN_VIEW_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_ANY_LOCKER_TYPES, PermissionsEnum::CAN_CREATE_LOCKER_TYPES, PermissionsEnum::CAN_VIEW_AUDIT_LOCKER_TYPES, PermissionsEnum::CAN_UPDATE_LOCKER_TYPES, PermissionsEnum::CAN_DELETE_LOCKER_TYPES]);
        $this->command->info($grant_role_msg.RolesEnum::LOCKER_TYPE_ADMIN);

        // create Manager role with default permissions
        $manager_role = Role::create(['name' => RolesEnum::MANAGER]);
        $manager_role->givePermissionTo([PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_CREATE_CUSTOMERS, PermissionsEnum::CAN_UPDATE_CUSTOMERS, PermissionsEnum::CAN_DELETE_CUSTOMERS,
            PermissionsEnum::CAN_VIEW_VISITS, PermissionsEnum::CAN_VIEW_ANY_VISITS, PermissionsEnum::CAN_CREATE_VISITS, PermissionsEnum::CAN_UPDATE_VISITS, PermissionsEnum::CAN_DELETE_VISITS,
            PermissionsEnum::CAN_VIEW_FLOORS, PermissionsEnum::CAN_VIEW_ANY_FLOORS, PermissionsEnum::CAN_VIEW_ANY_LOCKERS, PermissionsEnum::CAN_VIEW_STATUSES, PermissionsEnum::CAN_VIEW_ANY_STATUSES,
            PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_VIEW_USERS, PermissionsEnum::CAN_VIEW_ANY_USERS]);
        $this->command->info($grant_role_msg.RolesEnum::MANAGER);

        // create Operator role with default permissions
        $operator_role = Role::create(['name' => RolesEnum::OPERATOR]);
        $operator_role->givePermissionTo([PermissionsEnum::CAN_VIEW_VISITS, PermissionsEnum::CAN_VIEW_ANY_VISITS, PermissionsEnum::CAN_CREATE_VISITS, PermissionsEnum::CAN_UPDATE_VISITS,
            PermissionsEnum::CAN_VIEW_FLOORS, PermissionsEnum::CAN_VIEW_ANY_FLOORS, PermissionsEnum::CAN_VIEW_LOCKERS, PermissionsEnum::CAN_VIEW_ANY_LOCKERS, PermissionsEnum::CAN_VIEW_STATUSES, PermissionsEnum::CAN_VIEW_ANY_STATUSES,
            PermissionsEnum::CAN_VIEW_CUSTOMERS, PermissionsEnum::CAN_VIEW_ANY_CUSTOMERS, PermissionsEnum::CAN_VIEW_USERS, PermissionsEnum::CAN_VIEW_ANY_USERS]);
        $this->command->info($grant_role_msg.RolesEnum::OPERATOR);

        Role::create(['name' => RolesEnum::SUPER_ADMIN]);
        $this->command->info('Super Admin Role created successfully');

        // Create Default users with Super Admin Privilages
        $user = User::factory()->create([
            'name' => 'Raja Subramanian',
            'email' => 'raja@kongunadlocker.com',
            'password' => Hash::make('fb0f0b0cc9c1e81d'),
        ]);

        $user->assignRole(RolesEnum::SUPER_ADMIN);
        $this->command->info('User Raja Subramanian created with Super Admin Role');

        $user = User::factory()->create([
            'name' => 'Pavithra',
            'email' => 'pavithra@kongunadlocker.com',
            'password' => Hash::make('fb0f0b0cc9c1e81d'),
        ]);

        $user->assignRole(RolesEnum::SUPER_ADMIN);
        $this->command->info('User Pavithra created with Super Admin Role');

        $user = User::factory()->create([
            'name' => 'Manager',
            'email' => 'manager@kongunadlocker.com',
            'password' => Hash::make('fb0f0b0cc9c1e81d'),
        ]);

        $user->assignRole(RolesEnum::SUPER_ADMIN);
        $this->command->info('User Manager created with Super Admin Role');
        $this->command->alert('Manager has Super Admin Privileges. This is only for demo purposes. Make sure to change the Role in Production');

        $user = User::factory()->create([
            'name' => 'Info',
            'email' => 'info@kongunadlocker.com',
            'password' => Hash::make('fb0f0b0cc9c1e81d'),
        ]);

        $user->assignRole(RolesEnum::SUPER_ADMIN);
        $this->command->info('User Info created with Super Admin Role');
        $this->command->alert('Info has Super Admin Privileges. This is only for demo purposes. Make sure to change the Role in Production');
    }
}
