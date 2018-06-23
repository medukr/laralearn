<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Support\Carbon;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::wherePublicAndDate()->paginate(3);

        return view('pages.index', compact(
            'posts'
        ));
    }


    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if ($post->status != Post::IS_PUBLIC || $post->getPostTimestampDate() >= Carbon::now()->timestamp){
            if (!Auth::check() || Auth::user()->is_admin != 1) return abort(404);
        }

        $post->plusView();

        return view('pages.show', compact('post'));
    }


    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->where('status', Post::IS_PUBLIC)
            ->where('date', '<=', Carbon::now())->paginate(2);

        return view('pages.list', compact('posts'));
    }


    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()
            ->where('status', Post::IS_PUBLIC)
            ->where('date', '<=', Carbon::now())->paginate(2);

        return view('pages.list', compact('posts'));
    }


    public function contacts()
    {
        return view('pages.contacts');
    }


    public function about()
    {
        return view ('pages.about');
    }
}
