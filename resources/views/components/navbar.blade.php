<nav class="bg-white sticky top-0 z-50 py-2 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img class="h-12" src="/logo-team-tas.png" alt="TEAM TAS">
                </div>
            </div>
            <div class="hidden md:flex flex-1 justify-center">
                <div class="flex space-x-8">
                    <a href="/"
                        :class="current === 'beranda' ? 'text-green-600 font-medium' : 'text-gray-700'"
                        class="text-sm font-medium hover:text-green-600 transition">Beranda</a>
                    <a href="#tentang"
                        :class="current === 'tentang' ? 'text-green-600 font-medium' : 'text-gray-700'"
                        class="text-sm font-medium hover:text-green-600 transition">Tentang</a>
                    <a href="#layanan"
                        :class="current === 'layanan' ? 'text-green-600 font-medium' : 'text-gray-700'"
                        class="text-sm font-medium hover:text-green-600 transition">Layanan</a>
                    <a href="#kontak"
                        :class="current === 'kontak' ? 'text-green-600 font-medium' : 'text-gray-700'"
                        class="text-sm font-medium hover:text-green-600 transition">Kontak</a>
                </div>
            </div>
            <div class="hidden md:flex space-x-2">
                @auth
                    @if(auth()->user()->hasRole('owner'))
                        <a href="{{ route('owner.dashboard') }}"
                            class="inline-flex items-center rounded-full bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 transition">Dashboard</a>
                    @elseif(auth()->user()->hasRole('petani'))
                        <a href="{{ route('petani.dashboard') }}"
                            class="inline-flex items-center rounded-full bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 transition">Dashboard</a>
                    @elseif(auth()->user()->hasRole('pegawai'))
                        <a href="{{ route('pegawai.dashboard') }}"
                            class="inline-flex items-center rounded-full bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 transition">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center rounded-full bg-green-500 px-5 py-2 text-sm font-medium text-white hover:bg-green-600 transition">Daftar</a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center rounded-full bg-green-100 border border-green-500 px-5 py-2 text-sm font-medium text-green-600 hover:bg-green-200 transition">Masuk</a>
                @endauth
            </div>
            <!-- Hamburger -->
            <div class="md:hidden">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:bg-gray-100 hover:text-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <span class="sr-only">Buka menu</span>
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="open" x-transition @click.away="open = false" class="md:hidden bg-white px-4 py-3 space-y-2">
        <a href="#beranda" class="block text-gray-700 hover:text-green-600">Beranda</a>
        <a href="#tentang" class="block text-gray-700 hover:text-green-600 transition">Tentang</a>
        <a href="#layanan" class="block text-gray-700 hover:text-green-600 transition">Layanan</a>
        <a href="#kontak" class="block text-gray-700 hover:text-green-600 transition">Kontak</a>
        <div class="pt-2 space-y-2">
            @auth
                @if(auth()->user()->hasRole('owner'))
                    <a href="{{ route('owner.dashboard') }}"
                        class="block w-full bg-green-500 text-center rounded-full py-2 text-white font-medium">Dashboard</a>
                @elseif(auth()->user()->hasRole('petani'))
                    <a href="{{ route('petani.dashboard') }}"
                        class="block w-full bg-green-500 text-center rounded-full py-2 text-white font-medium">Dashboard</a>
                @elseif(auth()->user()->hasRole('pegawai'))
                    <a href="{{ route('pegawai.dashboard') }}"
                        class="block w-full bg-green-500 text-center rounded-full py-2 text-white font-medium">Dashboard</a>
                @endif
            @else
                <a href="{{ route('register') }}"
                    class="block w-full bg-green-500 text-center rounded-full py-2 text-white font-medium">Daftar</a>
                <a href="{{ route('login') }}"
                    class="block w-full bg-green-100 border border-green-500 text-center rounded-full py-2 text-green-600 font-medium">Masuk</a>
            @endauth
        </div>
    </div>
</nav>