@extends('layouts.owner')

@section('header', 'Profil Saya')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header Profil -->
        <div class="relative h-48 bg-gradient-to-r from-emerald-500 to-teal-600">
            <div class="absolute -bottom-16 left-8">
                <div class="relative">
                    <div id="fotoPreview" class="relative">
                        @if($user->foto_profil)
                            <img src="{{ Storage::url($user->foto_profil) }}" alt="Foto Profil" class="w-32 h-32 rounded-full border-4 border-white object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="Foto Profil" class="w-32 h-32 rounded-full border-4 border-white object-cover">
                        @endif
                        <div id="uploadButton" class="hidden absolute bottom-0 right-0 bg-white rounded-full p-2 shadow-lg hover:bg-gray-100 transition duration-200 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Profil -->
        <div class="pt-20 pb-8 px-8">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-600">{{ $user->email }}</p>
                </div>
                <button onclick="toggleEditMode()" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit Profil
                </button>
            </div>

            <!-- Form Edit Profil (Hidden by default) -->
            <form id="editForm" action="{{ route('owner.akun.update') }}" method="POST" enctype="multipart/form-data" class="hidden">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" name="no_telepon" value="{{ $user->no_telepon }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                    </div>
                </div>

                <input type="file" id="foto_profil" name="foto_profil" class="hidden" accept="image/*" onchange="previewFoto(this)">

                <div class="mt-6 flex justify-end space-x-4">
                    <button type="button" onclick="toggleEditMode()" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

            <!-- Informasi Profil (Visible by default) -->
            <div id="profileInfo" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nama Lengkap</h3>
                    <p class="text-gray-900">{{ $user->name }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Email</h3>
                    <p class="text-gray-900">{{ $user->email }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Nomor Telepon</h3>
                    <p class="text-gray-900">{{ $user->no_telepon ?? '-' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-1">Bergabung Sejak</h3>
                    <p class="text-gray-900">{{ $user->created_at->format('d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleEditMode() {
        const editForm = document.getElementById('editForm');
        const profileInfo = document.getElementById('profileInfo');
        const uploadButton = document.getElementById('uploadButton');
        
        if (editForm.classList.contains('hidden')) {
            editForm.classList.remove('hidden');
            profileInfo.classList.add('hidden');
            uploadButton.classList.remove('hidden');
        } else {
            editForm.classList.add('hidden');
            profileInfo.classList.remove('hidden');
            uploadButton.classList.add('hidden');
        }
    }

    function previewFoto(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const fotoPreview = document.querySelector('#fotoPreview img');
                fotoPreview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            // console.log(input.files[0]);
        }
    }

    // Menambahkan event listener untuk tombol upload
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('foto_profil').click();
    });
</script>
@endpush
@endsection 