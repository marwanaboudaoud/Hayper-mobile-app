<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEmployementContractsTableWithDocumentNumberAndExpirationDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employment_contracts', function (Blueprint $table) {
            $table->string('document_number');
            $table->date('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employment_contracts', function (Blueprint $table) {
            $table->dropColumn('document_number');
            $table->dropColumn('expiration_date');
        });
    }
}
