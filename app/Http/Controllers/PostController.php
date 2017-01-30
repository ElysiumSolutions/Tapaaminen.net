<?php

namespace App\Http\Controllers;

use App\Notifications\PostLiked;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use App\Thread;
use App\Post;
use Auth;
use GrahamCampbell\Markdown\Facades\Markdown;


class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $this->validate($request, [
            'message' => 'required',
        ]);

        $message = $request->input('message');
        $message = Markdown::convertToHtml($message);

        $thread = Thread::where('slug', $slug)->first();

        $post = new Post;
        $post->message = $message;
        $post->thread_id = $thread->id;
        $post->user_id = Auth::User()->id;
        $post->save();

        return redirect('/palsta/'.$slug);

    }

    public function like(Request $request){
        $postid = $request->input('post');
        $post = Post::where('id', $postid)->with('user')->first();
        $currentlikes = $post->likes;
        $feedback = "";
        $sendNotification = false;

        $likedusers = $post->likes_users;
        if($likedusers == ""){
            $post->likes = $currentlikes+1;
            $post->likes_users = json_encode(array(Auth::User()->id));
            $feedback = "Tykätty!";
            $sendNotification = true;
        }else{
            $likeusersarray = json_decode($likedusers);
            if(in_array(Auth::User()->id, $likeusersarray)){
                $post->likes = $currentlikes-1;
                $feedback = "Tykkäys peruutettu!";
                $arraybak = array();
                for($i = 0; $i < count($likeusersarray); $i++){
                    if(Auth::User()->id != $likeusersarray[$i]){
                        $arraybak[] = $likeusersarray[$i];
                    }
                }
                $likeusersarray = $arraybak;
            }else{
                $post->likes = $currentlikes+1;
                $likeusersarray[] = Auth::User()->id;
                $feedback = "Tykätty!";
                $sendNotification = true;
            }
            $post->likes_users = json_encode($likeusersarray);
        }

        $post->save();

        if($sendNotification){
            $post->user->notify(new PostLiked($post, Auth::User()));
        }
        return array(
            "feedback" => $feedback,
            "likes" => $post->likes
        );
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
