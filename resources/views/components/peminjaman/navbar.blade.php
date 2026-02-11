<!-- Navbar Component - 3D White Blue Theme -->
<header class="fixed top-0 right-0 left-0 lg:left-72 z-30 bg-gradient-to-r from-white via-blue-50 to-white shadow-lg backdrop-blur-sm bg-opacity-95">
    
    <div class="px-6 py-4 flex justify-between items-center">
        
        <!-- Page Title with 3D Effect -->
        <div class="flex items-center space-x-4">
            <!-- Mobile Menu Toggle (visible on mobile only) -->
            <button id="mobileMenuToggle" class="lg:hidden p-2 rounded-lg bg-white shadow-md hover:shadow-lg transition-all duration-300 group">
                <svg class="w-6 h-6 text-blue-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            
            <!-- Title -->
            <div class="relative">
                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    @yield('page-title', 'Dashboard Peminjam')
                </h1>
                <div class="absolute -bottom-1 left-0 h-1 w-16 bg-gradient-to-r from-blue-500 to-transparent rounded-full"></div>
            </div>
        </div>

        <!-- Right Section: Profile Dropdown -->
        <div class="flex items-center space-x-4">
            
            <!-- Notification Button (Optional) -->
            <button class="relative p-2.5 rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300 group hidden sm:block">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <!-- Notification Badge -->
                <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-red-500 to-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold shadow-lg">3</span>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative" id="profileDropdown">
                <!-- Profile Button -->
                <button id="profileButton" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300 group">
                    <!-- Avatar with 3D Effect -->
                    <div class="relative">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <!-- Online Status Indicator -->
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    
                    <!-- Name and Role -->
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 leading-tight">
                            {{ auth()->user()->name ?? 'User' }}
                        </p>
                        <p class="text-xs text-gray-500">Peminjam</p>
                    </div>

                    <!-- Dropdown Arrow -->
                    <svg id="dropdownArrow" class="w-4 h-4 text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="absolute right-0 mt-4 w-64 bg-white rounded-xl shadow-2xl opacity-0 invisible transform scale-95 transition-all duration-300 origin-top-right overflow-hidden">
                    
                    <!-- User Info Section -->
                    <div class="px-4 py-5 bg-gradient-to-br from-blue-50 to-white border-b border-blue-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <!-- Profile -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent transition-all duration-300 group">
                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-3 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-sm">Profile Saya</p>
                                <p class="text-xs text-gray-500">Kelola akun Anda</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <!-- Decorative gradient line -->
    <div class="h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>

</header>

<!-- JavaScript for Dropdown Functionality -->
<script>
    const profileButton = document.getElementById('profileButton');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const dropdownArrow = document.getElementById('dropdownArrow');
    let isDropdownOpen = false;

    // Toggle dropdown
    profileButton.addEventListener('click', (e) => {
        e.stopPropagation();
        isDropdownOpen = !isDropdownOpen;
        
        if (isDropdownOpen) {
            dropdownMenu.classList.remove('opacity-0', 'invisible', 'scale-95');
            dropdownMenu.classList.add('opacity-100', 'visible', 'scale-100');
            dropdownArrow.style.transform = 'rotate(180deg)';
        } else {
            dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdownArrow.style.transform = 'rotate(0deg)';
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (isDropdownOpen && !document.getElementById('profileDropdown').contains(e.target)) {
            dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdownArrow.style.transform = 'rotate(0deg)';
            isDropdownOpen = false;
        }
    });

    // Close dropdown on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isDropdownOpen) {
            dropdownMenu.classList.add('opacity-0', 'invisible', 'scale-95');
            dropdownMenu.classList.remove('opacity-100', 'visible', 'scale-100');
            dropdownArrow.style.transform = 'rotate(0deg)';
            isDropdownOpen = false;
        }
    });
</script>

<!-- Additional CSS for smooth animations -->
<style>
    /* Ensure dropdown appears above other content */
    #dropdownMenu {
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Smooth hover effects */
    #profileButton:hover {
        transform: translateY(-1px);
    }

    /* Notification pulse animation */
    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    #profileDropdown button span {
        animation: pulse 2s infinite;
    }
</style>