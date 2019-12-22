<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trigger extends Model
{
    protected $fillable = ['trigger', 'file'];

    public function teams()
    {
        return $this->belongsToMany(Trigger::class, 'team_to_trigger');
    }
}
