@extends('layouts.owner')

@section('header', 'Detail Mitra')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-8">
    <div class="flex items-center space-x-4 mb-6">
        <a href="{{ route('owner.mitra.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition duration-200">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Mitra</h1>
    </div>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <div class="mb-4">
                <span class="font-semibold">Nama Lengkap:</span>
                <div>{{ $mitra->nama_lengkap }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Email:</span>
                <div>{{ $mitra->email }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">No. Telepon:</span>
                <div>{{ $mitra->telepon }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Luas Lahan:</span>
                <div>{{ $mitra->luas_lahan }} m²</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Jumlah Pohon:</span>
                <div>{{ $mitra->pohon ?? '-' }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Media Lahan:</span>
                <div>{{ $mitra->media_lahan }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Status:</span>
                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                    @if($mitra->status === 'menunggu') bg-yellow-100 text-yellow-800
                    @elseif($mitra->status === 'disetujui') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($mitra->status) }}
                </span>
            </div>
        </div>
        <div>
            <div class="mb-4">
                <span class="font-semibold">Provinsi:</span>
                <div>{{ $mitra->provinsi }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Kabupaten:</span>
                <div>{{ $mitra->kabupaten }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Kecamatan:</span>
                <div>{{ $mitra->kecamatan }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Desa:</span>
                <div>{{ $mitra->desa }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Alamat Detail:</span>
                <div>{{ $mitra->alamat_detail }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Latitude:</span>
                <div>{{ $mitra->latitude }}</div>
            </div>
            <div class="mb-4">
                <span class="font-semibold">Longitude:</span>
                <div>{{ $mitra->longitude }}</div>
            </div>
        </div>
    </div>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <span class="font-semibold">Surat Tanah:</span>
            @if($mitra->surat_tanah)
                <a href="{{ asset('storage/' . $mitra->surat_tanah) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Download</a>
            @else
                <span class="text-gray-500 ml-2">Tidak ada file</span>
            @endif
        </div>
        <div>
            <span class="font-semibold">Kontrak:</span>
            @if($mitra->kontrak)
                <a href="{{ asset('storage/' . $mitra->kontrak) }}" target="_blank" class="text-blue-600 hover:underline ml-2">Download</a>
            @else
                <span class="text-gray-500 ml-2">Tidak ada file</span>
            @endif
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts') --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
{{-- @endpush  --}}