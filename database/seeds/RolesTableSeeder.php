<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
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

       $manager_permissions = [
           'user-list',
           'user-permission-add',
           'user-permission-delete',
           'user-role-add',
           'user-role-delete',

           'task-list',
           'task-create',
           'task-edit',
           'task-execute',
           'task-delete',
        ];

       $worker_permissions = [
           'task-list',
           'task-create',
           'task-edit',
           'task-execute',
           'task-delete',
        ];

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'manager'])
            ->givePermissionTo($manager_permissions);
        $role = Role::create(['name' => 'worker'])
            ->givePermissionTo($worker_permissions);
    }
}
