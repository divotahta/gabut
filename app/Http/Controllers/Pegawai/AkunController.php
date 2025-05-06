<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function profil()
    {
        return view('pegawai.akun.profil');
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        $user->update($request->all());
        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();
        
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return back()->with('success', 'Password berhasil diubah');
    }
} 