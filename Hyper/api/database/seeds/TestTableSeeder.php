<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(HourlyWageSeeder::class);

        // Create users
        factory(App\User::class)->create([
            'first_name' => 'Ricky',
            'insertion' => 'van',
            'last_name' => 'Waas',
            'role_id' => 1,
            'is_active' => 1,
            'email' => 'dashboard@holygrow.nl'
        ]);

        $employee = factory(App\User::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role_id' => 2,
            'email' => 'app@holygrow.nl',
            'is_active' => 1,
            'has_drivers_license' => true
        ]);

        $address = factory(\App\Address::class)->create([
            'street' => 'Pergolesistraat',
            'house_number' => 19,
            'postcode' => '2901PA',
            'city' => 'Capelle aan den IJssel',
            'is_active' => true,
            'user_id' => $employee->id
        ]);

        $emergencyContact = factory(\App\EmergencyContact::class)->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'phone' => '0101234567891',
            'relationship' => 'Vriendin',
            'user_id' => $employee->id
        ]);

        $ziggo = factory(\App\Partner::class)->create([
            'name' => 'Ziggo'
        ]);

        $schedule = factory(\App\Schedule::class)->create([
            'name' => 'Albert heijn',
            'address' => 'Beursplein 100',
            'postcode' => '3014HD',
            'city' => 'Rotterdam',
            'date' => \Carbon\Carbon::now()->toDateString(),
            'project_id' => factory(\App\Project::class)->create([
                'partner_id' => $ziggo->id
            ]),
            'driver_id' => $employee->id,
            'availability_shift_id' => 1
        ]);

        $schedule ->employeeSchedules()->attach(
            $employee->id
        );

        $kpn = factory(\App\Partner::class)->create([
            'name' => 'KPN'
        ]);

        $schedule = factory(\App\Schedule::class)->create([
            'name' => 'Jumbo',
            'address' => 'Beursplein 25',
            'postcode' => '1010SS',
            'city' => 'Amsterdam',
            'date' => \Carbon\Carbon::now()->addDay()->toDateString(),
            'project_id' => factory(\App\Project::class)->create([
                'partner_id' => $kpn->id
            ]),
            'driver_id' => $employee->id,
            'availability_shift_id' => 2
        ]);

        $schedule ->employeeSchedules()->attach(
            $employee->id
        );

        $salary = factory(\App\Salary::class)->create([
            'date' => \Carbon\Carbon::now()->startOfMonth()->toDateString(),
            'is_closed' => false,
            'description' => 'Salaris Maart',
            'user_id' => $employee->id
        ]);
        $salaryDay = factory(\App\SalaryDay::class)->create([
            'partner_id' => $ziggo->id,
            'date' => \Carbon\Carbon::now()->startOfMonth()->addDays(5),
            'salary_id' => $salary->id,
            'is_manual' => false
        ]);
        $salaryRow = factory(\App\SalaryRow::class)->create([
            'description' => 'Basis bedrag',
            'amount' => 1,
            'price' => 75.55,
            'is_bonus' => false,
            'salary_day_id' => $salaryDay->id
        ]);
        $salaryRow = factory(\App\SalaryRow::class)->create([
            'description' => 'Beloning',
            'underline_description' => '6802T/36mnd/Drie jaar',
            'amount' => 1,
            'price' => 30.00,
            'is_bonus' => true,
            'salary_day_id' => $salaryDay->id
        ]);
        $salaryRow = factory(\App\SalaryRow::class)->create([
            'description' => 'Bonus bij 3 inschrijvingen',
            'amount' => 1,
            'price' => 30.00,
            'is_bonus' => true,
            'salary_day_id' => $salaryDay->id
        ]);

        $contract = factory(\App\EmploymentContract::class)->create([
            'start_date' => \Carbon\Carbon::now()->startOfYear(),
            'end_date' => \Carbon\Carbon::now()->addWeek(2),
            'trial_per_day' => 10,
            'user_id' => $employee->id,
            'document_number' => sha1(rand(1, 100) * 10),
        ]);
    }
}
