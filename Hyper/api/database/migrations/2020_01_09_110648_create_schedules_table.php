<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->string('address');

            $table->string('postcode');

            $table->string('city');

            $table->date('date');

            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')
                ->onDelete('cascade');

            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
