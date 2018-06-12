<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* This is the model class for table 'comments'
*
* @property int $id
* @property string $text
* @property int $user_id
* @property int $post_id
* @property int $status
* @property string $created_at
* @property string $updated_at
**/

class Comment extends Model
{
    const IS_ALLOW = 1;
    const IS_DISALLOW = 0;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow()
    {
        $this->status = Comment::IS_ALLOW;
        $this->save();
    }

    public function disallow()
    {
        $this->status = Comment::IS_DISALLOW;
        $this->save();
    }

    public function toggleStatus()
    {
//        if ($this->status == 0) return $this->allow();
//        return $this->disallow();
        return $this->status == 0 ? $this->allow() : $this->disallow();
    }

    public function remove()
    {
        $this->delete();
    }

}
