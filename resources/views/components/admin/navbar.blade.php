<header class="sticky top-0 z-50 bg-gradient-to-r from-white via-gray-50 to-white px-6 py-3 header-3d">
    <div class="flex items-center justify-between max-w-7xl mx-auto">
        
        <!-- Left: Logo & Brand -->
        <div class="flex items-center gap-6">
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="lg:hidden p-2.5 rounded-xl hover:bg-white transition-all duration-300 mobile-btn-3d">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>


        </div>

        <!-- Center: Empty space for balance -->
        <div class="flex-1"></div>

        <!-- Right: Dashboard, Settings & User Profile -->
        <div class="flex items-center gap-3">
            
            <!-- Dashboard Dropdown -->
            <div class="relative" id="dashboard-dropdown">
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 quick-action-btn group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="hidden lg:inline">Dashboard</span>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dashboard Dropdown Menu -->
                <div class="absolute left-0 top-full mt-2 w-48 bg-white rounded-xl border border-gray-200 hidden dashboard-dropdown-3d" id="dashboard-menu">
                    <div class="py-2">
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Peminjam
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            Petugas
                        </a>
                    </div>
                </div>
            </div>

            <!-- Settings Icon -->
            <button class="p-2.5 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition-all duration-300 settings-btn-3d text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </button>

            <!-- Divider -->
            <div class="hidden md:block w-px h-8 bg-gradient-to-b from-transparent via-gray-300 to-transparent"></div>

            <!-- User Profile Dropdown -->
            <div class="relative" id="user-dropdown">
                <button class="flex items-center gap-3 pl-2 pr-3 py-2 rounded-xl hover:bg-white transition-all duration-300 group user-btn-3d">
                    <!-- Avatar dengan status indicator -->
                    <div class="relative">
                        <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-blue-100 avatar-3d">
                            <img src="{{asset('assets_admin/img/invexlog.png')}}" alt="Admin Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white status-dot-3d"></span>
                    </div>
                    
                    <!-- User Info -->
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-gray-800">Administrator</p>
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            Online
                        </p>
                    </div>
                    
                    <!-- Chevron -->
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 transition-all duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute right-0 top-full mt-3 w-72 bg-white rounded-2xl border border-gray-200 hidden dropdown-3d overflow-hidden"
                     id="dropdown-menu">
                    
                    <!-- Profile Header -->
                    <div class="px-5 py-4 bg-gradient-to-br from-blue-50 to-indigo-50 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl overflow-hidden border-2 border-white avatar-3d">
                                <img src="{{asset('assets_admin/img/invexlog.png')}}" alt="Admin Avatar" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-gray-800">Administrator</p>
                                <p class="text-xs text-gray-600">Super Admin</p>
                                <p class="text-xs text-gray-500 mt-0.5">admin@invex.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <div class="py-2">
                        <a href="#" class="flex items-center gap-3 px-5 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition-all duration-300 group">
                            <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-blue-100 flex items-center justify-center transition-all duration-300 menu-icon-3d">
                                <svg class="w-4 h-4 text-gray-600 group-hover:text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium">My Profile</p>
                                <p class="text-xs text-gray-500">View and edit profile</p>
                            </div>
                        </a>
                    </div>
                    
                    <!-- Logout Section -->
                    <div class="border-t border-gray-100 p-3 bg-gray-50">
                        <button id="logout-btn" 
                            class="flex items-center justify-center gap-3 px-4 py-2.5 text-sm font-medium text-red-600 hover:text-white hover:bg-red-600 w-full rounded-xl transition-all duration-300 logout-btn-3d group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            <span>Sign Out</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Logout Confirmation Modal -->
<div id="logout-modal" class="fixed inset-0 z-[60] hidden">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md transition-opacity duration-300"></div>
    
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="modal-3d bg-white rounded-3xl w-full max-w-md relative transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
            
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-gray-100">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-red-100 to-red-200 flex items-center justify-center icon-3d flex-shrink-0">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900">Confirm Logout</h3>
                        <p class="text-sm text-gray-600 mt-1">You're about to sign out from your account</p>
                    </div>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="px-6 py-5">
                <p class="text-sm text-gray-600 leading-relaxed">
                    Are you sure you want to sign out from your account? You will be redirected to the login page.
                </p>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-4 border-t border-gray-100 bg-gradient-to-b from-white to-gray-50 rounded-b-3xl flex flex-col sm:flex-row justify-end gap-3">
                <button id="cancel-logout" 
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 rounded-xl transition-all duration-300 button-3d order-2 sm:order-1 border border-gray-200">
                    <span class="flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </span>
                </button>

                <form method="POST" action="{{ route('logout') }}" id="logout-form" class="order-1 sm:order-2">
                    @csrf
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 rounded-xl transition-all duration-300 button-3d-red">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Yes, Sign Out
                        </span>
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    /* Header 3D Effect - Enhanced */
    .header-3d {
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        border-bottom: 3px solid #e5e7eb;
        box-shadow: 
            0 10px 15px -3px rgba(0, 0, 0, 0.1),
            0 4px 6px -2px rgba(0, 0, 0, 0.05),
            inset 0 -3px 10px rgba(59, 130, 246, 0.08);
        backdrop-filter: blur(10px);
    }

    /* Logo 3D Effect */
    .logo-3d {
        box-shadow: 
            0 4px 6px -1px rgba(59, 130, 246, 0.3),
            0 2px 4px -1px rgba(59, 130, 246, 0.2),
            inset -2px -2px 4px rgba(0, 0, 0, 0.1),
            inset 2px 2px 4px rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
    }

    .logo-3d:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 6px 8px -1px rgba(59, 130, 246, 0.4),
            0 3px 5px -1px rgba(59, 130, 246, 0.3),
            inset -2px -2px 4px rgba(0, 0, 0, 0.1),
            inset 2px 2px 4px rgba(255, 255, 255, 0.3);
    }

    /* Avatar 3D Effect - Enhanced */
    .avatar-3d {
        box-shadow: 
            0 6px 8px -2px rgba(0, 0, 0, 0.15),
            0 3px 5px -1px rgba(0, 0, 0, 0.1),
            inset -2px -2px 4px rgba(255, 255, 255, 0.6),
            inset 2px 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Status Dot 3D */
    .status-dot-3d {
        box-shadow: 
            0 2px 4px rgba(34, 197, 94, 0.4),
            inset -1px -1px 2px rgba(255, 255, 255, 0.5);
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    /* Quick Action Button 3D */
    .quick-action-btn {
        box-shadow: 
            0 2px 4px rgba(0, 0, 0, 0.05),
            inset -1px -1px 2px rgba(0, 0, 0, 0.03),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    .quick-action-btn:hover {
        box-shadow: 
            0 4px 6px rgba(59, 130, 246, 0.15),
            inset -1px -1px 2px rgba(59, 130, 246, 0.1),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
    }

    /* Notification Button 3D */
    .notification-btn-3d,
    .settings-btn-3d,
    .mobile-btn-3d {
        box-shadow: 
            0 2px 4px rgba(0, 0, 0, 0.08),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .notification-btn-3d:hover,
    .settings-btn-3d:hover,
    .mobile-btn-3d:hover {
        box-shadow: 
            0 4px 6px rgba(0, 0, 0, 0.12),
            inset -2px -2px 4px rgba(0, 0, 0, 0.08),
            inset 2px 2px 4px rgba(255, 255, 255, 0.6);
        transform: translateY(-1px);
    }

    /* User Button 3D */
    .user-btn-3d {
        box-shadow: 
            0 3px 5px rgba(0, 0, 0, 0.08),
            inset -1px -1px 3px rgba(0, 0, 0, 0.05),
            inset 1px 1px 3px rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    .user-btn-3d:hover {
        box-shadow: 
            0 5px 8px rgba(0, 0, 0, 0.12),
            inset -2px -2px 4px rgba(0, 0, 0, 0.08),
            inset 2px 2px 4px rgba(255, 255, 255, 0.6);
    }

    /* Pulse Animation for notification dot */
    .pulse-dot {
        animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse-ring {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
        }
        50% {
            box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
        }
    }

    /* Dashboard Dropdown 3D Effect */
    .dashboard-dropdown-3d {
        box-shadow: 
            0 10px 15px -3px rgba(0, 0, 0, 0.15),
            0 4px 6px -2px rgba(0, 0, 0, 0.1),
            -2px 0 10px rgba(0, 0, 0, 0.08),
            2px 0 10px rgba(0, 0, 0, 0.08);
        border-left: 2px solid rgba(59, 130, 246, 0.1);
        border-right: 2px solid rgba(59, 130, 246, 0.1);
        animation: slideDown 0.2s ease-out;
    }

    /* Dropdown 3D Effect - Enhanced */
    .dropdown-3d {
        box-shadow: 
            0 20px 25px -5px rgba(0, 0, 0, 0.15),
            0 10px 10px -5px rgba(0, 0, 0, 0.1),
            -4px 0 20px rgba(0, 0, 0, 0.08),
            4px 0 20px rgba(0, 0, 0, 0.08),
            inset 0 2px 4px rgba(59, 130, 246, 0.05);
        border-left: 3px solid rgba(59, 130, 246, 0.15);
        border-right: 3px solid rgba(59, 130, 246, 0.15);
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Menu Icon 3D */
    .menu-icon-3d {
        box-shadow: 
            0 2px 4px rgba(0, 0, 0, 0.05),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }

    /* Logout Button 3D */
    .logout-btn-3d {
        box-shadow: 
            0 2px 4px rgba(239, 68, 68, 0.2),
            inset -1px -1px 2px rgba(0, 0, 0, 0.05),
            inset 1px 1px 2px rgba(255, 255, 255, 0.3);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .logout-btn-3d:hover {
        box-shadow: 
            0 4px 6px rgba(239, 68, 68, 0.3),
            inset -2px -2px 4px rgba(0, 0, 0, 0.1),
            inset 2px 2px 4px rgba(255, 255, 255, 0.2);
    }

    /* Modal 3D Effect - Enhanced */
    .modal-3d {
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 15px 25px -10px rgba(0, 0, 0, 0.15),
            -6px 0 25px rgba(0, 0, 0, 0.12),
            6px 0 25px rgba(0, 0, 0, 0.12),
            inset 0 2px 4px rgba(239, 68, 68, 0.05);
        border-left: 4px solid rgba(239, 68, 68, 0.3);
        border-right: 4px solid rgba(239, 68, 68, 0.3);
    }

    .modal-3d.show {
        transform: scale(1) !important;
        opacity: 1 !important;
    }

    /* Icon 3D Effect - Enhanced */
    .icon-3d {
        box-shadow: 
            0 4px 6px rgba(239, 68, 68, 0.2),
            inset -2px -2px 4px rgba(255, 255, 255, 0.6),
            inset 2px 2px 4px rgba(239, 68, 68, 0.15);
    }

    /* Info Box 3D Effect - Enhanced */
    .info-box-3d {
        box-shadow: 
            0 3px 6px rgba(59, 130, 246, 0.1),
            inset -3px 0 6px rgba(59, 130, 246, 0.08),
            inset 3px 0 6px rgba(59, 130, 246, 0.08);
        border-left: 3px solid rgba(59, 130, 246, 0.3);
    }

    /* Button 3D Effect - Enhanced */
    .button-3d {
        box-shadow: 
            0 3px 5px rgba(0, 0, 0, 0.1),
            inset -2px 0 3px rgba(0, 0, 0, 0.08),
            inset 2px 0 3px rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }

    .button-3d-red {
        box-shadow: 
            0 5px 8px rgba(239, 68, 68, 0.3),
            inset -3px 0 6px rgba(0, 0, 0, 0.15),
            inset 3px 0 6px rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .button-3d:hover,
    .button-3d-red:hover {
        transform: translateY(-2px);
        box-shadow: 
            0 8px 12px rgba(0, 0, 0, 0.2),
            inset -3px 0 6px rgba(0, 0, 0, 0.15),
            inset 3px 0 6px rgba(255, 255, 255, 0.2);
    }

    /* Dropdown transition */
    #dropdown-menu {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        transform: translateY(-15px) scale(0.95);
        pointer-events: none;
    }

    #dropdown-menu.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* Smooth transitions */
    * {
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Responsive adjustments */
    @media (max-width: 640px) {
        .header-3d {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        
        .modal-3d {
            margin: 1rem;
            max-width: calc(100% - 2rem);
        }

        .dropdown-3d {
            width: calc(100vw - 2rem);
            right: 1rem;
        }
    }

    @media (max-width: 1024px) {
        .dropdown-3d {
            width: 280px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const userDropdown = document.getElementById('user-dropdown');
        const dropdownMenu = document.getElementById('dropdown-menu');
        const dashboardDropdown = document.getElementById('dashboard-dropdown');
        const dashboardMenu = document.getElementById('dashboard-menu');
        const logoutBtn = document.getElementById('logout-btn');
        const logoutModal = document.getElementById('logout-modal');
        const modalContent = document.getElementById('modal-content');
        const cancelLogout = document.getElementById('cancel-logout');
        const mobileMenuToggle = document.getElementById('mobile-menu-toggle');

        // Toggle dashboard dropdown
        if (dashboardDropdown && dashboardMenu) {
            dashboardDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                dashboardMenu.classList.toggle('hidden');
                
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
                if (!dashboardDropdown.contains(e.target)) {
                    dashboardMenu.classList.add('hidden');
                }
            });
        }

        // Toggle dropdown menu with animation
        if (userDropdown && dropdownMenu) {
            userDropdown.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('hidden');
                
                // Trigger animation
                setTimeout(() => {
                    dropdownMenu.classList.toggle('show');
                }, 10);

                // Close dashboard dropdown if open
                if (dashboardMenu && !dashboardMenu.classList.contains('hidden')) {
                    dashboardMenu.classList.add('hidden');
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!userDropdown.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                    setTimeout(() => {
                        dropdownMenu.classList.add('hidden');
                    }, 300);
                }
            });
        }

        // Mobile menu toggle
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                if (sidebar) {
                    sidebar.classList.toggle('-translate-x-full');
                }

                const overlay = document.getElementById('sidebar-overlay');
                if (overlay) {
                    overlay.classList.toggle('hidden');
                }
            });
        }

        // Show logout modal with animation
        function showLogoutModal() {
            if (logoutModal && modalContent) {
                logoutModal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.add('show');
                }, 10);
            }
        }

        // Hide logout modal with animation
        function hideLogoutModal() {
            if (logoutModal && modalContent) {
                modalContent.classList.remove('show');
                setTimeout(() => {
                    logoutModal.classList.add('hidden');
                }, 300);
            }
        }

        // Logout button click
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
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
            cancelLogout.addEventListener('click', function(e) {
                e.preventDefault();
                hideLogoutModal();
            });
        }

        // Close modal when clicking on backdrop
        if (logoutModal) {
            logoutModal.addEventListener('click', function(e) {
                if (e.target === logoutModal) {
                    hideLogoutModal();
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && logoutModal && !logoutModal.classList.contains('hidden')) {
                hideLogoutModal();
            }
        });

        // Smooth scroll behavior
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>