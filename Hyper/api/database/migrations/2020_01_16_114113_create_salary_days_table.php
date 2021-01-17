<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->boolean('has_driven');

            $table->unsignedBigInteger('salary_id');
            $table->foreign('salary_id')
                ->references('id')
                ->on('salaries');

            $table->unsignedBigInteger('partner_id');

            $table->foreign('partner_id')
                ->references('id')
                ->on('partners');
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
        Schema::dropIfExists('salary_days');
    }
}
