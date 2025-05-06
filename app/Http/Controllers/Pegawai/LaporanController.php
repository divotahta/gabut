<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::where('user_id', Auth::id())
            ->with('mitra')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pegawai.laporan.index', compact('laporans'));
    }
} 