<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin - ALBRK.SHOECARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0f172a; overflow: hidden; }

        /* Glassmorphism Panel */
        .glass-panel {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }

        /* Quick Action Card */
        .action-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        .action-card:hover {
            background: rgba(30, 41, 59, 0.6);
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateY(-4px);
        }
        .action-card:hover .action-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        }
        .action-icon {
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        /* Stat Card */
        .stat-card {
            background: rgba(30, 41, 59, 0.4);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            border-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        .stat-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2) 0%, rgba(5, 150, 105, 0.2) 100%);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }
    </style>
</head>
<body class="text-slate-200 antialiased flex h-screen overflow-hidden relative selection:bg-emerald-500 selection:text-white">

        <main class="flex-1 flex flex-col min-w-0 bg-[#0f172a] relative z-10 h-screen">
            <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-white/5 px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40">
                <div class="flex items-center gap-3 md:gap-4">
                    <a href="{{ url('/') }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-slate-800/50 border border-slate-700 text-slate-400 hover:text-emerald-400 hover:bg-slate-800 transition-all flex items-center justify-center shadow-sm group active:scale-95">
                        <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
                    </a>
                    <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-white leading-tight">
                        ALBRK.<span class="text-emerald-500">SUPER</span>
                    </h1>
                </div>
                <div class="flex items-center gap-5">
                    <div class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-800/50 px-3 md:px-4 py-2 rounded-full border border-slate-700 hidden sm:block shadow-inner">
                        Hari ini: <span class="text-white">{{ now()->format('d M Y') }}</span>
                    </div>
                    <div class="relative">
                    <button type="button" id="userMenuButton" onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center bg-slate-800/40 border border-slate-700 p-1 pr-4 rounded-full shadow-inner hover:border-emerald-500/40 transition-all">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-emerald-600 flex items-center justify-center text-[10px] font-black text-white border border-slate-700 shadow-xl shadow-emerald-500/20">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover">
                            @else
                                SU
                            @endif
                        </div>
                        <div class="ml-3 hidden md:block">
                            <p class="text-[10px] font-black text-white uppercase tracking-widest leading-none">{{ explode(' ', auth()->user()->nama)[0] }}</p>
                            <p class="text-[7px] font-bold text-emerald-400/80 uppercase mt-0.5 tracking-tighter">Akses Pemilik</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 ml-3"></i>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-3 w-56 rounded-2xl bg-slate-900/95 border border-slate-700 shadow-2xl shadow-black/30 overflow-hidden z-50">
                        <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-300 transition-colors">
                            <i class="fa-solid fa-user-gear w-4 text-center"></i>
                            Kelola Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors text-left">
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                                Keluar
                            </button>
                        </form>
                    </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <div class="p-6 lg:p-12 flex-1 overflow-y-auto custom-scroll relative">
                {{-- Background Glow --}}
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/10 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4"></div>

                {{-- Welcome Section --}}
                <div class="glass-panel w-full rounded-[2rem] p-8 mb-8 relative overflow-hidden border border-white/5">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-4 py-1.5 rounded-full mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <p class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.3em]">Akses Penuh</p>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-black text-white mb-2 tracking-tight">
                            Selamat Datang Kembali, <span class="text-emerald-400">{{ auth()->user()->nama ?? 'Pemilik' }}!</span>
                        </h1>
                        <p class="text-slate-400 max-w-xl">Anda memiliki akses penuh ke sistem. Kelola admin, lihat laporan lengkap, dan pantau seluruh operasional bisnis.</p>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-8 w-full">
                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div class="stat-icon w-12 h-12 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-clock text-emerald-400 text-lg"></i>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-lg">+12%</span>
                        </div>
                        <p class="text-3xl font-black text-white mb-1">{{ $stats['total_antrean'] ?? 0 }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Antrean Aktif</p>
                    </div>

                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div class="stat-icon w-12 h-12 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-check text-emerald-400 text-lg"></i>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-lg">+8%</span>
                        </div>
                        <p class="text-3xl font-black text-white mb-1">{{ $stats['total_selesai'] ?? 0 }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Selesai</p>
                    </div>

                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div class="stat-icon w-12 h-12 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-users text-emerald-400 text-lg"></i>
                            </div>
                        </div>
                        <p class="text-3xl font-black text-white mb-1">{{ $stats['total_pelanggan'] ?? 0 }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Total User</p>
                    </div>

                    <div class="stat-card rounded-2xl p-5">
                        <div class="flex items-center justify-between mb-3">
                            <div class="stat-icon w-12 h-12 rounded-xl flex items-center justify-center">
                                <i class="fa-solid fa-coins text-emerald-400 text-lg"></i>
                            </div>
                            <span class="text-xs font-bold text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded-lg">+15%</span>
                        </div>
                        <p class="text-2xl font-black text-white mb-1">Rp {{ number_format($stats['total_omzet'] ?? 0, 0, ',', '.') }}</p>
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Total Omzet</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mb-8 relative z-10">
                    <h3 class="text-lg font-bold text-white mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-5 gap-4 w-full">
                        @php
                            $menus = [
                                ['url' => route('superadmin.laporan'), 'icon' => 'fa-chart-line', 'title' => 'Laporan', 'desc' => 'Omset'],
                                ['url' => route('superadmin.users'), 'icon' => 'fa-user-shield', 'title' => 'Manajemen', 'desc' => 'User & Admin'],
                                ['url' => route('admin.antrean'), 'icon' => 'fa-list-check', 'title' => 'Antrean', 'desc' => 'Status'],
                                ['url' => route('superadmin.layanan.index'), 'icon' => 'fa-box', 'title' => 'Layanan', 'desc' => 'Harga'],
                                ['url' => route('superadmin.transaksi.offline'), 'icon' => 'fa-cash-register', 'title' => 'Kasir', 'desc' => 'Offline'],
                            ];
                        @endphp

                        @foreach($menus as $menu)
                        <a href="{{ $menu['url'] }}" class="action-card rounded-2xl p-5 text-center cursor-pointer">
                            <div class="action-icon w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid {{ $menu['icon'] }} text-xl text-emerald-400"></i>
                            </div>
                            <h4 class="font-semibold text-white mb-1">{{ $menu['title'] }}</h4>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider">{{ $menu['desc'] }}</p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <footer class="mt-auto w-full px-8 py-6 border-t border-white/5 bg-[#0f172a]/50">
                <p class="text-xs text-slate-500">&copy; 2026 ALBRK.SHOECARE. Hak cipta dilindungi. | Panel Superadmin</p>
            </footer>
        </main>
    <script>
        document.addEventListener('click', (event) => {
            const menu = document.getElementById('userMenu');
            const button = document.getElementById('userMenuButton');
            if (!menu || !button || button.contains(event.target) || menu.contains(event.target)) return;
            menu.classList.add('hidden');
        });
    </script>
</body>
</html>
