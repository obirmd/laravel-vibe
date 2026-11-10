<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 px-4 py-12 text-gray-900">
    <main class="mx-auto max-w-md rounded-xl bg-white p-8 shadow-lg">
        <h1 class="text-2xl font-bold">Buat akun</h1>
        <p class="mt-2 text-sm text-gray-600">Daftar untuk mulai menggunakan aplikasi.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert">
                <ul class="list-inside list-disc">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium">Konfirmasi password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <button type="submit" class="w-full rounded-lg bg-gray-900 px-4 py-2 font-medium text-white hover:bg-gray-700">Daftar</button>
        </form>

        <p class="mt-6 text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:underline">Login</a></p>
    </main>
</body>
</html>
