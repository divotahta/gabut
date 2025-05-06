@extends('layouts.owner')

@section('title', $laporan->judul)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-sm
                        {{ $laporan->metode == 'Kunjungan Langsung' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $laporan->metode }}
                    </span>
                </div>
            </div>

            <!-- Title -->
            <h1 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                {{ $laporan->judul }}
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-8">
                <div class="flex items-center">
                    <i class="fas fa-calendar mr-2"></i>
                    {{ $laporan->tanggal_laporan->format('d F Y') }}
                </div>
                <div class="flex items-center">
                    <i class="fas fa-user mr-2"></i>
                    {{ $laporan->pegawai->name }}
                </div>
                <div class="flex items-center">
                    <i class="fas fa-map-marker-alt mr-2"></i>
                    {{ $laporan->mitra->kabupaten }}
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <article class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Featured Image -->
            @if($laporan->media_foto)
                <div class="w-full h-96 relative">
                    <img src="{{ Storage::url($laporan->media_foto) }}" 
                         alt="Foto Laporan" 
                         class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Mitra Info -->
            <div class="p-8 border-b border-gray-200">
                <div class="flex items-center space-x-6">
                    <div class="flex-shrink-0">
                        @if($laporan->mitra->foto_profil)
                            <img src="{{ Storage::url($laporan->mitra->foto_profil) }}" 
                                 alt="{{ $laporan->mitra->nama_lengkap }}" 
                                 class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center border-4 border-white shadow-lg">
                                <i class="fas fa-user text-gray-400 text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 mb-1">{{ $laporan->mitra->nama_lengkap }}</h2>
                        <p class="text-gray-500 mb-2">{{ $laporan->mitra->email }}</p>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-phone mr-2"></i>
                            <span>{{ $laporan->mitra->telepon }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-8">
                <div class="prose max-w-none">
                    <div class="text-gray-700 whitespace-pre-line text-lg leading-relaxed">
                        {{ $laporan->keterangan }}
                    </div>
                </div>
            </div>

            <!-- Media Gallery -->
            @if($laporan->media_foto || $laporan->media_video)
                <div class="p-8 bg-gray-50 border-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 mb-6">Dokumentasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($laporan->media_foto)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <img src="{{ Storage::url($laporan->media_foto) }}" 
                                     alt="Foto Laporan" 
                                     class="w-full h-64 object-cover">
                            </div>
                        @endif

                        @if($laporan->media_video)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <video controls class="w-full h-64 object-cover">
                                    <source src="{{ Storage::url($laporan->media_video) }}" type="video/mp4">
                                    Browser Anda tidak mendukung tag video.
                                </video>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Footer -->
            <div class="p-8 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Terakhir diperbarui: {{ $laporan->updated_at->format('d F Y H:i') }}
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-share-alt"></i>
                        </a>
                        <a href="#" class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-print"></i>
                        </a>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection