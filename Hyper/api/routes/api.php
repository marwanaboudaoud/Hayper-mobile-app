<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => ['json.response', 'cors']], function () {
    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/forgot-password', 'Auth\AuthController@forgotPassword');
    Route::post('/reset-password', 'Auth\AuthController@resetPassword');
    Route::post('/employees/activate', 'Employee\EmployeeController@activate');

    Route::group(['middleware' => ['is.authenticated', 'is.admin']], function () {

        Route::prefix('contracts')->group(function () {
            Route::post('/', 'EmployeeContract\ContractController@index');
            Route::post('/store', 'EmployeeContract\ContractController@store');
            Route::post('/create-or-delete', 'EmployeeContract\ContractController@createOrDelete');
            Route::post('/download-contract', 'EmployeeContract\ContractController@download');
        });

        Route::prefix('nationalities')->group(function () {
            Route::get('/', 'Nationality\NationalityController@index');
        });

        Route::prefix('countries')->group(function () {
            Route::get('/', 'Country\CountryController@index');
        });

        Route::prefix('genders')->group(function () {
            Route::get('/', 'Gender\GenderController@index');
        });

        Route::prefix('maritalstatuses')->group(function () {
            Route::get('/', 'MaritalStatus\MaritalStatusController@index');
        });

        Route::prefix('expiring-contracts')->group(function () {
            Route::post('/', 'EmployeeContract\ExpiringContractController@index');
        });

        Route::prefix('employees')->group(function () {
            Route::post('/', 'Employee\EmployeeController@index');
            Route::post('/store', 'Employee\EmployeeController@store');
            Route::get('/{id}', 'Employee\EmployeeController@find');
            Route::post('/{id}/update', 'Employee\EmployeeController@update');
            Route::post('/export-generate', 'Employee\EmployeeController@generateExport');
        });

        Route::prefix('projects')->group(function () {
            Route::post('/', 'Project\ProjectController@index');
            Route::get('/{id}', 'Project\ProjectController@find');
            Route::post('/store', 'Project\ProjectController@store');
            Route::post('/{id}/update', 'Project\ProjectController@update');
            Route::post('/{id}/delete', 'Project\ProjectController@delete');
        });

        Route::prefix('schedules')->group(function () {
            Route::post('/', 'Schedule\ScheduleController@index');
            Route::post('/store', 'Schedule\ScheduleController@store');
            Route::post('/{id}/update', 'Schedule\ScheduleController@update');
            Route::post('/{id}/delete', 'Schedule\ScheduleController@delete');
        });

        Route::prefix('partners')->group(function () {
            Route::post('/', 'Partner\PartnerController@index');
            Route::post('/store', 'Partner\PartnerController@store');
            Route::get('/{id}', 'Partner\PartnerController@find');
            Route::post('/{id}/update', 'Partner\PartnerController@update');
            Route::post('/{id}/delete', 'Partner\PartnerController@delete');
        });

        Route::prefix('roles')->group(function () {
            Route::post('/', 'Role\RoleController@index');
            Route::post('/store', 'Role\RoleController@store');
            Route::get('/{id}', 'Role\RoleController@find');
            Route::post('/{id}/update', 'Role\RoleController@update');
            Route::post('/{id}/delete', 'Role\RoleController@delete');
        });

        Route::prefix('salaries')->group(function () {
            Route::post('/', 'Salary\SalaryController@index');
            Route::get('/{id}', 'Salary\SalaryController@find');
        });

        Route::prefix('salaries-manual')->group(function () {
            Route::post('/{salaryId}/store', 'Salary\SalaryManualController@store');
            Route::post('/{salaryId}/delete', 'Salary\SalaryManualController@delete');
        });

        Route::prefix('subscriptions')->group(function () {
            Route::post('/', 'Subscription\SubscriptionController@index');
            Route::post('/store', 'Subscription\SubscriptionController@store');
            Route::get('/{id}', 'Subscription\SubscriptionController@find');
            Route::post('/{id}/update', 'Subscription\SubscriptionController@update');
            Route::post('/{id}/delete', 'Subscription\SubscriptionController@delete');

        });

        Route::prefix('uploads')->group(function () {
            Route::post('/store', 'Document\UploadController@upload');
        });

        Route::prefix('availabilities')->group(function () {
            Route::post('/search', 'Availability\AvailabilitySearchController@search');
        });
    });

    Route::prefix('employees')->group(function () {
        Route::get('/export-download/{id}', 'Employee\EmployeeController@downloadExport');
    });

    Route::group(['middleware' => ['is.authenticated', 'is.employee']], function () {
        Route::prefix('my-schedule')->group(function () {
            Route::post('/', 'Schedule\MyScheduleController@index');
        });
        Route::prefix('my-availability')->group(function () {
            Route::post('/', 'Availability\MyAvailabilityController@index');
        });
        Route::prefix('signing-up-my-friend')->group(function () {
            Route::post('/', 'Friend\MyFriendsController@signUp');
        });

        Route::prefix('my-score')->group(function () {
            Route::post('/', 'Score\MyScoreController@index');
        });

        Route::prefix('my-salaries')->group(function () {
            Route::post('/', 'Salary\MySalaryController@index');
        });

        Route::prefix('availabilities')->group(function () {
            Route::post('/store', 'Availability\AvailabilityController@store');
            Route::post('/{id}/update', 'Availability\AvailabilityController@update');
        });

        Route::prefix('declarations')->group(function () {
            Route::post('/upload', 'Declaration\DeclarationController@upload');
        });
    });
});
