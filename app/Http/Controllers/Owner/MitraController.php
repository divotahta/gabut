<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Mitra;
use Illuminate\Support\Facades\Storage;

class MitraController extends Controller
{
    public function index(Request $request)
    {
        $query = Mitra::with('user')->latest();
        $kabupatenList = Mitra::distinct()->pluck('kabupaten')->sort();

        // Fitur pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($sub) use ($search) {
                $sub->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kabupaten
        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $mitras = $query->paginate(10)->withQueryString();
        return view('owner.mitra.index', compact('mitras', 'kabupatenList'));
    }

    public function create()
    {
        return view('owner.mitra.create');
    }

    public function show(Mitra $mitra)
    {
        return view('owner.mitra.show', compact('mitra'));
    }

    public function edit(Mitra $mitra)
    {
        return view('owner.mitra.edit', compact('mitra'));
    }

    public function update(Request $request, Mitra $mitra)
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
            'kontrak' => 'nullable|file|mimes:pdf|max:10240'
        ]);

        $data = $request->except(['surat_tanah', 'kontrak']);

        // Upload file surat tanah jika ada
        if ($request->hasFile('surat_tanah')) {
            // Hapus file lama jika ada
            if ($mitra->surat_tanah) {
                Storage::disk('public')->delete($mitra->surat_tanah);
            }
            $data['surat_tanah'] = $request->file('surat_tanah')->store('surat_tanah', 'public');
        }

        // Upload file kontrak jika ada
        if ($request->hasFile('kontrak')) {
            // Hapus file lama jika ada
            if ($mitra->kontrak) {
                Storage::disk('public')->delete($mitra->kontrak);
            }
            $data['kontrak'] = $request->file('kontrak')->store('kontrak', 'public');
        }

        $mitra->update($data);

        return redirect()->route('owner.mitra.index')
            ->with('success', 'Data mitra berhasil diperbarui.');
    }

    public function destroy(Mitra $mitra)
    {
        // Hapus file jika ada
        if ($mitra->surat_tanah) {
            Storage::disk('public')->delete($mitra->surat_tanah);
        }
        if ($mitra->kontrak) {
            Storage::disk('public')->delete($mitra->kontrak);
        }

        $mitra->delete();

        return redirect()->route('owner.mitra.index')
            ->with('success', 'Data mitra berhasil dihapus.');
    }

    public function approve(Mitra $mitra)
    {
        $mitra->update(['status' => 'disetujui']);
        
        return redirect()->route('owner.mitra.index')
            ->with('success', 'Mitra berhasil disetujui.');
    }

    public function reject(Mitra $mitra)
    {
        $mitra->update(['status' => 'ditolak']);
        
        return redirect()->route('owner.mitra.index')
            ->with('success', 'Mitra berhasil ditolak.');
    }

    public function laporan()
    {
        $laporan = Laporan::with('mitra')->get();
        return view('owner.mitra.laporan', compact('laporan'));
    }

    public function pengajuan()
    {
        $mitras = Mitra::where('status', 'menunggu')->paginate(10);
        return view('owner.mitra.pengajuan', compact('mitras'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $kabupatenList = Mitra::distinct()->pluck('kabupaten')->sort();
        $kabupaten = $kabupatenList;
        
        $mitras = Mitra::where('status', 'disetujui')
            ->where(function($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('kabupaten', 'like', "%{$search}%")
                    ->orWhere('telepon', 'like', "%{$search}%");
            })
            ->get();

        if ($request->ajax()) {
            $html = view('owner.laporan._mitra_list', compact('mitras'))->render();
            return response()->json([
                'html' => $html
            ]);
        }

        return view('owner.laporan.index', compact('mitras'));
    }
} 