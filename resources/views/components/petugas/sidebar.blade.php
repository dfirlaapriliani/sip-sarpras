{{-- Sidebar --}}
<aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-2xl z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300" id="sidebar">
  
  {{-- Header Sidebar --}}
  <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
        </svg>
      </div>
      <div class="text-center">
  <h2 class="text-lg font-bold text-gray-800">SIP-SARPRAS</h2>
  <p class="mt-1 text-sm text-gray-500 uppercase tracking-wide">Petugas</p>
</div>

    </div>
    
    {{-- Close Button (Mobile Only) --}}
    <button class="lg:hidden text-gray-600 hover:text-gray-800" onclick="toggleSidebar()">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
  </div>

  {{-- Navigation Menu --}}
  <nav class="px-4 py-6 space-y-2 overflow-y-auto h-[calc(100vh-180px)]">
    
    {{-- Dashboard --}}
    <a href="{{ route('petugas.dashboard') }}" 
       class="menu-item {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }} flex items-center gap-4 px-4 py-3.5 rounded-xl">
      <div class="w-10 h-10 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
      </div>
      <span class="font-semibold">Dashboard</span>
    </a>
  
    {{-- Data Barang --}}
    <a href="{{ route('petugas.barang.index') }}" 
       class="menu-item flex items-center gap-4 px-4 py-3.5 rounded-xl">
      <div class="w-10 h-10 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
        </svg>
      </div>
      <span class="font-semibold">Data Barang</span>
    </a>

    {{-- Data Peminjam --}}
    <a href="#data-peminjam" 
       class="menu-item flex items-center gap-4 px-4 py-3.5 rounded-xl">
      <div class="w-10 h-10 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
      </div>
      <span class="font-semibold">Data Peminjam</span>
    </a>

    {{-- Laporan --}}
    <a href="#laporan" 
       class="menu-item flex items-center gap-4 px-4 py-3.5 rounded-xl">
      <div class="w-10 h-10 rounded-lg flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
        </svg>
      </div>
      <span class="font-semibold">Laporan</span>
    </a>
  </nav>

  {{-- Logout Button --}}
  <div class="absolute bottom-0 left-0 right-0 px-4 py-4 border-t border-gray-200 bg-white">
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" 
              class="w-full flex items-center gap-4 px-4 py-3.5 rounded-xl bg-gray-50 hover:bg-red-50 text-gray-700 hover:text-red-600 border border-gray-200 hover:border-red-300">
        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-sm">
          <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
        </div>
        <span class="font-semibold">Logout</span>
      </button>
    </form>
  </div>
</aside>

{{-- Overlay for Mobile --}}
<div class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" id="overlay" onclick="toggleSidebar()"></div>

{{-- Mobile Menu Button --}}
<button class="fixed top-4 left-4 z-50 lg:hidden bg-gradient-to-br from-blue-500 to-blue-600 text-white p-3 rounded-xl shadow-lg" onclick="toggleSidebar()">
  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>

<script>
function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('overlay');
  
  sidebar.classList.toggle('-translate-x-full');
  overlay.classList.toggle('hidden');
}

// Close sidebar when clicking menu items on mobile
document.querySelectorAll('#sidebar a').forEach(link => {
  link.addEventListener('click', () => {
    if (window.innerWidth < 1024) {
      toggleSidebar();
    }
  });
});
</script>

<style>
/* Active state */
.menu-item.active {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: white;
  box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);
}

.menu-item.active .w-10 {
  background-color: rgba(255, 255, 255, 0.2);
}

.menu-item.active svg {
  color: white;
}

/* Non-active state */
.menu-item:not(.active) {
  background-color: #f9fafb;
  color: #374151;
  border: 1px solid #e5e7eb;
}

.menu-item:not(.active) .w-10 {
  background-color: white;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
}

.menu-item:not(.active) svg {
  color: #2563eb;
}

/* Hover state */
.menu-item:not(.active):hover {
  background: linear-gradient(to right, #3b82f6, #2563eb);
  color: white;
  border-color: transparent;
  box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
}

.menu-item:not(.active):hover .w-10 {
  background-color: rgba(255, 255, 255, 0.2);
}

.menu-item:not(.active):hover svg {
  color: white;
}

.menu-item {
  transition: all 0.2s ease;
}
</style>