@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-gray-700">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-netflix-red/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ticket-alt text-4xl text-netflix-red"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Your Movie Ticket</h1>
                <p class="text-gray-400">
                    Confirmation Code: <span class="text-netflix-red font-bold font-mono">{{ $reservation->confirmation_code }}</span>
                </p>
            </div>

            <div class="border-2 border-gray-600 rounded-xl p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-6 border-b border-gray-700">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">{{ $show->movie->title }}</h3>
                        <p class="text-gray-400"><i class="fas fa-tv mr-1"></i> {{ $show->screen_name }}</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="text-gray-400 text-sm">Date & Time</div>
                        <div class="text-white font-semibold">
                            {{ $show->show_time->format('M d, Y') }}
                        </div>
                        <div class="text-netflix-red font-semibold">
                            {{ $show->show_time->format('h:i A') }}
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
                    <div>
                        <div class="text-gray-500 text-sm">Seats</div>
                        <div class="text-white font-bold text-xl">
                            @foreach($seats as $seat)
                                <span class="inline-block mr-1 bg-netflix-red/20 text-netflix-red px-2 py-1 rounded text-sm">{{ $seat->seat_label }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Customer</div>
                        <div class="text-white font-semibold">{{ $reservation->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Status</div>
                        <div class="text-green-400 font-semibold">
                            {{ $reservation->is_confirmed ? 'Confirmed' : 'Pending' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Total</div>
                        <div class="text-green-400 font-bold text-xl">${{ number_format($seats->sum('price'), 2) }}</div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-gray-800 text-sm text-center mb-2 font-semibold">Scan at entrance</div>
                        <svg class="w-32 h-32" viewBox="0 0 100 100">
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

            <div class="text-center">
                <a href="{{ route('movies.index') }}"
                   class="inline-block bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-lg font-bold transition">
                    <i class="fas fa-film mr-2"></i> Back to Movies
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
