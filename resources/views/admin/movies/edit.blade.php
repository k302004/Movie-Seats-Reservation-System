@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Edit Movie</h1>
        <p class="text-gray-400 mt-1">Update the movie details</p>
    </div>

    @if($errors->any())
        <div class="bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-lg mb-6">
            @foreach($errors->all() as $error)
                <p><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.movies.update', $movie) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-info-circle netflix-red mr-2"></i> Basic Information
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-gray-400 text-sm mb-2">Movie Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" required
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>

                <div>
                    <label for="description" class="block text-gray-400 text-sm mb-2">Description *</label>
                    <textarea id="description" name="description" rows="4" required
                              class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">{{ old('description', $movie->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="genre" class="block text-gray-400 text-sm mb-2">Genre *</label>
                        <select id="genre" name="genre" required
                                class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                            <option value="Action" {{ $movie->genre == 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Adventure" {{ $movie->genre == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                            <option value="Comedy" {{ $movie->genre == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                            <option value="Drama" {{ $movie->genre == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Horror" {{ $movie->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Sci-Fi" {{ $movie->genre == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                            <option value="Thriller" {{ $movie->genre == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                            <option value="Romance" {{ $movie->genre == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Animation" {{ $movie->genre == 'Animation' ? 'selected' : '' }}>Animation</option>
                        </select>
                    </div>

                    <div>
                        <label for="duration" class="block text-gray-400 text-sm mb-2">Duration (minutes) *</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" min="1" required
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="release_date" class="block text-gray-400 text-sm mb-2">Release Date *</label>
                        <input type="date" id="release_date" name="release_date" value="{{ old('release_date', $movie->release_date->format('Y-m-d')) }}" required
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                    </div>

                    <div>
                        <label for="rating" class="block text-gray-400 text-sm mb-2">Rating (0-10)</label>
                        <input type="number" id="rating" name="rating" value="{{ old('rating', $movie->rating) }}" min="0" max="10" step="0.1"
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-image netflix-red mr-2"></i> Media
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label for="poster" class="block text-gray-400 text-sm mb-2">Poster Image URL</label>
                    <input type="url" id="poster" name="poster" value="{{ old('poster', $movie->poster) }}" placeholder="https://example.com/poster.jpg"
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                    @if($movie->poster)
                        <div class="mt-3">
                            <img src="{{ $movie->poster }}" alt="Current poster" class="h-24 rounded-lg object-cover">
                            <p class="text-gray-500 text-xs mt-1">Current poster</p>
                        </div>
                    @endif
                </div>

                <div>
                    <label for="video_url" class="block text-gray-400 text-sm mb-2">Trailer Video URL</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $movie->video_url ?? '') }}" placeholder="https://youtube.com/watch?v=..."
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                </div>
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-toggle-on netflix-red mr-2"></i> Status
            </h3>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ $movie->is_active ? 'checked' : '' }}
                       class="w-5 h-5 mr-3 bg-gray-900 border-gray-700 rounded text-netflix-red focus:ring-netflix-red">
                <span class="text-white">Active</span>
                <span class="text-gray-500 text-sm ml-2">(Visible to users)</span>
            </label>
        </div>

        <div class="flex justify-end space-x-4 pt-4">
            <a href="{{ route('admin.movies') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-lg font-semibold transition flex items-center">
                <i class="fas fa-save mr-2"></i> Update Movie
            </button>
        </div>
    </form>
</div>
@endsection
