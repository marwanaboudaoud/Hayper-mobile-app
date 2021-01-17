<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryRowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_rows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->integer('amount');
            $table->float('price');
            $table->unsignedBigInteger('salary_day_id');
            $table->foreign('salary_day_id')
                ->references('id')
                ->on('salary_days');
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
        Schema::dropIfExists('salary_rows');
    }
}
