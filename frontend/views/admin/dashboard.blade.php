<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - ALBRK.SHOECARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #0f172a; overflow-x: hidden; }

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
<body class="text-slate-200 antialiased">

    {{-- KONTEN UTAMA --}}
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside class="w-64 min-h-screen glass-panel border-r border-white/5 flex flex-col fixed left-0 top-0 z-30">
            {{-- Logo Section --}}
            <div class="p-6 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="font-black text-xl uppercase tracking-tighter italic text-white leading-tight">
                            ALBRK.<span class="text-emerald-500">ADMIN</span>
                        </h1>
                        <p class="text-[9px] text-slate-500 uppercase tracking-widest mt-1">Admin Panel</p>
                    </div>
                </div>
            </div>

            {{-- User Section --}}
            <div class="p-5 border-b border-white/5">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-slate-800/40 border border-slate-700">
                    <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white text-xs font-black border border-slate-700 shadow-xl overflow-hidden">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ explode(' ', auth()->user()->nama)[0] }}</p>
                        <p class="text-[10px] text-indigo-400 uppercase tracking-wide">Staff</p>
                    </div>
                </div>
                <a href="{{ route('profil.index') }}" class="mt-3 flex items-center gap-2 text-xs text-slate-400 hover:text-white transition-colors">
                    <i class="fa-solid fa-gear text-xs"></i>
                    <span>Pengaturan Akun</span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4">
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest px-4 mb-3">Menu</p>
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                        <i class="fa-solid fa-house text-sm w-5"></i>
                        <span class="text-sm font-semibold">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.transaksi.offline') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all">
                        <i class="fa-solid fa-cash-register text-sm w-5"></i>
                        <span class="text-sm">Kasir Offline</span>
                    </a>
                    <a href="{{ route('admin.antrean') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all">
                        <i class="fa-solid fa-list-check text-sm w-5"></i>
                        <span class="text-sm">Antrean</span>
                    </a>
                    <a href="{{ route('admin.layanan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all">
                        <i class="fa-solid fa-box text-sm w-5"></i>
                        <span class="text-sm">Layanan</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all">
                        <i class="fa-solid fa-users text-sm w-5"></i>
                        <span class="text-sm">Pelanggan</span>
                    </a>
                    <a href="{{ route('admin.laporan') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all">
                        <i class="fa-solid fa-chart-line text-sm w-5"></i>
                        <span class="text-sm">Laporan</span>
                    </a>
                </div>
            </nav>

            {{-- Footer --}}
            <div class="p-4 border-t border-white/5">
                <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:bg-slate-800/50 hover:text-white transition-all mb-1">
                    <i class="fa-solid fa-globe text-sm w-5"></i>
                    <span class="text-sm">Kembali ke Beranda</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-400 hover:text-red-300 transition-all">
                        <i class="fa-solid fa-arrow-right-from-bracket text-sm w-5"></i>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 ml-64">
            {{-- Top Bar --}}
            <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-white/5 px-8 py-4 sticky top-0 z-20">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-black text-white uppercase tracking-tight">Dashboard Admin</h2>
                        <p class="text-xs text-slate-500">Kelola operasional toko</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center bg-emerald-500/10 border border-emerald-500/20 px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse mr-2"></span>
                            <span class="text-[10px] font-black text-emerald-400 uppercase tracking-wider">Online</span>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <div class="p-8 custom-scroll relative">
                {{-- Background Glow --}}
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600/10 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4"></div>

                {{-- Welcome Section --}}
                <div class="glass-panel rounded-[2rem] p-8 mb-8 relative overflow-hidden border border-white/5">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
                    <div class="relative z-10">
                        <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-4 py-1.5 rounded-full mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <p class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.3em]">System Active</p>
                        </div>
                        <h1 class="text-3xl lg:text-4xl font-black text-white mb-2 tracking-tight">
                            Selamat Datang, <span class="text-emerald-400">{{ auth()->user()->nama ?? 'Admin' }}!</span>
                        </h1>
                        <p class="text-slate-400 max-w-xl">Kelola operasional ALBRK.SHOECARE dengan mudah. Pantau antrean, kelola layanan, dan lihat laporan omset.</p>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
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
                        <p class="text-[10px] text-slate-500 uppercase tracking-wider">Pelanggan</p>
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
                    <div class="grid grid-cols-2 lg:grid-cols-6 gap-4">
                        @php
                            $menus = [
                                ['url' => route('admin.transaksi.offline'), 'icon' => 'fa-cash-register', 'title' => 'Kasir', 'desc' => 'Offline'],
                                ['url' => route('profil.index'), 'icon' => 'fa-id-card', 'title' => 'Profil', 'desc' => 'Settings'],
                                ['url' => route('admin.antrean'), 'icon' => 'fa-list-check', 'title' => 'Antrean', 'desc' => 'Status'],
                                ['url' => route('admin.laporan'), 'icon' => 'fa-chart-line', 'title' => 'Laporan', 'desc' => 'Omset'],
                                ['url' => route('admin.users'), 'icon' => 'fa-users', 'title' => 'Pelanggan', 'desc' => 'Database'],
                                ['url' => route('admin.layanan.index'), 'icon' => 'fa-box', 'title' => 'Layanan', 'desc' => 'Harga'],
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
            <footer class="px-8 py-6 border-t border-white/5 bg-[#0f172a]/50">
                <p class="text-xs text-slate-500">&copy; 2026 ALBRK.SHOECARE. All rights reserved. | Admin Panel</p>
            </footer>
        </main>
    </div>
</body>
</html>
