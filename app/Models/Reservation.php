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
        'payment_method',
        'payment_status',
        'payment_expires_at',
        'is_confirmed',
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
        'payment_expires_at' => 'datetime',
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

    public function isExpired(): bool
    {
        return $this->payment_method === 'cashier'
            && $this->payment_status === 'pending'
            && $this->payment_expires_at
            && $this->payment_expires_at->isPast();
    }

    public static function releaseExpiredCashierReservations(): void
    {
        $expired = self::where('payment_method', 'cashier')
            ->where('payment_status', 'pending')
            ->whereNotNull('payment_expires_at')
            ->where('payment_expires_at', '<', now())
            ->get();

        foreach ($expired as $reservation) {
            $seat = $reservation->seat;

            if ($seat && !$seat->is_available) {
                $seat->update([
                    'is_available' => true,
                ]);
            }

            $reservation->update([
                'payment_status' => 'expired',
            ]);
        }
    }
}
