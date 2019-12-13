<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed answer
 * @property mixed move_id
 */
class Answer extends Model
{
    protected $fillable = [
        'answer', 'move_id'
    ];
}
