<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Mitra;
use App\Models\Laporan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $data = [
            'totalMitra' => Mitra::count(),
            'laporanHariIni' => Laporan::where('user_id', $user->id)
                ->whereDate('tanggal', today())
                ->count()
        ];

        return view('pegawai.dashboard', $data);
    }
} 