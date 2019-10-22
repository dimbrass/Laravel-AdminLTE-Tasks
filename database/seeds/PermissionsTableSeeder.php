<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
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

       $permissions = [
           'permission-list',
           'permission-create',
           'permission-edit',
           'permission-delete',

           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

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

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
