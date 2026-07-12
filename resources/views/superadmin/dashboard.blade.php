<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Superadmin - ALBRK.SHOECARE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f766e',
                        secondary: '#14b8a6',
                        accent: '#334155',
                        dark: '#020617',
                        surface: '#0f172a',
                    },
                    fontFamily: {
                        display: ['Space Grotesk', 'sans-serif'],
                        body: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }
        .gradient-text { background: linear-gradient(135deg, #5eead4 0%, #cbd5e1 52%, #f8fafc 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-card { background: rgba(30, 41, 59, 0.62); backdrop-filter: blur(16px); border: 1px solid rgba(20, 184, 166, 0.1); transition: all 0.4s ease; }
        .glass-card:hover { background: rgba(30, 41, 59, 0.9); transform: translateY(-4px); border-color: rgba(20, 184, 166, 0.35); }
        .stat-card { background: linear-gradient(135deg, rgba(15, 118, 110, 0.14) 0%, rgba(51, 65, 85, 0.1) 100%); border: 1px solid rgba(20, 184, 166, 0.18); }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(71, 85, 105, 0.4); border-radius: 3px; }
    </style>
</head>
<body class="text-gray-200 antialiased min-h-screen" style="background: linear-gradient(135deg, #07111f 0%, #0f172a 58%, #14312f 100%);">

    <div class="relative z-10 min-h-screen flex flex-col">
        <header class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-xl border-b border-slate-700/30 px-6 py-4">
            <div class="w-full flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center shadow-lg shadow-teal-950/30">
                        <i class="fa-solid fa-crown text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="font-display font-bold text-xl text-white">ALBRK<span class="text-slate-400">.SHOECARE</span></h1>
                        <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Superadmin Panel</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="hidden sm:flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
                        <i class="fa-solid fa-globe"></i><span>Landing</span>
                    </a>

                    <div class="flex items-center gap-3 bg-slate-800/50 border border-slate-700 rounded-full px-4 py-2">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center text-white text-xs font-bold">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover rounded-full">
                            @else
                                {{ strtoupper(substr(auth()->user()->nama ?? 'SA', 0, 2)) }}
                            @endif
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold text-white">{{ explode(' ', auth()->user()->nama)[0] }}</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Owner</p>
                        </div>
                        <div class="w-px h-6 bg-slate-600"></div>
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 px-6 py-8 w-full">
            <div class="relative rounded-2xl p-8 mb-8 overflow-hidden" style="background: linear-gradient(135deg, rgba(15, 118, 110, 0.22) 0%, rgba(51, 65, 85, 0.18) 100%); border: 1px solid rgba(20, 184, 166, 0.2);">
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span></span>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Full Access Granted</span>
                    </div>
                    <h1 class="font-display text-3xl lg:text-4xl font-bold text-white mb-3">
                        Welcome Back, <span class="italic gradient-text">{{ auth()->user()->nama ?? 'Owner' }}!</span>
                    </h1>
                    <p class="text-gray-400 max-w-2xl">Anda memiliki akses penuh ke sistem. Kelola admin, lihat laporan lengkap, dan pantau seluruh operasional bisnis.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <div class="stat-card rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-600/30 flex items-center justify-center"><i class="fa-solid fa-clock text-slate-300 text-lg"></i></div>
                        <span class="text-emerald-400 text-xs font-semibold">+12%</span>
                    </div>
                    <p class="text-3xl font-bold text-white mb-1">{{ $stats['total_antrean'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Antrean Aktif</p>
                </div>

                <div class="stat-card rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-emerald-600/30 flex items-center justify-center"><i class="fa-solid fa-check-circle text-emerald-400 text-lg"></i></div>
                        <span class="text-emerald-400 text-xs font-semibold">+8%</span>
                    </div>
                    <p class="text-3xl font-bold text-white mb-1">{{ $stats['total_selesai'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Selesai</p>
                </div>

                <div class="stat-card rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-500/30 flex items-center justify-center"><i class="fa-solid fa-users text-slate-300 text-lg"></i></div>
                    </div>
                    <p class="text-3xl font-bold text-white mb-1">{{ $stats['total_pelanggan'] ?? 0 }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Total User</p>
                </div>

                <div class="stat-card rounded-2xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="w-12 h-12 rounded-xl bg-slate-600/30 flex items-center justify-center"><i class="fa-solid fa-coins text-slate-300 text-lg"></i></div>
                        <span class="text-emerald-400 text-xs font-semibold">+15%</span>
                    </div>
                    <p class="text-2xl font-bold text-white mb-1">Rp {{ number_format($stats['total_omzet'] ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">Total Omzet</p>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                @php
                    $menus = [
                        ['url' => route('profil.index'), 'icon' => 'fa-id-card', 'title' => 'Profil', 'desc' => 'Settings', 'color' => 'text-teal-200', 'bg' => 'bg-slate-700/70'],
                        ['url' => route('superadmin.laporan'), 'icon' => 'fa-chart-line', 'title' => 'Laporan', 'desc' => 'Omset', 'color' => 'text-teal-200', 'bg' => 'bg-teal-500/10'],
                        ['url' => route('superadmin.users'), 'icon' => 'fa-user-shield', 'title' => 'Manajemen', 'desc' => 'User & Admin', 'color' => 'text-teal-200', 'bg' => 'bg-slate-700/70'],
                        ['url' => route('admin.antrean'), 'icon' => 'fa-list-check', 'title' => 'Antrean', 'desc' => 'Status', 'color' => 'text-teal-200', 'bg' => 'bg-teal-500/10'],
                        ['url' => route('admin.layanan.index'), 'icon' => 'fa-box', 'title' => 'Layanan', 'desc' => 'Harga', 'color' => 'text-teal-200', 'bg' => 'bg-slate-700/70'],
                        ['url' => route('admin.transaksi.offline'), 'icon' => 'fa-cash-register', 'title' => 'Kasir', 'desc' => 'Offline', 'color' => 'text-teal-200', 'bg' => 'bg-teal-500/10'],
                    ];
                @endphp

                @foreach($menus as $menu)
                <a href="{{ $menu['url'] }}" class="glass-card group rounded-2xl p-5 flex flex-col items-center text-center">
                    <div class="w-14 h-14 {{ $menu['bg'] }} {{ $menu['color'] }} rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid {{ $menu['icon'] }} text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">{{ $menu['title'] }}</h3>
                    <p class="text-xs text-gray-500 uppercase tracking-wider">{{ $menu['desc'] }}</p>
                </a>
                @endforeach
            </div>
        </main>

        <footer class="border-t border-slate-800 py-6 px-6 text-center">
            <p class="text-gray-600 text-xs">&copy; 2026 <span class="text-slate-400 font-semibold">ALBRK.SHOECARE</span> Superadmin Panel</p>
        </footer>
    </div>
</body>
</html>
