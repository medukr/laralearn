<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title;
 * @property string $slug
 * @property string $text
 * @property string $image
 * @property int $category_id
 * @property int $user_id
 * @property int $status
 * @property int $views
 * @property int $is_featured
 * @property string $created_at
 * @property string $updated_at
 * @property string $description
 * @property string $date
 **/

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable  = ['title', 'content', 'date', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'post_tags',
            'post_id',
            'tag_id'
        );
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function add($field)
    {
        $post = new static();
        $post->fill($field);
        $post->status = 0;
        $post->is_featured = 0;
        $post->user_id = 1;
        $post->save();

        return $post;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->tags()->detach($this->tags->pluck('id'));
        $this->delete();
    }

    public function uploadImage($image)
    {
        if ($image == null) return;

        $this->removeImage();
        $filename = str_random(10).'.'.$image->extension();
        $image->storeAs('upload', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function removeImage()
    {
        if ($this->image != null) Storage::delete('/upload/'.$this->image);
    }

    public function setCategory($id)
    {
        if ($id == null) return;

        $this->category_id = $id;
        $this->save();
    }

    public function setTags($ids)
    {
        if ($ids == null) return;

        $this->tags()->sync($ids);
    }

    public function setDraft()
    {
        $this->status = Post::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {
        $this->status = Post::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {
        if ($value == null) return $this->setDraft();
        return $this->setPublic();
    }

    public function setFeatured()
    {
        $this->is_featured = 1;
        $this->save();
    }

    public function setStandart()
    {
        $this->is_featured = 0;
        $this->save();
    }

    public function toggleFeatured($value)
    {
        if ($value == null) return $this->setStandart();
        return $this->setFeatured();
    }

    public function getImage()
    {
        return isset($this->image) ? '/upload/'.$this->image : '/img/no-image.png';
    }

    public function setDateAttribute($value)
    {
        $date = Carbon::createFromFormat('d/m/y', $value)->format('Y-m-d');

        $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value)
    {

        $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/y');

        return $date;
    }


    public function getCategoryTitle()
    {
        return ($this->category != null) ? $this->category->title : 'Нет категории';
    }

    public function getTagsTitles()
    {
        return (!empty($this->tags))
            ? implode(", ", $this->tags->pluck('title')->all())
            : 'Нет тегов';
    }

    public function getCategoryID()
    {
        return ($this->category != null) ? $this->category->id : null;
    }

    public function getDate()
    {
        $date = Carbon::createFromFormat('d/m/y', $this->date)->format('F d, Y');

        return $date;

    }

    public function hasPrevious()
    {

           return self::where('id', '<', $this->id)->max('id');
    }

    public function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    public function getPrevious()
    {
        $postID = $this->hasPrevious();
        return self::find($postID);
    }

    public function getNext()
    {
        $postID = $this->hasNext();
        return self::find($postID);
    }

    public function related()
    {
        return self::all()->except($this->id);
    }

}
