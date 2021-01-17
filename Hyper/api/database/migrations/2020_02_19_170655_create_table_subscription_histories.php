<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSubscriptionHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_subscriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('duration_in_months');
            $table->date('starting_date');
            $table->float('reward');
            $table->boolean('is_bonus_calc');
            $table->string('bw_code')->nullable();
            $table->unsignedBigInteger('subscription_id');
            $table->foreign('subscription_id')
                ->references('id')
                ->on('subscriptions');
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')
                ->references('id')
                ->on('projects');
            $table->boolean('is_active');
            $table->dateTime('active_at');
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
        Schema::dropIfExists('history_subscriptions');
    }
}
