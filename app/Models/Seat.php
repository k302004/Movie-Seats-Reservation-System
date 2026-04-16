<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'show_id',
        'row',
        'number',
        'is_available',
        'price',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'number' => 'integer',
        'price' => 'decimal:2',
    ];

    public function show(): BelongsTo
    {
        return $this->belongsTo(Show::class);
    }

    public function reservation(): HasOne
    {
        return $this->hasOne(Reservation::class);
    }

    public function getSeatLabelAttribute(): string
    {
        return $this->row . $this->number;
    }
}
