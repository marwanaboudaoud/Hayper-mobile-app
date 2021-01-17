<?php
namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //        Carbon::setWeekStartsAt(Carbon::MONDAY);
        //        Carbon::setWeekEndsAt(Carbon::SUNDAY);
        Builder::defaultStringLength(191); // Update defaultStringLength
    }
}
