<?php

namespace App\Http\Controllers;

use App\Registration;
use Illuminate\Http\Request;
use App\Meeting;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function index(){
	    $statsdata = Cache::remember('statsdata', 15, function () {
		    return array(
			    "meetingcount" => Meeting::all()->count(),
			    "usercount" => User::all()->count(),
			    "commentcount" => Comment::all()->count(),
			    "registrationcount" => Registration::all()->count(),
		    );
	    });

	    $meetingcount = $statsdata['meetingcount'];
        $usercount = $statsdata['usercount'];
        $commentcount = $statsdata['commentcount'];
        $registrationcount = $statsdata['registrationcount'];
	    $robots = true;
        return view('home', compact('meetingcount', 'usercount', 'registrationcount', 'commentcount', 'robots'));
    }

    public function wip(){
        return view('wip');
    }

    public function cookies(){
    	return view('cookies');
    }

    public function registerinfo(){
    	return view('registerinfo');
    }

    public function about(){
    	$robots = true;
    	return view('about', compact('robots'));
    }
}
