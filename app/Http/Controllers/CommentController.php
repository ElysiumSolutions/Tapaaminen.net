<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Meeting;
use Validator;
use Auth;

class CommentController extends Controller
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
    public function store(Request $request, $slug)
    {
        $meeting = Meeting::where('slug', $slug)->first();
        if(Auth::check()){
            $validationrules = [
                'username' => 'required',
                'comment' => 'required',
                'email' => 'required|email',
            ];
        }else{
            $validationrules = [
                'username' => 'required',
                'comment' => 'required',
                'email' => 'required|email',
                'g-recaptcha-response' => 'required|grecaptcha'
            ];
        }
        $validator = Validator::make($request->all(), $validationrules,
            [
                'grecaptcha' => 'Virheellinen ihmisyystarkastus!',
            ]);
        if ($validator->fails()) {
            return redirect('/s/'.$slug)
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment;
        $comment->meeting_id = $meeting->id;
        if(Auth::Check()){
            $comment->user_id = Auth::User()->id;
        }
        $comment->username = $request->input('username');
        $comment->comment = Markdown::convertToHtml($request->input('comment'));
        $comment->email = $request->input('email');
        $comment->save();

	    $request->session()->put( 'flashmessage', [
		    'title'   => "Kommentointi onnistui!",
		    'message' => "Kommentointi onnistui!",
		    'status'  => 'is-success'
	    ] );

        return redirect('/s/'.$slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
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
	 * @internal param Comment $comment
	 */
    public function destroy(Request $request, $adminslug)
    {
    	$comment = Comment::where('id', $request->input('comment'))->firstOrFail();

    	$comment->delete();

	    $request->session()->put( 'flashmessage', [
		    'title'   => "Kommentin poisto onnistui!",
		    'message' => "Kommentin poisto onnistui!",
		    'status'  => 'is-success'
	    ] );

	    return redirect('/a/'.$adminslug);
    }
}
