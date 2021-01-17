<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(HourlyWageSeeder::class);

        if (env('APP_ENV') === 'local') {
            $this->call(UserTableSeeder::class);
            $this->call(PartnerTableSeeder::class);
            $this->call(ProjectTableSeeder::class);
            $this->call(ScheduleTableSeeder::class);
            $this->call(SalaryTableSeeder::class);
        }
    }
}
