<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 px-4 py-12 text-gray-900">
    <main class="mx-auto max-w-3xl rounded-xl bg-white p-8 shadow-lg">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="mt-2 text-gray-600">Selamat datang, {{ auth()->user()->name }}.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-lg border border-gray-300 px-4 py-2 font-medium hover:bg-gray-50">Logout</button>
            </form>
        </div>
    </main>
</body>
</html>
