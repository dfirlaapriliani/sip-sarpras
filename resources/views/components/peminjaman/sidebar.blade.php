
<!-- Mobile Toggle Button (Fixed Position) -->
<button id="mobileSidebarToggle" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Overlay for Mobile -->
<div id="sidebarOverlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 hidden transition-opacity duration-300"></div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed top-0 left-0 h-screen w-72 bg-gradient-to-br from-white via-blue-50 to-white shadow-2xl z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto">
    
    <!-- Logo Section with 3D Effect -->
    <div class="relative p-6 border-b border-blue-100 bg-white bg-opacity-60 backdrop-blur-sm">
        <div class="flex justify-center">
            <img src="{{ asset('assets_peminjam/img/invex.png') }}" 
                alt="INVEX Logo" 
                class="h-10 w-auto object-contain">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="mt-6 px-4 pb-48">
        <ul class="space-y-2">
            
            <!-- Dashboard -->
            <li>
                <a href="{{ route('peminjam.dashboard') }}" class="group relative flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-600 transition-all duration-300 bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent shadow-sm hover:shadow-md">
                    <!-- Icon Container with 3D -->
                    <div class="relative mr-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <!-- Active Indicator -->
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-1 h-8 bg-blue-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <span class="font-semibold text-sm">Dashboard</span>
                    <!-- Hover Arrow -->
                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </li>

            <!-- Barang -->
            <li>
                <a href="#" class="group relative flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-600 transition-all duration-300 bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent shadow-sm hover:shadow-md">
                    <div class="relative mr-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-1 h-8 bg-blue-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <span class="font-semibold text-sm">Barang</span>
                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </li>

            <!-- Peminjaman & Pengembalian -->
            <li>
                <a href="#" class="group relative flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-600 transition-all duration-300 bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent shadow-sm hover:shadow-md">
                    <div class="relative mr-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </div>
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-1 h-8 bg-blue-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <span class="font-semibold text-sm">Peminjaman</span>
                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </li>

            <!-- Riwayat -->
            <li>
                <a href="#" class="group relative flex items-center px-4 py-3 rounded-xl text-gray-700 hover:text-blue-600 transition-all duration-300 bg-white hover:bg-gradient-to-r hover:from-blue-50 hover:to-transparent shadow-sm hover:shadow-md">
                    <div class="relative mr-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-1 h-8 bg-blue-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <span class="font-semibold text-sm">Riwayat</span>
                    <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </li>

        </ul>
    </nav>

    <!-- Account Section - Fixed at Bottom -->
    <div class="absolute bottom-0 left-0 right-0 px-4 pb-6 bg-gradient-to-t from-white via-blue-50 to-transparent pt-8">
        
        <!-- Divider with 3D Effect -->
        <div class="mb-4 relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-blue-100"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-gradient-to-br from-white via-blue-50 to-white px-4 text-xs text-gray-400 font-medium">AKUN</span>
            </div>
        </div>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group w-full relative flex items-center px-4 py-3 rounded-xl text-red-600 hover:text-red-700 transition-all duration-300 bg-white hover:bg-gradient-to-r hover:from-red-50 hover:to-transparent shadow-sm hover:shadow-md">
                <div class="relative mr-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-100 to-red-50 rounded-lg flex items-center justify-center group-hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <div class="absolute -left-1 top-1/2 -translate-y-1/2 w-1 h-8 bg-red-600 rounded-r-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <span class="font-semibold text-sm">Logout</span>
                <svg class="w-4 h-4 ml-auto opacity-0 group-hover:opacity-100 transform group-hover:translate-x-1 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

    </div>

    <!-- Decorative Elements -->
    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-200 to-transparent rounded-full blur-3xl opacity-30 -z-10"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-blue-200 to-transparent rounded-full blur-3xl opacity-30 -z-10"></div>

</aside>

<!-- JavaScript for Mobile Toggle -->
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');

    // Toggle sidebar on mobile
    mobileSidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        sidebarOverlay.classList.toggle('hidden');
    });

    // Close sidebar when clicking overlay
    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
    });

    // Close sidebar when window is resized to desktop
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        }
    });
</script>

<!-- Additional Custom Styles (Optional Enhancement) -->
<style>
    /* Smooth scrollbar for sidebar */
    #sidebar::-webkit-scrollbar {
        width: 6px;
    }

    #sidebar::-webkit-scrollbar-track {
        background: rgba(59, 130, 246, 0.1);
        border-radius: 10px;
    }

    #sidebar::-webkit-scrollbar-thumb {
        background: linear-gradient(to bottom, #3b82f6, #2563eb);
        border-radius: 10px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(to bottom, #2563eb, #1d4ed8);
    }

    /* Prevent body scroll when sidebar is open on mobile */
    body.sidebar-open {
        overflow: hidden;
    }
</style>