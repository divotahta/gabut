@extends('layouts.owner')

@section('title', 'Daftar Mitra')

@section('content')
    {{-- <div class="container mx-auto px-4 py-8"> --}}
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Mitra</h1>
        </div>

        <!-- Form Pencarian dan Filter -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <form id="searchForm" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               id="searchInput"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari berdasarkan nama, email, atau telepon..."
                               class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                    </div>
                </div>
                <div class="w-full md:w-64">
                    <select id="kabupatenFilter" 
                            name="kabupaten" 
                            class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                        <option value="">Semua Kabupaten</option>
                        @foreach($kabupatenList as $kabupaten)
                            <option value="{{ $kabupaten }}" {{ request('kabupaten') == $kabupaten ? 'selected' : '' }}>
                                {{ $kabupaten }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-64">
                    <select id="statusFilter" 
                            name="status" 
                            class="w-full rounded-lg border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-200">
                        <option value="">Semua Status</option>
                        <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-search mr-2"></i>Cari
                    </button>
                    <a href="{{ route('owner.mitra.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-200">
                        <i class="fas fa-redo mr-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Daftar Mitra -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kabupaten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mitras as $mitra)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-medium text-gray-900">{{ $mitra->nama_lengkap }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $mitra->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $mitra->telepon }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $mitra->kabupaten }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $mitra->status == 'disetujui'
                                        ? 'bg-green-100 text-green-800'
                                        : ($mitra->status == 'ditolak'
                                            ? 'bg-red-100 text-red-800'
                                            : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($mitra->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('owner.mitra.show', $mitra) }}"
                                        class="text-blue-600 hover:text-blue-900">Detail</a>
                                    @if ($mitra->status == 'menunggu')
                                        <div x-data="{ openApprove: false, openReject: false }" class="inline">
                                            <button type="button" @click="openApprove = true"
                                                class="text-green-600 hover:text-green-900 ml-2">Setujui</button>
                                            <button type="button" @click="openReject = true"
                                                class="text-red-600 hover:text-red-900 ml-2">Tolak</button>
                                            <!-- Modal Setujui -->
                                            <div x-show="openApprove" style="display: none;"
                                                class="fixed inset-0 flex items-center justify-center z-50">
                                                <div class="fixed inset-0 bg-black opacity-50" @click="openApprove = false">
                                                </div>
                                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-80">
                                                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Persetujuan</h3>
                                                    <p class="mb-6">Apakah Anda yakin ingin menyetujui mitra ini?</p>
                                                    <div class="flex justify-end gap-2">
                                                        <button @click="openApprove = false"
                                                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Tidak</button>
                                                        <form action="{{ route('owner.mitra.approve', $mitra) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal Tolak -->
                                            <div x-show="openReject" style="display: none;"
                                                class="fixed inset-0 flex items-center justify-center z-50">
                                                <div class="fixed inset-0 bg-black opacity-50" @click="openReject = false">
                                                </div>
                                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-80">
                                                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h3>
                                                    <p class="mb-6">Apakah Anda yakin ingin menolak mitra ini?</p>
                                                    <div class="flex justify-end gap-2">
                                                        <button @click="openReject = false"
                                                            class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Tidak</button>
                                                        <form action="{{ route('owner.mitra.reject', $mitra) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data mitra
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $mitras->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');
    const kabupatenFilter = document.getElementById('kabupatenFilter');
    const statusFilter = document.getElementById('statusFilter');
    let searchTimeout;

    // Fungsi untuk melakukan pencarian
    function performSearch() {
        searchForm.submit();
    }

    // Event listener untuk input pencarian
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(performSearch, 500);
    });

    // Event listener untuk filter kabupaten dan status
    kabupatenFilter.addEventListener('change', performSearch);
    statusFilter.addEventListener('change', performSearch);
});
</script>
@endpush
