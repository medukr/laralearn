<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::all();

        return view('admin.comments.index', compact('comments'));
    }

    public function toggle($id)
    {
        $comment = Comment::find($id);
        $comment->toggleStatus();

        return redirect()->back();
    }

    public function destroy($id)
    {
        Comment::find($id)->remove();

        return redirect()->back()->with('status', 'Комментарий удален');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        return view('admin.comments.edit', compact('comment'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'text' => 'required|max:1000',
        ]);

        $comment = Comment::find($id);

        $comment->text = $request->get('text');
        $comment->save();

        return redirect()->route('comments.index')->with('status', 'Комеентарий обновлен');
    }
}
