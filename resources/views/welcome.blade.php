<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Mini</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded shadow-lg w-full max-w-lg text-center">
        <h1 class="text-4xl font-bold mb-6">Selamat Datang di Perpustakaan Mini</h1>
        <p class="mb-8 text-gray-700">Silakan login atau daftar untuk mulai meminjam buku</p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded shadow-md transition duration-200">
                Login
            </a>

            <a href="{{ route('register') }}" 
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded shadow-md transition duration-200">
                Register
            </a>
        </div>

        <hr class="my-6 border-gray-300">

        <p class="text-gray-600">Atau lihat daftar buku tanpa login:</p>
        <a href="{{ route('books.index') }}" 
           class="mt-2 inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded shadow-md transition duration-200">
           Lihat Daftar Buku
        </a>
    </div>
</body>
</html>
