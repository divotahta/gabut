@extends('layouts.guest')

@section('content')
<div>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Daftar Akun Petani
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
        Atau
        <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500 transition duration-150 ease-in-out">
            masuk ke akun yang sudah ada
        </a>
    </p>
</div>

@if ($errors->any())
    <div class="rounded-md bg-red-50 p-4 mt-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">
                    Terdapat kesalahan dalam pengisian form:
                </h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif

<form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
    @csrf
    <input type="hidden" name="role" value="petani">
    
    <div class="space-y-4">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <div class="mt-1">
                <input id="name" name="name" type="text" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out @error('name') border-red-300 @enderror"
                    placeholder="Masukkan nama lengkap Anda"
                    value="{{ old('name') }}">
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input id="email" name="email" type="email" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out @error('email') border-red-300 @enderror"
                    placeholder="Masukkan email Anda"
                    value="{{ old('email') }}">
            </div>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out @error('password') border-red-300 @enderror"
                    placeholder="Masukkan password Anda">
            </div>
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required 
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-150 ease-in-out"
                    placeholder="Masukkan ulang password Anda">
            </div>
        </div>
    </div>

    <div>
        <button type="submit" 
            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out transform hover:scale-[1.02]">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-green-500 group-hover:text-green-400 transition duration-150 ease-in-out" 
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                </svg>
            </span>
            Daftar sebagai Petani
        </button>
    </div>
</form>
@endsection
