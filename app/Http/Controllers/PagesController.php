<?php

namespace App\Http\Controllers;

use App\Registration;
use App\Meeting;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Cache;
use DrewM\MailChimp\MailChimp;

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

	public function slack(){
		return view('slack');
	}

    public function registerinfo(){
    	return view('registerinfo');
    }

    public function about(){
    	$robots = true;
    	return view('about', compact('robots'));
    }

    public function announcements(){
	    $announcements = Cache::remember('mailchimpannouncements', 1, function () {
		    $mailchimp = new MailChimp( env( 'MAILCHIMP_APIKEY' ) );

		    $campaigndata = $mailchimp->get( '/campaigns', [
			    'count'   => 100,
			    'list_id' => env( 'MAILCHIMP_LIST_ID' ),
			    'status' => 'sent'
		    ] );

		    $announcementsarray = array();
		    foreach ($campaigndata['campaigns'] as $campaign){
		    	$sentDate = \Carbon\Carbon::createFromTimestamp(strtotime($campaign['send_time']))->format('j.n.Y \k\l\o H:i');
			    $announcementsarray[$campaign['id']]['title'] = $campaign['settings']['title'];
			    $announcementsarray[$campaign['id']]['send_time'] = $sentDate;
			    $announcementsarray[$campaign['id']]['url'] = $campaign['archive_url'];
			    $announcementsarray[$campaign['id']]['emails_sent'] = $campaign['emails_sent'];
		    	$campaigninfo = $mailchimp->get('/campaigns/'.$campaign['id'].'/content');
		    	$announcementsarray[$campaign['id']]['html'] = $campaigninfo['html'];
		    }
		    return $announcementsarray;
	    });

		return view('announcements', compact('announcements'));
    }
}
