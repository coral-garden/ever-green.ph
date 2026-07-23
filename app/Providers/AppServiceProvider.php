<?php

namespace App\Providers;

use App\Services\Leads\HttpLeadForwarder;
use App\Services\Leads\LeadForwarder;
use App\Services\Leads\MailLeadForwarder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Always email leads. When the external API is configured, deliver
        // there too and include any API failure details in the email.
        $this->app->bind(LeadForwarder::class, function () {
            $url = config('services.lead_forwarder.url');
            $email = new MailLeadForwarder(config('services.lead_mail.to'));

            if (! empty($url)) {
                return new HttpLeadForwarder(
                    $url,
                    config('services.lead_forwarder.key'),
                    config('services.lead_forwarder.origin'),
                    $email,
                );
            }

            return $email;
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
