@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-lg">
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-8 border border-gray-700">
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-netflix-red/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-ticket-alt text-4xl text-netflix-red"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Find Your Ticket</h1>
                <p class="text-gray-400">Enter your confirmation code to view your booking</p>
            </div>

            <form action="{{ route('reservations.show', ':code') }}" method="GET" id="lookupForm" class="space-y-6">
                <div>
                    <label for="confirmation_code" class="block text-gray-400 text-sm mb-2">Confirmation Code</label>
                    <input type="text" id="confirmation_code" name="confirmation_code" placeholder="TKT-XXXXXXXX"
                           class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-4 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition text-center text-xl font-mono uppercase tracking-wider"
                           required>
                </div>

                <button type="submit" id="submitBtn"
                        class="w-full bg-netflix-red hover-netflix-red text-white py-4 rounded-lg font-bold text-lg transition flex items-center justify-center">
                    <i class="fas fa-search mr-2"></i> Find My Ticket
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('movies.index') }}" class="text-gray-400 hover:text-white transition inline-flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Browse Movies
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.getElementById('lookupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const code = document.getElementById('confirmation_code').value.trim().toUpperCase();
    if (code) {
        this.action = this.action.replace(':code', code);
        this.submit();
    }
});
</script>
@endpush
