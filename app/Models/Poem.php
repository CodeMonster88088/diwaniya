<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poem extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'poet',
        'content',
        'description',
        'written_at',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'written_at' => 'date',
            'is_published' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

//Example Below:

// Title:       يا دارنا
// Poet:        محمد
// Content:     [full poem]
// Written at:  1987-03-12
// Category:    Poetry
// Published:   Yes