<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmploymentContractActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_contract_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contract_id')->unsigned();
            $table->bigInteger('new_contract_id')->unsigned();
            $table->foreign('contract_id')
                ->references('id')->on('employment_contracts');
            $table->foreign('new_contract_id')
                ->references('id')->on('employment_contracts');
            $table->boolean('is_extended');
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
        Schema::dropIfExists('employment_contract_actions');
    }
}
