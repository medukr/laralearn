<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title;
 * @property string $slug
 * @property string $text
 * @property string $image // нужно добавить в таблицу
 * @property int $category_id
 * @property int $user_id
 * @property int $status
 * @property int $views
 * @property int $is_featured
 * @property string $created_at
 * @property string $updated_at
 **/

class Post extends Model
{
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable  = ['title', 'text'];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'past_tags',
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
//        File::delete('/upload/'.$this->image);
        Storage::delete('/upload/'.$this->image); // в классе Storage метод delete() не нашел, но нашел в File;
        $this->delete();
    }

    public function uploadImage($image)
    {
        if ($image == null) return;
//        File::delete('/upload/'.$this->image);
        Storage::delete('/upload/'.$this->image); // в классе Storage метод delete() не нашел, но нашел в File

        $filename = str_random(10).'.'.$image->extension();
        $image->saveAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
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
        return isset($this->image) ? '/upload/'.$this->image : '/img/no-image.phg';
    }

}
