@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#141414]">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-gray-800/50 rounded-xl p-6 mb-8 border border-gray-700">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <div class="flex items-center space-x-3 mb-2">
                        <a href="{{ route('movies.show', $show->movie) }}" class="text-gray-400 hover:text-white transition">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <h1 class="text-2xl font-bold text-white">{{ $show->movie->title }}</h1>
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-gray-400 text-sm">
                        <span><i class="fas fa-tv mr-1"></i> {{ $show->screen_name }}</span>
                        <span><i class="fas fa-calendar mr-1"></i> {{ $show->show_time->format('M d, Y') }}</span>
                        <span><i class="fas fa-clock mr-1"></i> {{ $show->show_time->format('h:i A') }}</span>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-gray-400 text-sm">Per Ticket</div>
                    <div class="text-3xl font-bold text-white">${{ number_format($show->price, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl p-8 mb-8 border border-gray-700">
            <div class="mb-8 text-center">
                <div class="bg-gray-700 text-gray-300 text-xl font-bold py-4 rounded-lg mb-10 max-w-md mx-auto">
                    SCREEN
                </div>

                <div class="space-y-3">
                    @foreach($seats as $row => $rowSeats)
                        <div class="flex items-center justify-center gap-2">
                            <div class="text-gray-400 font-bold w-8 text-center text-sm">{{ $row }}</div>
                            <div class="flex gap-1 sm:gap-2 flex-wrap justify-center">
                                @foreach($rowSeats as $seat)
                                    @if($seat->is_available)
                                        <button type="button"
                                                data-seat-id="{{ $seat->id }}"
                                                data-seat-label="{{ $seat->seat_label }}"
                                                data-seat-price="{{ $seat->price }}"
                                                class="seat w-8 h-8 sm:w-10 sm:h-10 bg-green-600 hover:bg-green-500 text-white text-xs sm:text-sm font-bold rounded transition card-hover">
                                            {{ $seat->number }}
                                        </button>
                                    @else
                                        <button type="button"
                                                disabled
                                                class="seat w-8 h-8 sm:w-10 sm:h-10 bg-gray-700 text-gray-600 text-xs sm:text-sm font-bold rounded cursor-not-allowed">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                            <div class="text-gray-400 font-bold w-8 text-center text-sm">{{ $row }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-green-600 rounded flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                    <span class="text-gray-400">Available</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-netflix-red rounded flex items-center justify-center">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                    <span class="text-gray-400">Selected</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-gray-700 rounded flex items-center justify-center">
                        <i class="fas fa-times text-gray-600 text-xs"></i>
                    </div>
                    <span class="text-gray-400">Taken</span>
                </div>
            </div>
        </div>

        <div class="bg-gray-800/50 rounded-xl p-6 border border-gray-700">
            <h3 class="text-xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-ticket-alt netflix-red mr-3"></i> Complete Your Booking
            </h3>

            <div id="selectedSeatsDisplay" class="mb-6 hidden">
                <div class="bg-gray-900/50 rounded-lg p-4 mb-4">
                    <div class="text-gray-400 text-sm mb-3">Selected Seats:</div>
                    <div id="selectedSeatsList" class="flex flex-wrap gap-2 mb-4"></div>
                    <div class="flex justify-between items-center pt-4 border-t border-gray-700">
                        <span class="text-gray-300 font-medium">Total:</span>
                        <span id="totalPrice" class="text-3xl font-bold text-green-500">$0.00</span>
                    </div>
                </div>
            </div>

            <form id="reservationForm" action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <input type="hidden" name="show_id" value="{{ $show->id }}">
                <input type="hidden" name="seat_ids" id="selectedSeats">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="customer_name" class="block text-gray-400 text-sm mb-2">Full Name *</label>
                        <input type="text" id="customer_name" name="customer_name" required placeholder="John Doe"
                               class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                    </div>
                    <div>
                        <label for="customer_email" class="block text-gray-400 text-sm mb-2">Email Address *</label>
                        <input type="email" id="customer_email" name="customer_email" required placeholder="john@example.com"
                               class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                    </div>
                </div>

                <div class="mb-6">
                    <label for="customer_phone" class="block text-gray-400 text-sm mb-2">Phone Number (Optional)</label>
                    <input type="tel" id="customer_phone" name="customer_phone" placeholder="+1 234 567 8900"
                           class="w-full bg-gray-900 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition">
                </div>

                <button type="submit" id="submitBtn" disabled
                        class="w-full bg-netflix-red hover-netflix-red text-white py-4 rounded-md font-bold text-lg transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                    <i class="fas fa-lock mr-2"></i>
                    <span id="submitBtnText">Select seats to continue</span>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const seats = document.querySelectorAll('.seat:not([disabled])');
    const selectedSeatsDisplay = document.getElementById('selectedSeatsDisplay');
    const selectedSeatsList = document.getElementById('selectedSeatsList');
    const totalPriceEl = document.getElementById('totalPrice');
    const selectedSeatsInput = document.getElementById('selectedSeats');
    const submitBtn = document.getElementById('submitBtn');
    const submitBtnText = document.getElementById('submitBtnText');
    const ticketPrice = {!! json_encode($show->price) !!};

    let selectedSeats = [];

    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            const seatId = this.dataset.seatId;
            const seatLabel = this.dataset.seatLabel;
            const seatPrice = parseFloat(this.dataset.seatPrice);

            if (this.classList.contains('bg-netflix-red')) {
                this.classList.remove('bg-netflix-red');
                this.classList.add('bg-green-600');
                selectedSeats = selectedSeats.filter(s => s.id !== seatId);
            } else {
                this.classList.remove('bg-green-600');
                this.classList.add('bg-netflix-red');
                selectedSeats.push({ id: seatId, label: seatLabel, price: seatPrice });
            }

            updateDisplay();
        });
    });

    function updateDisplay() {
        if (selectedSeats.length > 0) {
            selectedSeatsDisplay.classList.remove('hidden');
            submitBtn.disabled = false;
            submitBtnText.textContent = `Proceed to Book ${selectedSeats.length} Seat${selectedSeats.length > 1 ? 's' : ''}`;

            selectedSeatsList.innerHTML = selectedSeats.map(s =>
                `<span class="bg-netflix-red/20 border border-netflix-red text-netflix-red px-3 py-1 rounded-full text-sm font-semibold">${s.label}</span>`
            ).join('');

            const total = selectedSeats.reduce((sum, s) => sum + s.price, 0);
            totalPriceEl.textContent = `$${total.toFixed(2)}`;
        } else {
            selectedSeatsDisplay.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtnText.textContent = 'Select seats to continue';
        }

        selectedSeatsInput.value = JSON.stringify(selectedSeats.map(s => s.id));
    }
});
</script>
@endpush
