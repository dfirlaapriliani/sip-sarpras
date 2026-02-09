<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Admin Panel - Manage your application">
    <meta name="robots" content="noindex, nofollow">
    
    <title>@yield('title', 'Admin Panel')</title>
    
    <!-- Preload Critical Resources -->
    <link rel="preload" as="image" href="{{ asset('assets_admin/img/bg.jpeg') }}">
    <link rel="preconnect" href="https://cdn.tailwindcss.com">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Partial Links -->
    @include('layout_admin.partial_admin.link')
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets_admin/css/admin-layout.css') }}">
    
    @stack('styles')
</head>

<body>

<div class="flex min-h-screen">

    {{-- Sidebar - Fixed --}}
    @include('components.admin.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col lg:ml-64 w-full">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Content --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    
        {{-- Footer --}}
        @include('components.admin.footer')
    </div>

</div>

<!-- JavaScript -->
<script src="{{ asset('assets_admin/js/admin-layout.js') }}"></script>
@stack('scripts')

</body>
</html>