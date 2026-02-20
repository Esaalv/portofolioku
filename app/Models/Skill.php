<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'user_id', 'name', 'category', 'level', 'icon', 'color', 'sort_order', 'is_featured'
    ];

    protected $casts = [
        'level' => 'integer',
        'sort_order' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}