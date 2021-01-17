<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableProjectsWithNewAttributes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('house_number');
            $table->dropColumn('postcode');
            $table->dropColumn('city');

            $table->boolean('is_active')->default(true)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('address');
            $table->string('house_number');
            $table->string('postcode');
            $table->string('city');

            $table->dropColumn('is_active');
        });
    }
}
