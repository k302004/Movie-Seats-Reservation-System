@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4" style="background: linear-gradient(135deg, #141414 0%, #1a1a2e 50%, #141414 100%);">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-8">
<<<<<<< HEAD
            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-6xl text-green-500"></i>
            </div>
            <h1 class="text-4xl font-bold text-green-500 mb-2">Booking Successful!</h1>
            <p class="text-gray-400">Your movie tickets have been reserved</p>
        </div>

        <div class="bg-white rounded-xl overflow-hidden shadow-2xl receipt" id="receipt">
            <div class="bg-netflix-red p-4 no-print">
                <div class="flex items-center justify-between">
=======
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
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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

<<<<<<< HEAD
            <div class="p-6">
                <div class="text-center mb-6 print-only">
                    <div class="text-2xl font-bold text-gray-900">SKYFLIX</div>
                    <div class="text-gray-500">Movie Ticket Receipt</div>
                    <div class="text-gray-400 text-sm mt-1">Confirmation: {{ $reservation->confirmation_code }}</div>
                </div>

=======
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
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                <div class="flex flex-col md:flex-row gap-6 mb-6">
                    <div class="flex-1">
                        <div class="text-gray-500 text-sm mb-1">Movie</div>
                        <div class="text-gray-900 font-bold text-xl">{{ $show->movie->title }}</div>
<<<<<<< HEAD
                        <div class="text-gray-500 text-sm mt-1">{{ $show->movie->genre }} &bull; {{ $show->movie->duration }} min</div>
=======
                        <div class="text-gray-500 text-sm mt-1">{{ $show->movie->genre }} • {{ $show->movie->duration }} min</div>
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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

<<<<<<< HEAD
                <div class="border-t border-b border-gray-200 py-4 my-4">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-gray-600">Ticket Price &times; {{ $seats->count() }}</span>
                        <span class="text-gray-900">&#x20B1;{{ number_format($show->price, 2) }} &times; {{ $seats->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                        <span class="text-gray-900 font-bold">Total</span>
                        <span class="text-green-600 font-bold text-2xl">&#x20B1;{{ number_format($seats->sum('price'), 2) }}</span>
                    </div>
                </div>

                <div class="bg-gray-100 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            @if($reservation->payment_method === 'cashless')
                                <i class="fas fa-credit-card text-blue-500"></i>
                                <span class="text-gray-700 font-medium">Cashless (Online)</span>
                            @else
                                <i class="fas fa-money-bill-wave text-green-500"></i>
                                <span class="text-gray-700 font-medium">Cash (Pay at Counter)</span>
                            @endif
                        </div>
                        @if($reservation->payment_status === 'paid')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle mr-1"></i> Paid
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-clock mr-1"></i> Unpaid
                            </span>
                        @endif
                    </div>
                </div>

                @if($reservation->payment_method === 'cash' && $reservation->payment_due_at)
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-triangle text-red-500 mt-1"></i>
                        <div>
                            <p class="text-red-700 font-semibold text-sm">Payment Required Within 24 Hours</p>
                            <p class="text-red-600 text-xs mt-1">
                                Please pay at the cinema counter on or before 
                                <strong>{{ $reservation->payment_due_at->format('M d, Y h:i A') }}</strong>.
                                Unpaid reservations will be automatically cancelled after this deadline.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="text-center">
                    <div class="bg-gray-100 rounded-lg p-4 mb-4">
                        <div class="text-gray-500 text-xs mb-2">Booked By</div>
                        <div class="text-gray-900 font-semibold">{{ $reservation->customer_name }}</div>
                        <div class="text-gray-500 text-sm">{{ $reservation->customer_email }}</div>
                        @if($reservation->customer_phone)
                            <div class="text-gray-500 text-sm">{{ $reservation->customer_phone }}</div>
                        @endif
=======
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
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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

<<<<<<< HEAD
        <div class="mt-8 text-center no-print">
=======
        <div class="mt-8 text-center">
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
            <div class="bg-yellow-500/20 border border-yellow-500/30 rounded-lg p-4 mb-6 max-w-md mx-auto">
                <p class="text-yellow-400">
                    <i class="fas fa-bookmark mr-2"></i>
                    Save your confirmation code: <span class="font-bold font-mono text-lg">{{ $reservation->confirmation_code }}</span>
                </p>
            </div>
<<<<<<< HEAD
            <div class="flex flex-wrap justify-center gap-4">
                <button onclick="window.print()"
                        class="bg-netflix-red hover:bg-red-700 text-white px-8 py-4 rounded-lg font-bold transition shadow-lg text-lg">
                    <i class="fas fa-print mr-2"></i> Print Receipt
                </button>
                <a href="{{ route('movies.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
=======
            <div class="text-gray-400 mb-4">
                Redirecting to home in <span id="countdown" class="text-white font-bold">5</span> seconds...
            </div>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('movies.index') }}"
                   class="bg-netflix-red hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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

<<<<<<< HEAD
<style>
.print-only { display: none; }
@media print {
    @page { margin: 0.3in; }
    body { background: white !important; }
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    nav, footer { display: none !important; }
    .min-h-screen { background: white !important; padding: 0 !important; }
    .max-w-2xl { max-width: 100% !important; margin: 0 !important; }
    .bg-white { box-shadow: none !important; border: 2px solid #000 !important; }
    .bg-netflix-red { background: #000 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .bg-netflix-red * { color: #fff !important; }
    .bg-gray-100 { background: #f5f5f5 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .text-gray-900 { color: #000 !important; }
    .text-green-600 { color: #000 !important; }
    .text-netflix-red { color: #000 !important; }
    .bg-green-100 { background: #e8e8e8 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .text-green-700 { color: #000 !important; }
    .bg-yellow-100 { background: #e8e8e8 !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    .text-yellow-700 { color: #000 !important; }
    .bg-red-50 { background: #fff !important; border-color: #ccc !important; }
    .text-red-700 { color: #000 !important; }
    .text-red-600 { color: #333 !important; }
    .bg-netflix-red.text-white { background: #000 !important; }
    .shadow-2xl { box-shadow: none !important; }
    .rounded-xl { border-radius: 0 !important; }
    .receipt { max-width: 100% !important; }
}
</style>
@endsection
=======
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
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
