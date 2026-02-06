<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @include('layout_admin.partial_admin.link')
    @stack('styles')
</head>

<body 
    style="
        background-image: url('{{ asset('assets_admin/img/bg.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
    "
>

<div class="flex min-h-screen">

    {{-- Sidebar - Fixed --}}
    @include('components.admin.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col lg:ml-64 w-full">

        {{-- Navbar --}}
        @include('components.admin.navbar')

        {{-- Content - BISA SCROLL --}}
        <main class="flex-1 p-4 sm:p-6">
            @yield('content')
        </main>
    
        {{-- Footer --}}
        @include('components.admin.footer')
    </div>

</div>

{{-- ========================================
     COMBINED SCRIPTS - SIDEBAR + NAVBAR
     ======================================== --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 COMBINED SCRIPT LOADED - SIDEBAR + NAVBAR');
    
    // ==========================================
    // SIDEBAR ELEMENTS & FUNCTIONS
    // ==========================================
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const navItems = document.querySelectorAll('.nav-item');
    
    // ==========================================
    // NAVBAR ELEMENTS & FUNCTIONS
    // ==========================================
    const userDropdown = document.getElementById('user-dropdown');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dashboardDropdown = document.getElementById('dashboard-dropdown');
    const dashboardMenu = document.getElementById('dashboard-menu');
    const logoutBtn = document.getElementById('logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const modalContent = document.getElementById('modal-content');
    const cancelLogout = document.getElementById('cancel-logout');
    
    // ==========================================
    // DEBUGGING - CHECK ALL ELEMENTS
    // ==========================================
    console.log('🍔 Hamburger:', hamburger);
    console.log('📋 Sidebar:', sidebar);
    console.log('🎭 Sidebar Overlay:', sidebarOverlay);
    console.log('👤 User Dropdown:', userDropdown);
    console.log('📋 Dropdown Menu:', dropdownMenu);
    console.log('🏠 Dashboard Dropdown:', dashboardDropdown);
    console.log('📋 Dashboard Menu:', dashboardMenu);
    
    // ==========================================
    // SIDEBAR FUNCTIONS
    // ==========================================
    function toggleSidebar() {
        console.log('🔄 Toggle sidebar called');
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        
        if (!isOpen) {
            // Open sidebar
            console.log('➡️ Opening sidebar...');
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            
            if (sidebarOverlay) {
                sidebarOverlay.classList.remove('hidden');
                sidebarOverlay.classList.add('block');
            }
            
            if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            
            if (window.innerWidth < 1024) {
                document.body.style.overflow = 'hidden';
            }
            
            console.log('✅ Sidebar opened');
        } else {
            closeSidebar();
        }
    }
    
    function closeSidebar() {
        console.log('❌ Closing sidebar...');
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        
        if (sidebarOverlay) {
            sidebarOverlay.classList.add('hidden');
            sidebarOverlay.classList.remove('block');
        }
        
        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        
        document.body.style.overflow = '';
        
        console.log('✅ Sidebar closed');
    }
    
    function initActiveMenu() {
        const currentPath = window.location.pathname;
        console.log('🔍 Current path:', currentPath);
        
        navItems.forEach(item => item.classList.remove('active'));
        
        navItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && href !== '#') {
                if (href === currentPath || currentPath.startsWith(href + '/')) {
                    item.classList.add('active');
                    console.log('✅ Set active:', href);
                }
            }
        });
    }
    
    // ==========================================
    // NAVBAR FUNCTIONS
    // ==========================================
    function showLogoutModal() {
        console.log('🚪 Showing logout modal...');
        if (logoutModal && modalContent) {
            logoutModal.classList.remove('hidden');
            setTimeout(() => modalContent.classList.add('show'), 10);
            console.log('✅ Logout modal shown');
        }
    }
    
    function hideLogoutModal() {
        console.log('❌ Hiding logout modal...');
        if (logoutModal && modalContent) {
            modalContent.classList.remove('show');
            setTimeout(() => logoutModal.classList.add('hidden'), 300);
            console.log('✅ Logout modal hidden');
        }
    }
    
    // ==========================================
    // SIDEBAR EVENT LISTENERS
    // ==========================================
    if (hamburger && sidebar) {
        console.log('🎯 Setting up SIDEBAR listeners...');
        
        hamburger.addEventListener('click', function(e) {
            console.log('🍔 HAMBURGER CLICKED!!!');
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', function() {
            console.log('🖱️ Sidebar overlay clicked');
            closeSidebar();
        });
    }
    
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            if (!href || href === '#' || href === 'javascript:void(0)') {
                e.preventDefault();
                return;
            }
            
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            
            if (window.innerWidth < 1024) {
                setTimeout(() => closeSidebar(), 300);
            }
        });
    });
    
    // ==========================================
    // NAVBAR EVENT LISTENERS
    // ==========================================
    if (dashboardDropdown && dashboardMenu) {
        console.log('🎯 Setting up DASHBOARD dropdown...');
        
        dashboardDropdown.addEventListener('click', function(e) {
            console.log('🏠 Dashboard dropdown clicked!');
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = dashboardMenu.classList.contains('hidden');
            
            if (isHidden) {
                dashboardMenu.classList.remove('hidden');
                console.log('✅ Dashboard menu opened');
            } else {
                dashboardMenu.classList.add('hidden');
                console.log('❌ Dashboard menu closed');
            }
            
            // Close user dropdown if open
            if (dropdownMenu && !dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }
    
    if (userDropdown && dropdownMenu) {
        console.log('🎯 Setting up USER dropdown...');
        
        userDropdown.addEventListener('click', function(e) {
            console.log('👤 User dropdown clicked!');
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = dropdownMenu.classList.contains('hidden');
            
            if (isHidden) {
                dropdownMenu.classList.remove('hidden');
                setTimeout(() => dropdownMenu.classList.add('show'), 10);
                console.log('✅ User dropdown opened');
            } else {
                dropdownMenu.classList.remove('show');
                setTimeout(() => dropdownMenu.classList.add('hidden'), 300);
                console.log('❌ User dropdown closed');
            }
            
            // Close dashboard menu if open
            if (dashboardMenu && !dashboardMenu.classList.contains('hidden')) {
                dashboardMenu.classList.add('hidden');
            }
        });
    }
    
    if (logoutBtn) {
        console.log('🎯 Setting up LOGOUT button...');
        
        logoutBtn.addEventListener('click', function(e) {
            console.log('🚪 Logout button clicked!');
            e.preventDefault();
            e.stopPropagation();
            showLogoutModal();
            
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
                setTimeout(() => dropdownMenu.classList.add('hidden'), 300);
            }
        });
    }
    
    if (cancelLogout) {
        cancelLogout.addEventListener('click', function(e) {
            console.log('❌ Cancel logout clicked');
            e.preventDefault();
            hideLogoutModal();
        });
    }
    
    if (logoutModal) {
        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                hideLogoutModal();
            }
        });
    }
    
    // ==========================================
    // CLOSE DROPDOWNS ON OUTSIDE CLICK
    // ==========================================
    document.addEventListener('click', function(e) {
        // Close dashboard menu
        if (dashboardDropdown && dashboardMenu) {
            if (!dashboardDropdown.contains(e.target) && !dashboardMenu.contains(e.target)) {
                dashboardMenu.classList.add('hidden');
            }
        }
        
        // Close user dropdown
        if (userDropdown && dropdownMenu) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                setTimeout(() => dropdownMenu.classList.add('hidden'), 300);
            }
        }
    });
    
    // ==========================================
    // KEYBOARD EVENTS
    // ==========================================
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close sidebar if open
            if (sidebar && !sidebar.classList.contains('-translate-x-full')) {
                closeSidebar();
            }
            
            // Close logout modal if open
            if (logoutModal && !logoutModal.classList.contains('hidden')) {
                hideLogoutModal();
            }
        }
    });
    
    // ==========================================
    // WINDOW RESIZE HANDLER
    // ==========================================
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                
                if (sidebarOverlay) {
                    sidebarOverlay.classList.add('hidden');
                    sidebarOverlay.classList.remove('block');
                }
                
                if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
                
                document.body.style.overflow = '';
            } else {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    closeSidebar();
                }
            }
        }, 250);
    });
    
    // ==========================================
    // PREVENT SIDEBAR CLOSE ON CLICK INSIDE
    // ==========================================
    if (sidebar) {
        sidebar.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // ==========================================
    // INITIALIZE
    // ==========================================
    initActiveMenu();
    
    console.log('✅✅✅ ALL SCRIPTS INITIALIZED SUCCESSFULLY! ✅✅✅');
});
</script>

{{-- ========================================
     CSS STYLES - FINAL VERSION
     ======================================== --}}
<style>
/* Sidebar Fixed Position */
#sidebar {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    width: 16rem;
    height: 100vh;
    overflow-y: auto;
    z-index: 40;
}

/* Hamburger button - HIGHEST Z-INDEX for mobile */
#hamburger {
    z-index: 9999 !important;
    position: fixed !important;
    pointer-events: auto !important;
    cursor: pointer !important;
    top: 1rem !important;
    left: 1rem !important;
}

/* Sidebar Overlay */
#sidebar-overlay {
    z-index: 35 !important;
    pointer-events: auto !important;
}

/* NAVBAR DROPDOWNS - Very high z-index */
#dropdown-menu,
#dashboard-menu {
    z-index: 99999 !important;
    position: absolute !important;
    pointer-events: auto !important;
}

/* Logout Modal - Highest of all */
#logout-modal {
    z-index: 999999 !important;
    pointer-events: auto !important;
}

/* Ensure all interactive elements are clickable */
button, a {
    cursor: pointer !important;
    pointer-events: auto !important;
}

/* Show dropdown properly */
#dropdown-menu:not(.hidden),
#dashboard-menu:not(.hidden) {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Smooth dropdown animation */
#dropdown-menu.show {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Mobile: Sidebar hidden by default */
@media (max-width: 1023px) {
    #sidebar {
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
    }
    
    #sidebar:not(.-translate-x-full),
    #sidebar.translate-x-0 {
        transform: translateX(0) !important;
    }
    
    .lg\:ml-64 {
        margin-left: 0 !important;
    }
    
    #hamburger {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
}

/* Desktop */
@media (min-width: 1024px) {
    #sidebar {
        transform: translateX(0) !important;
    }
    
    .lg\:ml-64 {
        margin-left: 16rem !important;
    }
    
    #hamburger {
        display: none !important;
    }
}
</style>

</body>
</html>