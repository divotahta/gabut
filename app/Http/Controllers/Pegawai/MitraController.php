<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class MitraController extends Controller
{
    public function index()
    {
        $mitra = Mitra::with('user')->get();
        return view('pegawai.mitra.index', compact('mitra'));
    }

    public function edit(Mitra $mitra)
    {
        return view('pegawai.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, Mitra $mitra)
    {
        $mitra->update($request->all());
        return redirect()->route('pegawai.mitra.index')->with('success', 'Data mitra berhasil diperbarui');
    }

    public function laporan(Mitra $mitra)
    {
        $laporans = Laporan::where('mitra_id', $mitra->id)
            ->where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pegawai.mitra.laporan', compact('mitra', 'laporans'));
    }

    public function createLaporan()
    {
        return view('pegawai.mitra.create-laporan');
    }


    public function storeLaporan(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitra,id',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
        ]);

        Laporan::create($request->all());
        return redirect()->route('pegawai.mitra.laporan')->with('success', 'Laporan berhasil dibuat');
    }
} 