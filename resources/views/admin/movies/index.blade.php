@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white">Movies</h1>
        <p class="text-gray-400 mt-1">Manage your movie catalog</p>
    </div>
    <a href="{{ route('admin.movies.create') }}" class="bg-netflix-red hover-netflix-red text-white px-6 py-3 rounded-lg font-semibold transition flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Movie
    </a>
</div>

@if($movies->isEmpty())
    <div class="bg-gray-800/50 rounded-xl p-12 text-center border border-gray-700">
        <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-xl">No movies found. Add your first movie!</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($movies as $movie)
            <div class="bg-gray-800/50 rounded-xl overflow-hidden border border-gray-700 hover:border-gray-600 transition group">
                <div class="relative aspect-[2/3] bg-gray-900">
                    @if($movie->poster)
                        <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <i class="fas fa-film text-5xl text-gray-600"></i>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3 flex flex-col gap-2">
                        @if($movie->is_active)
                            <span class="bg-green-600 text-white text-xs px-2 py-1 rounded font-semibold">Active</span>
                        @else
                            <span class="bg-red-600 text-white text-xs px-2 py-1 rounded font-semibold">Inactive</span>
                        @endif
                    </div>
                    @if($movie->rating > 0)
                        <div class="absolute bottom-3 left-3 bg-black/80 text-yellow-400 text-sm px-2 py-1 rounded font-semibold">
                            <i class="fas fa-star mr-1"></i>{{ $movie->rating }}
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-white font-bold text-lg truncate">{{ $movie->title }}</h3>
                    <div class="flex items-center gap-3 text-gray-400 text-sm mt-2">
                        <span><i class="fas fa-tag mr-1"></i> {{ $movie->genre }}</span>
                        <span><i class="fas fa-clock mr-1"></i> {{ $movie->duration }}m</span>
                    </div>
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-700">
                        <span class="text-gray-500 text-sm">{{ $movie->shows->count() }} shows</span>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.movies.edit', $movie) }}" class="text-gray-400 hover:text-white p-2 hover:bg-gray-700 rounded transition">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure? This will delete all associated shows and reservations.')" class="text-gray-400 hover:text-red-500 p-2 hover:bg-gray-700 rounded transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
