@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12" style="background: linear-gradient(135deg, #141414 0%, #1a1a2e 50%, #141414 100%);">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('movies.index') }}" class="text-4xl font-bold tracking-tight inline-block">
                <span class="netflix-red">STREAM</span><span class="text-white">FLIX</span>
            </a>
        </div>

        <div class="bg-black/60 backdrop-blur-sm rounded-lg p-8 border border-gray-800">
            <h1 class="text-2xl font-bold text-white mb-2">Sign In</h1>
            <p class="text-gray-400 mb-6">Welcome back! Sign in to continue</p>

            @if($errors->any())
                <div class="bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-lg mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-sm"><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-600/20 border border-green-600 text-green-400 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-gray-400 text-sm mb-2">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition"
                           placeholder="you@example.com">
                </div>

                <div>
                    <label for="password" class="block text-gray-400 text-sm mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-gray-800 border border-gray-700 rounded-md px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-netflix-red focus:ring-1 focus:ring-netflix-red transition"
                           placeholder="••••••••">
                </div>

                <button type="submit"
                        class="w-full bg-netflix-red hover-netflix-red text-white py-3 rounded-md font-semibold text-lg transition">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    New to StreamFlix? 
                    <a href="{{ route('register') }}" class="text-white hover:underline font-semibold">
                        Sign up now
                    </a>
                </p>
            </div>
        </div>

        <p class="text-center text-gray-600 text-sm mt-6">
            This is a demo project. Use: admin@movie.com / password
        </p>
    </div>
</div>
@endsection
