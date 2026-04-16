<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamFlix Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .netflix-red { color: #E50914; }
        .bg-netflix-red { background-color: #E50914; }
        .hover-netflix-red:hover { background-color: #F40612; }
        .sidebar { background-color: #0a0a0a; }
    </style>
</head>
<body class="bg-[#141414] text-white min-h-screen">
    <div class="flex">
        <aside class="fixed left-0 top-0 bottom-0 w-64 sidebar border-r border-gray-800 z-40">
            <div class="p-6 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold tracking-tight">
                    <span class="netflix-red">STREAM</span><span class="text-white">FLIX</span>
                    <span class="block text-xs text-gray-500 font-normal mt-1">Admin Panel</span>
                </a>
            </div>
            <nav class="p-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : 'text-gray-400' }}">
                            <i class="fas fa-chart-line w-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.movies') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.movies*') ? 'bg-gray-800 text-white' : 'text-gray-400' }}">
                            <i class="fas fa-film w-5"></i>
                            <span>Movies</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.shows') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.shows*') ? 'bg-gray-800 text-white' : 'text-gray-400' }}">
                            <i class="fas fa-tv w-5"></i>
                            <span>Shows</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reservations') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition {{ request()->routeIs('admin.reservations*') ? 'bg-gray-800 text-white' : 'text-gray-400' }}">
                            <i class="fas fa-ticket-alt w-5"></i>
                            <span>Reservations</span>
                        </a>
                    </li>
                </ul>
                
                <div class="mt-8 pt-8 border-t border-gray-800">
                    <a href="{{ route('movies.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition text-gray-400">
                        <i class="fas fa-external-link-alt w-5"></i>
                        <span>View Site</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-800 transition text-gray-400">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        <main class="flex-1 ml-64">
            <header class="bg-[#0a0a0a] border-b border-gray-800 px-8 py-4 sticky top-0 z-30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full bg-netflix-red flex items-center justify-center text-sm font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-semibold">{{ Auth::user()->name }}</div>
                            <div class="text-gray-500 text-sm">Administrator</div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-8">
                @if(session('success'))
                    <div class="bg-green-600/20 border border-green-600 text-green-400 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
