<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoricalPhoto extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'filename',
        'original_filename',
        'photographed_at',
        'location',
        'people',
        'photographer',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'photographed_at' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

//Example Below:

// Title:              Family gathering in 1985
// Description:        Family members gathered at the old house.
// Filename:           family-gathering-1985.jpg
// Original filename:  IMG_0042.jpg
// Photographed:       1985-06-20
// Location:           Muharraq
// People:             Ahmed, Hassan, Mohammed
// Photographer:       Ali
// Published:          Yes