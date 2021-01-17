<?php

use App\Partner;

use Illuminate\Database\Seeder;

class PartnerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Partner::class,25)->create();
    }
}
