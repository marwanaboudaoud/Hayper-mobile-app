<?php

namespace Tests\Unit;

use App\Exceptions\Employee\EmployeeNotFoundException;
use App\Src\Models\Hyper\Partner\PartnerModel;
use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Partner\PartnerService;
use Tests\TestCase;
use Mockery as m;

class PartnerFindServiceTest extends TestCase
{
    public function testPartnerFind()
    {
        $partnerRepository = $this->instance(IPartnerRepository::class, m::mock(IPartnerRepository::class, function ($mock) {
            $mock->shouldReceive('findById')
                ->andReturn(
                    m::mock(PartnerModel::class, function ($mock) {
                        $mock->shouldReceive('getId')
                            ->andReturn(1);
                    })
                );
        }));


        $partnerModel = m::mock(PartnerModel::class, function ($mock) {
            $mock->shouldReceive('getId')
                ->andReturn(1);
        });

        $service = new PartnerService($partnerRepository);
        $service->find($partnerModel->getId());
    }
}
