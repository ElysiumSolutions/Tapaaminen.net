<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\ConfirmEmail;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{

    public function sendEmailConfirmation(){
    	$user = Auth::User();
    	if($user->emailVerificationToken == null){
    		$token = str_random(40);
    		$tokens = DB::table('users')->where('emailVerificationToken', $token)->get();
			if(count($tokens) > 0) {
				while (count($tokens) > 0) {
				    $token = str_random(40);
				    $tokens = DB::table('users')->where('emailVerificationToken', $token)->get();
				}
			}
	    	
    		$user->emailVerificationToken = bcrypt($token);
    		$user->save();
    		$user->notify(new ConfirmEmail($token));
    	}
    	return view('user.confirmEmail');
    }

    public function confirmEmail(Request $request){
	    $user = Auth::User();

    	$validator = Validator::make($request->all(), [
            'code' => 'required|checkHashed:'.$user->emailVerificationToken
        ],
        [
        	'check_hashed' => 'Virheellinen vahvistuskoodi!',
        ]);

        if ($validator->fails()) {
            return redirect('/vahvista/sahkoposti')
                        ->withErrors($validator)
                        ->withInput();
        }

    	$user->emailVerificationDate = Carbon::now();
    	$user->save();
    	return redirect('/oma-tili');
    }
}
