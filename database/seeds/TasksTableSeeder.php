<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        $tasks = [
            [ 'id' => '1', 'user_id' => '1', 'name' => 'admin task 1', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '2', 'user_id' => '1', 'name' => 'admin task 2', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '3', 'user_id' => '1', 'name' => 'admin task 3', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '4', 'user_id' => '1', 'name' => 'admin task 4', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '5', 'user_id' => '1', 'name' => 'admin task 5', 'created_at' => '2019-11-06 10:11:52' ],

            [ 'id' => '6', 'user_id' => '2', 'name' => 'manager task 1', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '7', 'user_id' => '2', 'name' => 'manager task 2', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '8', 'user_id' => '2', 'name' => 'manager task 3', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '9', 'user_id' => '2', 'name' => 'manager task 4', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '10', 'user_id' => '2', 'name' => 'manager task 5', 'created_at' => '2019-11-06 10:11:52' ],

            [ 'id' => '11', 'user_id' => '3', 'name' => 'worker task 1', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '12', 'user_id' => '3', 'name' => 'worker task 2', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '13', 'user_id' => '3', 'name' => 'worker task 3', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '14', 'user_id' => '3', 'name' => 'worker task 4', 'created_at' => '2019-11-06 10:11:52' ],
            [ 'id' => '15', 'user_id' => '3', 'name' => 'worker task 5', 'created_at' => '2019-11-06 10:11:52' ],
        ];

        foreach($tasks as $task) {
            DB::table('tasks')->insert($task);
        }
    }
}
