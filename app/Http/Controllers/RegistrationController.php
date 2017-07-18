<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\Registration;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
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
	 * @param $slug
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store($slug, Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'times' => 'required|array',
		]);

		try {
			$meeting = Meeting::where( 'slug', $slug )->firstOrFail();
		}catch(ModelNotFoundException $e){
			return response()->view("errors.404", [], 404);
		}

		$registration = new Registration();
		$registration->times = json_encode($request->input('times'));
		$registration->meeting_id = $meeting->id;
		if(Auth::check()){
			$registration->user_id = Auth::user()->id;
		}
		$registration->username = $request->input('name');
		$registration->save();

		$request->session()->put('flashmessage', [
			'title' => 'Ilmoittautuminen onnistui',
			'message' => 'Ilmoittautuminen onnistui!',
			'status' => 'is-success'
		]);

		return redirect('/s/'.$meeting->slug);
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Request $request
	 * @param $adminslug
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function destroy(Request $request, $adminslug)
    {
    	// TODO VALIDATION

	    try {
		    $registration = Registration::where('id', $request->input('registration'))->firstOrFail();
	    }catch(ModelNotFoundException $e){
		    return response()->view("errors.404", [], 404);
	    }

	    $registration->delete();

	    $request->session()->put('flashmessage', [
		    'title' => 'Ilmoittautumisen poisto onnistui',
		    'message' => 'Ilmoittautumisen poisto onnistui!',
		    'status' => 'is-success'
	    ]);

        return redirect('/a/'.$adminslug);
    }
}
