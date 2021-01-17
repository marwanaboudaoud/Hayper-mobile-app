<?php

use Illuminate\Database\Seeder;

class HourlyWageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\HourlyWage::class)->create([
            'age' => '17',
            'role_id' => 2,
            'amount' => 3.77
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '18',
            'role_id' => 2,
            'amount' => 4.77
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '19',
            'role_id' => 2,
            'amount' => 5.73
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '20',
            'role_id' => 2,
            'amount' => 7.64
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '21',
            'role_id' => 2,
            'amount' => 9.54
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '17',
            'role_id' => 3,
            'amount' => 9.54
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '18',
            'role_id' => 3,
            'amount' => 9.54
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '19',
            'role_id' => 3,
            'amount' => 9.54
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '20',
            'role_id' => 3,
            'amount' => 9.54
        ]);

        factory(\App\HourlyWage::class)->create([
            'age' => '21',
            'role_id' => 3,
            'amount' => 9.54
        ]);
    }
}
