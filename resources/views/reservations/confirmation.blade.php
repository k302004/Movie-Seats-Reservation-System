@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4" style="background: linear-gradient(135deg, #141414 0%, #1a1a2e 50%, #141414 100%);">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <i class="fas fa-check-circle text-6xl text-green-500"></i>
            </div>
            <h1 class="text-4xl font-bold text-green-500 mb-2">Booking Successful!</h1>
            <p class="text-gray-400">Your movie tickets have been reserved</p>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow-2xl">
            <div class="bg-netflix-red p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-film text-3xl text-white"></i>
                        <div>
                            <div class="text-white font-bold text-lg">STREAMFLIX</div>
                            <div class="text-white/70 text-sm">Movie Ticket</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-white/70 text-xs">Confirmation</div>
                        <div class="text-white font-bold font-mono text-lg">{{ $reservation->confirmation_code }}</div>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="flex-1">
                        <div class="text-gray-500 text-sm mb-1">Movie</div>
                        <div class="text-gray-900 font-bold text-xl">{{ $show->movie->title }}</div>
                        <div class="text-gray-500 text-sm mt-1">{{ $show->movie->genre }} • {{ $show->movie->duration }} min</div>
                    </div>
                    @if($show->movie->poster)
                        <div class="w-24 h-32 rounded-lg overflow-hidden shadow-md flex-shrink-0">
                            <img src="{{ $show->movie->poster }}" alt="{{ $show->movie->title }}" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>

                <div class="border-t border-b border-gray-200 py-4 my-4">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <div class="text-gray-500 text-xs uppercase">Date</div>
                            <div class="text-gray-900 font-semibold">{{ $show->show_time->format('M d, Y') }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs uppercase">Time</div>
                            <div class="text-netflix-red font-bold">{{ $show->show_time->format('h:i A') }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-xs uppercase">Screen</div>
                            <div class="text-gray-900 font-semibold">{{ $show->screen_name }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <div class="text-gray-500 text-xs uppercase mb-2">Seats ({{ $seats->count() }})</div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($seats as $seat)
                            <span class="bg-netflix-red text-white px-4 py-2 rounded-lg font-bold">
                                {{ $seat->seat_label }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Ticket Price × {{ $seats->count() }}</span>
                        <span class="text-gray-900">${{ number_format($show->price, 2) }} × {{ $seats->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="text-gray-900 font-bold">Total Paid</span>
                        <span class="text-green-600 font-bold text-2xl">${{ number_format($seats->sum('price'), 2) }}</span>
                    </div>
                </div>

                <div class="text-center">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <div class="text-gray-500 text-xs mb-2">Booked By</div>
                        <div class="text-gray-900 font-semibold">{{ $reservation->customer_name }}</div>
                        <div class="text-gray-500 text-sm">{{ $reservation->customer_email }}</div>
                        @if($reservation->customer_phone)
                            <div class="text-gray-500 text-sm">{{ $reservation->customer_phone }}</div>
                        @endif
                    </div>
                    <div class="text-xs text-gray-400">
                        Booked on {{ $reservation->created_at->format('M d, Y at h:i A') }}
                    </div>
                </div>
            </div>

            <div class="bg-gray-100 p-4 text-center">
                <div class="bg-white rounded-lg p-4 inline-block shadow-md">
                    <div class="text-gray-800 text-xs text-center mb-2 font-semibold">Scan at entrance</div>
                    <svg class="w-24 h-24 mx-auto" viewBox="0 0 100 100">
                        <rect x="10" y="10" width="20" height="20" fill="#000"></rect>
                        <rect x="35" y="10" width="5" height="5" fill="#000"></rect>
                        <rect x="45" y="10" width="10" height="5" fill="#000"></rect>
                        <rect x="60" y="10" width="30" height="5" fill="#000"></rect>
                        <rect x="10" y="35" width="5" height="10" fill="#000"></rect>
                        <rect x="20" y="35" width="5" height="5" fill="#000"></rect>
                        <rect x="30" y="35" width="5" height="10" fill="#000"></rect>
                        <rect x="40" y="35" width="15" height="5" fill="#000"></rect>
                        <rect x="60" y="35" width="10" height="10" fill="#000"></rect>
                        <rect x="75" y="35" width="15" height="5" fill="#000"></rect>
                        <rect x="10" y="50" width="5" height="20" fill="#000"></rect>
                        <rect x="20" y="50" width="20" height="5" fill="#000"></rect>
                        <rect x="20" y="60" width="5" height="10" fill="#000"></rect>
                        <rect x="30" y="55" width="10" height="5" fill="#000"></rect>
                        <rect x="45" y="50" width="5" height="20" fill="#000"></rect>
                        <rect x="55" y="55" width="5" height="15" fill="#000"></rect>
                        <rect x="65" y="50" width="25" height="5" fill="#000"></rect>
                        <rect x="75" y="60" width="15" height="5" fill="#000"></rect>
                        <rect x="10" y="75" width="30" height="5" fill="#000"></rect>
                        <rect x="45" y="75" width="15" height="5" fill="#000"></rect>
                        <rect x="65" y="70" width="5" height="10" fill="#000"></rect>
                        <rect x="75" y="75" width="10" height="5" fill="#000"></rect>
                    </svg>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <div class="bg-yellow-500/20 border border-yellow-500/30 rounded-lg p-4 mb-6 max-w-md mx-auto">
                <p class="text-yellow-400">
                    <i class="fas fa-bookmark mr-2"></i>
                    Save your confirmation code: <span class="font-bold font-mono text-lg">{{ $reservation->confirmation_code }}</span>
                </p>
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('movies.index') }}"
                   class="bg-netflix-red hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                    <i class="fas fa-film mr-2"></i> Book More Movies
                </a>
                <a href="{{ route('reservations.lookup') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                    <i class="fas fa-search mr-2"></i> Find My Tickets
                </a>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, .flex.flex-wrap { display: none !important; }
    .min-h-screen { background: white !important; padding: 20px !important; }
}
</style>
@endsection
