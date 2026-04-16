@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white">Reservations</h1>
        <p class="text-gray-400 mt-1">View and manage all ticket bookings</p>
    </div>
    <div class="text-sm text-gray-400">
        Total Bookings: <span class="text-white font-semibold">{{ $reservations->total() }}</span>
    </div>
</div>

@if($reservations->isEmpty())
    <div class="bg-gray-800/50 rounded-xl p-12 text-center border border-gray-700">
        <i class="fas fa-ticket-alt text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-xl">No reservations found.</p>
    </div>
@else
    <div class="bg-gray-800/50 rounded-xl overflow-hidden border border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-900/50">
                <tr>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Confirmation</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Customer Info</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Movie & Show</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Seats</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Amount</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Booked At</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Status</th>
                    <th class="text-right px-6 py-4 text-gray-400 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservations as $reservation)
                    <tr class="border-t border-gray-700 hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.reservations.show', $reservation->confirmation_code) }}" 
                               class="text-netflix-red hover:text-red-400 font-mono font-semibold text-sm">
                                {{ $reservation->confirmation_code }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-netflix-red/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-netflix-red text-sm"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-white font-semibold truncate">{{ $reservation->customer_name }}</div>
                                    <div class="text-gray-500 text-xs truncate">{{ $reservation->customer_email }}</div>
                                    @if($reservation->customer_phone)
                                        <div class="text-gray-500 text-xs">{{ $reservation->customer_phone }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-white font-semibold truncate">{{ $reservation->seat->show->movie->title ?? 'N/A' }}</div>
                            <div class="text-gray-400 text-sm">
                                <i class="fas fa-calendar mr-1"></i> {{ $reservation->seat->show->show_time->format('M d, Y') }}
                            </div>
                            <div class="text-netflix-red text-sm">
                                <i class="fas fa-clock mr-1"></i> {{ $reservation->seat->show->show_time->format('h:i A') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full font-bold text-sm">
                                {{ $reservation->seat->seat_label ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-green-400 font-bold">${{ number_format($reservation->seat->price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-gray-400 text-sm">{{ $reservation->created_at->format('M d, Y') }}</div>
                            <div class="text-gray-500 text-xs">{{ $reservation->created_at->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($reservation->is_confirmed)
                                <span class="bg-green-600/20 text-green-400 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Confirmed
                                </span>
                            @else
                                <span class="bg-yellow-600/20 text-yellow-400 px-3 py-1 rounded-full text-xs font-semibold">
                                    <i class="fas fa-clock mr-1"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('admin.reservations.show', $reservation->confirmation_code) }}" 
                                   class="text-gray-400 hover:text-white p-2 hover:bg-gray-700 rounded transition" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Cancel this reservation? Customer: {{ addslashes($reservation->customer_name) }}')" 
                                            class="text-gray-400 hover:text-red-500 p-2 hover:bg-gray-700 rounded transition" title="Cancel Reservation">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 flex justify-center">
        {{ $reservations->links() }}
    </div>
@endif
@endsection
