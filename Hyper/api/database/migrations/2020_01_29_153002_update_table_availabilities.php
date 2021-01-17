<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableAvailabilities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('availability_shift_id')
                ->after('user_id')
                ->nullable();

            $table->foreign('availability_shift_id')
                ->on('availability_shifts')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('availabilities', function (Blueprint $table) {
            $table->dropForeign(['availability_shift_id']);
            $table->dropColumn('availability_shift_id');
        });
    }
}
