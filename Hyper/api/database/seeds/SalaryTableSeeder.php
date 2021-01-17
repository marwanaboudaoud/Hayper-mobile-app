<?php

use Illuminate\Database\Seeder;

class SalaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Salary::class, 25)->create();
        $partner = factory(\App\Partner::class)->create();

        \App\Salary::all()->each(function ($salary, $index) use ($partner) {


            $salaryDays = factory(\App\SalaryDay::class, 15)->create([
                'partner_id' => $partner->id,
                'date' => \Carbon\Carbon::now()->toDateString(),
                'salary_id' => $salary->id
            ])->each(function ($item, $index) use ($salary) {
                $nextDay = \Carbon\Carbon::createFromFormat('Y-m-d', $salary->date)->addDays($index + 1)->toDateString();
                $item->date = $nextDay;
                $item->save();
            });

            $salaryDays->each(function ($salaryDay) {
                factory(\App\SalaryRow::class, 5)->create([
                    'salary_day_id' => $salaryDay->id
                ]);
            });
        });
    }
}
