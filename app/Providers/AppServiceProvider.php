<?php

namespace App\Providers;

use App\Services\MailChimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
        app()->bind(Newsletter::class, function () {
            $client =
                (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us9'
            ]);

            return new MailChimpNewsletter(
                $client
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //paginator
        Paginator::useTailwind();
        Model::unguard();
    }
}
