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
<<<<<<< HEAD
                @if($errors->any())
                <div class="bg-red-900/30 border border-red-500/50 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-exclamation-circle text-red-400 mt-1"></i>
                        <div>
                            <p class="text-red-300 font-semibold text-sm">Please fix the following errors:</p>
                            <ul class="text-red-400 text-xs mt-1 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <form id="checkoutForm" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="show_id" value="{{ $show->id }}">
                    @foreach($seats->pluck('id') as $seatId)
                        <input type="hidden" name="seat_ids[]" value="{{ $seatId }}">
                    @endforeach
=======
                <form id="checkoutForm" action="{{ route('reservations.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="show_id" value="{{ $show->id }}">
                    <input type="hidden" name="seat_ids" value="{{ json_encode($seats->pluck('id')->toArray()) }}">
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="customer_name" class="block text-gray-400 text-sm mb-2">Full Name *</label>
                            <input type="text" id="customer_name" name="customer_name" required placeholder="Enter your full name"
<<<<<<< HEAD
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition @error('customer_name') border-red-500 @enderror">
                            @error('customer_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
=======
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                        </div>
                        <div>
                            <label for="customer_email" class="block text-gray-400 text-sm mb-2">Email Address *</label>
                            <input type="email" id="customer_email" name="customer_email" required placeholder="your@email.com"
<<<<<<< HEAD
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition @error('customer_email') border-red-500 @enderror">
                            @error('customer_email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
=======
                                   class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="customer_phone" class="block text-gray-400 text-sm mb-2">Phone Number (Optional)</label>
                        <input type="tel" id="customer_phone" name="customer_phone" placeholder="+63XXXXXXXXXX"
                               class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                    </div>

                    <div class="mb-6">
<<<<<<< HEAD
                        <label class="block text-gray-400 text-sm mb-3">Payment Method *</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <label class="payment-option cursor-pointer">
                                <input type="radio" name="payment_method" value="cash" checked class="hidden peer">
                                <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 peer-checked:border-green-500 peer-checked:bg-green-900/20 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-green-500/20 flex items-center justify-center">
                                            <i class="fas fa-money-bill-wave text-green-400"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-semibold">Cash (Counter)</div>
                                            <div class="text-gray-400 text-xs">Pay at the cinema counter</div>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-yellow-400 payment-hint-cash">
                                        <i class="fas fa-info-circle mr-1"></i> Payment at counter — receipt shows as <strong>unpaid</strong>
                                    </div>
                                </div>
                            </label>
                            <label class="payment-option cursor-pointer">
                                <input type="radio" name="payment_method" value="cashless" class="hidden peer">
                                <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 peer-checked:border-green-500 peer-checked:bg-green-900/20 transition">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                            <i class="fas fa-credit-card text-blue-400"></i>
                                        </div>
                                        <div>
                                            <div class="text-white font-semibold">Cashless (Online)</div>
                                            <div class="text-gray-400 text-xs">Pay online via GCash, Maya, etc.</div>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-xs text-green-400 payment-hint-cashless">
                                        <i class="fas fa-check-circle mr-1"></i> Paid online — receipt shows as <strong>paid</strong>
=======
                        <span class="block text-gray-400 text-sm mb-2">Payment Method *</span>
                        <div class="grid gap-4 md:grid-cols-2">
                            <label class="cursor-pointer rounded-xl border border-gray-700 bg-gray-900 hover:border-netflix-red transition">
                                <input type="radio" name="payment_method" value="cashier" checked class="peer sr-only" />
                                <div class="flex items-start gap-3 p-4 peer-checked:border-netflix-red peer-checked:ring-2 peer-checked:ring-netflix-red peer-checked:bg-gray-800 transition rounded-xl">
                                    <div class="text-netflix-red text-2xl mt-1"><i class="fas fa-wallet"></i></div>
                                    <div>
                                        <div class="text-white font-semibold">Pay at Counter</div>
                                        <div class="text-gray-400 text-sm">Reserve now and settle payment when you arrive at the cinema cashier.</div>
                                    </div>
                                </div>
                            </label>
                            <label class="cursor-pointer rounded-xl border border-gray-700 bg-gray-900 hover:border-netflix-red transition">
                                <input type="radio" name="payment_method" value="online" class="peer sr-only" />
                                <div class="flex items-start gap-3 p-4 peer-checked:border-netflix-red peer-checked:ring-2 peer-checked:ring-netflix-red peer-checked:bg-gray-800 transition rounded-xl">
                                    <div class="text-netflix-red text-2xl mt-1"><i class="fas fa-credit-card"></i></div>
                                    <div>
                                        <div class="text-white font-semibold">Online Payment</div>
                                        <div class="text-gray-400 text-sm">Select this if you want to pay online and get a receipt immediately.</div>
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-500 text-white py-4 rounded-md font-bold text-lg transition flex items-center justify-center">
                        <i class="fas fa-check-circle mr-2"></i>
<<<<<<< HEAD
                        <span id="submitBtnText">Confirm Booking - Pay at Counter</span>
=======
                        <span>Confirm Booking</span>
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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
<<<<<<< HEAD
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    const submitBtnText = document.getElementById('submitBtnText');
    
    function updateButtonText() {
        const selected = document.querySelector('input[name="payment_method"]:checked');
        if (selected && selected.value === 'cashless') {
            submitBtnText.textContent = 'Confirm Booking - Pay Online';
        } else {
            submitBtnText.textContent = 'Confirm Booking - Pay at Counter';
        }
    }

    paymentRadios.forEach(radio => {
        radio.addEventListener('change', updateButtonText);
    });

=======
    
>>>>>>> 85d3be40cfe649a8304f3ddc942a262e67a3a530
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