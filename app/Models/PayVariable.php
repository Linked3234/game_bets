<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayVariable extends Model
{

    public $timestamps = false;

    protected $fillables = [
        'name',
        'description',
    ];

}
