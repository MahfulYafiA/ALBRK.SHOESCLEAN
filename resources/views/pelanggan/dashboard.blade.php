<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - ALBRK.SHOESCARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #e5e7eb; }
        .glass-panel, .action-card { background: #fff; border: 1px solid rgba(15, 23, 42, .08); }
        .action-card { transition: all .25s ease; }
        .action-card:hover { transform: translateY(-4px); border-color: rgba(17, 17, 17, .16); box-shadow: 0 18px 32px rgba(15, 23, 42, .08); }
        .action-card:hover .action-icon { background: #111; box-shadow: 0 8px 24px rgba(17, 17, 17, .2); }
        .action-icon { background: #111; border: 1px solid #111; transition: all .25s ease; }
        .custom-scroll { scrollbar-width: none; -ms-overflow-style: none; }
        .custom-scroll::-webkit-scrollbar { display: none; }
        .customer-dashboard main { background: #e5e7eb; }
        .customer-dashboard header { background: rgba(255, 255, 255, .88); border-color: #e5e7eb; }
        .customer-dashboard .text-white { color: #111827; }
        .customer-dashboard .text-slate-200, .customer-dashboard .text-slate-300 { color: #374151; }
        .customer-dashboard .text-slate-400 { color: #6b7280; }
        .customer-dashboard .text-slate-500, .customer-dashboard .text-slate-600 { color: #9ca3af; }
        .customer-dashboard .bg-slate-800, .customer-dashboard .bg-slate-800\/50 { background-color: #f3f4f6; }
        .customer-dashboard .border-slate-700 { border-color: #e5e7eb; }
        .customer-dashboard .text-emerald-400, .customer-dashboard .text-emerald-500 { color: #111; }
        .customer-dashboard .bg-emerald-500\/10 { background-color: #f3f4f6; }
        .customer-dashboard .bg-emerald-500 { background-color: #111; }
        .customer-dashboard .border-emerald-500\/20, .customer-dashboard .border-emerald-500\/40 { border-color: rgba(17, 17, 17, .14); }
        .customer-dashboard .action-icon .text-emerald-400 { color: #fff; }
        .customer-dashboard .rounded-full.bg-emerald-600 { background-color: #111; }
        .customer-dashboard .inline-flex .bg-emerald-500 { background-color: #22c55e; }
        .customer-dashboard a.bg-emerald-500, .customer-dashboard a.bg-emerald-500 .text-slate-950 { color: #fff; }
        .customer-dashboard a.reservation-cta { color: #fff !important; }
        .customer-dashboard a.reservation-cta:hover, .customer-dashboard a.reservation-cta:active { color: #000 !important; }
        .customer-dashboard .text-emerald-400\/80 { color: #9ca3af; }
    </style>
</head>
<body class="customer-dashboard h-screen overflow-hidden bg-[#0f172a] text-slate-200 antialiased selection:bg-gray-900 selection:text-white">
    <main class="flex h-screen flex-col overflow-hidden bg-[#0f172a] relative">
        <header class="sticky top-0 z-40 flex shrink-0 items-center justify-between border-b border-slate-700/80 bg-[#0f172a]/75 px-6 py-4 backdrop-blur-xl md:px-12">
            <div class="flex items-center gap-3 md:gap-4">
                <div>
                    <h1 class="text-xl font-black uppercase italic leading-none tracking-tighter text-white md:text-2xl">ALBRK.<span class="text-gray-400">SHOESCARE</span></h1>
                </div>
            </div>

            <div class="relative">
                <button type="button" onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center rounded-full border border-slate-700 bg-slate-800/50 p-1 pr-4 shadow-inner transition-all hover:border-emerald-500/40">
                    <div class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full border border-slate-700 bg-emerald-600 text-[10px] font-black text-white shadow-xl shadow-emerald-500/20">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ route('profil.foto') }}" class="h-full w-full rounded-full bg-white object-contain p-0.5" alt="Foto profil" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden')">
                            <span class="hidden">{{ strtoupper(substr(auth()->user()->nama ?? 'PL', 0, 2)) }}</span>
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? 'PL', 0, 2)) }}
                        @endif
                    </div>
                    <div class="ml-3 hidden text-left md:block">
                        <p class="text-[10px] font-black uppercase tracking-widest leading-none text-white">{{ explode(' ', auth()->user()->nama ?? 'Pelanggan')[0] }}</p>
                        <p class="mt-1 text-[7px] font-bold uppercase tracking-widest text-emerald-400/80">Pelanggan</p>
                    </div>
                    <i class="fa-solid fa-chevron-down ml-3 text-[10px] text-slate-500"></i>
                </button>
                <div id="userMenu" class="absolute right-0 z-50 mt-3 hidden w-56 overflow-hidden rounded-2xl border border-slate-700 bg-slate-900/95 shadow-2xl shadow-black/30">
                    <a href="{{ route('profil.index') }}" class="flex items-center gap-3 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition-colors hover:bg-slate-100 hover:text-emerald-700"><i class="fa-solid fa-user-gear w-4 text-center"></i>Kelola Profil</a>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="flex w-full items-center gap-3 bg-white px-4 py-3 text-left text-sm font-semibold text-red-600 transition-colors hover:bg-slate-100 hover:text-red-700"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>Keluar</button></form>
                </div>
            </div>
        </header>

        <div class="custom-scroll relative min-h-0 flex-1 overflow-hidden p-6 md:p-12">
            <div class="pointer-events-none absolute right-0 top-0 h-[500px] w-[500px] -translate-y-1/2 translate-x-1/4 rounded-full bg-emerald-600/10 blur-[120px]"></div>

            <section class="glass-panel relative mb-8 overflow-hidden rounded-[2rem] p-8">
                <div class="absolute right-0 top-0 h-64 w-64 -translate-y-1/2 translate-x-1/3 rounded-full bg-emerald-500/10 blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl font-black tracking-tight text-white lg:text-4xl">Halo, <span class="text-emerald-400">{{ auth()->user()->nama ?? 'Pelanggan' }}!</span></h2>
                    <p class="mt-2 max-w-xl text-slate-400">Kelola reservasi dan pantau status perawatan sepatu Anda dengan mudah.</p>
                </div>
            </section>

            <section class="relative z-10 mb-8">
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @php
                        $menus = [
                            ['url' => route('profil.index'), 'icon' => 'fa-user', 'title' => 'Profil', 'desc' => 'Pengaturan'],
                            ['url' => route('reservasi.create'), 'icon' => 'fa-calendar-plus', 'title' => 'Reservasi Baru', 'desc' => 'Buat pesanan'],
                            ['url' => route('reservasi.riwayat'), 'icon' => 'fa-clock-rotate-left', 'title' => 'Riwayat', 'desc' => 'Lihat pesanan'],
                            ['url' => 'https://wa.me/6285736084686', 'icon' => 'fa-headset', 'title' => 'Bantuan', 'desc' => 'Hubungi CS', 'external' => true],
                        ];
                    @endphp
                    @foreach($menus as $menu)
                        <a href="{{ $menu['url'] }}" @if(!empty($menu['external'])) target="_blank" rel="noopener noreferrer" @endif class="action-card rounded-2xl p-5 text-center">
                            <div class="action-icon mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl"><i class="fa-solid {{ $menu['icon'] }} text-xl text-emerald-400"></i></div>
                            <h4 class="mb-1 font-semibold text-white">{{ $menu['title'] }}</h4>
                            <p class="text-[10px] uppercase tracking-wider text-slate-500">{{ $menu['desc'] }}</p>
                        </a>
                    @endforeach
                </div>
            </section>

            <section class="glass-panel relative z-10 rounded-2xl p-6">
                <div class="mb-6 flex items-center justify-between"><h3 class="font-bold text-white">Reservasi Terbaru</h3><a href="{{ route('reservasi.riwayat') }}" class="text-sm font-semibold text-emerald-400 transition-colors hover:text-emerald-300">Lihat Semua</a></div>
                <div class="py-12 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-slate-800"><i class="fa-solid fa-inbox text-3xl text-slate-500"></i></div>
                    <h4 class="mb-2 font-semibold text-white">Belum ada reservasi</h4>
                    <p class="mb-6 text-sm text-slate-400">Mulai buat reservasi pertama Anda</p>
                    <a href="{{ route('reservasi.create') }}" class="reservation-cta inline-flex items-center gap-2 rounded-xl bg-black px-6 py-3 text-sm font-bold text-white transition-all hover:-translate-y-0.5 hover:bg-white hover:text-black active:scale-95 active:bg-white active:text-black focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-300"><i class="fa-solid fa-plus"></i>Buat Reservasi</a>
                </div>
            </section>
        </div>
        <footer class="shrink-0 border-t border-gray-300 bg-white px-6 py-6 text-center">
            <p class="text-xs text-gray-500">&copy; 2026 <span class="font-semibold text-gray-600">ALBRK.SHOESCARE</span></p>
        </footer>
    </main>
</body>
</html>
