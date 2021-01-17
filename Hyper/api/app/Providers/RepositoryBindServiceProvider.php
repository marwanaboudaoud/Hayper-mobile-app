<?php

namespace App\Providers;

use App\Src\Repositories\App\Financial\IFinancialCloseRepository;
use App\Src\Repositories\App\Financial\IFinancialOpenRepository;
use App\Src\Repositories\App\Financial\MonthCloseRepository;
use App\Src\Repositories\App\Financial\MonthOpenRepository;
use App\Src\Repositories\Hyper\Address\AddressRepository;
use App\Src\Repositories\Hyper\Address\IAddressRepository;
use App\Src\Repositories\Hyper\Availability\AvailabilityRepository;
use App\Src\Repositories\Hyper\Availability\IAvailabilityRepository;
use App\Src\Repositories\Hyper\Availability\IMyAvailabilityRepository;
use App\Src\Repositories\Hyper\Availability\MyAvailabilityRepository;
use App\Src\Repositories\Hyper\AvailabilityShift\AvailabilityShiftRepository;
use App\Src\Repositories\Hyper\AvailabilityShift\IAvailabilityShiftRepository;
use App\Src\Repositories\Hyper\CommissionRate\CommissionRateRepository;
use App\Src\Repositories\Hyper\CommissionRate\ICommissionRateRepository;
use App\Src\Repositories\Hyper\Contract\EmployeeContractActionRepository;
use App\Src\Repositories\Hyper\Contract\EmployeeContractDeleteRepository;
use App\Src\Repositories\Hyper\Contract\ContractExpireRepository;
use App\Src\Repositories\Hyper\Contract\ContractRepository;
use App\Src\Repositories\Hyper\Contract\EmployeeContractRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractActionRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractDeleteRepository;
use App\Src\Repositories\Hyper\Contract\IContractExpireRepository;
use App\Src\Repositories\Hyper\Contract\IContractRepository;
use App\Src\Repositories\Hyper\Contract\IEmployeeContractRepository;
use App\Src\Repositories\Hyper\Country\CountryRepository;
use App\Src\Repositories\Hyper\Country\ICountryRepository;
use App\Src\Repositories\Hyper\Declaration\DeclarationMailRepository;
use App\Src\Repositories\Hyper\Declaration\IDeclarationMailRepository;
use App\Src\Repositories\Hyper\DocumentType\DocumentTypeRepository;
use App\Src\Repositories\Hyper\DocumentType\IDocumentTypeRepository;
use App\Src\Repositories\Hyper\EmergencyContact\EmergencyContactRepository;
use App\Src\Repositories\Hyper\EmergencyContact\IEmergencyContactRepository;
use App\Src\Repositories\Hyper\Gender\GenderRepository;
use App\Src\Repositories\Hyper\Gender\IGenderRepository;
use App\Src\Repositories\Hyper\Nationality\INationalityRepository;
use App\Src\Repositories\Hyper\Nationality\NationalityRepository;
use App\Src\Repositories\Hyper\Partner\IPartnerRepository;
use App\Src\Repositories\Hyper\Partner\PartnerRepository;
use App\Src\Repositories\Hyper\Project\IProjectRepository;
use App\Src\Repositories\Hyper\Project\ProjectRepository;
use App\Src\Repositories\Hyper\Role\IRoleRepository;
use App\Src\Repositories\Hyper\Role\RoleRepository;
use App\Src\Repositories\Hyper\Salary\IMySalaryRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryDayRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryManualDeleteRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryManualRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRepository;
use App\Src\Repositories\Hyper\Salary\ISalaryRowRepository;
use App\Src\Repositories\Hyper\Salary\MySalaryRepository;
use App\Src\Repositories\Hyper\Salary\SalaryDayRepository;
use App\Src\Repositories\Hyper\Salary\SalaryManualDeleteRepository;
use App\Src\Repositories\Hyper\Salary\SalaryManualRepository;
use App\Src\Repositories\Hyper\Salary\SalaryRepository;
use App\Src\Repositories\Hyper\Salary\SalaryRowRepository;
use App\Src\Repositories\Hyper\Schedule\IMyScheduleRepository;
use App\Src\Repositories\Hyper\Schedule\IScheduleRepository;
use App\Src\Repositories\Hyper\Schedule\MyScheduleRepository;
use App\Src\Repositories\Hyper\Schedule\ScheduleRepository;
use App\Src\Repositories\Hyper\Shift\IMyShiftRepository;
use App\Src\Repositories\Hyper\Shift\MyShiftRepository;
use App\Src\Repositories\Hyper\Subscription\HistorySubscriptionRepository;
use App\Src\Repositories\Hyper\Subscription\IHistorySubscriptionRepository;
use App\Src\Repositories\Hyper\Subscription\ISubscriptionRepository;
use App\Src\Repositories\Hyper\Subscription\SubscriptionRepository;
use App\Src\Repositories\Hyper\Token\ActivateUserTokenRepository;
use App\Src\Repositories\Hyper\Token\ITokenRepository;
use App\Src\Repositories\Hyper\Token\ResetPasswordTokenRepository;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Repositories\Hyper\User\UserRepository;
use App\Src\Repositories\MaritalStatus\IMaritalStatusRepository;
use App\Src\Repositories\MaritalStatus\MaritalStatusRepository;
use App\Src\Repositories\Nmbrs\Employee\EmployeeStoreRepository;
use App\Src\Repositories\Nmbrs\Employee\EmployeeUpdateRepository;
use App\Src\Repositories\Nmbrs\Employee\IEmployeeStoreRepository;
use App\Src\Repositories\Nmbrs\Employee\IEmployeeUpdateRepository;
use App\Src\Repositories\Nmbrs\INmbrsRepository;
use App\Src\Repositories\Nmbrs\NmbrsRepository;
use App\Src\Repositories\Nmbrs\Upload\IUploadRepository;
use App\Src\Repositories\Nmbrs\Upload\UploadRepository;
use App\Src\Services\App\FinancialClosing\MonthClosingService;
use App\Src\Services\Hyper\Token\ActivateUserTokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use Hamcrest\Thingy;
use Illuminate\Support\ServiceProvider;

class RepositoryBindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IUserRepository::class,
            UserRepository::class
        );
        $this->app->bind(
            IAddressRepository::class,
            AddressRepository::class
        );
        $this->app->bind(
            IEmergencyContactRepository::class,
            EmergencyContactRepository::class
        );

        $this->app->bind(
            IEmployeeStoreRepository::class,
            EmployeeStoreRepository::class
        );

        $this->app->bind(
            IEmployeeUpdateRepository::class,
            EmployeeUpdateRepository::class
        );

        $this->app->bind(
            IScheduleRepository::class,
            ScheduleRepository::class
        );

        $this->app->bind(
            IScheduleRepository::class,
            ScheduleRepository::class
        );

        $this->app->bind(
            INmbrsRepository::class,
            NmbrsRepository::class
        );

        $this->app->bind(
            IEmployeeContractRepository::class,
            EmployeeContractRepository::class
        );

        $this->app->bind(
            ITokenRepository::class,
            ResetPasswordTokenRepository::class
        );

        $this->app->bind(
            IProjectRepository::class,
            ProjectRepository::class
        );

        $this->app->bind(
            ISalaryRepository::class,
            SalaryRepository::class
        );

        $this->app->bind(
            IPartnerRepository::class,
            PartnerRepository::class
        );

        $this->app->bind(
            IUploadRepository::class,
            UploadRepository::class
        );

        $this->app->bind(
            ISalaryRowRepository::class,
            SalaryRowRepository::class
        );

        $this->app->bind(
            ISubscriptionRepository::class,
            SubscriptionRepository::class
        );

        $this->app->bind(
            IAvailabilityRepository::class,
            AvailabilityRepository::class
        );

        $this->app->bind(
            IAvailabilityShiftRepository::class,
            AvailabilityShiftRepository::class
        );

        $this->app->when(ResetPasswordTokenService::class)
            ->needs(ITokenRepository::class)
            ->give(ResetPasswordTokenRepository::class);

        $this->app->when(ActivateUserTokenService::class)
            ->needs(ITokenRepository::class)
            ->give(ActivateUserTokenRepository::class);

        $this->app->bind(
            IPartnerRepository::class,
            PartnerRepository::class
        );

        $this->app->bind(
            IDocumentTypeRepository::class,
            DocumentTypeRepository::class
        );

        $this->app->bind(
            IRoleRepository::class,
            RoleRepository::class
        );

        $this->app->bind(
            ISalaryDayRepository::class,
            SalaryDayRepository::class
        );

        $this->app->bind(
            IDeclarationMailRepository::class,
            DeclarationMailRepository::class
        );

        $this->app->bind(
            IMyAvailabilityRepository::class,
            MyAvailabilityRepository::class
        );

        $this->app->bind(
            IMyScheduleRepository::class,
            MyScheduleRepository::class
        );
        $this->app->bind(
            IMySalaryRepository::class,
            MySalaryRepository::class
        );
        $this->app->bind(
            IMyShiftRepository::class,
            MyShiftRepository::class
        );
        $this->app->bind(
            ISalaryManualDeleteRepository::class,
            SalaryManualDeleteRepository::class
        );
        $this->app->bind(
            ISalaryManualRepository::class,
            SalaryManualRepository::class
        );
        $this->app->when(MonthClosingService::class)
            ->needs(IFinancialCloseRepository::class)
            ->give(MonthCloseRepository::class);

        $this->app->bind(
            IEmployeeContractActionRepository::class,
            EmployeeContractActionRepository::class
        );
        $this->app->bind(
            IEmployeeContractDeleteRepository::class,
            EmployeeContractDeleteRepository::class
        );

        $this->app->bind(
            IContractExpireRepository::class,
            ContractExpireRepository::class
        );

        $this->app->bind(
            IContractRepository::class,
            ContractRepository::class
        );

        $this->app->bind(
            IHistorySubscriptionRepository::class,
            HistorySubscriptionRepository::class
        );

        $this->app->bind(
            ICommissionRateRepository::class,
            CommissionRateRepository::class
        );

        $this->app->bind(
            INationalityRepository::class,
            NationalityRepository::class
        );

        $this->app->bind(
            ICountryRepository::class,
            CountryRepository::class
        );

        $this->app->bind(
            IGenderRepository::class,
            GenderRepository::class
        );

        $this->app->bind(
            IMaritalStatusRepository::class,
            MaritalStatusRepository::class
        );

        $this->app->bind(
            IMaritalStatusRepository::class,
            MaritalStatusRepository::class
        );
        
            $this->app->bind(
                IFinancialOpenRepository::class,
                MonthOpenRepository::class
            );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
