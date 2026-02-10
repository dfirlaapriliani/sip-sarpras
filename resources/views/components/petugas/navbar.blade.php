<nav class="bg-white shadow px-6 py-3 flex justify-between items-center w-full">
    
    {{-- Left: Page Title --}}
    <div class="text-lg font-semibold text-gray-800">
        @yield('page-title', 'Dashboard Petugas')
    </div>

    {{-- Right: User Info --}}
    <div class="flex items-center gap-4">
        <span class="text-gray-600 text-sm">
            {{ auth()->user()->name ?? 'Petugas' }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm px-3 py-1 rounded bg-red-500 text-white hover:bg-red-600 transition">
                Logout
            </button>
        </form>
    </div>

</nav>
