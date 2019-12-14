<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $fillable = ['move', 'play_time', 'status', 'team_id'];
}
