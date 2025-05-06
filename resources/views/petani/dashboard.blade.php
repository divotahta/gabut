@extends('layouts.petani')
@section('title', 'Dashboard Petani')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <div class="bg-white shadow rounded-lg p-8">
        <h1 class="text-2xl font-bold text-green-700 mb-4">Selamat Datang di Dashboard Petani</h1>
        <p class="text-gray-700 mb-6">Halo <span class="font-semibold">{{ Auth::user()->name }}</span>,
            selamat datang di dashboard petani. Di sini Anda dapat mengelola pengajuan mitra, melihat status pengajuan, dan informasi lahan Anda.</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $totalMitra ?? 0 }}</div>
                <div class="text-gray-600">Total Pengajuan Mitra</div>
            </div>
            <div class="bg-blue-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalLahan ?? 0 }}</div>
                <div class="text-gray-600">Total Lahan</div>
            </div>
            <div class="bg-yellow-50 p-4 rounded-lg text-center">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $totalApproved ?? 0 }}</div>
                <div class="text-gray-600">Pengajuan Disetujui</div>
            </div>
        </div>
    </div>
</div>
@endsection 