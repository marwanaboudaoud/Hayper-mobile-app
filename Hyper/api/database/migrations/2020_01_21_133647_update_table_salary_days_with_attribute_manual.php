<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableSalaryDaysWithAttributeManual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('salary_days', function (Blueprint $table) {
            $table->boolean('is_manual')
                ->after('has_driven')
                ->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('salary_days', function (Blueprint $table) {
            $table->dropColumn('is_manual');
        });
    }
}
