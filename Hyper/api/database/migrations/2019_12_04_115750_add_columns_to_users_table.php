<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //            $table->string('gender')->nullable();
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('nmbrs_id')->unique()->nullable();

            $table->string('alias')->after('id')->nullable();

            $table->string('initials')->after('alias')->nullable();

            $table->string('first_name')->after('initials');

            $table->string('insertion')->after('first_name');

            $table->string('last_name')->after('insertion');

            $table->string('phone')->after('last_name')->nullable();

            $table->boolean('has_drivers_license')->after('phone');

            $table->date('date_of_birth')->after('has_drivers_license')->nullable();

            $table->unsignedBigInteger('country_of_birth_id')->after('date_of_birth');
            $table->foreign('country_of_birth_id')
                ->references('id')
                ->on('countries');

            $table->unsignedBigInteger('nationality_id')->after('country_of_birth_id');
            $table->foreign('nationality_id')
                ->references('id')
                ->on('nationalities');

            $table->unsignedBigInteger('marital_status_id')->after('nationality_id');
            $table->foreign('marital_status_id')
                ->references('id')
                ->on('marital_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nmbrs_id');
            $table->dropColumn('alias');
            $table->dropColumn('first_name');
            $table->dropColumn('insertion');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('has_drivers_license');
            $table->dropColumn('date_of_birth');

            $table->dropForeign(['country_of_birth_id']);
            $table->dropForeign(['nationality_id']);
            $table->dropForeign(['marital_status_id']);
        });
    }
}
