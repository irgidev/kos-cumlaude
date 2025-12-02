<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kos Cumlaude</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-600 to-blue-800 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-2xl w-96 transform transition duration-500 hover:scale-105">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-extrabold text-blue-800">Kos Cumlaude</h1>
            <p class="text-gray-500 text-sm mt-2">Sistem Informasi Manajemen Kos</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4 text-sm text-center border border-red-400">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <!-- Pilihan Role -->
            <div class="flex justify-center mb-6 bg-gray-200 p-1 rounded-lg">
                <label class="cursor-pointer w-1/2 text-center">
                    <input type="radio" name="role" value="staf" class="peer sr-only" checked>
                    <!-- UBAH: peer-checked:text-blue-600 -->
                    <div class="peer-checked:bg-white peer-checked:text-blue-800 peer-checked:shadow text-gray-500 py-2 rounded-md transition font-bold">Staf</div>
                </label>
                <label class="cursor-pointer w-1/2 text-center">
                    <input type="radio" name="role" value="penghuni" class="peer sr-only">
                    <!-- UBAH: peer-checked:text-blue-600 (Sebelumnya Hijau) -->
                    <div class="peer-checked:bg-white peer-checked:text-blue-800 peer-checked:shadow text-gray-500 py-2 rounded-md transition font-bold">Penghuni</div>
                </label>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Pengguna</label>
                <input type="text" name="username" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nama Staf / Nama Penghuni" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password (No. Telepon)</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="08xxxxxxxxxx" required>
            </div>
            <button type="submit" class="w-full bg-blue-800 text-white font-bold py-2 px-4 rounded hover:bg-blue-900 transition shadow-lg">
                Masuk Sistem
            </button>
        </form>
    </div>

</body>
</html>