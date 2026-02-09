document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================
    // ELEMENT DECLARATIONS
    // ==========================================
    
    // Sidebar Elements
    const hamburger = document.getElementById('hamburger');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const navItems = document.querySelectorAll('.nav-item');
    
    // Navbar Elements
    const userDropdown = document.getElementById('user-dropdown');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dashboardDropdown = document.getElementById('dashboard-dropdown');
    const dashboardMenu = document.getElementById('dashboard-menu');
    const logoutBtn = document.getElementById('logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const modalContent = document.getElementById('modal-content');
    const cancelLogout = document.getElementById('cancel-logout');
    
    // ==========================================
    // SIDEBAR FUNCTIONS
    // ==========================================
    
    function toggleSidebar() {
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        
        if (!isOpen) {
            openSidebar();
        } else {
            closeSidebar();
        }
    }
    
    function openSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('translate-x-0');
        
        if (sidebarOverlay) {
            sidebarOverlay.classList.remove('hidden');
            sidebarOverlay.classList.add('block');
        }
        
        if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
        if (closeIcon) closeIcon.classList.remove('hidden');
        
        if (hamburger) hamburger.setAttribute('aria-expanded', 'true');
        
        if (window.innerWidth < 1024) {
            document.body.style.overflow = 'hidden';
        }
    }
    
    function closeSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        
        if (sidebarOverlay) {
            sidebarOverlay.classList.add('hidden');
            sidebarOverlay.classList.remove('block');
        }
        
        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        
        if (hamburger) hamburger.setAttribute('aria-expanded', 'false');
        
        document.body.style.overflow = '';
    }
    
    function initActiveMenu() {
        const currentPath = window.location.pathname;
        
        navItems.forEach(item => item.classList.remove('active'));
        
        navItems.forEach(item => {
            const href = item.getAttribute('href');
            if (href && href !== '#') {
                if (href === currentPath || currentPath.startsWith(href + '/')) {
                    item.classList.add('active');
                }
            }
        });
    }
    
    // ==========================================
    // NAVBAR FUNCTIONS
    // ==========================================
    
    function showLogoutModal() {
        if (logoutModal && modalContent) {
            logoutModal.classList.remove('hidden');
            setTimeout(() => modalContent.classList.add('show'), 10);
        }
    }
    
    function hideLogoutModal() {
        if (logoutModal && modalContent) {
            modalContent.classList.remove('show');
            setTimeout(() => logoutModal.classList.add('hidden'), 300);
        }
    }
    
    function toggleDropdown(dropdown, menu) {
        const isHidden = menu.classList.contains('hidden');
        
        if (isHidden) {
            menu.classList.remove('hidden');
            setTimeout(() => menu.classList.add('show'), 10);
            dropdown.setAttribute('aria-expanded', 'true');
        } else {
            menu.classList.remove('show');
            setTimeout(() => menu.classList.add('hidden'), 300);
            dropdown.setAttribute('aria-expanded', 'false');
        }
    }
    
    // ==========================================
    // EVENT LISTENERS - SIDEBAR
    // ==========================================
    
    if (hamburger && sidebar) {
        hamburger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
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
                setTimeout(closeSidebar, 300);
            }
        });
    });
    
    // ==========================================
    // EVENT LISTENERS - NAVBAR
    // ==========================================
    
    if (dashboardDropdown && dashboardMenu) {
        dashboardDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            toggleDropdown(dashboardDropdown, dashboardMenu);
            
            // Close user dropdown if open
            if (dropdownMenu && !dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
                if (userDropdown) userDropdown.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    if (userDropdown && dropdownMenu) {
        userDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            toggleDropdown(userDropdown, dropdownMenu);
            
            // Close dashboard menu if open
            if (dashboardMenu && !dashboardMenu.classList.contains('hidden')) {
                dashboardMenu.classList.add('hidden');
                if (dashboardDropdown) dashboardDropdown.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function(e) {
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
                dashboardDropdown.setAttribute('aria-expanded', 'false');
            }
        }
        
        // Close user dropdown
        if (userDropdown && dropdownMenu) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
                setTimeout(() => dropdownMenu.classList.add('hidden'), 300);
                userDropdown.setAttribute('aria-expanded', 'false');
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
            
            // Close dropdowns
            if (dropdownMenu && !dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
                if (userDropdown) userDropdown.setAttribute('aria-expanded', 'false');
            }
            
            if (dashboardMenu && !dashboardMenu.classList.contains('hidden')) {
                dashboardMenu.classList.add('hidden');
                if (dashboardDropdown) dashboardDropdown.setAttribute('aria-expanded', 'false');
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
});