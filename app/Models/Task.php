<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'reward',
        'max_winners',
        'league_id',
        'user_id',
        'status',
    ];
}
