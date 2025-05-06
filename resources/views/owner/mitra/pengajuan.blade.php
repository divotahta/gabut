@extends('layouts.owner')

@section('header', 'Pengajuan Mitra Menunggu')

@section('content')
<div class="overflow-hidden bg-white shadow sm:rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama Lengkap</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Telepon</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Luas Lahan</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Alamat</th>
                    <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($mitras as $mitra)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->nama_lengkap }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->telepon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->luas_lahan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $mitra->alamat_detail }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('owner.mitra.show', $mitra) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        <div x-data="{ openApprove: false, openReject: false }" class="inline">
                            <button type="button" @click="openApprove = true" class="text-green-600 hover:text-green-900 ml-2">Setujui</button>
                            <button type="button" @click="openReject = true" class="text-red-600 hover:text-red-900 ml-2">Tolak</button>
                            <!-- Modal Setujui -->
                            <div x-show="openApprove" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="fixed inset-0 bg-black opacity-50" @click="openApprove = false"></div>
                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-80">
                                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Persetujuan</h3>
                                    <p class="mb-6">Apakah Anda yakin ingin menyetujui mitra ini?</p>
                                    <div class="flex justify-end gap-2">
                                        <button @click="openApprove = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Tidak</button>
                                        <form action="{{ route('owner.mitra.approve', $mitra) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Tolak -->
                            <div x-show="openReject" style="display: none;" class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="fixed inset-0 bg-black opacity-50" @click="openReject = false"></div>
                                <div class="bg-white rounded-lg shadow-lg p-6 z-10 w-80">
                                    <h3 class="text-lg font-semibold mb-4">Konfirmasi Penolakan</h3>
                                    <p class="mb-6">Apakah Anda yakin ingin menolak mitra ini?</p>
                                    <div class="flex justify-end gap-2">
                                        <button @click="openReject = false" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Tidak</button>
                                        <form action="{{ route('owner.mitra.reject', $mitra) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Ya</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-sm text-center text-gray-500">
                        Tidak ada pengajuan mitra menunggu
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($mitras->hasPages())
    <div class="px-6 py-4 bg-gray-50">
        {{ $mitras->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush 