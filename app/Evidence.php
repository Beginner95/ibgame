<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    protected $table = 'evidences';
    protected $fillable = ['clue', 'status'];

    public function teams()
    {
        return $this->belongsToMany(Evidence::class, 'team_to_evidence');
    }
}
