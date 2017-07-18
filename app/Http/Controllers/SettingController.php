<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Setting;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SettingController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param $adminslug
	 *
	 * @return \Illuminate\Http\Response
	 * @internal param Setting $setting
	 */
    public function update(Request $request, $adminslug)
    {
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

	    $settings = Setting::where('meeting_id', $meeting->id)->first();

	    $target = $request->input('target');

	    // TODO VALIDATION

	    $title = "Asetusten muokkaus onnistui";
	    $message = "";

	    if($target == "setPassword"){
	    	$settings->password = bcrypt($request->input('password'));
	    	$settings->save();
	    	$message = "Salasanan asetus onnistui!";
	    }

	    if($target == "removePassword"){
		    $settings->password = NULL;
		    $settings->save();
		    $message = "Salasanan poisto onnistui!";
	    }

	    if($target == "hideComments"){
		    $settings->comments = false;
		    $settings->save();
		    $message = "Kommenttien piilotus onnistui!";
	    }

	    if($target == "showComments"){
		    $settings->comments = true;
		    $settings->save();
		    $message = "Kommenttien näyttö onnistui!";
	    }

	    if($target == "hideEmail"){
		    $settings->showemail = false;
		    $settings->save();
		    $message = "Oman sähköpostin piilotus onnistui!";
	    }

	    if($target == "showEmail"){
		    $settings->showemail = true;
		    $settings->save();
		    $message = "Oman sähköpostin näyttö onnistui!";
	    }

	    if($target == "hideNames"){
		    $settings->shownames = false;
		    $settings->save();
		    $message = "Osallistujien nimien piilotus onnistui!";
	    }

	    if($target == "showNames"){
		    $settings->shownames = true;
		    $settings->save();
		    $message = "Osallistujien nimien näyttö onnistui!";
	    }

	    if($target == "hideSocialmediabuttons"){
		    $settings->socialmediabuttons = false;
		    $settings->save();
		    $message = "Sosiaalisten medioiden painikkeiden piilotus onnistui!";
	    }

	    if($target == "showSocialmediabuttons"){
		    $settings->socialmediabuttons = true;
		    $settings->save();
		    $message = "Sosiaalisten medioiden painikkeiden näyttö onnistui!";
	    }

	    if($title != "" && $message != "") {
		    $request->session()->put( 'flashmessage', [
			    'title'   => $title,
			    'message' => $message,
			    'status'  => 'is-success'
		    ] );
	    }

	    return redirect('/a/'.$adminslug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
