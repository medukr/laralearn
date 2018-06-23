<?php

namespace App\Providers;

use App\Category;
use App\Comment;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('pages._sidebar', function ($view){
            $view->with('popularPosts', Post::getPopularPosts());
            $view->with('categories', Category::getCategoriesHavingPublishPosts());
            $view->with('resentPosts', Post::wherePublicAndDate()
                                            ->orderBy('date', 'desc')
                                            ->take(4)
                                            ->get());
            $view->with('featuredPosts', Post::wherePublicAndDate()
                                            ->where('is_featured', 1)
                                            ->take(3)
                                            ->get());
        });

        view()->composer('admin._sidebar', function ($view){
           $view->with('countComments', Comment::where('status', 0)->count());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
