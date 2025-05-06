<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laporan;
use App\Models\Mitra;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $mitras = Mitra::all();
        $selectedMitra = null;
        $laporans = collect();

        if ($request->has('mitra_id')) {
            $selectedMitra = Mitra::findOrFail($request->mitra_id);
            $laporans = Laporan::with(['mitra', 'pegawai'])
                ->where('mitra_id', $request->mitra_id)
                ->latest()
                ->paginate(9);

            if ($request->ajax()) {
                $view = view('owner.laporan._laporan_list', compact('laporans'))->render();
                $pagination = $laporans->appends(request()->query())->links()->toHtml();
                
                return response()->json([
                    'html' => $view,
                    'pagination' => $pagination
                ]);
            }
        }

        return view('owner.laporan.index', compact('mitras', 'selectedMitra', 'laporans'));
    }

    public function create()
    {
        $mitras = Mitra::all();
        $pegawais = User::where('role', 'pegawai')->get();
        return view('owner.laporan.create', compact('mitras', 'pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitra,id',
            'pegawai_id' => 'required|exists:users,id',
            'tanggal_laporan' => 'required|date',
            'keterangan' => 'required|string',
            'media_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'media_video' => 'nullable|mimes:mp4,mov,avi|max:10240',
            'metode' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('media_foto')) {
            $data['media_foto'] = $request->file('media_foto')->store('laporan/foto', 'public');
        }

        if ($request->hasFile('media_video')) {
            $data['media_video'] = $request->file('media_video')->store('laporan/video', 'public');
        }

        Laporan::create($data);

        return redirect()->route('owner.laporan.index', ['mitra_id' => $request->mitra_id])
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    public function show(Laporan $laporan)
    {
        return view('owner.laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $mitras = Mitra::all();
        $pegawais = User::where('role', 'pegawai')->get();
        return view('owner.laporan.edit', compact('laporan', 'mitras', 'pegawais'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'mitra_id' => 'required|exists:mitra,id',
            'pegawai_id' => 'required|exists:users,id',
            'tanggal_laporan' => 'required|date',
            'keterangan' => 'required|string',
            'media_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'media_video' => 'nullable|mimes:mp4,mov,avi|max:10240',
            'metode' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('media_foto')) {
            // Hapus foto lama jika ada
            if ($laporan->media_foto) {
                Storage::disk('public')->delete($laporan->media_foto);
            }
            $data['media_foto'] = $request->file('media_foto')->store('laporan/foto', 'public');
        }

        if ($request->hasFile('media_video')) {
            // Hapus video lama jika ada
            if ($laporan->media_video) {
                Storage::disk('public')->delete($laporan->media_video);
            }
            $data['media_video'] = $request->file('media_video')->store('laporan/video', 'public');
        }

        $laporan->update($data);

        return redirect()->route('owner.laporan.index', ['mitra_id' => $request->mitra_id])
            ->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy(Laporan $laporan)
    {
        // Hapus file media jika ada
        if ($laporan->media_foto) {
            Storage::disk('public')->delete($laporan->media_foto);
        }
        if ($laporan->media_video) {
            Storage::disk('public')->delete($laporan->media_video);
        }

        $mitraId = $laporan->mitra_id;
        $laporan->delete();

        return redirect()->route('owner.laporan.index', ['mitra_id' => $mitraId])
            ->with('success', 'Laporan berhasil dihapus');
    }

    public function search(Request $request)
    {
        try {
            $mitraId = $request->mitra_id;
            $search = $request->search;

            $query = Laporan::with(['pegawai', 'mitra'])
                ->when($mitraId, function($query) use ($mitraId) {
                    return $query->where('mitra_id', $mitraId);
                });

            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%")
                      ->orWhere('keterangan', 'like', "%{$search}%");
                });
            }

            $laporans = $query->latest()->paginate(9);

            if ($request->ajax()) {
                $view = view('owner.laporan._laporan_list', compact('laporans'))->render();
                $pagination = $laporans->appends(request()->query())->links()->toHtml();
                
                return response()->json([
                    'html' => $view,
                    'pagination' => $pagination
                ]);
            }

            $mitras = Mitra::all();
            $selectedMitra = Mitra::find($mitraId);
            return view('owner.laporan.index', compact('laporans', 'mitras', 'selectedMitra'));
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => 'Terjadi kesalahan saat melakukan pencarian'
                ], 500);
            }
            return back()->with('error', 'Terjadi kesalahan saat melakukan pencarian');
        }
    }
} 