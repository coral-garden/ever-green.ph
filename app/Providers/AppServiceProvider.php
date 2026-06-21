<?php

namespace App\Providers;

use App\Services\Leads\HttpLeadForwarder;
use App\Services\Leads\LeadForwarder;
use App\Services\Leads\LogLeadForwarder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Use the HTTP forwarder when the external system (TBC) is configured;
        // otherwise fall back to logging every lead so nothing is lost.
        $this->app->bind(LeadForwarder::class, function () {
            $url = config('services.lead_forwarder.url');

            if (! empty($url)) {
                return new HttpLeadForwarder($url, config('services.lead_forwarder.key'));
            }

            return new LogLeadForwarder();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
