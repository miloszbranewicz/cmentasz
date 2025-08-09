<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    protected $fillable = [
        'task_id',
        'user_id',
        'description',
        'media',
        'is_winner'
    ];
}
