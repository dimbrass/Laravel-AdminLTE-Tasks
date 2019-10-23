<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
            'created_at' => '2019-10-01',
            'userrole_id' => '1',
        ]);

        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@manager.manager',
            'password' => bcrypt('manager'),
            'created_at' => '2019-10-01',
            'userrole_id' => '2',
        ]);

        DB::table('users')->insert([
            'name' => 'worker',
            'email' => 'worker@worker.worker',
            'password' => bcrypt('worker'),
            'created_at' => '2019-10-01',
            'userrole_id' => '3',
        ]);
    }
}
