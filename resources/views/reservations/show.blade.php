@extends('layouts.app')

@section('content')
<div class="min-h-screen py-12 px-4">
    <div class="max-w-2xl mx-auto">
<<<<<<< HEAD
        @if(session('booking_completed'))
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-check-circle text-6xl text-green-500"></i>
            </div>
            <h1 class="text-4xl font-bold text-green-500 mb-2">Booking Successful!</h1>
            <p class="text-gray-400">Your movie tickets have been reserved</p>
        </div>
        @endif

        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-6 md:p-8 border border-gray-700 receipt" id="receipt">
            <div class="text-center mb-6 print-only">
                <div class="text-2xl font-bold text-white">SKYFLIX</div>
                <div class="text-gray-400">Movie Ticket Receipt</div>
                <div class="text-gray-500 text-sm mt-1">Confirmation: {{ $reservation->confirmation_code }}</div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-6 border-b border-gray-700">
                <div>
                    <h3 class="text-2xl font-bold text-white mb-2">{{ $show->movie->title }}</h3>
                    <p class="text-gray-400"><i class="fas fa-tv mr-1"></i> {{ $show->screen_name }}</p>
                </div>
                <div class="mt-4 md:mt-0 text-right">
                    <div class="text-gray-400 text-sm">Confirmation Code</div>
                    <div class="text-netflix-red font-bold font-mono text-xl">{{ $reservation->confirmation_code }}</div>
                    <div class="text-gray-500 text-xs mt-1">
                        {{ $show->show_time->format('M d, Y') }} &bull; {{ $show->show_time->format('h:i A') }}
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
                    <div class="text-gray-500 text-sm">Name</div>
                    <div class="text-white font-semibold">{{ $reservation->customer_name }}</div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Email</div>
                    <div class="text-white font-semibold">{{ $reservation->customer_email }}</div>
                </div>
                @if($reservation->customer_phone)
                <div>
                    <div class="text-gray-500 text-sm">Phone</div>
                    <div class="text-white font-semibold">{{ $reservation->customer_phone }}</div>
                </div>
                @endif
                <div>
                    <div class="text-gray-500 text-sm">Status</div>
                    <div class="text-green-400 font-semibold">
                        {{ $reservation->is_confirmed ? 'Confirmed' : 'Pending' }}
                    </div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Payment</div>
                    <div class="text-white font-semibold">
                        @if($reservation->payment_method === 'cashless')
                            <span class="text-blue-400"><i class="fas fa-credit-card mr-1"></i> Cashless</span>
                        @else
                            <span class="text-green-400"><i class="fas fa-money-bill-wave mr-1"></i> Cash</span>
                        @endif
                        @if($reservation->payment_status === 'paid')
                            <span class="text-green-400 ml-1">&bull; Paid</span>
                        @else
                            <span class="text-yellow-400 ml-1">&bull; Unpaid</span>
                        @endif
                    </div>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Total</div>
                    <div class="text-green-400 font-bold text-xl">&#x20B1;{{ number_format($seats->sum('price'), 2) }}</div>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 mb-6">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-gray-500 text-xs uppercase">Date</div>
                        <div class="text-white font-semibold">{{ $show->show_time->format('M d, Y') }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-xs uppercase">Time</div>
                        <div class="text-netflix-red font-bold">{{ $show->show_time->format('h:i A') }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-xs uppercase">Screen</div>
                        <div class="text-white font-semibold">{{ $show->screen_name }}</div>
=======
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
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6 pb-6 border-b border-gray-700">
                    <div>
                        <h3 class="text-2xl font-bold text-white mb-2">Receipt</h3>
                        <p class="text-gray-400 text-sm">Print this page or save as PDF for your ticket.</p>
                    </div>
                    <button type="button" onclick="window.print()" class="bg-blue-600 hover:bg-blue-500 text-white px-5 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-print mr-2"></i> Print Receipt
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="rounded-2xl bg-gray-900 p-4 border border-gray-700">
                        <div class="text-gray-500 text-xs uppercase mb-1">Payment Method</div>
                        <div class="text-white font-semibold">{{ $reservation->payment_method === 'online' ? 'Online Payment' : 'Pay at Counter' }}</div>
                        <div class="text-gray-400 text-sm mt-2">{{ $reservation->payment_method === 'online' ? 'Payment complete.' : 'Pay at cashier within 12 hours.' }}</div>
                    </div>
                    <div class="rounded-2xl bg-gray-900 p-4 border border-gray-700">
                        <div class="text-gray-500 text-xs uppercase mb-1">Status</div>
                        <div class="text-white font-semibold">{{ $reservation->payment_method === 'online' ? 'Paid' : ($reservation->isExpired() ? 'Expired' : 'Pending Payment') }}</div>
                        @if($reservation->payment_method === 'cashier')
                            <div class="text-gray-500 text-xs mt-3 uppercase">Expires</div>
                            <div class="text-white font-semibold">{{ optional($reservation->payment_expires_at)->format('M d, Y h:i A') }}</div>
                        @endif
                    </div>
                    <div class="rounded-2xl bg-gray-900 p-4 border border-gray-700 flex items-center justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ urlencode(route('reservations.show', $reservation->confirmation_code)) }}"
                             alt="Reservation QR code"
                             class="w-full h-full object-contain rounded-xl">
                    </div>
                </div>
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
                        <div class="text-gray-500 text-sm">Name</div>
                        <div class="text-white font-semibold">{{ $reservation->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Email</div>
                        <div class="text-white font-semibold">{{ $reservation->customer_email }}</div>
                    </div>
                    @if($reservation->customer_phone)
                    <div>
                        <div class="text-gray-500 text-sm">Phone</div>
                        <div class="text-white font-semibold">{{ $reservation->customer_phone }}</div>
                    </div>
                    @endif
                    <div>
                        <div class="text-gray-500 text-sm">Payment</div>
                        <div class="text-white font-semibold">
                            {{ $reservation->payment_method === 'online' ? 'Online Payment' : 'Pay at Counter' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Status</div>
                        <div class="text-green-400 font-semibold">
                            {{ $reservation->is_confirmed ? 'Confirmed' : 'Pending' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-500 text-sm">Total</div>
                        <div class="text-green-400 font-bold text-xl">₱{{ number_format($seats->sum('price'), 2) }}</div>
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            @if($reservation->payment_method === 'cash' && $reservation->payment_due_at)
            <div class="bg-red-900/20 border border-red-500/30 rounded-lg p-4 mb-6">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-triangle text-red-400 mt-1"></i>
                    <div>
                        <p class="text-red-300 font-semibold text-sm">Payment Required Within 24 Hours</p>
                        <p class="text-red-400 text-xs mt-1">
                            Please pay at the cinema counter on or before 
                            <strong>{{ $reservation->payment_due_at->format('M d, Y h:i A') }}</strong>.
                            Unpaid reservations will be automatically cancelled after this deadline.
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="flex justify-center pt-6 border-t border-gray-700">
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

            <div class="text-xs text-gray-500 text-center mt-4">
                Booked on {{ $reservation->created_at->format('M d, Y at h:i A') }}
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mt-8 no-print">
            <button onclick="window.print()"
                    class="bg-netflix-red hover:bg-red-700 text-white px-8 py-4 rounded-lg font-bold transition shadow-lg text-lg">
                <i class="fas fa-print mr-2"></i> Print Receipt
            </button>
            <a href="{{ route('movies.index') }}"
               class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                <i class="fas fa-film mr-2"></i> Book More Movies
            </a>
            @if(!session('booking_completed'))
            <a href="{{ route('reservations.lookup') }}"
               class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition shadow-lg">
                <i class="fas fa-search mr-2"></i> Look Up Another Ticket
            </a>
            @endif
=======
            <div class="text-center mb-6 no-print">
                <button type="button" onclick="window.print()"
                   class="inline-block bg-blue-600 hover:bg-blue-500 text-white px-8 py-3 rounded-lg font-bold transition mr-4 mb-4">
                    <i class="fas fa-print mr-2"></i> Print Receipt
                </button>
                <a href="{{ route('movies.index') }}"
                   class="inline-block bg-netflix-red hover-netflix-red text-white px-8 py-3 rounded-lg font-bold transition mb-4">
                    <i class="fas fa-film mr-2"></i> Back to Movies
                </a>
            </div>
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
        </div>
    </div>
</div>

<style>
<<<<<<< HEAD
.print-only { display: none; }
@media print {
    @page { margin: 0.3in; }
    body { background: #141414 !important; }
    .no-print { display: none !important; }
    .print-only { display: block !important; }
    nav, footer { display: none !important; }
    .min-h-screen { background: #141414 !important; padding: 0 !important; }
    .max-w-2xl { max-width: 100% !important; margin: 0 !important; }
    .bg-gray-800\/50 { background: white !important; border: 2px solid #000 !important; }
    .bg-netflix-red\/20 { background: #000 !important; }
    .text-white { color: #000 !important; }
    .text-gray-400 { color: #555 !important; }
    .text-gray-500 { color: #666 !important; }
    .text-netflix-red { color: #000 !important; }
    .text-green-400 { color: #000 !important; }
    .text-blue-400 { color: #000 !important; }
    .text-yellow-400 { color: #666 !important; }
    .text-red-300 { color: #000 !important; }
    .text-red-400 { color: #333 !important; }
    .border-gray-700 { border-color: #ccc !important; }
    .bg-red-900\/20 { background: #fff !important; border-color: #ccc !important; }
    .backdrop-blur-sm { backdrop-filter: none !important; }
    .shadow-lg { box-shadow: none !important; }
    .shadow-2xl { box-shadow: none !important; }
    .rounded-xl { border-radius: 0 !important; }
}
</style>
@endsection
=======
@media print {
    nav, footer, .no-print { display: none !important; }
    .min-h-screen { background: white !important; padding: 20px !important; }
    body { background: white !important; color: #000 !important; }
    .bg-netflix-red, .bg-gray-800\/50, .bg-gray-700, .bg-gray-100, .bg-white, .bg-gray-200 { background: transparent !important; }
}
</style>
@endsection
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
