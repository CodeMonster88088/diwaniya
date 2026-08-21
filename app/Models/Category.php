<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
    ];

    public function audioRecordings(): HasMany
    {
        return $this->hasMany(AudioRecording::class);
    }

    public function historicalPhotos(): HasMany
    {
        return $this->hasMany(HistoricalPhoto::class);
    }

    public function poems(): HasMany
    {
        return $this->hasMany(Poem::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}

//Example Below:

// id:          1
// name:        Family Events
// slug:        family-events
// description: Events and gatherings of the family
// type:        event