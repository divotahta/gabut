<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TAS - Kemitraan Petani Alpukat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body x-data="scrollNavNav()" x-init="init()">

    <!-- NAVIGATION -->
    @include('components.navbar')

    <!-- BERANDA -->
    <section id="beranda" class="bg-green-500 text-white relative overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 py-24 md:py-32 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">SELAMAT DATANG</h1>
            <p class="text-lg mb-8 max-w-3xl mx-auto">
                Selamat datang di website TEAM TAS. Bergabunglah sebagai anggota kami dan
                nikmati akses eksklusif ke fitur-fitur yang dirancang khusus untuk meningkatkan
                kesuksesan bisnis peternakan Anda. Terima kasih atas kunjungan Anda!
            </p>
            <a href="{{ route('register') }}"
                class="bg-white text-green-600 px-8 py-3 font-medium rounded-full hover:bg-gray-100 inline-block">
                Bermitra Sekarang
            </a>

        </div>
        <!-- Wave effect -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200" class="w-full">
                <path fill="#f8fafc" fill-opacity="1"
                    d="M0,192L48,181.3C96,171,192,149,288,154.7C384,160,480,192,576,197.3C672,203,768,181,864,144C960,107,1056,53,1152,42.7C1248,32,1344,64,1392,80L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section id="tentang" class="py-20 px-6 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-16 text-center">Tentang Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-4 border mb-6 shadow-md">
                        <img src="/img/alpukat-1.jpg" alt="Pengelolaan Buah"
                            class="w-40 h-40 object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Bantu pengelolaan buah alpukat anda dengan baik</h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-4 border mb-6 shadow-md">
                        <img src="/img/handshake.jpg" alt="Pertemuan Supplier"
                            class="w-40 h-40 object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Pertemukan anda langsung dengan supplier terpercaya</h3>
                </div>
                <div class="flex flex-col items-center">
                    <div class="bg-white rounded-full p-4 border mb-6 shadow-md">
                        <img src="/img/alpukat-2.jpg" alt="Pemantauan Proses"
                            class="w-40 h-40 object-cover rounded-full">
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Bantu pemantauan proses dari pembibitan sampai pembuahan
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <!-- LAYANAN (BENEFIT BERMITRA with Carousel) -->
    <section id="layanan" class="py-20 px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-center">Benefit Bermitra</h2>
            <div class="flex justify-center mb-12">
                <div class="bg-gray-200 h-2 w-32 rounded-full flex items-center">
                    <div class="bg-green-500 h-2 w-20 rounded-full"></div>
                </div>
            </div>

            <!-- Carousel Container -->
            <div class="relative overflow-hidden">
                <!-- Slides Container -->
                <div class="relative">
                    <!-- Slide 1 -->
                    <div x-show="activeSlide === 0" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full"
                        class="bg-white border rounded-lg overflow-hidden shadow-md">
                        <div class="bg-green-500 p-4">
                            <img src="/img/alpukat-3.jpg" alt="Hasil Panen" class="w-full h-64 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Hasil Panen Berkualitas</h3>
                            <p class="text-gray-600">Dengan pengelolaan yang tepat, hasil panen alpukat anda akan
                                memiliki kualitas terbaik dan nilai jual yang tinggi di pasaran. Tim kami akan membantu
                                Anda mencapai standar kualitas tertinggi.</p>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div x-show="activeSlide === 1" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full"
                        class="bg-white border rounded-lg overflow-hidden shadow-md">
                        <div class="bg-green-500 p-4">
                            <img src="/img/handshake-2.jpg" alt="Distribusi" class="w-full h-64 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Distribusi Hasil Panen</h3>
                            <p class="text-gray-600">Memberikan anda kemudahan dalam menjual hasil panen karena
                                kualitas yang bagus. Kami memiliki jaringan distributor luas yang siap menerima hasil
                                panen berkualitas tinggi dengan harga terbaik.</p>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div x-show="activeSlide === 2" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform translate-x-full"
                        x-transition:enter-end="opacity-100 transform translate-x-0"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 transform translate-x-0"
                        x-transition:leave-end="opacity-0 transform -translate-x-full"
                        class="bg-white border rounded-lg overflow-hidden shadow-md">
                        <div class="bg-green-500 p-4">
                            <img src="/img/clock.jpg" alt="Harga Jual" class="w-full h-64 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">Harga Jual Tinggi</h3>
                            <p class="text-gray-600">Hasil panen yang bagus akan berdampak ke harga buah. Dengan
                                kualitas terbaik, Anda dapat memperoleh harga jual hingga 40% lebih tinggi dibandingkan
                                rata-rata pasar.</p>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <div class="flex justify-between items-center mt-6">
                    <button @click="prevSlide"
                        class="bg-green-500 text-white rounded-full p-2 hover:bg-green-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Dots -->
                    <div class="flex space-x-2">
                        <button @click="goToSlide(0)" :class="activeSlide === 0 ? 'bg-green-500' : 'bg-gray-300'"
                            class="w-3 h-3 rounded-full focus:outline-none"></button>
                        <button @click="goToSlide(1)" :class="activeSlide === 1 ? 'bg-green-500' : 'bg-gray-300'"
                            class="w-3 h-3 rounded-full focus:outline-none"></button>
                        <button @click="goToSlide(2)" :class="activeSlide === 2 ? 'bg-green-500' : 'bg-gray-300'"
                            class="w-3 h-3 rounded-full focus:outline-none"></button>
                    </div>

                    <button @click="nextSlide"
                        class="bg-green-500 text-white rounded-full p-2 hover:bg-green-600 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- KONTAK -->
    <footer id="kontak" class="bg-green-500 text-white py-12">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-center text-3xl font-bold mb-6">Kontak Kami</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 border-b border-green-400 pb-8 mb-8">
                <div class="flex items-start">
                    <span class="text-2xl mr-3">📍</span>
                    <p>Alamat: Jl. Alpukat No. 123, Bandung</p>
                </div>
                <div class="flex items-start">
                    <span class="text-2xl mr-3">📧</span>
                    <p>Email: tas.support@email.com</p>
                </div>
                <div class="flex items-start">
                    <span class="text-2xl mr-3">📱</span>
                    <p>WhatsApp: +62 812-3456-7890</p>
                </div>
            </div>
            <div class="text-center">
                <p>By Team TAS 2025. All Right Reserved</p>
            </div>
        </div>
    </footer>
</body>

</html>
