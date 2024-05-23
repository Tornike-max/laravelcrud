<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $incomingFields = $request->validate([
            'post' => 'required',
            'body' => 'required'
        ]);

        $incomingFields['post'] = strip_tags($incomingFields['post']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        $incomingFields['user_id'] = auth()->id();

        Post::create($incomingFields);

        return redirect('/');
    }


    public function editPost(Post $post)
    {
        if (auth()->user()->id === $post['user_id']) {
            return view('editpost', ['post' => $post]);
        }
        return redirect('/');
    }

    public function deletepost(Post $post)
    {
        if (auth()->user()->id === $post['user_id']) {
            $post->delete();
            return redirect('/');
        }
        return redirect('/');
    }

    public function editActualPost(Post $post, Request $request)
    {
        if (auth()->user()->id === $post['user_id']) {
            $incomingFields = $request->validate([
                'post' => 'required',
                'body' => 'required',
            ]);
            $post->update($incomingFields);
            return redirect('/');
        }
        return redirect('/');
    }
}
