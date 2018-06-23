<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
Use Image;

/**
* This is the model class for table "users".
*
* @property int $id
* @property string $name
* @property string $email
* @property string $password
* @property string $avatar // необходимо добавить в таблицу
* @property int $is_admin
* @property int $status
* @property string $remember_token
* @property string $created_at
* @property string $updated_at
**/


class User extends Authenticatable
{
    use Notifiable;

    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'user_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fields)
    {
        $user = new static();
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);


        $this->save();
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($image)
    {
        if ($image == null) return;

        $this->removeAvatar();
        $filename = str_random(10);

        $imageMain = Image::make($image)->fit(500);
        $imageMain->save('upload/'.$filename.'.jpg', 90);

        $imageMini = $imageMain->fit(90);
        $imageMini->save('upload/'.$filename.'_90x90.jpg', 60);

        $this->avatar = $filename;
        $this->save();
    }


    public function removeAvatar(){
        if ($this->avatar != null) {
            Storage::delete('/upload/' . $this->avatar . '.jpg');
            Storage::delete('/upload/' . $this->avatar. '_90x90.jpg');
        }
    }

    public function getAvatar()
    {
        return isset($this->avatar) ? '/upload/'.$this->avatar.'.jpg' : '/img/no-user-image.png';
    }

    public function getAvatarMini()
    {
        return isset($this->avatar) ? '/upload/'.$this->avatar.'_90x90.jpg' : '/img/no-user-image.png';
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
    }

    public function toggleAdmin($value)
    {
        if ($value == 0){
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }

    public function toggleBan()
    {
        if ($this->status == 1) return $this->unban();

        return $this->ban();
    }
}
