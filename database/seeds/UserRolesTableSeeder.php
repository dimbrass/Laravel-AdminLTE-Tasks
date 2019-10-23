<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('userroles')->insert([
            'id' => '1',
            'admin' => true,
        ]);

        DB::table('userroles')->insert([
            'id' => '2',
            'manager' => true,
        ]);

        DB::table('userroles')->insert([
            'id' => '3',
            'worker' => true,
        ]);
    }
}
