<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meeting;
use App\User;
use App\Comment;

class PagesController extends Controller
{
    public function index(){
        // TODO put to cache and get from there
        $meetingcount = Meeting::all()->count();
        $usercount = User::all()->count();
        $commentcount = Comment::all()->count();
        //$registrationcount = Registration::all()->count();
	    $registrationcount = 0;
        return view('home', compact('meetingcount', 'usercount', 'registrationcount', 'commentcount'));
    }

    public function wip(){
        return view('wip');
    }
}
