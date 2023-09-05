<?php

namespace App\Providers;

use App\Models\User;
use App\Services\MailChimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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

        Gate::define('admin', function (User $user) {
            return $user->username === 'john' || $user->roles()->where('name', 'Admin')->orWhere('name', 'Moderator')->exists();
        });

//        Gate::define('admin', function (User $user) {
//            return $user->hasRole('Moderator');
//        });
//
//      Gate::define('admin', function (User $user) {
//            return $user->hasRole('Admin');
//        });

        Blade::if('admin', function () {
            return request()->user()?->can('admin');
        }
        );

    }
}
