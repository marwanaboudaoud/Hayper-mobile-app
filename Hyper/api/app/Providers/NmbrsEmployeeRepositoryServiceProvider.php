<?php

namespace App\Providers;

use App\Src\Repositories\Interfaces\Nmbrs\EmployeeRepositoryInterface;
use App\Src\Repositories\Nmbrs\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class NmbrsEmployeeRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
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
