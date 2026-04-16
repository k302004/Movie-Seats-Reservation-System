<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Show;
use App\Models\Seat;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'totalMovies' => Movie::count(),
            'activeMovies' => Movie::where('is_active', true)->count(),
            'totalShows' => Show::count(),
            'totalReservations' => Reservation::count(),
            'totalRevenue' => Reservation::sum('seat_price') ?? 0,
        ];

        $recentReservations = Reservation::with(['seat.show.movie'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReservations'));
    }

    public function movies()
    {
        $movies = Movie::with('shows')->orderBy('created_at', 'desc')->get();
        return view('admin.movies.index', compact('movies'));
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    public function storeMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'nullable|url',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'genre' => $request->genre,
            'release_date' => $request->release_date,
            'rating' => $request->rating ?? 0,
            'poster' => $request->poster,
            'video_url' => $request->video_url,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.movies')->with('success', 'Movie created successfully!');
    }

    public function editMovie(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function updateMovie(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'genre' => 'required|string|max:100',
            'release_date' => 'required|date',
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'nullable|url',
            'video_url' => 'nullable|url',
            'is_active' => 'boolean',
        ]);

        $movie->update($request->only([
            'title', 'description', 'duration', 'genre', 
            'release_date', 'rating', 'poster', 'video_url', 'is_active'
        ]));

        return redirect()->route('admin.movies')->with('success', 'Movie updated successfully!');
    }

    public function destroyMovie(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies')->with('success', 'Movie deleted successfully!');
    }

    public function shows()
    {
        $shows = Show::with('movie')->orderBy('show_time', 'desc')->get();
        return view('admin.shows.index', compact('shows'));
    }

    public function createShow()
    {
        $movies = Movie::where('is_active', true)->get();
        return view('admin.shows.create', compact('movies'));
    }

    public function storeShow(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'screen_name' => 'required|string|max:100',
            'show_time' => 'required|date|after:now',
            'price' => 'required|numeric|min:0',
            'total_seats' => 'required|integer|min:1',
        ]);

        $show = Show::create([
            'movie_id' => $request->movie_id,
            'screen_name' => $request->screen_name,
            'show_time' => $request->show_time,
            'price' => $request->price,
            'total_seats' => $request->total_seats,
        ]);

        $rows = ['A', 'B', 'C', 'D', 'E'];
        $seatsPerRow = (int)($request->total_seats / count($rows));

        foreach ($rows as $row) {
            for ($num = 1; $num <= $seatsPerRow; $num++) {
                Seat::create([
                    'show_id' => $show->id,
                    'row' => $row,
                    'number' => $num,
                    'is_available' => true,
                    'price' => $request->price,
                ]);
            }
        }

        return redirect()->route('admin.shows')->with('success', 'Show created successfully with seats!');
    }

    public function destroyShow(Show $show)
    {
        $show->seats()->delete();
        $show->delete();
        return redirect()->route('admin.shows')->with('success', 'Show deleted successfully!');
    }

    public function reservations()
    {
        $reservations = Reservation::with(['seat.show.movie'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function showReservation($confirmationCode)
    {
        $reservations = Reservation::where('confirmation_code', $confirmationCode)
            ->with(['seat.show.movie'])
            ->get();

        if ($reservations->isEmpty()) {
            abort(404);
        }

        return view('admin.reservations.show', compact('reservations'));
    }

    public function destroyReservation(Reservation $reservation)
    {
        $reservation->seat->update(['is_available' => true]);
        $reservation->delete();
        return back()->with('success', 'Reservation cancelled successfully!');
    }
}
