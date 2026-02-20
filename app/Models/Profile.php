<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'title', 'tagline', 'bio', 'avatar',
        'email', 'phone', 'location', 'website', 'github', 'linkedin',
        'twitter', 'instagram', 'years_experience', 'projects_completed',
        'clients_served', 'resume', 'available_for_hire'
    ];

    protected $casts = [
        'available_for_hire' => 'boolean',
        'years_experience' => 'integer',
        'projects_completed' => 'integer',
        'clients_served' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}