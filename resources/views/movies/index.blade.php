@extends('layouts.app')

@section('content')
@if($movies->isNotEmpty())
@php $featured = $movies->first(); @endphp
<section class="relative h-[70vh] min-h-[500px]">
    @if($featured->poster)
        <div class="absolute inset-0">
            <img src="{{ $featured->poster }}" alt="{{ $featured->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#141414] via-[#141414]/80 to-transparent"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/50 via-gray-900 to-purple-900/50"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#141414] via-transparent to-transparent"></div>
    @endif
    <div class="relative z-20 h-full flex items-center">
        <div class="px-4 md:px-12 max-w-2xl">
            <div class="flex items-center space-x-3 mb-3">
                @if($featured->rating > 0)
                    <span class="bg-yellow-500 text-black px-2 py-1 rounded text-sm font-bold">
                        <i class="fas fa-star mr-1"></i>{{ $featured->rating }}
                    </span>
                @endif
                <span class="text-gray-300 text-sm">{{ $featured->genre }}</span>
                <span class="text-gray-300 text-sm">{{ $featured->duration }} min</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black mb-4 leading-tight">{{ $featured->title }}</h1>
            <p class="text-gray-300 text-lg mb-6 line-clamp-3">{{ $featured->description }}</p>
            <div class="flex space-x-4">
                <a href="{{ route('movies.show', $featured) }}"
                   class="bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-md font-semibold text-lg transition flex items-center">
                    <i class="fas fa-ticket-alt mr-2"></i> Book Tickets
                </a>
                @if($featured->video_url)
                    <a href="{{ route('movies.show', $featured) }}#trailer"
                       class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-6 py-3 rounded-md font-semibold transition flex items-center">
                        <i class="fas fa-play mr-2"></i> Watch Trailer
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

<section class="px-4 md:px-8 py-8 @if($movies->isNotEmpty()) -mt-32 relative z-20 @endif" id="movies">
    @if($movies->isEmpty())
        <div class="bg-gray-800/50 rounded-lg p-12 text-center">
            <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
            <p class="text-gray-400 text-xl">No movies available at the moment.</p>
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.movies.create') }}" class="inline-block mt-4 bg-netflix-red hover-netflix-red text-white px-6 py-3 rounded-md font-semibold transition">
                        Add Movie (Admin)
                    </a>
                @endif
            @endauth
        </div>
    @else
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-white mb-6">Now Playing</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($movies as $movie)
                    <a href="{{ route('movies.show', $movie) }}" class="group card-hover block">
                        <div class="relative aspect-[2/3] rounded-md overflow-hidden bg-gray-800 mb-3 shadow-lg">
                            @if($movie->poster)
                                <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-red-700 to-purple-900 flex items-center justify-center">
                                    <i class="fas fa-film text-4xl text-white/50"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <i class="fas fa-play-circle text-5xl text-white"></i>
                            </div>
                            @if($movie->rating > 0)
                                <div class="absolute bottom-2 left-2 bg-black/80 px-2 py-1 rounded text-xs font-semibold">
                                    <i class="fas fa-star text-yellow-400 mr-1"></i>{{ $movie->rating }}
                                </div>
                            @endif
                        </div>
                        <h3 class="text-white font-medium text-sm truncate group-hover:text-netflix-red transition">{{ $movie->title }}</h3>
                        <p class="text-gray-500 text-xs">{{ $movie->genre }} • {{ $movie->duration }} min</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</section>
@endsection
