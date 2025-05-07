@extends('layouts.petani')

@section('title', 'Detail Mitra')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6">
            <!-- Tombol Kembali -->
            <div class="mb-6">
                <a href="{{ route('petani.mitra.index') }}" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Mitra</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Informasi Umum</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Status</label>
                            <div class="mt-1">
                                @if($mitra->status == 'menunggu')
                                    <span class="px-2 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                @elseif($mitra->status == 'disetujui')
                                    <span class="px-2 py-1 text-sm rounded-full bg-green-100 text-green-800">Disetujui</span>
                                @else
                                    <span class="px-2 py-1 text-sm rounded-full bg-red-100 text-red-800">Ditolak</span>
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <div class="mt-1 text-gray-900">{{ $mitra->nama_lengkap }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 text-gray-900">{{ $mitra->email }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <div class="mt-1 text-gray-900">{{ $mitra->telepon }}</div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4">Informasi Lahan</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Luas Lahan</label>
                            <div class="mt-1 text-gray-900">{{ $mitra->luas_lahan }} m²</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Pohon</label>
                            <div class="mt-1 text-gray-900">{{ $mitra->jumlah_pohon }}</div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                            <div class="mt-1 text-gray-900">
                                {{ $mitra->alamat_detail }}, 
                                Desa {{ $mitra->desa }}, 
                                Kec. {{ $mitra->kecamatan }}, 
                                Kab. {{ $mitra->kabupaten }}, 
                                Prov. {{ $mitra->provinsi }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-lg font-semibold mb-4">Dokumen</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Lahan</label>
                            <img src="{{ asset('storage/' . $mitra->media_lahan) }}" 
                                 alt="Foto Lahan" 
                                 class="w-full h-48 object-cover rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surat Tanah</label>
                            <a href="{{ asset('storage/' . $mitra->surat_tanah) }}" 
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kontrak</label>
                            <a href="{{ asset('storage/' . $mitra->kontrak) }}" 
                               target="_blank"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                <i class="fas fa-file-pdf mr-2"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
