<header class="sticky top-0 z-50 bg-gradient-to-r from-white via-gray-50 to-white px-6 py-3 header-3d">
    <div class="flex items-center justify-between max-w-7xl mx-auto">
        
        <!-- Left: Mobile Menu Toggle -->
        <div class="flex items-center">
            <button id="mobile-menu-toggle" class="lg:hidden p-2.5 rounded-xl hover:bg-white transition-all duration-300 mobile-btn-3d">
                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Right: User Profile Only -->
        <div class="flex items-center gap-3 ml-auto">

            <!-- User Profile Dropdown -->
            <div class="relative" id="user-dropdown">
                <button class="flex items-center gap-3 pl-2 pr-3 py-2 rounded-xl hover:bg-white transition-all duration-300 group user-btn-3d">
                    <div class="relative">
                        <div class="w-10 h-10 rounded-xl overflow-hidden border-2 border-blue-100 avatar-3d">
                            <img src="{{asset('assets_admin/img/sip.png')}}" alt="Admin Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white status-dot-3d"></span>
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-gray-800">Administrator</p>
                        <p class="text-xs text-gray-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                            Online
                        </p>
                    </div>
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
                    
                    <!-- Logout Section -->
                    <div class="p-3 bg-gray-50">
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