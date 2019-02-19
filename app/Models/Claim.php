<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{

    public $timestamps = false;


    public function user()
    {

        return $this->hasMany(User::class, 'id', 'user_id')->first();

    }

}
