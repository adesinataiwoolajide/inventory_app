<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
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
        Schema::defaultStringLength(191);
        Bugsnag::registerCallback(function ($report) {
            $report->setMetaData([
                'account' => [
                    'name' => 'Glorious Empire Technologies.',
                    'paying_customer' => true,
                ]
            ]);
        });
    }
}
