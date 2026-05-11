<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Seat;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{
    public function selectSeats(Show $show)
    {
<<<<<<< HEAD
=======
        Reservation::releaseExpiredCashierReservations();

>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        $show->load('movie');
        $seats = $show->seats()
            ->orderBy('row')
            ->orderBy('number')
            ->get()
            ->groupBy('row');

        $availableSeats = $show->seats()->where('is_available', true)->count();
        $bookedSeats = $show->seats()->where('is_available', false)->count();

        return view('shows.seats', compact('show', 'seats', 'availableSeats', 'bookedSeats'));
    }

    public function checkout(Request $request, Show $show)
    {
        $seatIds = $request->query('seats');
        
        if (!$seatIds) {
            return redirect()->route('shows.seats', $show)->with('error', 'Please select seats first.');
        }

        $seatIdsArray = is_array($seatIds) ? $seatIds : json_decode($seatIds, true);
        
        if (empty($seatIdsArray)) {
            return redirect()->route('shows.seats', $show)->with('error', 'Please select seats first.');
        }

        $seats = Seat::whereIn('id', $seatIdsArray)
            ->where('show_id', $show->id)
            ->where('is_available', true)
            ->get();

        if ($seats->isEmpty()) {
            return redirect()->route('shows.seats', $show)->with('error', 'Selected seats are no longer available. Please choose different seats.');
        }

        if ($seats->count() !== count($seatIdsArray)) {
            return redirect()->route('shows.seats', $show)->with('error', 'Some selected seats are no longer available. Please choose different seats.');
        }

<<<<<<< HEAD
=======
        $confirmationCode = Reservation::generateConfirmationCode();
        $tempReservationId = 'temp_' . time() . '_' . rand(1000, 9999);

        foreach ($seats as $seat) {
            $seat->update([
                'is_available' => false,
                'temp_reservation_id' => $tempReservationId
            ]);
        }

        $request->session()->put('temp_reservation', [
            'id' => $tempReservationId,
            'show_id' => $show->id,
            'seat_ids' => $seats->pluck('id')->toArray(),
            'confirmation_code' => $confirmationCode,
            'expires_at' => now()->addMinutes(15)
        ]);

>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        $show->load('movie');
        $totalPrice = $seats->sum('price');

        return view('checkout.index', compact('show', 'seats', 'totalPrice'));
    }

    public function releaseSeats(Request $request)
    {
        $tempReservation = $request->session()->get('temp_reservation');
        
        if ($tempReservation && now()->lt($tempReservation['expires_at'])) {
            Seat::whereIn('id', $tempReservation['seat_ids'])->update([
                'is_available' => true,
                'temp_reservation_id' => null
            ]);
        }
        
        $request->session()->forget('temp_reservation');
        
        return response()->json(['success' => true]);
    }
}
