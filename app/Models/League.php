<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class League extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];

    public function tasks(): HasMany {
        return $this->hasMany(Task::class);
    }
}
