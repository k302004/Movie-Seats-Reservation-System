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
                    </div>
                </div>
            </div>

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
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, .no-print { display: none !important; }
    .min-h-screen { background: white !important; padding: 20px !important; }
    body { background: white !important; color: #000 !important; }
    .bg-netflix-red, .bg-gray-800\/50, .bg-gray-700, .bg-gray-100, .bg-white, .bg-gray-200 { background: transparent !important; }
}
</style>
@endsection
