<?php

namespace App\Http\Controllers;

use App\Models\Show;
use App\Models\Seat;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function selectSeats(Show $show)
    {
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
}
