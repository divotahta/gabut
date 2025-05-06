<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'petani',
        ]);

        Auth::login($user);

        if (Auth::user()->role == 'owner') {
            return redirect(route('owner.dashboard', absolute: false));
        } else if (Auth::user()->role == 'pegawai') {
            return redirect(route('pegawai.dashboard', absolute: false));
        } else {
            return redirect(route('petani.dashboard', absolute: false));
        }
    }
} 