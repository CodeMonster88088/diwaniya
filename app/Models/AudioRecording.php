<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AudioRecording extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'speaker',
        'recorded_at',
        'location',
        'filename',
        'original_filename',
        'mime_type',
        'duration',
        'file_size',
        'transcript',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

//the upper function means

// Category
//    │
//    └─── has many AudioRecordings

// AudioRecording
//    │
//    └─── belongs to one Category

// So later:

// $audio->category

// will give us its category.

// And:

// $audio->category->name

//Example Below:

// Title:              Interview with Grandfather
// Category:           Family
// Speaker:            Hassan
// Recorded:           1998-05-14
// Location:           Family Diwaniya
// Filename:           interview-grandfather.mp3
// Original filename:  tape_003.mp3
// Duration:           3642 seconds
// File size:          52428800 bytes
// Transcript:         ...
// Published:          Yes