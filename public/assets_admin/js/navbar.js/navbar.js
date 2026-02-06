// Fixed navbar.js with improved event handling and debugging

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Navbar script initialized');
    
    // Get all elements
    const userDropdown = document.getElementById('user-dropdown');
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dashboardDropdown = document.getElementById('dashboard-dropdown');
    const dashboardMenu = document.getElementById('dashboard-menu');
    const logoutBtn = document.getElementById('logout-btn');
    const logoutModal = document.getElementById('logout-modal');
    const modalContent = document.getElementById('modal-content');
    const cancelLogout = document.getElementById('cancel-logout');
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');

    // Debug: Log all elements
    console.log('Elements found:', {
        userDropdown: !!userDropdown,
        dropdownMenu: !!dropdownMenu,
        dashboardDropdown: !!dashboardDropdown,
        dashboardMenu: !!dashboardMenu,
        logoutBtn: !!logoutBtn,
        logoutModal: !!logoutModal,
        modalContent: !!modalContent,
        cancelLogout: !!cancelLogout,
        mobileMenuToggle: !!mobileMenuToggle
    });

    // ==================== DASHBOARD DROPDOWN ====================
    if (dashboardDropdown && dashboardMenu) {
        console.log('Setting up dashboard dropdown');
        
        dashboardDropdown.addEventListener('click', function(e) {
            console.log('Dashboard dropdown clicked');
            e.preventDefault();
            e.stopPropagation();
            
            // Toggle dashboard menu
            const isHidden = dashboardMenu.classList.contains('hidden');
            dashboardMenu.classList.toggle('hidden');
            console.log('Dashboard menu toggled. Now hidden:', !isHidden);
            
            // Close user dropdown if open
            if (dropdownMenu && !dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.remove('show');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300);
            }
        });

        // Close dashboard dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!dashboardDropdown.contains(e.target) && !dashboardMenu.contains(e.target)) {
                if (!dashboardMenu.classList.contains('hidden')) {
                    dashboardMenu.classList.add('hidden');
                    console.log('Dashboard menu closed (outside click)');
                }
            }
        });
    }

    // ==================== USER DROPDOWN ====================
    if (userDropdown && dropdownMenu) {
        console.log('Setting up user dropdown');
        
        userDropdown.addEventListener('click', function(e) {
            console.log('User dropdown clicked');
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = dropdownMenu.classList.contains('hidden');
            
            if (isHidden) {
                // Show dropdown
                dropdownMenu.classList.remove('hidden');
                // Force reflow
                void dropdownMenu.offsetWidth;
                // Trigger animation
                setTimeout(() => {
                    dropdownMenu.classList.add('show');
                }, 10);
                console.log('User dropdown opened');
            } else {
                // Hide dropdown
                dropdownMenu.classList.remove('show');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300);
                console.log('User dropdown closed');
            }

            // Close dashboard dropdown if open
            if (dashboardMenu && !dashboardMenu.classList.contains('hidden')) {
                dashboardMenu.classList.add('hidden');
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!userDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                if (!dropdownMenu.classList.contains('hidden')) {
                    dropdownMenu.classList.remove('show');
                    setTimeout(() => {
                        dropdownMenu.classList.add('hidden');
                    }, 300);
                    console.log('User dropdown closed (outside click)');
                }
            }
        });
    }

    // ==================== MOBILE MENU TOGGLE ====================
    if (mobileMenuToggle) {
        console.log('Setting up mobile menu toggle');
        
        mobileMenuToggle.addEventListener('click', function(e) {
            console.log('Mobile menu toggle clicked');
            e.preventDefault();
            e.stopPropagation();
            
            const sidebar = document.getElementById('sidebar');
            if (sidebar) {
                sidebar.classList.toggle('-translate-x-full');
                console.log('Sidebar toggled');
            }

            const overlay = document.getElementById('sidebar-overlay');
            if (overlay) {
                overlay.classList.toggle('hidden');
                console.log('Overlay toggled');
            }
        });
    }

    // ==================== LOGOUT MODAL ====================
    
    // Show logout modal with animation
    function showLogoutModal() {
        console.log('Showing logout modal');
        if (logoutModal && modalContent) {
            logoutModal.classList.remove('hidden');
            // Force reflow
            void modalContent.offsetWidth;
            setTimeout(() => {
                modalContent.classList.add('show');
            }, 10);
        }
    }

    // Hide logout modal with animation
    function hideLogoutModal() {
        console.log('Hiding logout modal');
        if (logoutModal && modalContent) {
            modalContent.classList.remove('show');
            setTimeout(() => {
                logoutModal.classList.add('hidden');
            }, 300);
        }
    }

    // Logout button click
    if (logoutBtn) {
        console.log('Setting up logout button');
        
        logoutBtn.addEventListener('click', function(e) {
            console.log('Logout button clicked');
            e.preventDefault();
            e.stopPropagation();
            
            showLogoutModal();
            
            // Close dropdown
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
                setTimeout(() => {
                    dropdownMenu.classList.add('hidden');
                }, 300);
            }
        });
    }

    // Cancel logout
    if (cancelLogout) {
        console.log('Setting up cancel logout button');
        
        cancelLogout.addEventListener('click', function(e) {
            console.log('Cancel logout clicked');
            e.preventDefault();
            e.stopPropagation();
            hideLogoutModal();
        });
    }

    // Close modal when clicking on backdrop
    if (logoutModal) {
        logoutModal.addEventListener('click', function(e) {
            if (e.target === logoutModal) {
                console.log('Modal backdrop clicked');
                hideLogoutModal();
            }
        });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && logoutModal && !logoutModal.classList.contains('hidden')) {
            console.log('Escape key pressed');
            hideLogoutModal();
        }
    });

    // ==================== SMOOTH SCROLL ====================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') {
                e.preventDefault();
                return;
            }
            
            const target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    console.log('Navbar script setup complete');
});