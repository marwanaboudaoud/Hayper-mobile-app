<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGrossAmountToHistorySubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('history_subscriptions', function (Blueprint $table) {
            $table->double('gross_amount')->after('starting_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_subscriptions', function (Blueprint $table) {
            $table->dropColumn('gross_amount');
        });
    }
}
