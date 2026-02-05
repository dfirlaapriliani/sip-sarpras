<aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 bg-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out overflow-y-auto sidebar-3d">
    
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
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group active">
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
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
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
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
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
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
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
           class="nav-item flex items-center gap-4 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200 group">
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

<!-- Modern Hamburger Button for Mobile -->
<button id="hamburger" class="fixed top-4 left-4 z-50 lg:hidden bg-white p-3 rounded-xl transition-all duration-300 border border-gray-200 hover:border-blue-300 group hamburger-3d">
    <div class="relative w-6 h-6">
        <svg id="hamburger-icon" class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg id="close-icon" class="w-6 h-6 text-gray-700 group-hover:text-blue-600 transition-colors duration-200 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </div>
</button>

<!-- Modern Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/40 z-30 lg:hidden hidden backdrop-blur-sm transition-opacity duration-300"></div>

<style>
    /* Sidebar 3D Effect - Border Melengkung Kanan Bawah Saja */
    .sidebar-3d {
        border-bottom-right-radius: 30px;
        border-right: 3px solid #e5e7eb;
        box-shadow: 
            8px 0 16px -2px rgba(0, 0, 0, 0.15),
            4px 0 8px -1px rgba(0, 0, 0, 0.1),
            inset -2px 0 8px rgba(59, 130, 246, 0.08);
    }

    /* Icon Box 3D Effect */
    .icon-box-3d {
        box-shadow: 
            0 2px 4px rgba(0, 0, 0, 0.1),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    /* Hamburger Button 3D */
    .hamburger-3d {
        box-shadow: 
            0 4px 8px rgba(0, 0, 0, 0.12),
            0 2px 4px rgba(0, 0, 0, 0.08),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    .hamburger-3d:hover {
        box-shadow: 
            0 6px 12px rgba(0, 0, 0, 0.15),
            0 3px 6px rgba(0, 0, 0, 0.1),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    /* Modern Active State - Clean & Elegant with 3D */
    .nav-item.active {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        font-weight: 600;
        transform: translateX(4px);
        box-shadow: 
            0 4px 12px rgba(37, 99, 235, 0.25),
            inset -2px 0 6px rgba(0, 0, 0, 0.1),
            inset 2px 0 6px rgba(255, 255, 255, 0.2);
    }
    
    .nav-item.active .w-10 {
        background: rgba(255, 255, 255, 0.2) !important;
        backdrop-filter: blur(10px);
        box-shadow: 
            0 2px 4px rgba(0, 0, 0, 0.15),
            inset -1px -1px 2px rgba(0, 0, 0, 0.1),
            inset 1px 1px 2px rgba(255, 255, 255, 0.3);
    }
    
    .nav-item.active svg {
        color: white !important;
    }
    
    .nav-item.active .w-2 {
        opacity: 1 !important;
        background: white !important;
        width: 4px;
        height: 4px;
        box-shadow: 0 0 4px rgba(255, 255, 255, 0.5);
    }
    
    /* Smooth hover effects with 3D */
    .nav-item {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .nav-item:hover {
        transform: translateX(4px);
        box-shadow: 
            0 2px 6px rgba(0, 0, 0, 0.08),
            inset -1px 0 3px rgba(59, 130, 246, 0.1);
    }

    .nav-item:hover .icon-box-3d {
        box-shadow: 
            0 3px 6px rgba(0, 0, 0, 0.15),
            inset -1px -1px 2px rgba(0, 0, 0, 0.08),
            inset 1px 1px 2px rgba(255, 255, 255, 0.6);
    }
    
    /* Custom scrollbar for sidebar */
    #sidebar::-webkit-scrollbar {
        width: 4px;
    }
    
    #sidebar::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #sidebar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
        box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);
    }
    
    #sidebar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 1024px) {
        #sidebar {
            box-shadow: 
                8px 0 24px rgba(0, 0, 0, 0.2),
                4px 0 12px rgba(0, 0, 0, 0.15);
        }
        
        .nav-item {
            padding: 0.875rem 1rem;
        }

        .sidebar-3d {
            border-right: 4px solid #e5e7eb;
        }
    }

    /* Desktop specific - border melengkung bawah kanan saja */
    @media (min-width: 1024px) {
        .sidebar-3d {
            border-bottom-right-radius: 30px;
        }
    }
</style>

<script>
    // Modern Sidebar Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        const navItems = document.querySelectorAll('.nav-item');
        
        // Toggle sidebar function
        function toggleSidebar() {
            const isOpen = sidebar.classList.contains('-translate-x-full');
            
            if (isOpen) {
                // Open sidebar
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                
                // Add body lock for mobile
                document.body.style.overflow = 'hidden';
            } else {
                // Close sidebar
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                
                // Remove body lock
                document.body.style.overflow = '';
            }
        }
        
        // Initialize active menu state
        function initActiveMenu() {
            const currentPath = window.location.pathname;
            
            // For demo, set dashboard as active by default
            // In real app, check current route and set active accordingly
            navItems.forEach(item => {
                item.classList.remove('active');
                if (item.getAttribute('href') === "{{ route('admin.dashboard') }}") {
                    item.classList.add('active');
                }
            });
        }
        
        // Setup click handlers
        hamburger.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);
        
        // Menu item click handler
        navItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Only handle non-dashboard links (prevent default for demo)
                const href = this.getAttribute('href');
                if (!href || href === '#') {
                    e.preventDefault();
                }
                
                // Update active state
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
                
                // Close sidebar on mobile after delay for smooth transition
                if (window.innerWidth < 1024) {
                    setTimeout(() => {
                        if (!sidebar.classList.contains('-translate-x-full')) {
                            toggleSidebar();
                        }
                    }, 300);
                }
            });
        });
        
        // Close sidebar on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
                toggleSidebar();
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                // Reset on desktop
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                document.body.style.overflow = '';
            }
        });
        
        // Initialize
        initActiveMenu();
        
        // Add touch swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;
        
        document.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        }, { passive: true });
        
        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, { passive: true });
        
        function handleSwipe() {
            const swipeThreshold = 50;
            const swipeDistance = touchEndX - touchStartX;
            
            // Swipe right to open
            if (swipeDistance > swipeThreshold && window.innerWidth < 1024) {
                if (sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
            // Swipe left to close
            else if (swipeDistance < -swipeThreshold && window.innerWidth < 1024) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
        }
    });
</script>