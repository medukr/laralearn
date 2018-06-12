<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
* This is the model for table 'subscriptions'
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property string $created_at
 * @property string $updated_at
 **/

class Subscription extends Model
{
    public static function add($email)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->save();

        return $sub;
    }

    public function generateToken()
    {
        $this->token = str_random(100);
        $this->save();
    }

    public function remove()
    {
        $this->delete();
    }
}
