<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ALBRK.SHOECARE</title>

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
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(71, 85, 105, 0.4); border-radius: 3px; }
    </style>
</head>
<body class="text-gray-200 antialiased min-h-screen" style="background: linear-gradient(135deg, #07111f 0%, #0f172a 58%, #14312f 100%);">

    <div class="relative z-10 min-h-screen flex flex-col">
        <header class="sticky top-0 z-50 bg-slate-900/80 backdrop-blur-xl border-b border-slate-700/30 px-6 py-4">
            <div class="w-full flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="/" class="w-11 h-11 rounded-2xl bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center shadow-lg shadow-teal-950/30">
                        <i class="fa-solid fa-shoe-prints text-white"></i>
                    </a>
                    <div>
                        <h1 class="font-display font-bold text-xl text-white">ALBRK<span class="text-slate-400">.SHOECARE</span></h1>
                        <p class="text-xs text-gray-500">Customer Dashboard</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <a href="/" class="hidden sm:flex items-center gap-2 text-gray-400 hover:text-white transition-colors text-sm">
                        <i class="fa-solid fa-home"></i><span>Beranda</span>
                    </a>

                    <div class="flex items-center gap-3 bg-slate-800/50 border border-slate-700 rounded-full px-4 py-2">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center text-white text-xs font-bold">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover rounded-full">
                            @else
                                {{ strtoupper(substr(auth()->user()->nama ?? 'CU', 0, 2)) }}
                            @endif
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold text-white">{{ explode(' ', auth()->user()->nama)[0] }}</p>
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Pelanggan</p>
                        </div>
                        <div class="w-px h-6 bg-slate-600"></div>
                        <a href="{{ route('profil.index') }}" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fa-solid fa-gear"></i>
                        </a>
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
                <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="font-display text-3xl lg:text-4xl font-bold text-white mb-2">
                            Halo, <span class="gradient-text italic">{{ auth()->user()->nama ?? 'Pelanggan' }}!</span>
                        </h1>
                        <p class="text-gray-400">Selamat datang di dashboard ALBRK.SHOECARE</p>
                    </div>
                    <a href="{{ route('reservasi.create') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-teal-700 to-slate-700 text-white px-6 py-3 rounded-full font-semibold text-sm hover:shadow-lg hover:shadow-teal-950/30 transition-all">
                        <i class="fa-solid fa-plus"></i>
                        Buat Reservasi
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('reservasi.create') }}" class="glass-card rounded-2xl p-5 flex flex-col items-center text-center group">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-calendar-plus text-white text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">Reservasi Baru</h3>
                    <p class="text-xs text-gray-500">Buat pesanan</p>
                </a>

                <a href="{{ route('reservasi.riwayat') }}" class="glass-card rounded-2xl p-5 flex flex-col items-center text-center group">
                    <div class="w-14 h-14 rounded-xl bg-teal-500/10 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-clock-rotate-left text-teal-300 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">Riwayat</h3>
                    <p class="text-xs text-gray-500">Lihat pesanan</p>
                </a>

                <a href="#" class="glass-card rounded-2xl p-5 flex flex-col items-center text-center group">
                    <div class="w-14 h-14 rounded-xl bg-slate-700/70 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-headset text-teal-200 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">Bantuan</h3>
                    <p class="text-xs text-gray-500">Hubungi CS</p>
                </a>

                <a href="{{ route('profil.index') }}" class="glass-card rounded-2xl p-5 flex flex-col items-center text-center group">
                    <div class="w-14 h-14 rounded-xl bg-slate-700/70 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-user text-teal-200 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-white text-sm mb-1">Profil</h3>
                    <p class="text-xs text-gray-500">Pengaturan</p>
                </a>
            </div>

            <div class="glass-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-display font-bold text-lg text-white">Reservasi Terbaru</h2>
                    <a href="{{ route('reservasi.riwayat') }}" class="text-slate-400 text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>

                <div class="text-center py-12 text-gray-500">
                    <div class="w-16 h-16 rounded-full bg-slate-800/50 flex items-center justify-center mx-auto mb-4">
                        <i class="fa-solid fa-inbox text-2xl text-gray-600"></i>
                    </div>
                    <p class="font-medium mb-2">Belum ada reservasi</p>
                    <p class="text-sm text-gray-600 mb-6">Mulai buat reservasi pertama Anda</p>
                    <a href="{{ route('reservasi.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-700 to-slate-700 text-white px-6 py-3 rounded-full font-semibold text-sm">
                        <i class="fa-solid fa-plus"></i>
                        Buat Reservasi
                    </a>
                </div>
            </div>
        </main>

        <footer class="border-t border-slate-800 py-6 px-6 text-center">
            <p class="text-gray-600 text-xs">&copy; 2026 <span class="text-slate-400 font-semibold">ALBRK.SHOECARE</span></p>
        </footer>
    </div>
</body>
</html>
