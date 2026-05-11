@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4" style="background: linear-gradient(135deg, #141414 0%, #1a1a2e 50%, #141414 100%);">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                <i class="fas fa-check-circle text-6xl text-green-500"></i>
            </div>
            <h1 class="text-4xl font-bold text-green-500 mb-2">Booking Successful!</h1>
            <p class="text-gray-400">Your movie tickets have been reserved and a receipt is ready.</p>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow-2xl">
            <div class="flex flex-wrap items-center justify-between gap-4 p-6 border-b border-gray-200 bg-gray-50">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Receipt</h2>
                    <p class="text-gray-500 text-sm mt-1">Print or save this receipt after completing payment.</p>
                </div>
                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-3 rounded-lg font-semibold transition">
                    <i class="fas fa-print mr-2"></i> Print Receipt
                </button>
            </div>
            <div class="bg-netflix-red p-4">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-film text-3xl text-white"></i>
                        <div>
                            <div class="text-white font-bold text-lg">SKYFLIX</div>
                            <div class="text-white/70 text-sm">Movie Ticket</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-white/70 text-xs">Confirmation</div>
                        <div class="text-white font-bold font-mono text-lg">{{ $reservation->confirmation_code }}</div>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-gray-50 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-[1.2fr_0.8fr] gap-6 items-center">
                    <div>
                        <div class="text-gray-500 text-xs uppercase tracking-wide mb-2">Receipt</div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Reservation Receipt</h2>
                        <p class="text-gray-600 text-sm">This receipt includes your booking details, QR code, and payment expiry information.</p>
                    </div>
                    <div class="rounded-3xl overflow-hidden bg-white border border-gray-200 p-3 w-full max-w-[220px] mx-auto">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode(route('reservations.show', $reservation->confirmation_code)) }}"
                             alt="Reservation QR code"
                             class="w-full h-full object-contain rounded-xl">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                    <div class="bg-white rounded-2xl p-4 border border-gray-200">
                        <div class="text-gray-500 text-xs uppercase mb-1">Payment Method</div>
                        <div class="text-gray-900 font-semibold">{{ $reservation->payment_method === 'online' ? 'Online Payment' : 'Pay at Counter' }}</div>
                        <div class="text-gray-500 text-xs mt-2">
                            {{ $reservation->payment_method === 'online' ? 'Payment complete.' : 'Pay at cashier within 12 hours.' }}
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl p-4 border border-gray-200">
                        <div class="text-gray-500 text-xs uppercase mb-1">Status</div>
                        <div class="text-gray-900 font-semibold">{{ $reservation->payment_method === 'online' ? 'Paid' : ($reservation->isExpired() ? 'Expired' : 'Pending Payment') }}</div>
                        @if($reservation->payment_method === 'cashier')
                            <div class="text-gray-500 text-xs mt-2">Expires</div>
                            <div class="text-gray-900 font-semibold">{{ optional($reservation->payment_expires_at)->format('M d, Y h:i A') }}</div>
                        @endif
                    </div>
                    <div class="bg-white rounded-2xl p-4 border border-gray-200">
                        <div class="text-gray-500 text-xs uppercase mb-1">Booked For</div>
                        <div class="text-gray-900 font-semibold">{{ $show->show_time->format('M d, Y') }}</div>
                        <div class="text-gray-500 text-xs mt-2">{{ $show->show_time->format('h:i A') }}</div>
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
                        <span class="text-gray-900">₱{{ number_format($show->price, 2) }} × {{ $seats->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="text-gray-900 font-bold">Total Paid</span>
                        <span class="text-green-600 font-bold text-2xl">₱{{ number_format($seats->sum('price'), 2) }}</span>
                    </div>
                </div>

                <div class="text-center">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <div class="text-gray-500 text-xs">Booked By</div>
                                <div class="text-gray-900 font-semibold">{{ $reservation->customer_name }}</div>
                                <div class="text-gray-500 text-sm">{{ $reservation->customer_email }}</div>
                                @if($reservation->customer_phone)
                                    <div class="text-gray-500 text-sm">{{ $reservation->customer_phone }}</div>
                                @endif
                            </div>
                            <div>
                                <div class="text-gray-500 text-xs">Payment Method</div>
                                <div class="text-gray-900 font-semibold">
                                    {{ $reservation->payment_method === 'online' ? 'Online Payment' : 'Pay at Counter' }}
                                </div>
                                <div class="text-gray-400 text-sm mt-2">
                                    {{ $reservation->payment_method === 'online' ? 'Print this receipt or save as PDF.' : 'Pay when you arrive at the cinema.' }}
                                </div>
                            </div>
                        </div>
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
            <div class="text-gray-400 mb-4">
                Redirecting to home in <span id="countdown" class="text-white font-bold">5</span> seconds...
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    let countdown = 5;
    const countdownEl = document.getElementById('countdown');
    
    const interval = setInterval(function() {
        countdown--;
        countdownEl.textContent = countdown;
        
        if (countdown <= 0) {
            clearInterval(interval);
            window.location.href = '{{ route("movies.index") }}';
        }
    }, 1000);
});
</script>

<style>
@media print {
    nav, footer, .no-print, .flex.flex-wrap { display: none !important; }
    .min-h-screen { background: white !important; padding: 20px !important; }
    body { background: white !important; color: #000 !important; }
    .bg-netflix-red, .bg-gray-100, .bg-yellow-500\/20, .bg-gray-200, .bg-gray-100 { background: transparent !important; }
}
</style>
@endsection
