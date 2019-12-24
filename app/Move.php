<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    protected $fillable = ['move', 'play_time', 'play_time_start', 'status', 'team_id'];

    public function answer()
    {
        return $this->hasOne(Answer::class);
    }
}
