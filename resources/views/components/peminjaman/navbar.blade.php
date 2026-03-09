@php
    $notifikasis = \App\Models\Notifikasi::where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->limit(10)
        ->get();
    $unreadCount = $notifikasis->where('dibaca', false)->count();
@endphp

<header class="fixed top-0 right-0 left-0 lg:left-72 z-30 bg-gradient-to-r from-white via-blue-50 to-white shadow-lg backdrop-blur-sm bg-opacity-95">
    <div class="px-6 py-4 flex justify-between items-center">

        <!-- Page Title -->
        <div class="flex items-center space-x-4">
            <button id="mobileMenuToggle" class="lg:hidden p-2 rounded-lg bg-white shadow-md hover:shadow-lg transition-all duration-300 group">
                <svg class="w-6 h-6 text-blue-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="relative">
                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    @yield('page-title', 'Dashboard Peminjam')
                </h1>
                <div class="absolute -bottom-1 left-0 h-1 w-16 bg-gradient-to-r from-blue-500 to-transparent rounded-full"></div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">

            <!-- NOTIFIKASI DROPDOWN -->
            <div class="relative" id="notifDropdown">
                <button id="notifButton" class="relative p-2.5 rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300 group">
                    <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @if($unreadCount > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-br from-red-500 to-red-600 rounded-full text-white text-xs flex items-center justify-center font-bold shadow-lg">
                            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                        </span>
                    @endif
                </button>

                <!-- Notif Panel -->
                <div id="notifMenu" class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-2xl opacity-0 invisible transform scale-95 transition-all duration-300 origin-top-right overflow-hidden">
                    <div class="px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 flex items-center justify-between">
                        <h3 class="text-white font-bold text-sm">Notifikasi</h3>
                        @if($unreadCount > 0)
                            <form action="{{ route('peminjam.notifikasi.baca-semua') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-blue-200 hover:text-white text-xs font-semibold transition">
                                    Tandai semua dibaca
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
                        @forelse($notifikasis->take(5) as $notif)
                        @php
                            $iconBg = match($notif->icon) {
                                'success' => 'bg-green-100',
                                'danger'  => 'bg-red-100',
                                'warning' => 'bg-yellow-100',
                                default   => 'bg-blue-100',
                            };
                            $emoji = match($notif->icon) {
                                'success' => '✅',
                                'danger'  => '❌',
                                'warning' => '⚠️',
                                default   => '📢',
                            };
                        @endphp
                        <a href="{{ route('peminjam.notifikasi.baca', $notif->id) }}"
                           class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 transition {{ $notif->dibaca ? '' : 'bg-blue-50/50' }}">
                            <div class="w-9 h-9 rounded-xl {{ $iconBg }} flex items-center justify-center flex-shrink-0 text-base">
                                {{ $emoji }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-gray-900 leading-snug">{{ $notif->judul }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 line-clamp-2 leading-relaxed">{{ $notif->pesan }}</p>
                                <p class="text-[10px] text-gray-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                            </div>
                            @if(!$notif->dibaca)
                                <div class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-2"></div>
                            @endif
                        </a>
                        @empty
                        <div class="px-4 py-8 text-center">
                            <p class="text-gray-400 text-sm">Belum ada notifikasi</p>
                        </div>
                        @endforelse
                    </div>

                    @if($notifikasis->count() > 0)
                    <div class="px-4 py-2.5 border-t border-gray-100 text-center">
                        <span class="text-xs text-gray-400">Menampilkan {{ min($notifikasis->count(), 5) }} notifikasi terbaru</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" id="profileDropdown">
                <button id="profileButton" class="flex items-center space-x-3 px-4 py-2.5 rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300 group">
                    <div class="relative">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold shadow-md group-hover:scale-110 transition-transform">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-semibold text-gray-800 leading-tight">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="text-xs text-gray-500">Peminjam</p>
                    </div>
                    <svg id="dropdownArrow" class="w-4 h-4 text-gray-600 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="dropdownMenu" class="absolute right-0 mt-4 w-64 bg-white rounded-xl shadow-2xl opacity-0 invisible transform scale-95 transition-all duration-300 origin-top-right overflow-hidden">
                    <div class="px-4 py-5 bg-gradient-to-br from-blue-50 to-white border-b border-blue-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="text-xs text-gray-500">{{ auth()->user()->email ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-blue-50 transition group">
                            <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-sm">Profile Saya</p>
                                <p class="text-xs text-gray-500">Kelola akun Anda</p>
                            </div>
                        </a>
                        <div class="px-4 py-2 border-t border-gray-100">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-red-600 hover:bg-red-50 rounded-xl transition text-sm font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="h-1 bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>
</header>

<script>
const notifButton = document.getElementById('notifButton');
const notifMenu   = document.getElementById('notifMenu');
const profileButton = document.getElementById('profileButton');
const dropdownMenu  = document.getElementById('dropdownMenu');
const dropdownArrow = document.getElementById('dropdownArrow');
let notifOpen = false, profileOpen = false;

notifButton.addEventListener('click', (e) => {
    e.stopPropagation();
    notifOpen = !notifOpen;
    if (notifOpen) {
        notifMenu.classList.remove('opacity-0','invisible','scale-95');
        notifMenu.classList.add('opacity-100','visible','scale-100');
        closeProfile();
    } else { closeNotif(); }
});

profileButton.addEventListener('click', (e) => {
    e.stopPropagation();
    profileOpen = !profileOpen;
    if (profileOpen) {
        dropdownMenu.classList.remove('opacity-0','invisible','scale-95');
        dropdownMenu.classList.add('opacity-100','visible','scale-100');
        dropdownArrow.style.transform = 'rotate(180deg)';
        closeNotif();
    } else { closeProfile(); }
});

function closeNotif() {
    notifMenu.classList.add('opacity-0','invisible','scale-95');
    notifMenu.classList.remove('opacity-100','visible','scale-100');
    notifOpen = false;
}
function closeProfile() {
    dropdownMenu.classList.add('opacity-0','invisible','scale-95');
    dropdownMenu.classList.remove('opacity-100','visible','scale-100');
    dropdownArrow.style.transform = 'rotate(0deg)';
    profileOpen = false;
}

document.addEventListener('click', () => { closeNotif(); closeProfile(); });
document.addEventListener('keydown', (e) => { if(e.key==='Escape'){ closeNotif(); closeProfile(); }});
</script>