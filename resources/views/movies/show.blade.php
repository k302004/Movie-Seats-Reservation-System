@extends('layouts.app')

@section('content')
<section class="relative h-[60vh] min-h-[450px]">
    @if($movie->poster)
        <div class="absolute inset-0">
            <img src="{{ $movie->poster }}" alt="{{ $movie->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-[#141414] via-[#141414]/80 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-[#141414] via-transparent to-transparent"></div>
        </div>
    @else
        <div class="absolute inset-0 bg-gradient-to-br from-red-900/40 via-gray-900 to-purple-900/40"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#141414] via-transparent to-transparent"></div>
    @endif
    <div class="relative z-20 h-full flex items-center">
        <div class="px-4 md:px-12 max-w-4xl">
            <div class="flex items-center space-x-3 mb-4">
                @if($movie->rating > 0)
                    <span class="bg-yellow-500 text-black px-2 py-1 rounded text-sm font-bold">
                        <i class="fas fa-star mr-1"></i>{{ $movie->rating }}/10
                    </span>
                @endif
                <span class="text-gray-300">{{ $movie->genre }}</span>
                <span class="text-gray-300">{{ $movie->duration }} min</span>
                <span class="bg-gray-700 text-gray-300 px-2 py-1 rounded text-xs">HD</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-black mb-4">{{ $movie->title }}</h1>
            <p class="text-gray-300 text-lg mb-6 max-w-2xl">{{ $movie->description }}</p>
            <div class="flex flex-wrap gap-3 mb-6">
                <span class="bg-gray-800/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-calendar mr-1"></i> {{ $movie->release_date?->format('M d, Y') }}
                </span>
                <span class="bg-gray-800/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-film mr-1"></i> {{ $movie->genre }}
                </span>
                <span class="bg-gray-800/80 text-gray-300 px-3 py-1 rounded-full text-sm">
                    <i class="fas fa-clock mr-1"></i> {{ $movie->duration }} min
                </span>
            </div>
            <div class="flex space-x-4">
                <a href="#showtimes"
                   class="bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-md font-semibold text-lg transition flex items-center">
                    <i class="fas fa-ticket-alt mr-2"></i> Book Now
                </a>
                @if($movie->video_url)
                    <a href="#trailer"
                       class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-6 py-3 rounded-md font-semibold transition">
                        <i class="fas fa-play mr-2"></i> Watch Trailer
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

@if($movie->video_url)
<section class="px-4 md:px-12 py-8 bg-black" id="trailer">
    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
        <i class="fas fa-play-circle netflix-red mr-3"></i> Trailer
    </h2>
    <div class="max-w-4xl mx-auto">
        @php
            $videoId = null;
            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $movie->video_url, $match)) {
                $videoId = $match[1];
            }
        @endphp
        @if($videoId)
            <div class="aspect-video rounded-lg overflow-hidden shadow-2xl">
                <iframe 
                    class="w-full h-full"
                    src="https://www.youtube.com/embed/{{ $videoId }}"
                    title="Movie Trailer"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>
        @else
            <div class="bg-gray-800 rounded-lg p-8 text-center">
                <a href="{{ $movie->video_url }}" target="_blank" class="text-netflix-red hover:underline">
                    <i class="fas fa-external-link-alt mr-2"></i> Watch Trailer
                </a>
            </div>
        @endif
    </div>
</section>
@endif

<section class="px-4 md:px-12 py-8" id="showtimes">
    <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
        <i class="fas fa-calendar-alt netflix-red mr-3"></i> Available Showtimes
    </h2>

    @if($movie->shows->isEmpty())
        <div class="bg-gray-800/50 rounded-lg p-12 text-center border border-gray-700">
            <i class="fas fa-calendar-times text-5xl text-gray-600 mb-4"></i>
            <p class="text-gray-400 text-xl">No showtimes available for this movie.</p>
            <p class="text-gray-500 mt-2">Check back soon for new showtimes!</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($movie->shows as $show)
                <div class="bg-gray-800/60 hover:bg-gray-800 rounded-lg p-6 transition border border-gray-700 hover:border-gray-600">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-14 h-14 bg-netflix-red/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-film text-2xl text-netflix-red"></i>
                            </div>
                            <div>
                                <h3 class="text-white font-bold">{{ $show->screen_name }}</h3>
                                <p class="text-gray-400 text-sm">{{ $show->show_time->format('l') }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-2xl font-bold text-white">${{ number_format($show->price, 2) }}</div>
                            <div class="text-gray-500 text-xs">per ticket</div>
                        </div>
                    </div>
                    
                    <div class="bg-gray-900/50 rounded-lg p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-gray-400 text-sm">Date</div>
                                <div class="text-white font-semibold">{{ $show->show_time->format('M d, Y') }}</div>
                            </div>
                            <div class="text-center px-4">
                                <div class="text-3xl font-black text-netflix-red">{{ $show->show_time->format('h:i') }}</div>
                                <div class="text-gray-400 text-sm">{{ $show->show_time->format('A') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-400">Availability</span>
                            @php
                                $available = $show->seats()->where('is_available', true)->count();
                                $total = $show->total_seats;
                            @endphp
                            <span class="{{ $available > 20 ? 'text-green-400' : ($available > 5 ? 'text-yellow-400' : 'text-red-400') }}">
                                {{ $available }} seats left
                            </span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            @php $percentage = $total > 0 ? ($available / $total) * 100 : 0; @endphp
                            <div class="h-2 rounded-full {{ $percentage > 40 ? 'bg-green-500' : ($percentage > 10 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ $percentage }}%"></div>
                        </div>
                    </div>

                    <a href="{{ route('shows.seats', $show) }}"
                       class="block w-full bg-netflix-red hover-netflix-red text-white text-center py-3 rounded-md font-semibold transition {{ $available == 0 ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}">
                        @if($available > 0)
                            <i class="fas fa-chair mr-2"></i> Select Seats
                        @else
                            <i class="fas fa-ban mr-2"></i> Sold Out
                        @endif
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
