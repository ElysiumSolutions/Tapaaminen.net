<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\User;

class PagesController extends Controller
{
    public function index(){
        $meetingcount = Meeting::all()->count();
        $usercount = User::all()->count();
        $commentcount = 123;
        $registrationcount = 222;
        return view('home', compact('meetingcount', 'usercount', 'registrationcount', 'commentcount'));
    }

    public function wip(){
        return view('wip');
    }
}
