<nav class="fixed top-0 left-0 lg:left-64 right-0 bg-gradient-to-br from-blue-50 via-white to-blue-50 shadow-md px-4 md:px-6 py-3 flex justify-between items-center w-full lg:w-auto z-30 border-b-2 border-blue-300" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">
    
    {{-- Left: Empty Space --}}
    <div class="flex items-center gap-3">
        {{-- Mobile Menu Button Spacer --}}
        <div class="w-10 lg:hidden"></div>
    </div>

    {{-- Right: User Profile Dropdown --}}
    <div class="relative">
        <button 
            onclick="toggleDropdown()" 
            class="flex items-center gap-2 md:gap-3 px-3 md:px-4 py-2 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md hover:shadow-lg transition-all duration-200 hover:scale-105"
        >
            {{-- Avatar --}}
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            
            {{-- Name (Hidden on mobile) --}}
            <span class="hidden md:block font-semibold text-sm">
                {{ auth()->user()->name ?? 'Petugas' }}
            </span>
            
            {{-- Arrow Icon --}}
            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" id="arrow-icon">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        {{-- Dropdown Menu --}}
        <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden z-50">
            {{-- User Info --}}
            <div class="px-4 py-3 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                <p class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Petugas' }}</p>
                <p class="text-xs text-blue-100 mt-1">{{ auth()->user()->email ?? 'petugas@example.com' }}</p>
            </div>

            {{-- Menu Items --}}
            <div class="py-2">
                <a href="#profile" class="flex items-center gap-3 px-4 py-2.5 hover:bg-gray-50 text-gray-700 hover:text-blue-600">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-sm font-medium">Profil Saya</span>
                </a>
            </div>

            {{-- Logout --}}
            <div class="border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 hover:bg-red-50 text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

</nav>

{{-- Spacer untuk konten agar tidak tertutup navbar fixed --}}
<div class="h-16"></div>

<script>
function toggleDropdown() {
    const dropdown = document.getElementById('dropdown-menu');
    const arrow = document.getElementById('arrow-icon');
    
    dropdown.classList.toggle('hidden');
    arrow.classList.toggle('rotate-180');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('dropdown-menu');
    const button = event.target.closest('button[onclick="toggleDropdown()"]');
    
    if (!button && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
        document.getElementById('arrow-icon').classList.remove('rotate-180');
    }
});
</script>

<style>
#arrow-icon {
    transition: transform 0.2s ease;
}

.rotate-180 {
    transform: rotate(180deg);
}
</style>