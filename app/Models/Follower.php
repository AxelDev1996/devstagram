<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Follower extends Pivot
{
    //

    protected $fillable = [
        'user_id',
        'follower_id'
    ];
}
