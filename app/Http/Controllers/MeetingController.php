<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\DB;
use App\Meeting;
use App\Setting;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingCreated;
use Validator;

class MeetingController extends Controller
{

	public function attach(){
		return view('meetings.attach');
	}

	public function attachUser(Request $request){

		$validator = Validator::make($request->all(), [
			'adminslug' => 'required|url|checkIfAdminurlHasUserAndItExists'
		],
		[
			'check_if_adminurl_has_user_and_it_exists' => 'Tämä tapaaminen on jo liitetty käyttäjätiliin tai sitä ei ole olemassa!'
		]);
		if ($validator->fails()) {
			return redirect('/oma-tili/lunasta')
				->withErrors($validator)
				->withInput();
		}
		$adminslug = str_replace("/", "", explode('/a/', $request->input('adminslug'))[1]);

		try {
			$meeting = Meeting::where('adminslug', $adminslug)->firstOrFail();
		}catch(ModelNotFoundException $e){
			return response()->view("errors.404", [], 404);
		}

		$meeting->user_id = Auth::user()->id;
		$meeting->save();

		$request->session()->put('flashmessage', [
			'title' => 'Lunastaminen onnistui',
			'message' => 'Tapaamisen liittäminen omaan tiliin onnistui!',
			'status' => 'is-success'
		]);
		return redirect('/oma-tili');
	}

	public function password(Request $request, $slug)
	{
		try {
			$meeting = Meeting::where( 'slug', $slug )
			                  ->with( [
				                  'settings'
			                  ] )->firstOrFail();
		}catch(ModelNotFoundException $e){
			return response()->view("errors.404", [], 404);
		}

		$validator = Validator::make($request->all(), [
			'password' => 'required|checkHashed:'.$meeting->settings->password
		],
			[
				'check_hashed' => 'Virheellinen salasana!',
			]);
		if ($validator->fails()) {
			return redirect('/s/'.$meeting->slug)
				->withErrors($validator)
				->withInput();
		}

		$request->session()->put($meeting->slug, bcrypt($meeting->settings->id));

		$request->session()->put('flashmessage', [
			'title' => 'Oikea salasana',
			'message' => 'Tapaamisen salasana oli oikea!',
			'status' => 'is-success'
		]);

		return redirect('/s/'.$meeting->slug);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check()){
            $validationrules = [
                'name' => 'required',
                'organizer' => 'required',
                'email' => 'required|email',
                'dates' => 'required'
            ];
        }else{
            $validationrules = [
                'name' => 'required',
                'organizer' => 'required',
                'email' => 'required|email',
                'dates' => 'required',
                'g-recaptcha-response' => 'required|grecaptcha'
            ];
        }
        $validator = Validator::make($request->all(), $validationrules,
            [
                'grecaptcha' => 'Virheellinen ihmisyystarkastus!',
            ]);
        if ($validator->fails()) {
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $name = $request->input('name');
        $description = $request->input('description');
        $location = $request->input('location');
        $organizer = $request->input('organizer');
        $email = $request->input('email');

        $slugify = new Slugify();
        $slugify->activateRuleset('swedish');

        $slugrandom = 6;
        $slug = $slugify->slugify(str_random($slugrandom)."-".$name);

        $slugs = DB::table("meetings")->where([
            ["slug", "=", $slug]
        ])->get();
        if(count($slugs) > 0) {
            while (count($slugs) > 0) {
                $slug = $slugify->slugify(str_random($slugrandom)."-".$name);
                $slugs = DB::table("meetings")->where([
                    ["slug", "=", $slug]
                ])->get();
            }
        }

        $adminslug = Uuid::uuid1()->toString();
        $adminslugs = DB::table("meetings")->where([
            ["adminslug", "=", $adminslug]
        ])->get();
        if(count($adminslugs) > 0) {
            while (count($adminslugs) > 0) {
                $adminslug = Uuid::uuid1()->toString();
                $adminslugs = DB::table("meetings")->where([
                    ["adminslug", "=", $adminslug]
                ])->get();
            }
        }

        $meeting = new Meeting;
        $meeting->name = $name;
        $meeting->description = $description;
        $meeting->location = $location;
        $meeting->email = $email;
        $meeting->organizer = $organizer;
        if(Auth::Check()){
            $meeting->user_id = Auth::User()->id;
        }
        $meeting->slug = $slug;
        $meeting->adminslug = $adminslug;
        $meeting->save();

        $settings = new Setting;
        $settings->meeting_id = $meeting->id;
        $settings->save();


        $dates = $request->input('dates');
        $dateparts = explode('|', $dates);
        $column_amount = $request->input('column-amount');
        for($i = 0; $i < count($dateparts); $i++){
            $date = $dateparts[$i];
            if($date != ""){
                $k = 1;
                $datehastimes = false;
                for($j = 1; $j <= $column_amount; $j++){
                    $timeval = $request->input('time_'.$j.'_'.$date);
                    if($timeval != "") {
	                    $time = new Time;
	                    $time->meeting_id = $meeting->id;
	                    $time->day = $date;
	                    $time->time = $timeval;
	                    $time->save();
	                    $datehastimes = true;
                        $k++;
                    }
                }
	            if($k > 0 && !$datehastimes){
		            $time = new Time;
		            $time->meeting_id = $meeting->id;
		            $time->day = $date;
		            $time->save();
	            }
            }
        }

        Mail::to($email)->send(new MeetingCreated($meeting));

        return redirect('/a/'.$adminslug);
    }

    public function admin($adminslug){

	    try {
		    $meeting = Meeting::where( 'adminslug', $adminslug )
		                      ->with( [
			                      'user',
			                      'settings',
			                      'registrations'=> function ( $query ) {
				                      $query->orderBy( 'created_at', 'asc' );
			                      },
			                      'comments' => function ( $query ) {
				                      $query->orderBy( 'created_at', 'asc' );
			                      }
		                      ] )->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
	    }

	    $meetingtimes = Time::where('meeting_id', $meeting->id)->orderBy('day', 'asc')->get();
	    $times = array();
	    $amounts = array();
	    $j = 0;
	    foreach ($meetingtimes as $time){
		    $timetime = $time->time;
		    if($timetime == ""){
			    $timetime = "Koko";
		    }
		    if(!isset($amounts[$time->day->format('n.Y')])) {
			    $amounts[ $time->day->format( 'n.Y' ) ] = 0;
		    }
		    $amounts[$time->day->format('n.Y')]++;

		    $times[$time->day->format('n.Y')][$time->day->format('j')][$j]['time'] = $timetime;
		    $times[$time->day->format('n.Y')][$time->day->format('j')][$j]['id'] = $time->id;

		    $j++;
	    }

	    $admin = true;

	    return view('meetings.show', compact('meeting', 'times', 'amounts', 'admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
    	try {
		    $meeting = Meeting::where( 'slug', $slug )
                      ->with( [
	                      'user',
	                      'settings',
	                      'registrations'=> function ( $query ) {
		                      $query->orderBy( 'created_at', 'asc' );
	                      },
	                      'comments' => function ( $query ) {
		                      $query->orderBy( 'created_at', 'asc' );
	                      }
                      ] )->firstOrFail();
	    }catch(ModelNotFoundException $e){
    		return response()->view("errors.404", [], 404);
	    }

	    if($meeting->settings->password != null){
	    	if(!Hash::check( $meeting->settings->id, session()->get($meeting->slug))){
	    		return view('meetings.password', compact('meeting'));
		    }
	    }


        $meetingtimes = Time::where( 'meeting_id', $meeting->id )->orderBy( 'day', 'asc' )->get();
        $times        = array();
        $amounts      = array();
        $j            = 0;
        foreach ( $meetingtimes as $time ) {
	        $timetime = $time->time;
	        if ( $timetime == "" ) {
		        $timetime = "Koko";
	        }
	        if ( ! isset( $amounts[ $time->day->format( 'n.Y' ) ] ) ) {
		        $amounts[ $time->day->format( 'n.Y' ) ] = 0;
	        }
	        $amounts[ $time->day->format( 'n.Y' ) ] ++;

	        $times[ $time->day->format( 'n.Y' ) ][ $time->day->format( 'j' ) ][ $j ]['time'] = $timetime;
	        $times[ $time->day->format( 'n.Y' ) ][ $time->day->format( 'j' ) ][ $j ]['id']   = $time->id;

	        $j ++;
        }

        $admin = false;

        return view( 'meetings.show', compact( 'meeting', 'times', 'amounts', 'admin' ) );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param $adminslug
	 * @param $part
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, $adminslug, $part)
    {
	    try {
		    $meeting = Meeting::where( 'adminslug', $adminslug )
		                      ->with( [
			                      'settings',
		                      ] )->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
	    }

	    if($part == "basic"){
	    	// TODO VALIDATION
		    $meeting->name = $request->input('name');
		    $meeting->description = $request->input('description');
		    $meeting->location = $request->input('location');
		    $meeting->email = $request->input('email');
		    $meeting->organizer = $request->input('organizer');
		    $meeting->save();

		    $request->session()->put('flashmessage', [
			    'title' => 'Muokkaus onnistui',
			    'message' => 'Tapaamisen tietojen muokkaus onnistui!',
			    'status' => 'is-success'
		    ]);

		    return redirect('/a/'.$meeting->adminslug);
	    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
