<?php

namespace App\Providers;


use App\Mixins\StrMixins;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;


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
        ## add custom helper function to Str
        Str::macro('partNumber', function($part) {
            return 'AB-'. substr($part,0,3). '-' .substr($part,3);
        });

        Str::mixin(new StrMixins(), false);  // groups the macros  # -false avoids overide


        //  add custom error reporting to Responsefactory
        ResponseFactory::macro('errorJson', function($message = 'Custom Error Message') {
            return [
                'Message' => $message,
                'Error_code' => '123'
            ];
        });
    }
}
