<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PETUGAS INVEX')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
</head>

<body>

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('components.petugas.sidebar')

    {{-- Main --}}
    <div class="flex-1 flex flex-col lg:ml-64 w-full">

        {{-- Navbar --}}
        @include('components.petugas.navbar')

        {{-- Content --}}
        <main class="flex-1 p-4 sm:p-6 flex justify-center">
            <div class="w-full max-w-6xl">
                @yield('content')
            </div>
        </main>

    </div>

</div>

@stack('scripts')

</body>
</html>
