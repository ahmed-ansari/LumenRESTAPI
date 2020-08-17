<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

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

    // public function boot(){
    //     DB::listen(function ($query) {
    //         var_dump([
    //             $query->sql,
    //             $query->bindings,
    //             $query->time
    //         ]);
    //     });
    // }


    
}
