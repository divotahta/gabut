<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AkunController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('owner.akun.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'no_telepon' => 'nullable|string|max:20',
            'password' => 'nullable|min:8|confirmed',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()) {
            // Hapus foto lama jika ada
            if ($user->foto_profil) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            // Upload foto baru
            $file = $request->file('foto_profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/foto-profil'), $fileName);
            $user->foto_profil = 'foto-profil/' . $fileName;
        }

        $user->save();

        return redirect()->route('owner.akun.index')
            ->with('success', 'Profil berhasil diperbarui');
    }
}
