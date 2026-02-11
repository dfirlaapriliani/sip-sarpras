<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PEMINJAM INVEX')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('components.peminjaman.sidebar')

    {{-- Main --}}
    <div class="flex-1 flex flex-col lg:ml-72">

        {{-- Navbar --}}
        @include('components.peminjaman.navbar')

        {{-- Content --}}
        <main class="pt-24 px-4 sm:px-6 pb-6">
            <div class="w-full max-w-6xl mx-auto">
                @yield('content')
            </div>
        </main>

    </div>

</div>

@stack('scripts')
</body>
</html>
