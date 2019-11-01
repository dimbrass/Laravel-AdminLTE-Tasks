<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTasksTableChangeFieldTaskComplete extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            //$table->tinyInteger('complete')->nullable()->change();
            DB::statement('ALTER TABLE tasks MODIFY COLUMN complete INTEGER(1)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
