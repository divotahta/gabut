<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Petani')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-green-700 text-white flex flex-col py-6 px-4">
            <div class="mb-8 flex items-center space-x-2">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-2xl font-bold">Petani</span>
            </div>
            <nav class="flex-1 space-y-2">
                <a href="{{ route('petani.dashboard') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-green-800 @if(request()->routeIs('petani.dashboard')) bg-green-900 @endif">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('petani.mitra.index') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-green-800 @if(request()->routeIs('petani.mitra.*')) bg-green-900 @endif">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3m-8 4h8" />
                    </svg>
                    Pengajuan Mitra
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-green-800 @if(request()->routeIs('profile.*')) bg-green-900 @endif">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profil
                </a>
            </nav>
            <form method="POST" action="{{ route('logout') }}" class="mt-8">
                @csrf
                <button type="submit" class="w-full flex items-center px-3 py-2 rounded-md hover:bg-green-800 focus:outline-none">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </aside>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow px-6 py-4 flex items-center justify-between">
                <h1 class="text-xl font-semibold text-green-700">@yield('title', 'Dashboard')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 font-medium">{{ Auth::user()->name }}</span>
                </div>
            </header>
            <!-- Content -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html> 