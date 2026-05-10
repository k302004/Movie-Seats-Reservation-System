@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Add New Show</h1>
        <p class="text-gray-400 mt-1">Create a new showtime for a movie</p>
    </div>

    @if($movies->isEmpty())
        <div class="bg-gray-800/50 rounded-xl p-12 text-center border border-gray-700">
            <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
            <p class="text-gray-400 text-xl">No active movies available. Please add a movie first.</p>
            <a href="{{ route('admin.movies.create') }}" class="inline-block mt-4 bg-netflix-red hover-netflix-red text-white px-6 py-3 rounded-lg font-semibold transition">
                <i class="fas fa-plus mr-2"></i> Add Movie
            </a>
        </div>
    @else
        @if($errors->any())
            <div class="bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-lg mb-6">
                @foreach($errors->all() as $error)
                    <p><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.shows.store') }}" method="POST" class="bg-gray-800/50 rounded-xl p-6 border border-gray-700 space-y-6">
            @csrf

            <div>
                <label for="movie_id" class="block text-gray-400 text-sm mb-2">Movie *</label>
                <select id="movie_id" name="movie_id" required
                        class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                    <option value="">Select Movie</option>
                    @foreach($movies as $movie)
                        <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }} ({{ $movie->duration }} min)
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="screen_name" class="block text-gray-400 text-sm mb-2">Screen *</label>
                    <select id="screen_name" name="screen_name" required
                            class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                        <option value="">Select Screen</option>
                        <option value="Screen 1" {{ old('screen_name') == 'Screen 1' ? 'selected' : '' }}>Screen 1</option>
                        <option value="Screen 2" {{ old('screen_name') == 'Screen 2' ? 'selected' : '' }}>Screen 2</option>
                        <option value="Screen 3" {{ old('screen_name') == 'Screen 3' ? 'selected' : '' }}>Screen 3</option>
                        <option value="Screen 4" {{ old('screen_name') == 'Screen 4' ? 'selected' : '' }}>Screen 4</option>
                        <option value="Screen 5" {{ old('screen_name') == 'Screen 5' ? 'selected' : '' }}>Screen 5</option>
                    </select>
                </div>

                <div>
                    <label for="show_time" class="block text-gray-400 text-sm mb-2">Date & Time *</label>
                    <input type="datetime-local" id="show_time" name="show_time" value="{{ old('show_time') }}" required
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-gray-400 text-sm mb-2">Ticket Price ($) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price', 12.99) }}" min="0" step="0.01" required
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>

                <div>
                    <label for="total_seats" class="block text-gray-400 text-sm mb-2">Total Seats *</label>
                    <input type="number" id="total_seats" name="total_seats" value="{{ old('total_seats', 50) }}" min="1" required
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
            </div>

            <div class="bg-gray-900/50 rounded-lg p-4">
                <p class="text-gray-400 text-sm">
                    <i class="fas fa-info-circle mr-2 text-netflix-red"></i>
                    Seats will be automatically generated in 5 rows (A-E)
                </p>
            </div>

            <div class="flex justify-end space-x-4 pt-4">
                <a href="{{ route('admin.shows') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Cancel
                </a>
                <button type="submit" class="bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-lg font-semibold transition flex items-center">
                    <i class="fas fa-save mr-2"></i> Create Show
                </button>
            </div>
        </form>
    @endif
</div>
@endsection
