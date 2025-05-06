@extends('layouts.owner')

@section('header', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-6 mb-6 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Total Mitra -->
    <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
        <div class="flex items-center">
            <div class="p-3 bg-emerald-100 rounded-full">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Mitra</h3>
                <p class="text-2xl font-bold text-emerald-600">{{ $totalMitra }}</p>
            </div>
        </div>
    </div>

    <!-- Total Pegawai -->
    <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Pegawai</h3>
                <p class="text-2xl font-bold text-blue-600">{{ $totalPegawai }}</p>
            </div>
        </div>
    </div>

    <!-- Pengajuan Baru -->
    <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
        <div class="flex items-center">
            <div class="p-3 bg-amber-100 rounded-full">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Pengajuan Baru</h3>
                <p class="text-2xl font-bold text-amber-600">{{ $pengajuanBaru }}</p>
            </div>
        </div>
    </div>

    <!-- Total Petani -->
    <div class="p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition duration-300">
        <div class="flex items-center">
            <div class="p-3 bg-violet-100 rounded-full">
                <svg class="w-6 h-6 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Petani</h3>
                <p class="text-2xl font-bold text-violet-600">{{ $totalPetani }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Grafik dan Tabel -->
<div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Grafik Pengajuan -->
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Statistik Pengajuan Mitra</h3>
            <div class="flex items-center space-x-2">
                <span class="px-2 py-1 text-xs font-semibold text-emerald-800 bg-emerald-100 rounded-full">Disetujui</span>
                <span class="px-2 py-1 text-xs font-semibold text-amber-800 bg-amber-100 rounded-full">Menunggu</span>
                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
            </div>
        </div>
        <div class="h-80">
            <canvas id="pengajuanChart"></canvas>
        </div>
    </div>

    <!-- Tabel Pengajuan Terbaru -->
    <div class="p-6 bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-700">Pengajuan Terbaru</h3>
            <a href="{{ route('owner.mitra.pengajuan') }}" class="text-sm text-blue-600 hover:text-blue-800">
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pengajuanTerbaru as $pengajuan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if($pengajuan->foto_profil)
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($pengajuan->foto_profil) }}" alt="{{ $pengajuan->nama }}">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $pengajuan->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $pengajuan->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pengajuan->created_at->format('d M Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $pengajuan->created_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold leading-5 rounded-full
                                {{ $pengajuan->status == 'disetujui' ? 'bg-emerald-100 text-emerald-800' : 
                                   ($pengajuan->status == 'ditolak' ? 'bg-red-100 text-red-800' : 
                                   'bg-amber-100 text-amber-800') }}">
                                {{ ucfirst($pengajuan->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk grafik
    const ctx = document.getElementById('pengajuanChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: {!! json_encode($chartValues) !!},
                borderColor: 'rgb(16, 185, 129)',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection 