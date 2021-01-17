<?php

namespace Tests\Feature;

use App\Exceptions\Role\RoleNotFoundException;
use App\Project;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $projects = Project::all();

        $role = factory(Role::class)->create();

        $response = $this->post('/api/employees/store', [
            'alias' => 'Rickert',
            'initials' => 'rvw',
            'first_name' => 'holy',
            'insertion' => 'G',
            'last_name' => 'stonl',
            'email' => Str::random(25) . '@holygrow.nl',
            'phone' => '0631955082',
            'has_drivers_license' => true,
            'date_of_birth' => '2019-01-01',
            'country_of_birth_id' => 1,
            'nationality_id' => 1,
            'marital_status_id' => 1,
            'bsn' => 1020303023020203423,
            'iban' => 'nl 89 atvg 09 5894 330',
            'income_tax' => true,
            'role_id' => 2,
            'gender_id' => 1,
            'works_on_project' => $projects->pluck('id')->toArray(),
            'contract' => [
                'start_date' => Carbon::parse('2020-03-19')->format('Y-m-d'),
                'end_date' => Carbon::parse('2020-03-19')->format('Y-m-d'),
                'trial_per_day' => rand(1, 100),
                'user' => $loginUser->id,
                'document_number' => '123123123123a',
            ],
            'address' => [
                'street' => 'Kruisplein',
                'house_number' => 100,
                'postcode' => '3016PA',
                'city' => 'Rotterdam'
            ],
            'emergency_contact' => [
                'first_name' => 'Youandi',
                'last_name' => 'Veltman',
                'phone' => '061234567',
                'relationship' => 'vriendin'
            ],
        ], [
            'api-key' => $loginUser->api_token
        ]);
        $response->assertStatus(200);
    }

    public function testStoreRoleNotFound()
    {
        $loginUser = factory(User::class)->create([
            'is_active' => true,
            'role_id' => 1
        ]);

        $projects = Project::all();

        $response = $this->post('/api/employees/store', [
            'alias' => 'Rickert',
            'initials' => 'rvw',
            'first_name' => 'holy',
            'insertion' => 'G',
            'last_name' => 'stonl',
            'email' => Str::random(25) . '@holygrow.nl',
            'phone' => '0631955082',
            'has_drivers_license' => true,
            'date_of_birth' => '2019-01-01',
            'country_of_birth_id' => 1,
            'nationality_id' => 1,
            'marital_status_id' => 1,
            'bsn' => 1020303023020203423,
            'role_id' => 0,
            'gender_id' => 1,
            'iban' => 'nl 89 atvg 09 5894 330',
            'income_tax' => true,
            'works_on_project' => $projects->pluck('id')->toArray(),
            'contract' => [
                'start_date' => Carbon::parse('2020-03-19')->format('Y-m-d'),
                'end_date' => Carbon::parse('2020-03-19')->format('Y-m-d'),
                'trial_per_day' => rand(1, 100),
                'user' => $loginUser->id,
                'document_number' => '123123123123a',
            ],
            'address' => [
                'street' => 'Kruisplein',
                'house_number' => 100,
                'postcode' => '3016PA',
                'city' => 'Rotterdam'
            ],
            'emergency_contact' => [
                'first_name' => 'Youandi',
                'last_name' => 'Veltman',
                'phone' => '061234567',
                'relationship' => 'vriendin'
            ],
        ], [
            'api-key' => $loginUser->api_token
        ]);

        $response->assertStatus(409);
    }
}
