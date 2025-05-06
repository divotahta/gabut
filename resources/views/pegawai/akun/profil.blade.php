@extends('layouts.app')

@section('title', 'Profil Pegawai')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Profil Pegawai</h3>
    </div>
    <div class="border-t border-gray-200">
        <form action="{{ route('pegawai.profil.update') }}" method="POST" class="px-4 py-5 sm:p-6">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Simpan Perubahan
                </button>
            </div>
        </form>

        <div class="px-4 py-5 sm:p-6">
            <h4 class="text-lg font-medium text-gray-900 mb-4">Ubah Password</h4>
            <form action="{{ route('pegawai.password.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_lama" class="block text-sm font-medium text-gray-700">Password Lama</label>
                        <input type="password" name="password_lama" id="password_lama" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_baru" class="block text-sm font-medium text-gray-700">Password Baru</label>
                        <input type="password" name="password_baru" id="password_baru" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_baru_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 