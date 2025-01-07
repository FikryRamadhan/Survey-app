<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-white">

    <main class="flex items-center justify-center min-h-screen px-4">
        <!-- Container -->
        <div class="max-w-lg w-full text-center bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-green-500 mb-4">Terima Kasih!</h1>
            <p class="text-gray-300 mb-6">Terima kasih telah mengisi survei kami. Pendapat Anda sangat berharga bagi kami
                untuk terus meningkatkan layanan kami.</p>

            <div class="mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500 mx-auto" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <a href="{{ route('app.survey') }}" class="text-lg font-medium text-blue-400 hover:text-blue-600">
                Kembali ke Halaman Utama
            </a>
        </div>
    </main>

</body>

</html>
