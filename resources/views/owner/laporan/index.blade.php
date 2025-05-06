@extends('layouts.owner')

@section('title', 'Daftar Laporan')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                @if(request('mitra_id'))
                    <a href="{{ route('owner.laporan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                @endif
                <h1 class="text-2xl font-bold text-gray-800">
                    @if(request('mitra_id'))
                        Laporan {{ $selectedMitra->nama_lengkap }}
                    @else
                        Pilih Mitra
                    @endif
                </h1>
            </div>
        </div>

        @if(!request('mitra_id'))
            <!-- Form Pencarian Mitra -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="searchMitraInput"
                               placeholder="Cari mitra berdasarkan nama, email, atau kabupaten..."
                               class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                    </div>
                </div>
            </div>

            <!-- Daftar Mitra -->
            <div id="mitraContainer">
                <div id="mitraList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($mitras->where('status', 'disetujui') as $mitra)
                <a href="{{ route('owner.laporan.index', ['mitra_id' => $mitra->id]) }}" 
                   class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200">
                    <div class="p-6">
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex-shrink-0">
                                @if($mitra->foto_profil)
                                    <img src="{{ Storage::url($mitra->foto_profil) }}" 
                                         alt="{{ $mitra->nama }}" 
                                         class="w-16 h-16 rounded-full object-cover">
                                @else
                                    <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400 text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $mitra->nama_lengkap }}</h3>
                                <p class="text-sm text-gray-500">{{ $mitra->email }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-map-marker-alt w-5"></i>
                                <span>{{ $mitra->kabupaten }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-phone w-5"></i>
                                <span>{{ $mitra->telepon }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center text-gray-500">
                        Belum ada mitra yang disetujui
                    </div>
                </div>
                @endforelse
                </div>
            </div>
        @else
            <!-- Form Pencarian -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <div class="flex items-center gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="searchInput"
                               placeholder="Cari judul atau keterangan laporan..."
                               class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                    </div>
                </div>
            </div>

            <!-- Daftar Laporan dalam Card -->
            <div id="laporanContainer">
                <div id="laporanList" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($laporans as $laporan)
                        <a href="{{ route('owner.laporan.show', $laporan) }}" 
                           class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-200 group">
                            <div class="p-6">
                                <!-- Header Laporan -->
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition duration-200">
                                        {{ $laporan->judul }}
                                    </h3>
                                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar mr-2"></i>
                                            {{ $laporan->tanggal_laporan->format('d F Y') }}
                                        </span>
                                        <span class="px-3 py-1 rounded-full text-sm
                                            {{ $laporan->metode == 'Kunjungan Langsung' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $laporan->metode }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 mb-3">
                                        <i class="fas fa-user mr-2"></i>
                                        {{ $laporan->pegawai->name }}
                                    </div>
                                </div>

                                <!-- Keterangan Singkat -->
                                <div class="text-gray-700 line-clamp-3 mb-4">
                                    {{ Str::limit(strip_tags($laporan->keterangan), 150) }}
                                </div>

                                <!-- Footer -->
                                @if($laporan->media_foto || $laporan->media_video)
                                    <div class="flex items-center text-sm text-gray-500 border-t pt-3 mt-3">
                                        <i class="fas fa-paperclip mr-2"></i>
                                        {{ $laporan->media_foto ? 'Foto' : '' }}
                                        {{ $laporan->media_foto && $laporan->media_video ? ' & ' : '' }}
                                        {{ $laporan->media_video ? 'Video' : '' }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-lg shadow-lg p-6 text-center text-gray-500">
                            Tidak ada laporan yang ditemukan
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($laporans instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    <div id="paginationContainer" class="mt-8">
                        {{ $laporans->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kode untuk pencarian laporan yang sudah ada
    const searchInput = document.getElementById('searchInput');
    const laporanList = document.getElementById('laporanList');
    const paginationContainer = document.getElementById('paginationContainer');
    let searchTimeout;

    // Fungsi untuk melakukan pencarian laporan
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        const mitraId = '{{ request('mitra_id') }}';
        
        fetch(`{{ route('owner.laporan.search') }}?search=${encodeURIComponent(searchTerm)}&mitra_id=${mitraId}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.html) {
                laporanList.innerHTML = data.html;
            }
            if (data.pagination) {
                paginationContainer.innerHTML = data.pagination;
            } else {
                paginationContainer.innerHTML = '';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            laporanList.innerHTML = `
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center text-red-500">
                        Terjadi kesalahan saat melakukan pencarian
                    </div>
                </div>
            `;
            paginationContainer.innerHTML = '';
        });
    }

    // Event listener untuk input pencarian laporan
    if (searchInput) {
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 500);
        });
    }

    // Kode untuk pencarian mitra
    const searchMitraInput = document.getElementById('searchMitraInput');
    const mitraList = document.getElementById('mitraList');
    let searchMitraTimeout;

    // Fungsi untuk melakukan pencarian mitra
    function performMitraSearch() {
        const searchTerm = searchMitraInput.value.trim();
        
        fetch(`{{ route('owner.mitra.search') }}?search=${encodeURIComponent(searchTerm)}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.html) {
                mitraList.innerHTML = data.html;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mitraList.innerHTML = `
                <div class="col-span-full">
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center text-red-500">
                        Terjadi kesalahan saat melakukan pencarian
                    </div>
                </div>
            `;
        });
    }

    // Event listener untuk input pencarian mitra
    if (searchMitraInput) {
        searchMitraInput.addEventListener('input', function() {
            clearTimeout(searchMitraTimeout);
            searchMitraTimeout = setTimeout(performMitraSearch, 500);
    });
    }

    // Event listener untuk pagination laporan
    document.addEventListener('click', function(e) {
        if (e.target.matches('.pagination a')) {
            e.preventDefault();
            const url = e.target.href;
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.html) {
                    laporanList.innerHTML = data.html;
                }
                if (data.pagination) {
                    paginationContainer.innerHTML = data.pagination;
                }
                window.scrollTo({ top: 0, behavior: 'smooth' });
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    });
});
</script>
@endpush
@endsection
