<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body 
    style="
        background-image: url('{{ asset('assets_admin/img/bg.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
    "
>

<div class="flex min-h-screen bg-white/50">

    {{-- Sidebar --}}
    @include('components.admin.sidebar')

    <div class="flex-1 flex flex-col">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Content --}}
        <main class="p-4 sm:p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
