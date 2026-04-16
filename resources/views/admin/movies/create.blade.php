@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Add New Movie</h1>
        <p class="text-gray-400 mt-1">Fill in the details to add a new movie to your catalog</p>
    </div>

    @if($errors->any())
        <div class="bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-lg mb-6">
            @foreach($errors->all() as $error)
                <p><i class="fas fa-exclamation-circle mr-2"></i> {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('admin.movies.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-info-circle netflix-red mr-2"></i> Basic Information
            </h3>
            
            <div class="space-y-4">
                <div>
                    <label for="title" class="block text-gray-400 text-sm mb-2">Movie Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter movie title"
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                </div>

                <div>
                    <label for="description" class="block text-gray-400 text-sm mb-2">Description *</label>
                    <textarea id="description" name="description" rows="4" required placeholder="Enter movie description"
                              class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="genre" class="block text-gray-400 text-sm mb-2">Genre *</label>
                        <select id="genre" name="genre" required
                                class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                            <option value="">Select Genre</option>
                            <option value="Action" {{ old('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Adventure" {{ old('genre') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
                            <option value="Comedy" {{ old('genre') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                            <option value="Drama" {{ old('genre') == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Horror" {{ old('genre') == 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Sci-Fi" {{ old('genre') == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                            <option value="Thriller" {{ old('genre') == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                            <option value="Romance" {{ old('genre') == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Animation" {{ old('genre') == 'Animation' ? 'selected' : '' }}>Animation</option>
                        </select>
                    </div>

                    <div>
                        <label for="duration" class="block text-gray-400 text-sm mb-2">Duration (minutes) *</label>
                        <input type="number" id="duration" name="duration" value="{{ old('duration') }}" min="1" required placeholder="e.g., 120"
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="release_date" class="block text-gray-400 text-sm mb-2">Release Date *</label>
                        <input type="date" id="release_date" name="release_date" value="{{ old('release_date') }}" required
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                    </div>

                    <div>
                        <label for="rating" class="block text-gray-400 text-sm mb-2">Rating (0-10)</label>
                        <input type="number" id="rating" name="rating" value="{{ old('rating', 0) }}" min="0" max="10" step="0.1" placeholder="e.g., 8.5"
                               class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
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
                    <input type="url" id="poster" name="poster" value="{{ old('poster') }}" placeholder="https://example.com/poster.jpg"
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                    <p class="text-gray-500 text-xs mt-2">Enter a URL to the movie poster image (recommended size: 400x600)</p>
                </div>

                <div>
                    <label for="video_url" class="block text-gray-400 text-sm mb-2">Trailer Video URL</label>
                    <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}" placeholder="https://youtube.com/watch?v=..."
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red transition">
                    <p class="text-gray-500 text-xs mt-2">Enter a YouTube or video URL for the movie trailer/trailer</p>
                </div>
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                <i class="fas fa-toggle-on netflix-red mr-2"></i> Status
            </h3>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked
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
                <i class="fas fa-save mr-2"></i> Create Movie
            </button>
        </div>
    </form>
</div>
@endsection
