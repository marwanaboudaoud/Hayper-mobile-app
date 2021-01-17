<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableEmployeeScheduleWithOnDeleteOnCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_schedule', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);

            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_schedule', function (Blueprint $table) {
            $table->dropForeign(['schedule_id']);

            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules');
        });
    }
}
