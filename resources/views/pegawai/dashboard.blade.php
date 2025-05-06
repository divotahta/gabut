@extends('layouts.app')

@section('title', 'Dashboard Pegawai')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard Pegawai</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Total Mitra</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $totalMitra }}</h5>
                                    <a href="{{ route('pegawai.mitra.index') }}" class="text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-header">Laporan Hari Ini</div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $laporanHariIni }}</h5>
                                    <a href="{{ route('pegawai.laporan.index') }}" class="text-white">Lihat Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 