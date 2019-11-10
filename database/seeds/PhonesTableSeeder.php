<?php

use Illuminate\Database\Seeder;

class PhonesTableSeeder extends Seeder
{
    public function run()
    {
        $rows = [
                    [ 'id' => '1', 'user_id' => '1', 'ord_phone' => '1', 'phone' => '89998887766' ],
                    [ 'id' => '2', 'user_id' => '1', 'ord_phone' => '2', 'phone' => '89887776655' ],

                    [ 'id' => '3', 'user_id' => '2', 'ord_phone' => '1', 'phone' => '89776654433' ],
                    [ 'id' => '4', 'user_id' => '2', 'ord_phone' => '2', 'phone' => '89665554432' ],

                    [ 'id' => '5', 'user_id' => '3', 'ord_phone' => '1', 'phone' => '89554443322' ],
                    [ 'id' => '6', 'user_id' => '3', 'ord_phone' => '2', 'phone' => '89443332211' ],
                ];

        foreach($rows as $row) {
            DB::table('phones')->insert($row);
        }
    }
}
