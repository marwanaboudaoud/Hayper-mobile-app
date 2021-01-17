<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDocumentTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::insert("INSERT INTO document_types (name, document_guid_type) VALUES
    ('Contract','b7c39468-7acc-4b34-899b-f7989a044eca'),
    ('CV','fcdc3330-33b9-428c-976d-638637c25062'),
    ('Diploma','1c044ac5-da75-42f8-bf7b-ea6195c3cbbf'),
    ('Foto','07c8a39b-06aa-4903-8372-2713f35ee8a9'),
    ('Foto medewerker','8461e504-d35e-4639-90d3-286d42349efc'),
    ('Identiteitskaart','c586bcb1-c909-4fcc-a204-af3303f073c1'),
    ('Loonbelastingverklaring','726fa8fb-2350-493e-aa7e-5a8b7446ddc8'),
    ('Medewerker-login document','d9dc1190-eb6b-4e04-bba3-39e900205307'),
    ('Motivational Letter','e382872e-d062-4c1f-a78f-3368a812a1cd'),
    ('Overig','c21d471a-2d8c-47a7-b8c4-9bde8d188b13'),
    ('Planning','b66be3b9-f524-4f86-9ed6-6b2ea6d5a2c7')
    ");
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
