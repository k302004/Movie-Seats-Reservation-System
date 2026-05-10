<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'poster',
        'video_url',
        'duration',
        'genre',
        'release_date',
        'rating',
        'is_active',
    ];

    protected $casts = [
        'release_date' => 'date',
        'duration' => 'integer',
        'rating' => 'decimal:1',
        'is_active' => 'boolean',
    ];

    public function shows(): HasMany
    {
        return $this->hasMany(Show::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getStarRatingAttribute(): string
    {
        $fullStars = floor($this->rating / 2);
        $halfStar = ($this->rating % 2) >= 1;
        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
        
        return str_repeat('★', $fullStars) . ($halfStar ? '½' : '') . str_repeat('☆', $emptyStars);
    }
}
