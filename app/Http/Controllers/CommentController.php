<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'body'=> 'required',   
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['post_id'] =intval($request->post_id);
        
        $slug = $request->slug;
        Comment::create($validatedData);
        $postId = Post::find($request->post_id);
        $postId->decrement('count');

        return redirect('/detail/'. $slug)->with('success', 'Your comment has been added!');
    }
}
