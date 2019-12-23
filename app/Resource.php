<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['resource', 'file'];

    public function teams()
    {
        return $this->belongsToMany(Resource::class, 'team_to_resource');
    }
}
