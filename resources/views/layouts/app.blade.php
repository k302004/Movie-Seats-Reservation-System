<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StreamFlix - Movie Tickets</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .netflix-red { color: #E50914; }
        .bg-netflix-red { background-color: #E50914; }
        .hover-netflix-red:hover { background-color: #F40612; }
        .hero-gradient { background: linear-gradient(to top, #141414, transparent); }
        .card-hover { transition: transform 0.3s ease, z-index 0.3s ease; }
        .card-hover:hover { transform: scale(1.05); z-index: 10; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        .movie-row { scroll-behavior: smooth; }
        .btn-focus:focus { outline: 2px solid #E50914; outline-offset: 2px; }
    </style>
    @stack('scripts')
</head>
<body class="bg-[#141414] text-white min-h-screen">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#141414]/95 backdrop-blur-sm border-b border-gray-800">
        <div class="px-4 md:px-8 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('movies.index') }}" class="text-3xl font-bold tracking-tight">
                        <span class="netflix-red">STREAM</span><span class="text-white">FLIX</span>
                    </a>
                    <div class="hidden md:flex items-center space-x-6 text-sm font-medium">
                        <a href="{{ route('movies.index') }}" class="text-gray-300 hover:text-white transition">Home</a>
                        <a href="{{ route('movies.index') }}#movies" class="text-gray-300 hover:text-white transition">Movies</a>
                        <a href="{{ route('reservations.lookup') }}" class="text-gray-300 hover:text-white transition">My Tickets</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="hidden md:block bg-netflix-red hover-netflix-red text-white px-4 py-2 rounded-md text-sm font-semibold transition">
                                Admin
                            </a>
                        @endif
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-netflix-red flex items-center justify-center text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-white text-sm transition">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white text-sm font-medium transition">Sign In</a>
                        <a href="{{ route('register') }}" class="bg-netflix-red hover-netflix-red text-white px-5 py-2 rounded-md text-sm font-semibold transition">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16">
        @if(session('error'))
            <div class="bg-red-600/90 text-white px-4 py-3 mx-4 mt-4 rounded-md text-center">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-600/90 text-white px-4 py-3 mx-4 mt-4 rounded-md text-center">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-black border-t border-gray-800 py-12 mt-16">
        <div class="px-4 md:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-gray-400 text-sm mb-4">Browse</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('movies.index') }}" class="text-gray-500 hover:text-white transition">Movies</a></li>
                        <li><a href="{{ route('reservations.lookup') }}" class="text-gray-500 hover:text-white transition">My Tickets</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gray-400 text-sm mb-4">Help</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-500 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-white transition">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gray-400 text-sm mb-4">Company</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-500 hover:text-white transition">About</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-white transition">Careers</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-gray-400 text-sm mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-500 hover:text-white transition">Terms</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-white transition">Privacy</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex justify-center space-x-6 mb-6 text-2xl">
                <a href="#" class="text-gray-500 hover:text-white transition"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-gray-500 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-gray-500 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-gray-500 hover:text-white transition"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="text-center text-gray-600 text-sm">&copy; {{ date('Y') }} StreamFlix. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
