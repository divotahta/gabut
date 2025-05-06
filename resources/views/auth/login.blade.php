@extends('layouts.guest')

@section('content')
<div>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Selamat Datang Kembali
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
        Atau
        <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500 transition duration-150 ease-in-out">
            daftar akun baru
        </a>
    </p>
</div>

@if (session('success'))
    <div class="rounded-md bg-green-50 p-4 mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="rounded-md bg-red-50 p-4 mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">
                    {{ session('error') }}
                </p>
            </div>
        </div>
    </div>
@endif

<form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="space-y-4">
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out"
                    placeholder="Masukkan email Anda">
            </div>
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out"
                    placeholder="Masukkan password Anda">
            </div>
        </div>
    </div>
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <input id="remember_me" name="remember" type="checkbox" 
                class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded transition duration-150 ease-in-out">
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                Ingat saya
            </label>
        </div>
        <div class="text-sm">
            <a href="{{ route('password.request') }}" 
                class="font-medium text-green-600 hover:text-green-500 transition duration-150 ease-in-out">
                Lupa password?
            </a>
        </div>
    </div>
    <div>
        <button type="submit" 
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out transform hover:scale-[1.02]">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400 transition duration-150 ease-in-out" 
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </span>
            Masuk
        </button>
    </div>
</form>
@endsection
