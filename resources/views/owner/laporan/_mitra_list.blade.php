@forelse($mitras as $mitra)
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
        Tidak ada mitra yang ditemukan
    </div>
</div>
@endforelse 