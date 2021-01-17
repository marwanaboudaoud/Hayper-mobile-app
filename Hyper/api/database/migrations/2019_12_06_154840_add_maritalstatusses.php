<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaritalstatusses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::insert("INSERT INTO marital_statuses (name) values
    ('Extraneï'),
    ('Gehuwd'),
    ('Gescheiden na partnerschap'),
    ('Gescheiden na wettig huwelijk'),
    ('Ongehuwd'),
    ('Partnerschap'),
    ('Verweduwd'),
    ('Verweduwd na partnerschap'),
    ('Verweduwd na wettig huwelijkl'),
    ('Verweduwing'),
    ('Wettig gehuwd')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
