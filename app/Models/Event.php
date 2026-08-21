<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'event_date',
        'location',
        'image',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'is_published' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}


//Example Below:

// Title:        Annual Family Gathering
// Description:  The annual family gathering.
// Event date:   2026-12-20 19:00
// Location:     Family Diwaniya
// Image:        events/family-gathering.jpg
// Published:    Yes