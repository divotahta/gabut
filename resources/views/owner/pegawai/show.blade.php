@extends('layouts.owner')

@section('header', 'Detail Pegawai')

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex items-center gap-6">
        @if($pegawai->foto_profil)
            <img src="{{ asset('storage/' . $pegawai->foto_profil) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover border">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($pegawai->name) }}&background=4f46e5&color=fff&size=96" alt="Avatar Default" class="w-24 h-24 rounded-full object-cover border">
        @endif
        <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Informasi Pegawai
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Detail informasi pegawai
            </p>
        </div>
    </div>
    <div class="border-t border-gray-200">
        <dl>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Nama
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $pegawai->name }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Email
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $pegawai->email }}
                </dd>
            </div>
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Terdaftar Pada
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $pegawai->created_at->format('d/m/Y H:i') }}
                </dd>
            </div>
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">
                    Status Akun
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <span class="inline-flex px-2 text-xs font-semibold leading-5 rounded-full
                        @if($pegawai->status_akun)
                            bg-green-100 text-green-800
                        @else
                            bg-red-100 text-red-800
                        @endif">
                        {{ $pegawai->status_akun ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </dd>
            </div>
        </dl>
    </div>
</div>

<div class="mt-6 flex justify-end space-x-3">
    <a href="{{ route('owner.pegawai.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Kembali
    </a>
    <a href="{{ route('owner.pegawai.edit', $pegawai) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
        Edit
    </a>
</div>
@endsection 