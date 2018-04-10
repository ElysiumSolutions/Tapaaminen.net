<?php

namespace App\Http\Controllers;

use App\Time;
use App\Meeting;
use Illuminate\Http\Request;
use Validator;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($adminslug)
    {
        try {
		    $meeting = Meeting::where( 'adminslug', $adminslug )->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
        }
        
        return view('meetings.addtime', compact('meeting'));
    }

    public function remove($adminslug)
    {
        try {
		    $meeting = Meeting::where( 'adminslug', $adminslug )->with(['times' => function($q){
                $q->orderBy( 'day', 'asc' );
            }])->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
        }        
        return view('meetings.deletetime', compact('meeting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $adminslug)
    {
        $validationrules = [
            'dates' => 'required'
        ];

        $validator = Validator::make($request->all(), $validationrules);
        if ($validator->fails()) {
            return redirect('/a/'.$adminslug.'/times/add')
                ->withErrors($validator)
                ->withInput();
        }

        try {
		    $meeting = Meeting::where( 'adminslug', $adminslug )->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
        }

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
                        $timecount = Time::where([
                            ['meeting_id', '=', $meeting->id],
                            ['day', '=', $date],
                            ['time', '=', $timeval],
                        ])->get()->count();
                        if($timecount == 0){
                            $time = new Time;
                            $time->meeting_id = $meeting->id;
                            $time->day = $date;
                            $time->time = $timeval;
                            $time->save();
                        }
                        $datehastimes = true;
                        $k++;
                    }
                }
	            if($k > 0 && !$datehastimes){
                    $timecount = Time::where([
                        ['meeting_id', '=', $meeting->id],
                        ['day', '=', $date],
                    ])->get()->count();
                    if($timecount == 0){
                        $time = new Time;
                        $time->meeting_id = $meeting->id;
                        $time->day = $date;
                        $time->save();
                    }
	            }
            }
        }

        $request->session()->put( 'flashmessage', [
            'title'   => "Aikojen lisäys",
            'message' => "Aikojen lisäys tapaamiseen onnistui!",
            'status'  => 'is-success'
        ] );

	    return redirect('/a/'.$meeting->adminslug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function show(Time $time)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function edit(Time $time)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Time $time)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Time  $time
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $adminslug)
    {
        $validationrules = [
            'times' => 'required|array'
        ];

        $validator = Validator::make($request->all(), $validationrules);
        if ($validator->fails()) {
            return redirect('/a/'.$adminslug.'/times/remove')
                ->withErrors($validator)
                ->withInput();
        }

        Time::destroy($request->input('times'));

        $request->session()->put( 'flashmessage', [
            'title'   => "Aikojen poisto",
            'message' => "Aikojen poistaminen tapaamisesta onnistui!",
            'status'  => 'is-success'
        ] );

	    return redirect('/a/'.$adminslug);
    }
}
