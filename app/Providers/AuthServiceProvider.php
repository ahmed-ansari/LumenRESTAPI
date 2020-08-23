<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            // return true;
            // if ($request->input('api_token')) {
            //     return User::where('api_token', $request->input('api_token'))->first();
            // }
            if ($request->header('Authorization')) {
                // echo $request->header('Authorization');
                // var_dump(explode(' ',$request->header('Authorization')));
                $apiToken = explode(' ',$request->header('Authorization'));
                // var_dump($apiToken);
                // var_dump(User::where('api_token', $apiToken[0])->first());
                return User::where('api_token', $apiToken[0])->first();
            }
        });
    }
}
