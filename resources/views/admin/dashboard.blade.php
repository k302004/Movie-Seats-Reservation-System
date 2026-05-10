@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-white">Dashboard</h1>
    <p class="text-gray-400 mt-1">Welcome back! Here's what's happening.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-gray-400 text-sm">Total Movies</div>
                <div class="text-3xl font-bold text-white mt-1">{{ $stats['totalMovies'] }}</div>
                <div class="text-green-400 text-sm mt-2"><i class="fas fa-film mr-1"></i> All movies</div>
            </div>
            <div class="w-14 h-14 bg-blue-600/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-film text-2xl text-blue-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-gray-400 text-sm">Active Movies</div>
                <div class="text-3xl font-bold text-green-400 mt-1">{{ $stats['activeMovies'] }}</div>
                <div class="text-green-400 text-sm mt-2"><i class="fas fa-check-circle mr-1"></i> Live now</div>
            </div>
            <div class="w-14 h-14 bg-green-600/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-circle text-2xl text-green-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-gray-400 text-sm">Total Shows</div>
                <div class="text-3xl font-bold text-white mt-1">{{ $stats['totalShows'] }}</div>
                <div class="text-gray-400 text-sm mt-2"><i class="fas fa-tv mr-1"></i> Showings</div>
            </div>
            <div class="w-14 h-14 bg-purple-600/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-tv text-2xl text-purple-500"></i>
            </div>
        </div>
    </div>

    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-gray-400 text-sm">Total Bookings</div>
                <div class="text-3xl font-bold netflix-red mt-1">{{ $stats['totalReservations'] }}</div>
                <div class="text-gray-400 text-sm mt-2"><i class="fas fa-ticket-alt mr-1"></i> Tickets sold</div>
            </div>
            <div class="w-14 h-14 bg-netflix-red/20 rounded-xl flex items-center justify-center">
                <i class="fas fa-ticket-alt text-2xl text-netflix-red"></i>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-clock netflix-red mr-3"></i> Recent Bookings
            </h2>
            <a href="{{ route('admin.reservations') }}" class="text-gray-400 hover:text-white text-sm transition">
                View All <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
        
        @if($recentReservations->isEmpty())
            <div class="text-center py-12">
                <i class="fas fa-ticket-alt text-5xl text-gray-700 mb-4"></i>
                <p class="text-gray-500">No bookings yet</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($recentReservations as $reservation)
                    <div class="flex items-center justify-between p-4 bg-gray-900/50 rounded-lg hover:bg-gray-700/50 transition">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-netflix-red/20 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user text-netflix-red"></i>
                            </div>
                            <div>
                                <div class="text-white font-semibold">{{ $reservation->customer_name }}</div>
                                <div class="text-gray-400 text-sm">
                                    {{ $reservation->seat->show->movie->title ?? 'N/A' }} • Seat {{ $reservation->seat->seat_label ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-netflix-red font-bold font-mono text-sm">{{ $reservation->confirmation_code }}</div>
                            <div class="text-gray-500 text-xs">{{ $reservation->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
        <h2 class="text-xl font-bold text-white mb-6 flex items-center">
            <i class="fas fa-bolt netflix-red mr-3"></i> Quick Actions
        </h2>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.movies.create') }}" class="bg-netflix-red hover-netflix-red text-white p-5 rounded-lg font-semibold transition flex flex-col items-center">
                <i class="fas fa-plus text-2xl mb-2"></i>
                Add Movie
            </a>
            <a href="{{ route('admin.shows.create') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-5 rounded-lg font-semibold transition flex flex-col items-center">
                <i class="fas fa-calendar-plus text-2xl mb-2"></i>
                Add Show
            </a>
            <a href="{{ route('admin.movies') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-5 rounded-lg font-semibold transition flex flex-col items-center">
                <i class="fas fa-film text-2xl mb-2"></i>
                Manage Movies
            </a>
            <a href="{{ route('admin.reservations') }}" class="bg-gray-700 hover:bg-gray-600 text-white p-5 rounded-lg font-semibold transition flex flex-col items-center">
                <i class="fas fa-list text-2xl mb-2"></i>
                View Bookings
            </a>
        </div>
    </div>
</div>
@endsection
