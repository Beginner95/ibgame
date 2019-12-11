<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function triggers()
    {
        return $this->hasMany(Trigger::class);
    }

    public function evidence()
    {
        return $this->hasMany(Evidence::class);
    }

    public function moves()
    {
        return $this->hasMany(Move::class);
    }
}
