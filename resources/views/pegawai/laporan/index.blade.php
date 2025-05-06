@extends('layouts.app')

@section('title', 'Daftar Laporan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Daftar Laporan</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Mitra</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($laporans as $laporan)
                                <tr>
                                    <td>{{ $laporan->tanggal->format('d/m/Y') }}</td>
                                    <td>{{ $laporan->mitra->nama_usaha }}</td>
                                    <td>{{ $laporan->keterangan }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 