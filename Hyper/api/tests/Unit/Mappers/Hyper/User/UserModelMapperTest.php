<?php

namespace Tests\Feature\Mappers\Hyper\User;

use App\Src\Mappers\Hyper\Auth\ApiTokenModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Address\AddressModel;
use App\Src\Models\Hyper\Contract\EmployeeContractModel;
use App\Src\Models\Hyper\Role\RoleModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class UserModelMapperTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testToArray()
    {
        $role = (new RoleModel());
        $empoyeeContract = (new EmployeeContractModel())
        ->setStartDate(Carbon::now())
        ->setEndDate(Carbon::now());

        $userModel = m::mock(UserModel::class, function ($mock) use ($role, $empoyeeContract) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getAlias')
                ->andReturn('mo');

            $mock->shouldReceive('getNmbrsId')
                ->andReturn(10);

            $mock->shouldReceive('getInitials')
                ->andReturn('mk');

            $mock->shouldReceive('getFirstName')
                ->andReturn('mohamed');

            $mock->shouldReceive('getInsertion')
                ->andReturn('van der');

            $mock->shouldReceive('getLastName')
                ->andReturn('kaddouri');

            $mock->shouldReceive('getPhone')
                ->andReturn('0614674568');

            $mock->shouldReceive('isHasDriversLicense')
                ->andReturn(true);

            $mock->shouldReceive('getAddress')
                ->andReturn(null);

            $mock->shouldReceive('getEmergencyContact')
                ->andReturn(null);

            $mock->shouldReceive('getDateOfBirth')
                ->andReturn('2019-10-26');

            $mock->shouldReceive('getCountryOfBirthId')
                ->andReturn(1);

            $mock->shouldReceive('getNationalityId')
                ->andReturn(1);

            $mock->shouldReceive('getMaritalStatusId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('mohamed@holygrow.nl');

            $mock->shouldReceive('getPassword')
                ->andReturn('1234567WaarIsMoTochGebleven');

            $mock->shouldReceive('getEmailVerifiedAt')
                ->andReturn('2019-03-20');

            $mock->shouldReceive('isActive')
                ->andReturn(true);

            $mock->shouldReceive('getGenderId')
                ->andReturn(1);

            $mock->shouldReceive('getRole')
                ->andReturn($role);

            $mock->shouldReceive('getRoleId')
                ->andReturn(2);

            $mock->shouldReceive('getLocation')
                ->andReturn('amsterdam');

            $mock->shouldReceive('getIntoServiceDate')
                ->andReturn(Carbon::parse('2019-01-13'));

            $mock->shouldReceive('getEndDateContract')
                ->andReturn(Carbon::parse('2019-01-14'));

            $mock->shouldReceive('getIban')
                ->andReturn('hoi123');

            $mock->shouldReceive('isIncomeTax')
                ->andReturn(true);

            $mock->shouldReceive('getEmployeeContract')
            ->andReturn($empoyeeContract);

        });

        // dd($userModel);

        $result = UserModelMapper::toArray($userModel);

        $this->assertEquals([
            'id' => 1,
            'alias' => 'mo',
            'nmbrs_id' => 10,
            'initials' => 'mk',
            'first_name' => 'mohamed',
            'insertion' => 'van der',
            'last_name' => 'kaddouri',
            'phone' => '0614674568',
            'has_drivers_license' => true,
            'date_of_birth' => '2019-10-26',
            'country_of_birth_id' => 1,
            'nationality_id' => 1,
            'marital_status_id' => 1,
            'email' => 'mohamed@holygrow.nl',
            'is_active' => true,
            'gender_id' => 1,
            'role' => [
                'id' => null,
                'title' => null,
                'code_in_nmbrs' => null
            ],
            'role_title' => null,
            'iban' => 'hoi123',
            'income_tax' => true,
            'location' => 'amsterdam',
            'into_service' => '2019-01-13',
            'out_of_service' => '2019-01-14',
            'address' => [],
            'emergency_contact' => [],
            'contract' => [
                       'id' => null,
                       'start_date' => Carbon::now()->toDateString(),
                       'end_date' => Carbon::now()->toDateString(),
                       'trial_per_day' => null,
                       'user_id' => null,
                       'employee_name' => null,
                       'document_number' => null,
                       'contract_in_months' => ' maanden',
                       'is_archived' => null
            ],

        ], $result);
    }

    public function testToEloquentModel()
    {
        $outOfService = Carbon::now();

        $userModel = m::mock(UserModel::class, function ($mock) use ($outOfService) {
            $mock->shouldReceive('getId')
                ->andReturn(1);

            $mock->shouldReceive('getAlias')
                ->andReturn('mo');

            $mock->shouldReceive('getNmbrsId')
                ->andReturn(10);

            $mock->shouldReceive('getInitials')
                ->andReturn('mk');

            $mock->shouldReceive('getFirstName')
                ->andReturn('mohamed');

            $mock->shouldReceive('getInsertion')
                ->andReturn('van der');

            $mock->shouldReceive('getLastName')
                ->andReturn('kaddouri');

            $mock->shouldReceive('getPhone')
                ->andReturn('0614674568');

            $mock->shouldReceive('isHasDriversLicense')
                ->andReturn(true);

            $mock->shouldReceive('getDateOfBirth')
                ->andReturn('2019-10-26');

            $mock->shouldReceive('getCountryOfBirthId')
                ->andReturn(1);

            $mock->shouldReceive('getNationalityId')
                ->andReturn(1);

            $mock->shouldReceive('getMaritalStatusId')
                ->andReturn(1);

            $mock->shouldReceive('getEmail')
                ->andReturn('mohamed@holygrow.nl');

            $mock->shouldReceive('getPassword')
                ->andReturn('1234567WaarIsMoTochGebleven');

            $mock->shouldReceive('isActive')
                ->andReturn(true);

            $mock->shouldReceive('getGenderId')
                ->andReturn(1);

            $mock->shouldReceive('getRole')
                ->andReturn(null);

            $mock->shouldReceive('getRoleId')
                ->andReturn(2);

            $mock->shouldReceive('getLocation')
                ->andReturn('amsterdam');

            $mock->shouldReceive('getGenderId')
                ->andReturn(1);

            $mock->shouldReceive('getIban')
                ->andReturn('hoi123');

            $mock->shouldReceive('isIncomeTax')
                ->andReturn(true);

            $mock->shouldReceive('getOutOfService')
                ->andReturn($outOfService);
        });

        $userModel->getId();
        $results = UserModelMapper::toEloquentModel($userModel);

        $user = new User();
        $user->id = 1;
        $user->alias = 'mo';
        $user->nmbrs_id = 10;
        $user->initials = 'mk';
        $user->gender_id = 1;
        $user->first_name = 'mohamed';
        $user->insertion = 'van der';
        $user->last_name = 'kaddouri';
        $user->phone = '0614674568';
        $user->has_drivers_license = true;
        $user->date_of_birth = '2019-10-26';
        $user->country_of_birth_id = 1;
        $user->nationality_id = 1;
        $user->marital_status_id = 1;
        $user->email = 'mohamed@holygrow.nl';
        $user->password = '1234567WaarIsMoTochGebleven';
        $user->is_active = true;
        $user->role_id = 2;
        $user->iban = 'hoi123';
        $user->income_tax = true;
        $user->out_of_service = $outOfService;

        $this->assertEquals( $user, $results);
    }
}
