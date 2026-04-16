@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white">Reservation Details</h1>
            <p class="text-gray-400 mt-1">View booking information</p>
        </div>
        <a href="{{ route('admin.reservations') }}" class="text-gray-400 hover:text-white transition flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back to Reservations
        </a>
    </div>

    @if($reservations->isEmpty())
        <div class="bg-gray-800/50 rounded-xl p-12 text-center border border-gray-700">
            <i class="fas fa-search text-6xl text-gray-600 mb-4"></i>
            <p class="text-gray-400 text-xl">Reservation not found.</p>
        </div>
    @else
        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700 mb-6">
            <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-700">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-netflix-red/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-ticket-alt text-3xl text-netflix-red"></i>
                    </div>
                    <div>
                        <div class="text-gray-400 text-sm">Confirmation Code</div>
                        <div class="text-3xl font-bold text-white font-mono">{{ $reservations->first()->confirmation_code }}</div>
                    </div>
                </div>
                <div>
                    @if($reservations->first()->is_confirmed)
                        <span class="bg-green-600/20 text-green-400 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i> Confirmed
                        </span>
                    @else
                        <span class="bg-yellow-600/20 text-yellow-400 px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-clock mr-1"></i> Pending
                        </span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gray-900/50 rounded-xl p-5">
                    <h3 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-user text-netflix-red mr-2"></i> Customer Information
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <div class="text-gray-500 text-sm">Name</div>
                            <div class="text-white font-semibold">{{ $reservations->first()->customer_name }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Email</div>
                            <div class="text-gray-300">{{ $reservations->first()->customer_email }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Phone</div>
                            <div class="text-gray-300">{{ $reservations->first()->customer_phone ?? 'Not provided' }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900/50 rounded-xl p-5">
                    <h3 class="text-white font-semibold mb-4 flex items-center">
                        <i class="fas fa-film text-netflix-red mr-2"></i> Show Details
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <div class="text-gray-500 text-sm">Movie</div>
                            <div class="text-white font-semibold text-lg">{{ $reservations->first()->seat->show->movie->title ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-500 text-sm">Screen</div>
                            <div class="text-gray-300">{{ $reservations->first()->seat->show->screen_name ?? 'N/A' }}</div>
                        </div>
                        <div class="flex gap-4">
                            <div>
                                <div class="text-gray-500 text-sm">Date</div>
                                <div class="text-gray-300">{{ $reservations->first()->seat->show->show_time->format('M d, Y') }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 text-sm">Time</div>
                                <div class="text-netflix-red font-semibold">{{ $reservations->first()->seat->show->show_time->format('h:i A') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-5 mb-6">
                <h3 class="text-white font-semibold mb-4 flex items-center">
                    <i class="fas fa-chair text-netflix-red mr-2"></i> Reserved Seats ({{ $reservations->count() }})
                </h3>
                <div class="flex flex-wrap gap-3">
                    @foreach($reservations as $reservation)
                        <span class="bg-netflix-red/20 border border-netflix-red text-netflix-red px-4 py-2 rounded-lg font-bold text-lg">
                            {{ $reservation->seat->seat_label ?? 'N/A' }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-900/50 rounded-xl p-5">
                <div class="flex justify-between items-center">
                    <div class="text-gray-400">Total Amount</div>
                    <div class="text-3xl font-bold text-green-400">
                        ${{ number_format($reservations->sum(function($r) { return $r->seat->price ?? 0; }), 2) }}
                    </div>
                </div>
                <div class="flex justify-between items-center mt-3 text-sm text-gray-500">
                    <span>Booked on</span>
                    <span>{{ $reservations->first()->created_at->format('M d, Y h:i A') }}</span>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-700 flex justify-between items-center">
                <a href="{{ route('admin.reservations') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
                <form action="{{ route('admin.reservations.destroy', $reservations->first()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Cancel this reservation? The seats will be released.')" 
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-times mr-2"></i> Cancel Reservation
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
