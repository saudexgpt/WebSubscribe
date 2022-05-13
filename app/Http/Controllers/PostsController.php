<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Mail\SubscriberMail;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
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
     * Store a newly created post in db.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $new_post = new Post();
        $new_post->website_id = $request->website_id;
        $new_post->title = $request->title;
        $new_post->description = $request->description;
        $new_post->save();
        return $this->show($new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        return response()->json(compact('post'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
        //
        $post->is_published = '1';
        //check if post is sent to subscribers
        if ($post->is_sent == '0') {
            // post is not sent, so we send
            $post->is_sent = '1'; // update the post to sent

            // send email to all subscriber to the website with this post
            $subscribers =  $post->website->subscribers;
            $mail = new SubscriberMail($post->title, $post->description);
            foreach ($subscribers as $subscriber) {
                Mail::to($subscriber)->send($mail);
                // $post->subscribers()->sync($subscriber->id);
            }
        }
        $post->save();
        return response()->json(['message' => 'Post is published and sent to subscribers'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
