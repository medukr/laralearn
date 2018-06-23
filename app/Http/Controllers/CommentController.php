<?php

namespace App\Http\Controllers;

use Auth;
use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->status == 1) return redirect()->back()->with('status', 'вы не можете оствлять комментарии');
        $this->validate($request,[
           'message' => 'required|max:1000',
        ]);

        $comment = new Comment();
        $comment->text = $request->get('message');
        $comment->post_id = $request->get('post_id');
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()->back()->with('status', 'Ваш комментарий будет скоро добавлен');
    }
}
