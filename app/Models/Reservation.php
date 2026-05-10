<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'seat_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'confirmation_code',
        'is_confirmed',
        'payment_method',
        'payment_status',
        'payment_due_at',
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
        'payment_due_at' => 'datetime',
    ];

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_email', 'email');
    }

    public static function generateConfirmationCode(): string
    {
        return 'TKT-' . strtoupper(uniqid());
    }
}
