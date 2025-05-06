<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil total mitra
        // $totalMitra = Mitra::count();
        $mitra = Mitra::all();
        $totalMitra = 0;
        foreach ($mitra as $m) {
            if ($m->status == 'disetujui') {
                $totalMitra = $totalMitra + 1;
            }
        }
        
        // Mengambil total pegawai
        $totalPegawai = User::where('role', 'pegawai')->count();
        
        // Mengambil total petani
        $totalPetani = User::where('role', 'petani')->count();
        
        // Mengambil pengajuan baru (status menunggu)
        $pengajuanBaru = Mitra::where('status', 'menunggu')->count();
        
        // Mengambil pengajuan terbaru
        $pengajuanTerbaru = Mitra::with('user')
            ->latest()
            ->take(5)
            ->get();
        
        // Data untuk grafik pengajuan (6 bulan terakhir)
        $chartData = Mitra::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
        
        $chartLabels = [];
        $chartValues = [];
        
        foreach ($chartData as $data) {
            $chartLabels[] = date('F', mktime(0, 0, 0, $data->bulan, 1));
            $chartValues[] = $data->total;
        }
        
        return view('owner.dashboard', compact(
            'totalMitra',
            'totalPegawai',
            'totalPetani',
            'pengajuanBaru',
            'pengajuanTerbaru',
            'chartLabels',
            'chartValues'
        ));
    }
} 