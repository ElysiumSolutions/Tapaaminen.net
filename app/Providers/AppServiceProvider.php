<?php

namespace App\Providers;

use Illuminate\Contracts\Logging\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;

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

        Validator::extend('checkIfAdminurlHasUserAndItExists', function($attribute, $value, $parameters){
            $parts = explode('/a/', $value);
            if(!isset($parts[1])){
                return false;
            }
        	$adminslug = str_replace("/", "", $parts[1]);
	        try {
		        $meeting = \App\Meeting::where('adminslug', $adminslug)->firstOrFail();
	        }catch(ModelNotFoundException $e){
		        return false;
	        }
        	if($meeting->user_id != null){
        		return false;
	        }
        	return true;
        });

        Validator::extend('grecaptcha', function($attribute, $value, $parameters)
        {
            $client = new Client;
            $r = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'query' => [
                    'secret' => config('google.recaptcha.secret'),
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
    	if(env('APP_ENV') != "local") {
		    $this->app->alias( 'bugsnag.logger', Log::class );
		    $this->app->alias( 'bugsnag.logger', LoggerInterface::class );
	    }
    }
}
