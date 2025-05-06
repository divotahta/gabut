@extends('layouts.owner')

@section('header', 'Edit Pegawai')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <form action="{{ route('owner.pegawai.update', $pegawai) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="px-4 py-5 bg-white sm:p-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pegawai->name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pegawai->email) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-300 @enderror">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <label for="status_akun" class="block text-sm font-medium text-gray-700">Status Akun</label>
                    <select name="status_akun" id="status_akun" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1" {{ old('status_akun', $pegawai->status_akun) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ !old('status_akun', $pegawai->status_akun) ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            <a href="{{ route('owner.pegawai.show', $pegawai) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection 