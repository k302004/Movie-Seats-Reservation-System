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
<<<<<<< HEAD
    public function index(Request $request)
    {
        if ($request->has('confirmation_code')) {
            $code = strtoupper(trim($request->confirmation_code));
            return redirect()->route('reservations.show', $code);
        }
=======
    public function index()
    {
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        return view('reservations.index');
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
=======
        Reservation::releaseExpiredCashierReservations();

>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        $request->validate([
            'show_id' => 'required|exists:shows,id',
            'seat_ids' => 'required|array|min:1',
            'seat_ids.*' => 'required|exists:seats,id',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:20',
<<<<<<< HEAD
            'payment_method' => 'required|in:cash,cashless',
=======
            'payment_method' => 'required|in:online,cashier',
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        ]);

        try {
            DB::beginTransaction();

            $seatIds = is_string($request->seat_ids) ? json_decode($request->seat_ids) : $request->seat_ids;
<<<<<<< HEAD

            $seats = Seat::whereIn('id', $seatIds)
                ->where('show_id', $request->show_id)
                ->where('is_available', true)
=======
            $tempReservation = $request->session()->get('temp_reservation');
            $paymentMethod = $request->payment_method;
            $paymentStatus = $paymentMethod === 'online' ? 'paid' : 'pending';
            $expiresAt = $paymentMethod === 'cashier' ? now()->addHours(12) : null;

            $seats = Seat::whereIn('id', $seatIds)
                ->where('show_id', $request->show_id)
                ->where(function ($query) use ($tempReservation) {
                    $query->where('is_available', true);

                    if ($tempReservation) {
                        $query->orWhere('temp_reservation_id', $tempReservation['id']);
                    }
                })
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                ->lockForUpdate()
                ->get();

            if ($seats->count() !== count($seatIds)) {
                return back()->with('error', 'Some selected seats are no longer available.');
            }

            $confirmationCode = Reservation::generateConfirmationCode();

            foreach ($seats as $seat) {
                $seat->update([
                    'is_available' => false,
                    'temp_reservation_id' => null
                ]);
<<<<<<< HEAD
                $paymentStatus = $request->payment_method === 'cashless' ? 'paid' : 'pending';
                $paymentDueAt = $request->payment_method === 'cash' ? now()->addDay() : null;

=======
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                Reservation::create([
                    'seat_id' => $seat->id,
                    'customer_name' => $request->customer_name,
                    'customer_email' => $request->customer_email,
                    'customer_phone' => $request->customer_phone,
                    'confirmation_code' => $confirmationCode,
<<<<<<< HEAD
                    'is_confirmed' => true,
                    'payment_method' => $request->payment_method,
                    'payment_status' => $paymentStatus,
                    'payment_due_at' => $paymentDueAt,
=======
                    'payment_method' => $paymentMethod,
                    'payment_status' => $paymentStatus,
                    'payment_expires_at' => $expiresAt,
                    'is_confirmed' => true,
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                ]);
            }

            DB::commit();

            $request->session()->forget('temp_reservation');

            $reservation = Reservation::where('confirmation_code', $confirmationCode)->first();
            $show = Show::with('movie')->find($request->show_id);

<<<<<<< HEAD
            session()->flash('booking_completed', true);

            return view('reservations.show', compact('reservation', 'show', 'seats'));
=======
            return view('reservations.confirmation', compact('reservation', 'show', 'seats'))->with('bookingCompleted', true);
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530

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
<<<<<<< HEAD
=======
        Reservation::releaseExpiredCashierReservations();

>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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
