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