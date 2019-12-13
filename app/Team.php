<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function resources()
    {
        return $this->hasMany(Resource::class)->orderBy('id', 'DESC');
    }

    public function triggers()
    {
        return $this->hasMany(Trigger::class)->orderBy('id', 'DESC');
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class)->orderBy('id', 'DESC');
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }
}
