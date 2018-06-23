<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['title'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function getCategoriesHavingPublishPosts()
    {

        return self::select('categories.id', 'categories.slug', 'categories.title')
            ->join('posts', 'categories.id','=','posts.category_id')
            ->where('posts.status', '=', Post::IS_PUBLIC)
            ->where('posts.date', '<=', Carbon::now())
            ->groupBy('categories.id')
            ->get();
    }
}
