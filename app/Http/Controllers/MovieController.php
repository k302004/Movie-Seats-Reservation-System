<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['shows' => function($query) {
            $query->where('show_time', '>', now());
        }])->active()->get();
        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $movie->load(['shows' => function($query) {
            $query->where('show_time', '>', now())->orderBy('show_time');
        }]);
        return view('movies.show', compact('movie'));
    }
}
