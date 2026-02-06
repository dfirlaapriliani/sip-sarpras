// Modern Sidebar Functionality - Enhanced & Fixed
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Sidebar script loaded');
    
    const hamburger = document.getElementById('hamburger');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    
    // DEBUGGING - Check if elements exist
    console.log('🍔 Hamburger element:', hamburger);
    console.log('📱 Mobile menu toggle:', mobileMenuToggle);
    console.log('📋 Sidebar element:', sidebar);
    console.log('🎭 Overlay element:', overlay);
    
    // Check if elements exist
    if (!sidebar) {
        console.error('❌ Sidebar element not found!');
        return;
    }
    
    if (!hamburger && !mobileMenuToggle) {
        console.error('❌ No hamburger button found!');
        return;
    }
    
    console.log('✅ All elements found');
    
    // Toggle sidebar function
    function toggleSidebar() {
        console.log('🔄 Toggle sidebar called');
        const isOpen = !sidebar.classList.contains('-translate-x-full');
        
        console.log('Current state - isOpen:', isOpen);
        
        if (!isOpen) {
            // Open sidebar
            console.log('➡️ Opening sidebar...');
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            
            if (overlay) {
                overlay.classList.remove('hidden');
                overlay.classList.add('block');
                console.log('✅ Overlay shown');
            }
            
            if (hamburgerIcon) hamburgerIcon.classList.add('hidden');
            if (closeIcon) closeIcon.classList.remove('hidden');
            
            // Add body lock for mobile
            if (window.innerWidth < 1024) {
                document.body.style.overflow = 'hidden';
            }
            
            console.log('✅ Sidebar opened');
        } else {
            // Close sidebar
            closeSidebar();
        }
    }
    
    // Close sidebar function
    function closeSidebar() {
        console.log('❌ Closing sidebar...');
        sidebar.classList.add('-translate-x-full');
        sidebar.classList.remove('translate-x-0');
        
        if (overlay) {
            overlay.classList.add('hidden');
            overlay.classList.remove('block');
        }
        
        if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
        if (closeIcon) closeIcon.classList.add('hidden');
        
        // Remove body lock
        document.body.style.overflow = '';
        
        console.log('✅ Sidebar closed');
    }
    
    // Setup hamburger click handlers
    if (hamburger) {
        console.log('🎯 Setting up hamburger click listener...');
        hamburger.addEventListener('click', function(e) {
            console.log('🍔 HAMBURGER CLICKED!!! 🎉');
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });
        
        // Test if hamburger is clickable
        hamburger.addEventListener('mouseenter', function() {
            console.log('🖱️ Mouse over hamburger');
        });
    }
    
    // Mobile menu toggle (alternative ID)
    if (mobileMenuToggle) {
        console.log('🎯 Setting up mobile menu toggle listener...');
        mobileMenuToggle.addEventListener('click', function(e) {
            console.log('📱 MOBILE MENU TOGGLE CLICKED!!!');
            e.preventDefault();
            e.stopPropagation();
            toggleSidebar();
        });
    }
    
    
    // Sidebar close button
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            closeSidebar();
        });
    }
    
    // Overlay click to close
    if (overlay) {
        overlay.addEventListener('click', function() {
            closeSidebar();
        });
    }
    
    // Handle submenu toggles
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const submenu = this.nextElementSibling;
            const icon = this.querySelector('.submenu-icon');
            
            if (submenu && submenu.classList.contains('submenu')) {
                // Toggle submenu
                const isHidden = submenu.classList.contains('hidden');
                
                if (isHidden) {
                    submenu.classList.remove('hidden');
                    if (icon) icon.classList.add('rotate-180');
                    this.setAttribute('aria-expanded', 'true');
                } else {
                    submenu.classList.add('hidden');
                    if (icon) icon.classList.remove('rotate-180');
                    this.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
    
    // Menu item click handler - FIXED VERSION
    navItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            console.log('🖱️ Menu clicked:', href);
            
            // Don't prevent default if it's a valid link
            if (!href || href === '#' || href === 'javascript:void(0)') {
                e.preventDefault();
                return;
            }
            
            // Update active state IMMEDIATELY for better UX
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');
            
            console.log('✨ Active class set to:', href);
            
            // Close sidebar on mobile after navigation
            if (window.innerWidth < 1024) {
                setTimeout(() => {
                    closeSidebar();
                }, 300);
            }
        });
    });
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebar();
        }
    });
    
    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if (window.innerWidth >= 1024) {
                // Reset on desktop
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                
                if (overlay) {
                    overlay.classList.add('hidden');
                    overlay.classList.remove('block');
                }
                
                if (hamburgerIcon) hamburgerIcon.classList.remove('hidden');
                if (closeIcon) closeIcon.classList.add('hidden');
                
                document.body.style.overflow = '';
            } else {
                // On mobile, ensure sidebar is closed by default
                if (!sidebar.classList.contains('-translate-x-full')) {
                    closeSidebar();
                }
            }
        }, 250);
    });
    
    // Initialize active menu on load
    initActiveMenu();
    
    // Add touch swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    let touchStartY = 0;
    let touchEndY = 0;
    
    document.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
        touchStartY = e.changedTouches[0].screenY;
    }, { passive: true });
    
    document.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        touchEndY = e.changedTouches[0].screenY;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const swipeDistanceX = touchEndX - touchStartX;
        const swipeDistanceY = Math.abs(touchEndY - touchStartY);
        
        // Only handle horizontal swipes (ignore vertical scrolling)
        if (swipeDistanceY < 100 && window.innerWidth < 1024) {
            // Swipe right to open (only from left edge)
            if (swipeDistanceX > swipeThreshold && touchStartX < 50) {
                if (sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
            // Swipe left to close
            else if (swipeDistanceX < -swipeThreshold) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    closeSidebar();
                }
            }
        }
    }
    
    // Handle sidebar collapse/expand on desktop (optional feature)
    const sidebarToggleDesktop = document.getElementById('sidebar-toggle-desktop');
    if (sidebarToggleDesktop) {
        sidebarToggleDesktop.addEventListener('click', function() {
            sidebar.classList.toggle('sidebar-collapsed');
            
            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebarCollapsed', isCollapsed);
        });

        // Restore sidebar state from localStorage
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState === 'true' && window.innerWidth >= 1024) {
            sidebar.classList.add('sidebar-collapsed');
        }
    }
    
    // Prevent sidebar from closing when clicking inside it
    sidebar.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    console.log('✅ Sidebar initialized successfully');
});