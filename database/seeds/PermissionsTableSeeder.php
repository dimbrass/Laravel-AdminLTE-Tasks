<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
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
           'worker-list',
           'worker-add',
           'worker-comment',
           'worker-delete',

           'worker-task-list',
           'worker-task-add',
           'worker-task-delete',

           'task-list',
           'task-create',
           'task-edit',
           'task-execute',
           'task-delete',

           'task-report',
           'task-rm',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
