<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'issuer', 'credential_id', 'credential_url',
        'image', 'issued_date', 'expiry_date', 'has_expiry', 'category', 'is_featured'
    ];

    protected $casts = [
        'issued_date' => 'date',
        'expiry_date' => 'date',
        'has_expiry' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getIsExpiredAttribute()
    {
        if (!$this->has_expiry || !$this->expiry_date) return false;
        return $this->expiry_date->isPast();
    }
}