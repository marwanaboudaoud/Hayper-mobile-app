<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableWorksOnProjectProjectIdForeignCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works_on_project', function (Blueprint $table) {
            $table->dropForeign(['project_id']);

            $table->foreign('project_id')->references('id')
                ->on('projects')
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
        Schema::table('works_on_project', function (Blueprint $table) {
            $table->dropForeign(['project_id']);

            $table->foreign('project_id')->references('id')
                ->on('projects');
        });
    }
}
