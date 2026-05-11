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
<<<<<<< HEAD
        'is_confirmed',
        'payment_method',
        'payment_status',
        'payment_due_at',
=======
        'payment_method',
        'payment_status',
        'payment_expires_at',
        'is_confirmed',
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
    ];

    protected $casts = [
        'is_confirmed' => 'boolean',
<<<<<<< HEAD
        'payment_due_at' => 'datetime',
=======
        'payment_expires_at' => 'datetime',
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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
<<<<<<< HEAD
=======

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
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
}
