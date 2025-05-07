@extends('layouts.petani')

@section('title', 'Daftar Mitra')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Daftar Mitra</h2>
                <a href="{{ route('petani.mitra.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">
                    Ajukan Mitra Baru
                </a>
            </div>

            <!-- Filter dan Pencarian -->
            <div class="mb-6 flex gap-4">
                <input type="text" 
                    class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" 
                    placeholder="Cari berdasarkan nama, email, atau telepon...">
                
                <select class="border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Kabupaten</option>
                    @foreach($kabupatenList as $kabupaten)
                        <option value="{{ $kabupaten }}">{{ $kabupaten }}</option>
                    @endforeach
                </select>

                <select class="border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="ditolak">Ditolak</option>
                </select>

                <button class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                    Cari
                </button>
                <button class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                    Reset
                </button>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kabupaten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mitras as $index => $mitra)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mitras->firstItem() + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mitra->nama_lengkap }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mitra->email }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mitra->telepon }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $mitra->kabupaten }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($mitra->status == 'menunggu')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($mitra->status == 'disetujui')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                @elseif($mitra->status == 'ditolak')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('petani.mitra.show', $mitra->id) }}" 
                                   class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data mitra
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $mitras->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
