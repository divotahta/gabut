<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mitra;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::where('user_id', Auth::id())->paginate(10);
        $kabupatenList = Mitra::where('user_id', Auth::id())->select('kabupaten')->distinct()->pluck('kabupaten');
        return view('petani.mitra.index', compact('mitras', 'kabupatenList'));
    }

    public function create()
    {
        return view('petani.mitra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama_lengkap' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'luas_lahan' => 'required|numeric',
            'jumlah_pohon' => 'required|integer',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'alamat_detail' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'media_lahan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'surat_tanah' => 'required|file|mimes:pdf|max:2048',
            'kontrak' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Upload media lahan
        $mediaLahan = $request->file('media_lahan');
        $mediaLahanName = time() . '_' . $mediaLahan->getClientOriginalName();
        $mediaLahan->move(public_path('storage/media-lahan'), $mediaLahanName);
        $mediaLahanPath = 'media-lahan/' . $mediaLahanName;
        
        // Upload surat tanah
        $suratTanah = $request->file('surat_tanah');
        $suratTanahName = time() . '_' . $suratTanah->getClientOriginalName();
        $suratTanah->move(public_path('storage/surat-tanah'), $suratTanahName);
        $suratTanahPath = 'surat-tanah/' . $suratTanahName;
        
        // Upload kontrak
        $kontrak = $request->file('kontrak');
        $kontrakName = time() . '_' . $kontrak->getClientOriginalName();
        $kontrak->move(public_path('storage/kontrak'), $kontrakName);
        $kontrakPath = 'kontrak/' . $kontrakName;

        // Buat data mitra baru
        Mitra::create([
            'user_id' => Auth::id(),
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'telepon' => $request->telepon,
            'luas_lahan' => $request->luas_lahan,
            'jumlah_pohon' => $request->jumlah_pohon,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat_detail' => $request->alamat_detail,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'media_lahan' => $mediaLahanPath,
            'surat_tanah' => $suratTanahPath,
            'kontrak' => $kontrakPath,
            'status' => 'menunggu'
        ]);

        return redirect()->route('petani.mitra.index');
    }

    public function show($id)
    {
        // Ambil data mitra dan pastikan milik petani yang login
        $mitra = Mitra::where('id', $id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail(); // akan throw 404 jika tidak ditemukan
        
        return view('petani.mitra.show', compact('mitra'));
    }
} 