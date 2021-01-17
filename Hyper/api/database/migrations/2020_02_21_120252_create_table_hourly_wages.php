<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHourlyWages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hourly_wages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('age');
            $table->float('amount');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->on('roles')->references('id');
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
        Schema::dropIfExists('hourly_wages');
    }
}
