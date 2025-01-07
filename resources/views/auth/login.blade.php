<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="w-full mx-5 max-w-4xl bg-gray-800 rounded-lg shadow-lg overflow-hidden flex">
        <!-- Left Section -->
        <div class="hidden md:flex items-center justify-center w-1/2 bg-gray-800">
            <div class="flex flex-col items-center text-center p-6">
                <h2 class="text-2xl font-bold text-white">Selamat Datang!</h2>
                <p class="mt-4 text-white font-medium">Mari bersama-sama ciptakan lingkungan yang lebih baik dengan
                    melaporkan permasalahan masyarakat. Kami siap mendengarkan!</p>
            </div>
        </div>

        <!-- Right Section -->
        <div class="w-full md:w-1/2 p-8">
            <form action="{{ route('auth.login.process') }}" method="POST">
                <!-- Pesan Error -->
                @if (session('error'))
                    <div class="mb-4 px-4 py-3 bg-red-500 text-white rounded-lg shadow">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 bg-green-500 text-white rounded-lg shadow">
                        {{ session('success') }}
                    </div>
                @endif
                @csrf
                <!-- Email Input -->
                <div class="mb-4">
                    <label for="email" class="block text-white mb-2">Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V5a4 4 0 10-8 0v6m12 0a4 4 0 11-8 0m0 0v4m4 4H8" />
                            </svg>
                        </span>
                        <input type="text" name="email" placeholder="Masukan email Anda "
                            class="w-full pl-10 pr-4 py-2 rounded-lg border focus:outline-none focus:ring-2
                            @error('email') border-red-500 focus:ring-red-500 @else border-gray-900 focus:ring-green-500 @enderror">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="mb-6">
                    <label for="password" class="block text-white mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v-3m0 0a4 4 0 114 4H8a4 4 0 114-4m0 0v3" />
                            </svg>
                        </span>
                        <input type="password" name="password" placeholder="Masukan password Anda"
                            class="w-full pl-10 pr-4 py-2 rounded-lg border focus:outline-none focus:ring-2
                            @error('password') border-red-500 focus:ring-red-500 @else border-gray-900 focus:ring-green-500 @enderror">
                    </div>
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-green-600 text-white font-bold py-2 rounded-lg hover:bg-green-700 transition">LOGIN</button>

                <!-- Register Link -->
                <div class="flex items-center justify-center mt-4">
                    <span class="text-white">Belum punya akun?</span>
                    <a href="{{ route('auth.register') }}" class="text-sm ml-2 text-blue-600 hover:underline">Daftar disini!</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Toastr Script -->
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>
</body>

</html>
