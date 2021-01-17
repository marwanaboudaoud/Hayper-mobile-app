<?php

use App\Partner;
use App\Project;
use Illuminate\Database\Seeder;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Project::class, 25)->create([
            'partner_id' => Partner::all()->random(1)->first()->id
        ]);
    }
}
