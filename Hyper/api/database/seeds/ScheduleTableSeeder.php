<?php

use Illuminate\Database\Seeder;

class ScheduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Schedule::class, 55)->create([
            'project_id' => factory(\App\Project::class)->create([
                'partner_id' => factory(\App\Partner::class)->create()->id
            ]),
            'driver_id' => factory(\App\User::class)->create()->id,
            'availability_shift_id' => factory(\App\AvailabilityShift::class)->create()->id
        ]);

        $users = \App\User::all();

        App\Schedule::all()->each(function ($schedule) use ($users) {
            $schedule->employeeSchedules()->attach(
                $users->random()->first()->id
            );
        });
    }
}
