<nav class="fixed top-0 left-0 lg:left-64 right-0 bg-gradient-to-br from-blue-50 via-white to-blue-50 shadow-md px-4 md:px-6 py-3 flex justify-end items-center w-full lg:w-auto z-30 border-b-2 border-blue-300" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px;">

    <div class="flex items-center gap-2">

        {{-- BELL --}}
        <div class="relative" id="notif-wrapper">
            <button id="notif-btn"
                    class="relative p-2.5 rounded-xl hover:bg-blue-100 text-blue-600 transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span id="notif-badge"
                      class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center hidden">
                    0
                </span>
            </button>

            {{-- Dropdown --}}
            <div id="notif-dropdown"
                 class="hidden absolute right-0 top-full mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden z-50">
                <div class="flex items-center justify-between px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                    <span class="font-bold text-sm">🔔 Notifikasi</span>
                    <button id="baca-semua-btn" class="text-xs text-blue-100 hover:text-white underline transition">
                        Tandai semua dibaca
                    </button>
                </div>
                <div id="notif-list" class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                    <div class="flex items-center justify-center py-10 text-slate-400 text-sm" id="notif-empty">
                        <span>Tidak ada notifikasi</span>
                    </div>
                </div>
                <div class="px-4 py-2.5 bg-slate-50 border-t border-slate-100 text-center">
                    <a href="{{ route('petugas.peminjaman.index') }}"
                       class="text-xs text-blue-500 hover:text-blue-700 font-semibold transition">
                        Lihat semua peminjaman →
                    </a>
                </div>
            </div>
        </div>

        {{-- USER --}}
        <div class="flex items-center gap-2 px-3 py-2 rounded-xl bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md">
            <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="font-semibold text-sm">{{ auth()->user()->name ?? 'Petugas' }}</span>
        </div>

    </div>
</nav>

<div class="h-16"></div>

<script>
(function () {
    const btn        = document.getElementById('notif-btn');
    const dropdown   = document.getElementById('notif-dropdown');
    const badge      = document.getElementById('notif-badge');
    const list       = document.getElementById('notif-list');
    const emptyEl    = document.getElementById('notif-empty');
    const bacaSemua  = document.getElementById('baca-semua-btn');

    const apiUrl     = "{{ route('petugas.notifikasi.index') }}";
    const bacaUrl    = "{{ url('petugas/notifikasi') }}";
    const bacaSemUrl = "{{ route('petugas.notifikasi.baca-semua') }}";
    const csrf       = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    const iconMap = {
        info:    { bg: 'bg-blue-100',   emoji: 'ℹ️' },
        success: { bg: 'bg-green-100',  emoji: '✅' },
        warning: { bg: 'bg-yellow-100', emoji: '⚠️' },
        danger:  { bg: 'bg-red-100',    emoji: '❌' },
    };

    function renderNotif(data) {
        if (!data.length) {
            list.innerHTML = '';
            list.appendChild(emptyEl);
            emptyEl.classList.remove('hidden');
            return;
        }
        emptyEl.classList.add('hidden');
        list.innerHTML = data.map(n => {
            const ic = iconMap[n.icon] ?? iconMap.info;
            return `
            <div class="flex gap-3 px-4 py-3 hover:bg-slate-50 transition cursor-pointer notif-item ${n.dibaca ? 'opacity-60' : ''}"
                 data-id="${n.id}" data-url="${n.url ?? ''}">
                <div class="w-9 h-9 rounded-full ${ic.bg} flex items-center justify-center flex-shrink-0 text-base">${ic.emoji}</div>
                <div class="flex-1 min-w-0">
                    <div class="text-xs font-bold text-slate-800 truncate">${n.judul}</div>
                    <div class="text-xs text-slate-500 mt-0.5 line-clamp-2">${n.pesan}</div>
                    <div class="text-xs text-slate-400 mt-1">${n.waktu}</div>
                </div>
                ${!n.dibaca ? '<span class="w-2 h-2 bg-blue-500 rounded-full flex-shrink-0 mt-1.5"></span>' : ''}
            </div>`;
        }).join('');

        list.querySelectorAll('.notif-item').forEach(el => {
            el.addEventListener('click', () => {
                const id  = el.dataset.id;
                const url = el.dataset.url;
                fetch(`${bacaUrl}/${id}/baca`, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
                }).finally(() => {
                    if (url) window.location.href = url;
                    else loadNotif();
                });
            });
        });
    }

    function loadNotif() {
        fetch(apiUrl, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(r => r.json())
            .then(data => {
                renderNotif(data.notifikasi);
                if (data.unread > 0) {
                    badge.textContent = data.unread > 9 ? '9+' : data.unread;
                    badge.classList.remove('hidden');
                } else {
                    badge.classList.add('hidden');
                }
            })
            .catch(() => {});
    }

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
        if (!dropdown.classList.contains('hidden')) loadNotif();
    });

    document.addEventListener('click', (e) => {
        if (!document.getElementById('notif-wrapper').contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });

    bacaSemua.addEventListener('click', () => {
        fetch(bacaSemUrl, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrf, 'Content-Type': 'application/json' }
        }).then(() => loadNotif());
    });

    loadNotif();
    setInterval(loadNotif, 30000);
})();
</script>