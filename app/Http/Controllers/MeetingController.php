<?php

namespace App\Http\Controllers;

use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use Auth;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\DB;
use App\Meeting;
use App\Time;
use App\Setting;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingCreated;
use Validator;

class MeetingController extends Controller
{
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
                $slugs = DB::table("threads")->where([
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
                $datetimes = array();
                $k = 1;
                for($j = 1; $j <= $column_amount; $j++){
                    $timeval = $request->input('time_'.$j.'_'.$date);
                    if($timeval != "") {
                        $datetimes['time_' . $k] = $timeval;
                        $k++;
                    }
                }
                $datetimejson = json_encode($datetimes);
                $time = new Time;
                $time->meeting_id = $meeting->id;
                $time->day = $date;
                $time->times = $datetimejson;
                $time->save();
            }
        }

        Mail::to($email)->send(new MeetingCreated($meeting));

        return redirect('/a/'.$adminslug);
    }

    public function admin($adminslug){
        $meeting = Meeting::where('adminslug', $adminslug)->with('user', 'times', 'settings', 'comments')->first();
        return view('meetings.admin', compact('meeting'));
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $meeting = Meeting::where('slug', $slug)
            ->with([
                'user',
                'times' => function($query){
                    $query->orderBy('day', 'asc');
                },
                'settings',
                'comments' => function($query){
                    $query->orderBy('created_at', 'asc');
                }
            ])->first();
        return view('meetings.show', compact('meeting'));
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
