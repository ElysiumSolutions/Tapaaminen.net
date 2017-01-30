<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('fi');

        Validator::extend('checkHashed', function($attribute, $value, $parameters)
        {
            if( ! Hash::check( $value , $parameters[0] ) )
            {
                return false;
            }
            return true;
        });

        Validator::extend('grecaptcha', function($attribute, $value, $parameters)
        {
            $client = new Client;
            $r = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'query' => [
                    'secret' => env('RECAPTCHA_SECRET'),
                    'response' => $value
                ]]);
            $payload = json_decode($r->getBody()->getContents());
            if($payload->success){
                return true;
            }else {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
