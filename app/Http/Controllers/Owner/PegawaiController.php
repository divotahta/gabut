<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::where('role', 'pegawai')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('owner.pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        return view('owner.pegawai.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'status_akun' => 'required|boolean',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['role'] = 'pegawai';
        $validated['status_akun'] = (bool) $request->status_akun;

        User::create($validated);

        return redirect()->route('owner.pegawai.index')
            ->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function show(User $pegawai)
    {
        return view('owner.pegawai.show', compact('pegawai'));
    }

    public function edit(User $pegawai)
    {
        return view('owner.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, User $pegawai)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $pegawai->id,
            'status_akun' => 'required|boolean',
        ]);

        $validated['status_akun'] = (bool) $request->status_akun;

        $pegawai->update($validated);

        return redirect()->route('owner.pegawai.show', $pegawai)
            ->with('success', 'Data pegawai berhasil diperbarui');
    }

    public function destroy(User $pegawai)
    {
        $pegawai->delete();

        return redirect()->route('owner.pegawai.index')
            ->with('success', 'Pegawai berhasil dihapus');
    }
} 