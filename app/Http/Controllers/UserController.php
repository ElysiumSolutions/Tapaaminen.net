<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index(){
        return view('users.index');
    }

    public function notifications(){
        dd(Auth::User()->notifications);
    }
}
