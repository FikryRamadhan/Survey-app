<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Survey-app</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-4xl bg-gray-800 rounded-lg shadow-lg overflow-hidden flex">
        <!-- Left Section -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-gray-800">
            <div class="flex flex-col items-center text-center p-6">
                <h2 class="text-2xl font-bold text-white">Selamat Datang!</h2>
                <p class="mt-4 text-white font-medium">Daftar sekarang untuk mulai melaporkan masalah di lingkungan Anda dan menjadi bagian dari perubahan positif di masyarakat. Suara Anda sangat berarti!</p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="w-full md:w-1/2 p-8">
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-white">Daftar</h2>
            </div>

            <form action="{{ route('auth.register.process') }}" method="POST">
                @csrf

                @if (session('error'))
                    <div class="mb-4 px-4 py-3 bg-red-500 text-white rounded-lg shadow">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-white mb-2">Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0a4 4 0 114 4H8a4 4 0 114-4m0 0v3" />
                            </svg>
                        </span>
                        <input type="text" name="name" placeholder="Masukkan nama Anda" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('name') }}">
                    </div>
                    @error('name')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-white mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0a4 4 0 114 4H8a4 4 0 114-4m0 0v3" />
                            </svg>
                        </span>
                        <input type="email" id="email" name="email" placeholder="Masukkan email Anda" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0a4 4 0 114 4H8a4 4 0 114-4m0 0v3" />
                            </svg>
                        </span>
                        <input type="password" id="password" name="password" placeholder="Masukkan password Anda" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-white mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0 0a4 4 0 114 4H8a4 4 0 114-4m0 0v3" />
                            </svg>
                        </span>
                        <input type="password" name="password_confirmation" placeholder="Konfirmasi password Anda" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-900 focus:outline-none focus:ring-2 focus:ring-green-500">
                    </div>
                    @error('password_confirmation')
                        <div class="text-red-500 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-600 transition">DAFTAR</button>

                <div class="flex items-center justify-center mt-6">
                    <span class="text-white">Sudah punya akun?</span><a href="{{ route('auth.login') }}" class="text-sm ml-2 text-blue-600 hover:underline">Klik untuk login!</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
