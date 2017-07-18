<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index(){
	    $meetings = Auth::User()->meetings()->with('comments')->latest()->get();
        $notifications = Auth::user()->unreadNotifications()->latest()->limit(10)->get();
        $registrations = Auth::user()->registrations()->with('meeting')->latest()->get();
        return view('users.index', compact('meetings', 'notifications', 'registrations'));
    }

    public function notifications(){
        dd(Auth::User()->notifications);
    }

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

            Mail::to($user)->send(new ConfirmEmail($token));

        }
        return view('users.confirmEmail');
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

        $request->session()->put('flashmessage', [
            'title' => 'Sähköpostin vahvistus',
            'message' => 'Sähköpostin vahvistus onnistui!',
            'status' => 'is-success'
        ]);

        return redirect('/oma-tili');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::User();
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::User();

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'username' => 'required|max:255|unique:users,username,'.$user->id,
        ]);

        if($request->input('email') != $user->email){
            $user->emailVerificationDate = null;
            $user->emailVerificationToken = null;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->save();

        $request->session()->put('flashmessage', [
            'title' => 'Tietojen muokkaus',
            'message' => 'Muokkaus onnistui!',
            'status' => 'is-success'
        ]);

        return redirect('/oma-tili/muokkaa');

    }

    public function updatePassword(Request $request)
    {
        $user = Auth::User();
        $validator = Validator::make($request->all(), [
            'currentpassword' => 'required|checkHashed:'.$user->password,
            'password' => 'required|min:6|confirmed',
        ],
            [
                'check_hashed' => 'Nykyinen salasana on virheellinen!',
            ]);
        if ($validator->fails()) {
            return redirect('/oma-tili/muokkaa')
                ->withErrors($validator)
                ->withInput();
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        $request->session()->put('flashmessage', [
            'title' => 'Salasanan vaihto',
            'message' => 'Salasanan vaihtaminen onnistui!',
            'status' => 'is-success'
        ]);

        return redirect('/oma-tili/muokkaa');
    }
}