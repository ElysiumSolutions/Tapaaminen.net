<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Post;
use App\User;
use Auth;
use Cocur\Slugify\Slugify;
use Illuminate\Support\Facades\DB;
use GrahamCampbell\Markdown\Facades\Markdown;


class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::with(['user', 'posts' => function($query){
            $query->orderBy('created_at', 'asc');
        }])->latest('updated_at')->paginate(10);

        $threadcount = Thread::all()->count();
        $messagecount = Post::all()->count();
        $usercount = User::all()->count();
        $likecount = Post::sum('likes');

        return view('thread.index', compact('threads', 'threadcount', 'messagecount', 'usercount', 'likecount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'message' => 'required',
        ]);

        $title = $request->input('title');
        $message = $request->input('message');
        $message = Markdown::convertToHtml($message);

        $slugify = new Slugify();
        $slugify->activateRuleset('swedish');
        $slug = $slugify->slugify($title);

        $j = 1;
        $slugs = DB::table("threads")->where([
            ["slug", "=", $slug]
        ])->get();
        if(count($slugs) > 0) {
            while (count($slugs) > 0) {
                $slug = $slugify->slugify($name."-".$j);
                $slugs = DB::table("threads")->where([
                    ["slug", "=", $slug]
                ])->get();
                $j++;
            }
        }

        $thread = new Thread;
        $thread->title = $title;
        $thread->slug = $slug;
        $thread->user_id = Auth::User()->id;
        $thread->save();

        $post = new Post;
        $post->message = $message;
        $post->thread_id = $thread->id;
        $post->user_id = Auth::User()->id;
        $post->save();

        $thread->first_post_id = $post->id;
        $thread->save();

        return redirect('/palsta/'.$thread->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $thread = Thread::where('slug', $slug)->with(['user', 'posts' => function($query){
            $query->orderBy('created_at', 'asc');
        }])->first();
        return view('thread.show', compact('thread'));
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
