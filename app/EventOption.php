<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOption extends Model
{
    protected $fillable = ['name', 'description'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_to_event_option');
    }
}
