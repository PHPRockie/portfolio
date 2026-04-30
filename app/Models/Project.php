<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'summary', 'description',
        'tech_stack', 'github_url', 'github_private', 'live_url',
        'featured', 'problem', 'solution', 'highlights', 'sort_order',
    ];

    protected $casts = [
        'tech_stack'     => 'array',
        'highlights'     => 'array',
        'featured'       => 'boolean',
        'github_private' => 'boolean',
    ];
}
