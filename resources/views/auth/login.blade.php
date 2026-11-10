<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 px-4 py-12 text-gray-900">
    <main class="mx-auto max-w-md rounded-xl bg-white p-8 shadow-lg">
        <h1 class="text-2xl font-bold">Login</h1>
        <p class="mt-2 text-sm text-gray-600">Masuk ke akun Anda.</p>

        @if ($errors->any())
            <div class="mt-6 rounded-lg bg-red-50 p-4 text-sm text-red-700" role="alert">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2">
            </div>
            <button type="submit" class="w-full rounded-lg bg-gray-900 px-4 py-2 font-medium text-white hover:bg-gray-700">Login</button>
        </form>

        <p class="mt-6 text-sm text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline">Register</a></p>
    </main>
</body>
</html>
