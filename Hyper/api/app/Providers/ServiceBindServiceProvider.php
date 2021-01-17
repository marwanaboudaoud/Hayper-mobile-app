<?php

namespace App\Providers;

use App\Console\Commands\CloseMonth;
use App\Http\Controllers\Salary\SalaryManualController;
use App\Src\Services\App\FinancialClosing\IFinancialClosingService;
use App\Src\Services\App\FinancialClosing\IMonthClosingService;
use App\Src\Services\App\FinancialClosing\MonthClosingService;
use App\Src\Services\App\FinancialOpening\IFinancialOpenService;
use App\Src\Services\App\FinancialOpening\MonthOpeningService;
use App\Src\Services\Hyper\Auth\AuthService;
use App\Src\Services\Hyper\Auth\IAuthService;
use App\Src\Services\Hyper\Availability\AvailabilityDateValidatorService;
use App\Src\Services\Hyper\Availability\AvailabilityCountService;
use App\Src\Services\Hyper\Availability\AvailabilitySearchService;
use App\Src\Services\Hyper\Availability\AvailabilityStoreService;
use App\Src\Services\Hyper\Availability\AvailabillityUpdateService;
use App\Src\Services\Hyper\Availability\IAvailabilityDateValidatorService;
use App\Src\Services\Hyper\Availability\IAvailabilityCountService;
use App\Src\Services\Hyper\Availability\IAvailabilitySearchService;
use App\Src\Services\Hyper\Availability\IAvailabilityStoreService;
use App\Src\Services\Hyper\Availability\IAvailabillityUpdateService;
use App\Src\Services\Hyper\AvailabilityShift\AvailabilityShiftService;
use App\Src\Services\Hyper\AvailabilityShift\IAvailabilityShiftService;
use App\Src\Services\Hyper\CommissionRate\CommissionRateDeleteService;
use App\Src\Services\Hyper\CommissionRate\CommissionRateStoreService;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateDeleteService;
use App\Src\Services\Hyper\CommissionRate\ICommissionRateStoreService;
use App\Src\Services\Hyper\Contract\ContractActionService;
use App\Src\Services\Hyper\Contract\ContractExportService;
use App\Src\Services\Hyper\Contract\ContractService;
use App\Src\Services\Hyper\Contract\ContractExpireService;
use App\Src\Services\Hyper\Contract\ContractStoreService;
use App\Src\Services\Hyper\Contract\EmployeeContractDeleteService;
use App\Src\Services\Hyper\Contract\IContractActionService;
use App\Src\Services\Hyper\Contract\IContractService;
use App\Src\Services\Hyper\Contract\IContractExpireService;
use App\Src\Services\Hyper\Contract\IContractStoreService;
use App\Src\Services\Hyper\Contract\IEmployeeContractDeleteService;
use App\Src\Services\Hyper\Country\CountryService;
use App\Src\Services\Hyper\Country\ICountryService;
use App\Src\Services\Hyper\Declaration\DeclarationUploadService;
use App\Src\Services\Hyper\Declaration\IDeclarationUploadService;
use App\Src\Services\Hyper\Availability\MyAvailabilityService;
use App\Src\Services\Hyper\Availability\IMyAvailabilityService;
use App\Src\Services\Hyper\Employee\EmployeeActivateService;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\Src\Services\Hyper\Employee\EmployeeStoreService;
use App\Src\Services\Hyper\Employee\EmployeeUpdateService;
use App\Src\Services\Hyper\Employee\IEmployeeActivateService;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Employee\IEmployeeStoreService;
use App\Src\Services\Hyper\Employee\IEmployeeUpdateService;
use App\Src\Services\Hyper\Export\IExportService;
use App\Src\Services\Hyper\Friend\FriendSignUpService;
use App\Src\Services\Hyper\Friend\IFriendSignUpService;
use App\Src\Services\Hyper\Gender\GenderService;
use App\Src\Services\Hyper\Gender\IGenderService;
use App\Src\Services\Hyper\MaritalStatus\IMaritalStatusService;
use App\Src\Services\Hyper\MaritalStatus\MaritalStatusService;
use App\Src\Services\Hyper\Nationality\INationalityService;
use App\Src\Services\Hyper\Nationality\NationalityService;
use App\Src\Services\Hyper\Notify\IEmployeeStoreNotifyService;
use App\Src\Services\Hyper\Notify\IFriendSignUpNotifyService;
use App\Src\Services\Hyper\Notify\Mailable\EmployeeStoreMailNotifyService;
use App\Src\Services\Hyper\Notify\Mailable\FriendSignUpMailNotifyService;
use App\Src\Services\Hyper\Partner\IPartnerService;
use App\Src\Services\Hyper\Partner\PartnerService;
use App\Src\Services\Hyper\Project\IProjectDeleteService;
use App\Src\Services\Hyper\Project\IProjectService;
use App\Src\Services\Hyper\Project\IProjectStoreService;
use App\Src\Services\Hyper\Project\IProjectUpdateService;
use App\Src\Services\Hyper\Project\ProjectDeleteService;
use App\Src\Services\Hyper\Project\ProjectService;
use App\Src\Services\Hyper\Project\ProjectStoreService;
use App\Src\Services\Hyper\Project\ProjectUpdateService;
use App\Src\Services\Hyper\Role\IRoleDeleteService;
use App\Src\Services\Hyper\Role\IRoleService;
use App\Src\Services\Hyper\Role\IRoleStoreService;
use App\Src\Services\Hyper\Role\IRoleUpdateService;
use App\Src\Services\Hyper\Role\RoleDeleteService;
use App\Src\Services\Hyper\Role\RoleService;
use App\Src\Services\Hyper\Role\RoleStoreService;
use App\Src\Services\Hyper\Role\RoleUpdateService;
use App\Src\Services\Hyper\Salary\IMySalaryService;
use App\Src\Services\Hyper\Salary\ISalaryDayStoreService;
use App\Src\Services\Hyper\Salary\ISalaryManualService;
use App\Src\Services\Hyper\Salary\ISalaryRowManualDeleteService;
use App\Src\Services\Hyper\Salary\ISalaryService;
use App\Src\Services\Hyper\Salary\MySalaryService;
use App\Src\Services\Hyper\Salary\SalaryManualService;
use App\Src\Services\Hyper\Salary\SalaryRowManualDeleteService;
use App\Src\Services\Hyper\Salary\SalaryRowManualStoreService;
use App\Src\Services\Hyper\Salary\SalaryService;
use App\Src\Services\Hyper\Schedule\IMyScheduleService;
use App\Src\Services\Hyper\Schedule\IScheduleDeleteService;
use App\Src\Services\Hyper\Schedule\IScheduleService;
use App\Src\Services\Hyper\Schedule\IScheduleStoreService;
use App\Src\Services\Hyper\Schedule\IScheduleUpdateService;
use App\Src\Services\Hyper\Schedule\MyScheduleService;
use App\Src\Services\Hyper\Schedule\ScheduleDeleteService;
use App\Src\Services\Hyper\Schedule\ScheduleService;
use App\Src\Services\Hyper\Schedule\ScheduleStoreService;
use App\Src\Services\Hyper\Schedule\ScheduleUpdateService;
use App\Src\Services\Hyper\Score\IMyScoreService;
use App\Src\Services\Hyper\Score\MyScoreService;
use App\Src\Services\Hyper\Subscription\DeleteSubscriptionService;
use App\Src\Services\Hyper\Subscription\HistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\IDeleteSubscriptionService;
use App\Src\Services\Hyper\Subscription\IHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\IStoreHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\IStoreSubscriptionService;
use App\Src\Services\Hyper\Subscription\ISubscriptionService;
use App\Src\Services\Hyper\Subscription\IUpdateHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\IUpdateSubscriptionService;
use App\Src\Services\Hyper\Subscription\StoreHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\StoreSubscriptionService;
use App\Src\Services\Hyper\Subscription\SubscriptionService;
use App\Src\Services\Hyper\Subscription\UpdateHistorySubscriptionService;
use App\Src\Services\Hyper\Subscription\UpdateSubscriptionService;
use App\Src\Services\Hyper\Token\ActivateUserTokenService;
use App\Src\Services\Hyper\Token\IActivateUserTokenService;
use App\Src\Services\Hyper\Token\ITokenService;
use App\Src\Services\Hyper\Token\ResetPasswordTokenService;
use App\Src\Services\Hyper\Notify\INotifyService;
use App\Src\Services\Hyper\Notify\Mailable\AuthForgotPasswordMailNotifyService;
use App\Src\Services\Nmbrs\Employee\EmployeeStoreNmbrsService;
use App\Src\Services\Nmbrs\Employee\IEmployeeStoreNmbrsService;
use App\Src\Services\Nmbrs\Upload\DocumentNmbrsService;
use App\Src\Services\Nmbrs\Upload\IDocumentNmbrsService;
use Illuminate\Support\ServiceProvider;

class ServiceBindServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            IAuthService::class,
            AuthService::class
        );
        $this->app->bind(
            IEmployeeService::class,
            EmployeeService::class
        );

        $this->app->bind(
            IEmployeeStoreNmbrsService::class,
            EmployeeStoreNmbrsService::class
        );

        $this->app->bind(
            IEmployeeStoreService::class,
            EmployeeStoreService::class
        );

        $this->app->bind(
            IEmployeeUpdateService::class,
            EmployeeUpdateService::class
        );

        $this->app->bind(
            IContractStoreService::class,
            ContractStoreService::class
        );

        $this->app->bind(
            IDocumentNmbrsService::class,
            DocumentNmbrsService::class
        );

        $this->app->bind(
            IEmployeeActivateService::class,
            EmployeeActivateService::class
        );

        $this->app->bind(
            ITokenService::class,
            ResetPasswordTokenService::class
        );

        $this->app->bind(
            IProjectUpdateService::class,
            ProjectUpdateService::class
        );

        $this->app->bind(
            IActivateUserTokenService::class,
            ActivateUserTokenService::class
        );

        $this->app->bind(
            ISalaryService::class,
            SalaryService::class
        );

        $this->app->bind(
            IEmployeeStoreNotifyService::class,
            EmployeeStoreMailNotifyService::class
        );

        $this->app->bind(
            IProjectService::class,
            ProjectService::class
        );

        $this->app->bind(
            IProjectStoreService::class,
            ProjectStoreService::class
        );

        $this->app->bind(
            IPartnerService::class,
            PartnerService::class
        );

        $this->app->bind(
            IProjectDeleteService::class,
            ProjectDeleteService::class
        );

        $this->app->bind(
            IScheduleService::class,
            ScheduleService::class
        );

        $this->app->bind(
            IScheduleStoreService::class,
            ScheduleStoreService::class
        );

        $this->app->bind(
            IScheduleUpdateService::class,
            ScheduleUpdateService::class
        );

        $this->app->bind(
            IScheduleDeleteService::class,
            ScheduleDeleteService::class
        );

        $this->app->bind(
            ISubscriptionService::class,
            SubscriptionService::class
        );

        $this->app->bind(
            IStoreSubscriptionService::class,
            StoreSubscriptionService::class
        );

        $this->app->bind(
            IUpdateSubscriptionService::class,
            UpdateSubscriptionService::class
        );

        $this->app->bind(
            IDeleteSubscriptionService::class,
            DeleteSubscriptionService::class
        );

        $this->app->bind(
            IAvailabilityStoreService::class,
            AvailabilityStoreService::class
        );

        $this->app->bind(
            IAvailabillityUpdateService::class,
            AvailabillityUpdateService::class
        );

        $this->app->bind(
            IAvailabilityShiftService::class,
            AvailabilityShiftService::class
        );

        $this->app->bind(
            IAvailabilityDateValidatorService::class,
            AvailabilityDateValidatorService::class
        );

        $this->app->bind(
            IAvailabilitySearchService::class,
            AvailabilitySearchService::class
        );

        $this->app->bind(
            IAvailabilityCountService::class,
            AvailabilityCountService::class
        );

        $this->app->bind(
            IMySalaryService::class,
            MySalaryService::class
        );

        $this->app->bind(
            IMonthClosingService::class,
            MonthClosingService::class
        );

        $this->app->bind(
            IContractExpireService::class,
            ContractExpireService::class
        );

        $this->app->when(SalaryManualController::class)
            ->needs(ISalaryDayStoreService::class)
            ->give(SalaryRowManualStoreService::class);

        $this->app->when(AuthService::class)
            ->needs(ITokenService::class)
            ->give(ResetPasswordTokenService::class);

        $this->app->when(EmployeeStoreService::class)
            ->needs(ITokenService::class)
            ->give(ActivateUserTokenService::class);

        $this->app->when(EmployeeActivateService::class)
            ->needs(ITokenService::class)
            ->give(ActivateUserTokenService::class);

        $this->app->bind(
            IPartnerService::class,
            PartnerService::class
        );

        $this->app->bind(
            IDeclarationUploadService::class,
            DeclarationUploadService::class
        );

        $this->app->bind(
            IMyAvailabilityService::class,
            MyAvailabilityService::class
        );

        $this->app->bind(
            IMyScheduleService::class,
            MyScheduleService::class
        );

        $this->app->bind(
            IFriendSignUpService::class,
            FriendSignUpService::class
        );

        $this->app->bind(
            IFriendSignUpNotifyService::class,
            FriendSignUpMailNotifyService::class
        );

        $this->app->bind(
            IMyScoreService::class,
            MyScoreService::class
        );

        $this->app->bind(
            ISalaryRowManualDeleteService::class,
            SalaryRowManualDeleteService::class
        );

        $this->app->bind(
            ISalaryManualService::class,
            SalaryManualService::class
        );

        $this->app->bind(
            IMyScoreService::class,
            MyScoreService::class
        );

        $this->app->bind(
            IContractService::class,
            ContractService::class
        );
        $this->app->bind(
            IContractActionService::class,
            ContractActionService::class
        );

        $this->app->bind(
            IEmployeeContractDeleteService::class,
            EmployeeContractDeleteService::class
        );


        $this->app->bind(
            IExportService::class,
            ContractExportService::class
        );

        $this->app->bind(
            IMyScoreService::class,
            MyScoreService::class
        );

        $this->app->bind(
            IContractService::class,
            ContractService::class
        );

        $this->app->bind(
            IStoreHistorySubscriptionService::class,
            StoreHistorySubscriptionService::class
        );

        $this->app->bind(
            IHistorySubscriptionService::class,
            HistorySubscriptionService::class
        );

        $this->app->bind(
            IUpdateHistorySubscriptionService::class,
            UpdateHistorySubscriptionService::class
        );

        $this->app->bind(
            IContractService::class,
            ContractService::class
        );

        $this->app->bind(
            IRoleService::class,
            RoleService::class
        );

        $this->app->bind(
            IRoleStoreService::class,
            RoleStoreService::class
        );

        $this->app->bind(
            IRoleUpdateService::class,
            RoleUpdateService::class
        );

        $this->app->bind(
            IRoleDeleteService::class,
            RoleDeleteService::class
        );

        $this->app->bind(
            ICommissionRateStoreService::class,
            CommissionRateStoreService::class
        );

        $this->app->bind(
            ICommissionRateDeleteService::class,
            CommissionRateDeleteService::class
        );

        $this->app->bind(
            INationalityService::class,
            NationalityService::class
        );

        $this->app->bind(
            ICountryService::class,
            CountryService::class
        );

        $this->app->bind(
            IGenderService::class,
            GenderService::class
        );

        $this->app->bind(
            IMaritalStatusService::class,
            MaritalStatusService::class
        );

        $this->app->bind(
            IMaritalStatusService::class,
            MaritalStatusService::class
        );
        
        $this->app->bind(
            IFinancialOpenService::class,
            MonthOpeningService::class
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
