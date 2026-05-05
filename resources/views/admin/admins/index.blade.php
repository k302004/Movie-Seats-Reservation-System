@extends('layouts.admin')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold">Admin Management</h1>
        <p class="text-gray-400 mt-1">Manage administrator accounts</p>
    </div>
    <button onclick="document.getElementById('createModal').classList.remove('hidden')" class="bg-netflix-red hover-netflix-red text-white px-6 py-3 rounded-lg font-medium transition flex items-center space-x-2">
        <i class="fas fa-plus"></i>
        <span>Add Admin</span>
    </button>
</div>

<div class="bg-[#1a1a1a] rounded-xl border border-gray-800 overflow-hidden">
    <table class="w-full">
        <thead class="bg-[#0a0a0a] border-b border-gray-800">
            <tr>
                <th class="text-left px-6 py-4 text-gray-400 font-medium">Name</th>
                <th class="text-left px-6 py-4 text-gray-400 font-medium">Email</th>
                <th class="text-left px-6 py-4 text-gray-400 font-medium">Created</th>
                <th class="text-right px-6 py-4 text-gray-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @foreach($admins as $admin)
            <tr class="hover:bg-gray-800/50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-netflix-red flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr($admin->name, 0, 1)) }}
                        </div>
                        <span class="font-medium">{{ $admin->name }}</span>
                        @if($admin->id === auth()->id())
                        <span class="text-xs bg-gray-700 text-gray-300 px-2 py-1 rounded">You</span>
                        @endif
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-300">{{ $admin->email }}</td>
                <td class="px-6 py-4 text-gray-400">{{ $admin->created_at->format('M d, Y') }}</td>
                <td class="px-6 py-4 text-right">
                    @if($admin->id !== auth()->id())
                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this admin?')" class="text-red-400 hover:text-red-300 transition p-2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @if($admins->isEmpty())
    <div class="p-12 text-center text-gray-400">
        <i class="fas fa-users text-4xl mb-4"></i>
        <p>No administrators found</p>
    </div>
    @endif
</div>

<div id="createModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50">
    <div class="bg-[#1a1a1a] rounded-xl border border-gray-800 w-full max-w-md mx-4">
        <div class="p-6 border-b border-gray-800 flex items-center justify-between">
            <h2 class="text-xl font-bold">Add New Admin</h2>
            <button onclick="document.getElementById('createModal').classList.add('hidden')" class="text-gray-400 hover:text-white transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form action="{{ route('admin.admins.store') }}" method="POST" class="p-6">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Name</label>
                    <input type="text" name="name" required class="w-full bg-[#0a0a0a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" required class="w-full bg-[#0a0a0a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" required minlength="8" class="w-full bg-[#0a0a0a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" required minlength="8" class="w-full bg-[#0a0a0a] border border-gray-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-netflix-red transition">
                </div>
            </div>
            <div class="flex space-x-3 mt-6">
                <button type="button" onclick="document.getElementById('createModal').classList.add('hidden')" class="flex-1 bg-gray-700 hover:bg-gray-600 text-white py-3 rounded-lg font-medium transition">
                    Cancel
                </button>
                <button type="submit" class="flex-1 bg-netflix-red hover-netflix-red text-white py-3 rounded-lg font-medium transition">
                    Create Admin
                </button>
            </div>
        </form>
    </div>
</div>
@endsection