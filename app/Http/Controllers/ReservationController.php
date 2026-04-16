<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Seat;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'show_id' => 'required|exists:shows,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'required|exists:seats,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
        ]);

        try {
            DB::beginTransaction();

            $seatIds = is_string($request->seat_ids) ? json_decode($request->seat_ids) : $request->seat_ids;

            $seats = Seat::whereIn('id', $seatIds)
                ->where('show_id', $request->show_id)
                ->where('is_available', true)
                ->lockForUpdate()
                ->get();

            if ($seats->count() !== count($seatIds)) {
                return back()->with('error', 'Some selected seats are no longer available.');
            }

            $confirmationCode = Reservation::generateConfirmationCode();

            foreach ($seats as $seat) {
                $seat->update(['is_available' => false]);
                Reservation::create([
                    'seat_id' => $seat->id,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'confirmation_code' => $confirmationCode,
                    'is_confirmed' => true,
                ]);
            }

            DB::commit();

            $reservation = Reservation::where('confirmation_code', $confirmationCode)->first();
            $show = Show::with('movie')->find($request->show_id);

            return view('reservations.confirmation', compact('reservation', 'show', 'seats'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your reservation.');
        }
    }

    public function show($confirmationCode)
    {
        $reservations = Reservation::where('confirmation_code', $confirmationCode)
            ->with(['seat.show.movie'])
            ->get();

        if ($reservations->isEmpty()) {
            abort(404);
        }

        $reservation = $reservations->first();
        $seats = $reservations->pluck('seat');
        $show = $seats->first()->show;

        return view('reservations.show', compact('reservation', 'seats', 'show'));
    }

    public function checkAvailability(Show $show)
    {
        $seats = $show->seats()
            ->orderBy('row')
            ->orderBy('number')
            ->get()
            ->map(function ($seat) {
                return [
                    'id' => $seat->id,
                    'row' => $seat->row,
                    'number' => $seat->number,
                    'is_available' => $seat->is_available,
                    'seat_label' => $seat->seat_label,
                ];
            });

        return response()->json([
            'available' => $seats->where('is_available', true)->count(),
            'reserved' => $seats->where('is_available', false)->count(),
            'seats' => $seats,
        ]);
    }
}
