<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto sidebar-3d">

    <!-- Logo dengan background biru subtle -->
    <div class="px-4 py-2 bg-gradient-to-r from-blue-50 to-white border-b border-gray-100">
        <div class="flex items-center justify-center h-14">
            <img src="{{asset('assets_admin/img/invex.png')}}" 
                class="h-14 w-auto object-contain scale-125 drop-shadow-md">
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="px-4 py-6 space-y-1">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="relative">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-500 transition-colors duration-200 icon-box-3d">
                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
            </div>
            <div class="flex-1">
                <span class="font-medium text-sm">Dashboard</span>
            </div>
            <div class="w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        </a>

        <!-- Users -->
        <a href="#" 
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-blue-500 transition-colors duration-200 icon-box-3d">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <span class="font-medium text-sm">Users</span>
            </div>
            <div class="w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        </a>

        <!-- Barang -->
        <a href="#" 
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group {{ request()->routeIs('admin.barang*') ? 'active' : '' }}">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-blue-500 transition-colors duration-200 icon-box-3d">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <div class="flex-1">
                <span class="font-medium text-sm">Barang</span>
            </div>
            <div class="w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        </a>

        <!-- Peminjaman -->
        <a href="#" 
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group {{ request()->routeIs('admin.peminjaman*') ? 'active' : '' }}">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-blue-500 transition-colors duration-200 icon-box-3d">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
            </div>
            <div class="flex-1">
                <span class="font-medium text-sm">Peminjaman</span>
            </div>
            <div class="w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        </a>

        <!-- Role Management -->
        <a href="#" 
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group {{ request()->routeIs('admin.roles*') ? 'active' : '' }}">
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center group-hover:bg-blue-500 transition-colors duration-200 icon-box-3d">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>
            <div class="flex-1">
                <span class="font-medium text-sm">Role Management</span>
            </div>
            <div class="w-2 h-2 bg-blue-500 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
        </a>

    </nav>

</aside>

<!-- Modern Hamburger Button for Mobile - PASTIKAN INI ADA -->
<button id="hamburger" class="fixed top-4 left-4 z-50 lg:hidden bg-white p-3 rounded-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 group hamburger-3d">
    <div class="relative w-6 h-6">
        <svg id="hamburger-icon" class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg id="close-icon" class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition-colors duration-200 hidden absolute inset-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </div>
</button>

<!-- Modern Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 lg:hidden hidden backdrop-blur-sm transition-opacity duration-300"></div>