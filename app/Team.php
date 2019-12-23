<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'team', 'description', 'icon', 'status'
    ];

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'team_to_resource')->orderBy('id', 'DESC')->withTimestamps();
    }

    public function triggers()
    {
        return $this->belongsToMany(Trigger::class, 'team_to_trigger')->orderBy('id', 'DESC')->withTimestamps();
    }

    public function evidences()
    {
        return $this->belongsToMany(Evidence::class, 'team_to_evidence')->orderBy('id', 'DESC')->withTimestamps();
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }

    public function eventOptions()
    {
        return $this->belongsToMany(EventOption::class, 'team_to_event_option')->withTimestamps();
    }
}
