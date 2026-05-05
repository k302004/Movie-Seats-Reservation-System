@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#141414]" id="checkoutPage">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-6">
            <a href="{{ route('shows.seats', $show) }}" class="text-gray-400 hover:text-white transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Seats</span>
            </a>
        </div>

        <div class="bg-gray-800/50 rounded-xl border border-gray-700 overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-700">
                <h1 class="text-2xl font-bold text-white">Confirm Your Booking</h1>
                <p class="text-gray-400 mt-1">Please review your booking details before proceeding to payment</p>
            </div>

            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        @if($show->movie->poster)
                        <img src="{{ $show->movie->poster }}" alt="{{ $show->movie->title }}" class="w-32 h-48 object-cover rounded-lg">
                        @else
                        <div class="w-32 h-48 bg-gray-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-film text-4xl text-gray-500"></i>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-white mb-3">{{ $show->movie->title }}</h2>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Screen:</span>
                                <span class="text-white ml-2">{{ $show->screen_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Date:</span>
                                <span class="text-white ml-2">{{ $show->show_time->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Time:</span>
                                <span class="text-white ml-2">{{ $show->show_time->format('h:i A') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Duration:</span>
                                <span class="text-white ml-2">{{ $show->movie->duration }} mins</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-700">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-chair netflix-red mr-3"></i> Selected Seats
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 mb-6">
                    @foreach($seats as $seat)
                    <div class="bg-gray-900/50 rounded-lg p-3 text-center border border-gray-700">
                        <div class="text-lg font-bold text-white">{{ $seat->seat_label }}</div>
                        <div class="text-green-500 font-semibold">₱{{ number_format($seat->price, 2) }}</div>
                    </div>
                    @endforeach
                </div>

                <div class="bg-gray-900/50 rounded-lg p-4 border border-gray-700">
                    <div class="flex justify-between items-center text-lg">
                        <span class="text-gray-300">Total ({{ count($seats) }} seat{{ count($seats) > 1 ? 's' : '' }})</span>
                        <span class="text-3xl font-bold text-green-500">₱{{ number_format($totalPrice, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="p-6 border-t border-gray-700">
                <h3 class="text-lg font-bold text-white mb-4 flex items-center">
                    <i class="fas fa-user netflix-red mr-3"></i> Customer Information
                </h3>
                <form id="checkoutForm" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="show_id" value="{{ $show->id }}">
                    <input type="hidden" name="seat_ids" value="{{ json_encode($seats->pluck('id')->toArray()) }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="customer_name" class="block text-gray-400 text-sm mb-2">Full Name *</label>
                            <input type="text" id="customer_name" name="customer_name" required placeholder="Enter your full name"
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                        </div>
                        <div>
                            <label for="customer_email" class="block text-gray-400 text-sm mb-2">Email Address *</label>
                            <input type="email" id="customer_email" name="customer_email" required placeholder="your@email.com"
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="customer_phone" class="block text-gray-400 text-sm mb-2">Phone Number (Optional)</label>
                        <input type="tel" id="customer_phone" name="customer_phone" placeholder="+63XXXXXXXXXX"
                               class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                    </div>

                    <div class="bg-blue-900/20 border border-blue-600/50 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-400 mt-1"></i>
                            <div class="text-sm text-blue-300">
                                <p class="font-semibold mb-1">Payment on Arrival</p>
                                <p>You will pay at the cinema counter when you arrive. A confirmation receipt will be sent to your email.</p>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-500 text-white py-4 rounded-md font-bold text-lg transition flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>Confirm Booking - Pay at Counter</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkoutForm = document.getElementById('checkoutForm');
    const backLink = document.querySelector('a[href*="shows.seats"]');
    
    function releaseSeats() {
        fetch('{{ route("shows.releaseSeats") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        });
    }

    checkoutForm.addEventListener('submit', function() {
        sessionStorage.setItem('bookingCompleted', 'true');
    });

    window.addEventListener('beforeunload', function(e) {
        if (!sessionStorage.getItem('bookingCompleted')) {
            releaseSeats();
        }
    });

    if (backLink) {
        backLink.addEventListener('click', function() {
            if (!sessionStorage.getItem('bookingCompleted')) {
                releaseSeats();
            }
        });
    }
});
</script>
@endpush
@endsection