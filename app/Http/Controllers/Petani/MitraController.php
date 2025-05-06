<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index()
    {
        $mitra = Mitra::where('user_id', Auth::id())->get();
        return view('petani.mitra.index', compact('mitra'));
    }

    public function create()
    {
        return view('petani.mitra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'luas_lahan' => 'required|numeric|min:0',
            'pohon' => 'nullable|numeric|min:0',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'alamat_detail' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'surat_tanah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'kontrak' => 'required|file|mimes:pdf|max:10240'
        ]);

        // Upload file surat tanah jika ada
        $suratTanahPath = null;
        if ($request->hasFile('surat_tanah')) {
            $suratTanahPath = $request->file('surat_tanah')->store('surat_tanah', 'public');
        }

        // Upload file kontrak
        $kontrakPath = $request->file('kontrak')->store('kontrak', 'public');

        // Simpan data pengajuan
        $mitra = Mitra::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'luas_lahan' => $request->luas_lahan,
            'jumlah_pohon' => $request->pohon,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat_detail' => $request->alamat_detail,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'surat_tanah' => $suratTanahPath,
            'kontrak' => $kontrakPath,
            'status' => 'menunggu'
        ]);

        return redirect()->route('petani.mitra.index')
                ->with('success', 'Pengajuan mitra berhasil dikirim. Silahkan tunggu konfirmasi dari admin.');
    }
} 