@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold text-white">Shows</h1>
        <p class="text-gray-400 mt-1">Manage all movie showtimes</p>
    </div>
    <a href="{{ route('admin.shows.create') }}" class="bg-netflix-red hover-netflix-red text-white px-6 py-3 rounded-lg font-semibold transition flex items-center">
        <i class="fas fa-plus mr-2"></i> Add New Show
    </a>
</div>

@if($shows->isEmpty())
    <div class="bg-gray-800/50 rounded-xl p-12 text-center border border-gray-700">
        <i class="fas fa-tv text-6xl text-gray-600 mb-4"></i>
        <p class="text-gray-400 text-xl">No shows found. Create your first show!</p>
    </div>
@else
    <div class="bg-gray-800/50 rounded-xl overflow-hidden border border-gray-700">
        <table class="w-full">
            <thead class="bg-gray-900/50">
                <tr>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Movie</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Screen</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Date & Time</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Price</th>
                    <th class="text-left px-6 py-4 text-gray-400 font-semibold">Availability</th>
                    <th class="text-right px-6 py-4 text-gray-400 font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shows as $show)
                    <tr class="border-t border-gray-700 hover:bg-gray-700/30 transition">
                        <td class="px-6 py-4">
                            <div class="text-white font-semibold">{{ $show->movie->title ?? 'N/A' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-300"><i class="fas fa-tv mr-1 text-gray-500"></i> {{ $show->screen_name }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-white">{{ $show->show_time->format('M d, Y') }}</div>
                            <div class="text-netflix-red text-sm font-semibold">{{ $show->show_time->format('h:i A') }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-green-400 font-bold">${{ number_format($show->price, 2) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $available = $show->seats()->where('is_available', true)->count();
                                $total = $show->total_seats;
                                $percentage = $total > 0 ? ($available / $total) * 100 : 0;
                            @endphp
                            <div class="flex items-center gap-2">
                                <div class="w-20 bg-gray-700 rounded-full h-2">
                                    <div class="h-2 rounded-full {{ $percentage > 50 ? 'bg-green-500' : ($percentage > 20 ? 'bg-yellow-500' : 'bg-red-500') }}" style="width: {{ $percentage }}%"></div>
                                </div>
                                <span class="text-gray-400 text-sm">{{ $available }}/{{ $total }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.shows.destroy', $show) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure? This will delete all seat data.')" 
                                        class="text-gray-400 hover:text-red-500 p-2 hover:bg-gray-700 rounded transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
