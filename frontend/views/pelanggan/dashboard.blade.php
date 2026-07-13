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
                        'surface': '#f8f9fa',
                        'primary': '#111111',
                        'secondary': '#6b7280',
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

        body { background: #f8f9fa; }

        /* Modern Sidebar */
        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #fafbfc 100%);
        }
        .sidebar-item {
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item:hover {
            background: rgba(17, 17, 17, 0.04);
            transform: translateX(4px);
        }
        .sidebar-item.active {
            background: rgba(17, 17, 17, 0.06);
            border-left: 3px solid #111111;
        }
        .sidebar-item.active span {
            color: #111111;
            font-weight: 600;
        }

        /* Modern Cards */
        .modern-card {
            background: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: rgba(0, 0, 0, 0.08);
        }

        /* Modern Button */
        .modern-btn {
            background: #111111;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .modern-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }
        .modern-btn:hover::before {
            left: 100%;
        }
        .modern-btn:hover {
            background: #333333;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        /* Icon Container */
        .icon-container {
            background: linear-gradient(135deg, #111111 0%, #333333 100%);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .icon-container-soft {
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        }

        /* Stats Card */
        .stat-card {
            background: linear-gradient(135deg, #ffffff 0%, #fafbfc 100%);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        /* Welcome Card */
        .welcome-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border: 1px solid rgba(0, 0, 0, 0.04);
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

        /* Avatar Ring */
        .avatar-ring {
            box-shadow: 0 0 0 3px rgba(17, 17, 17, 0.1);
        }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside class="sidebar w-64 min-h-screen flex flex-col border-r border-gray-100 fixed left-0 top-0 z-30">
            {{-- Logo Section --}}
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div>
                        <h1 class="font-display font-bold text-sm text-gray-900 leading-none">
                            ALBRK<span class="text-gray-400">.SHOECARE</span>
                        </h1>
                        <p class="text-[10px] text-gray-400 mt-0.5">Customer Portal</p>
                    </div>
                </div>
            </div>

            {{-- User Section --}}
            <div class="p-5 border-b border-gray-100">
                <div class="flex items-center gap-3 p-3 rounded-2xl bg-gray-50/50">
                    <div class="w-10 h-10 rounded-full bg-black flex items-center justify-center text-white text-xs font-bold avatar-ring overflow-hidden">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? 'CU', 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-900 truncate">{{ explode(' ', auth()->user()->nama)[0] }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-wide">Pelanggan</p>
                    </div>
                </div>
                <a href="{{ route('profil.index') }}" class="mt-3 flex items-center gap-2 text-xs text-gray-500 hover:text-gray-700 transition-colors">
                    <i class="fa-solid fa-user text-xs"></i>
                    <span>Profil</span>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 p-4">
                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider px-4 mb-3">Menu</p>
                <div class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="sidebar-item active flex items-center gap-3 px-4 py-3 rounded-xl">
                        <i class="fa-solid fa-house text-sm text-gray-400 w-5"></i>
                        <span class="text-sm text-gray-600">Dashboard</span>
                    </a>
                    <a href="{{ route('profil.index') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl">
                        <i class="fa-solid fa-user text-sm text-gray-400 w-5"></i>
                        <span class="text-sm text-gray-600">Profil</span>
                    </a>
                    <a href="{{ route('reservasi.create') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl">
                        <i class="fa-solid fa-calendar-plus text-sm text-gray-400 w-5"></i>
                        <span class="text-sm text-gray-600">Buat Reservasi</span>
                    </a>
                    <a href="{{ route('reservasi.riwayat') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl">
                        <i class="fa-solid fa-clock-rotate-left text-sm text-gray-400 w-5"></i>
                        <span class="text-sm text-gray-600">Riwayat</span>
                    </a>
                    <a href="#" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl">
                        <i class="fa-solid fa-headset text-sm text-gray-400 w-5"></i>
                        <span class="text-sm text-gray-600">Bantuan</span>
                    </a>
                </div>
            </nav>

            {{-- Footer --}}
            <div class="p-4 border-t border-gray-100">
                <a href="{{ url('/') }}" class="sidebar-item flex items-center gap-3 px-4 py-3 rounded-xl mb-1">
                    <i class="fa-solid fa-globe text-sm text-gray-400 w-5"></i>
                    <span class="text-sm text-gray-600">Kembali ke Beranda</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:text-red-600">
                        <i class="fa-solid fa-arrow-right-from-bracket text-sm w-5"></i>
                        <span class="text-sm">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="flex-1 ml-64">
            {{-- Top Bar --}}
            <header class="bg-white/80 backdrop-blur-xl border-b border-gray-100 px-8 py-4 sticky top-0 z-20">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-display font-bold text-gray-900">Dashboard</h2>
                        <p class="text-xs text-gray-500">Selamat datang kembali!</p>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <div class="p-8">
                {{-- Welcome Section --}}
                <div class="welcome-card rounded-3xl p-8 mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-gray-100 to-transparent rounded-full -translate-y-1/2 translate-x-1/2 opacity-50"></div>
                    <div class="relative z-10">
                        <span class="inline-flex items-center gap-2 text-xs font-medium text-gray-500 mb-4">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            Online
                        </span>
                        <h1 class="font-display text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                            Halo, <span class="text-gray-600">{{ auth()->user()->nama ?? 'Pelanggan' }}!</span>
                        </h1>
                        <p class="text-gray-500 max-w-xl">Kelola reservasi dan pantau status perawatan sepatu Anda dengan mudah.</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="{{ route('profil.index') }}" class="modern-card rounded-2xl p-6 text-center group cursor-pointer">
                            <div class="icon-container w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
                                <i class="fa-solid fa-user text-white text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Profil</h4>
                            <p class="text-xs text-gray-500">Pengaturan</p>
                        </a>

                        <a href="{{ route('reservasi.create') }}" class="modern-card rounded-2xl p-6 text-center group cursor-pointer">
                            <div class="icon-container w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
                                <i class="fa-solid fa-calendar-plus text-white text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Reservasi Baru</h4>
                            <p class="text-xs text-gray-500">Buat pesanan</p>
                        </a>

                        <a href="{{ route('reservasi.riwayat') }}" class="modern-card rounded-2xl p-6 text-center group cursor-pointer">
                            <div class="icon-container w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
                                <i class="fa-solid fa-clock-rotate-left text-white text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Riwayat</h4>
                            <p class="text-xs text-gray-500">Lihat pesanan</p>
                        </a>

                        <a href="#" class="modern-card rounded-2xl p-6 text-center group cursor-pointer">
                            <div class="icon-container w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-transform group-hover:scale-110">
                                <i class="fa-solid fa-headset text-white text-xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Bantuan</h4>
                            <p class="text-xs text-gray-500">Hubungi CS</p>
                        </a>
                    </div>
                </div>

                {{-- Recent Reservations --}}
                <div class="modern-card rounded-2xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-semibold text-gray-900">Reservasi Terbaru</h3>
                        <a href="{{ route('reservasi.riwayat') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">Lihat Semua</a>
                    </div>

                    <div class="text-center py-12">
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fa-solid fa-inbox text-3xl text-gray-300"></i>
                        </div>
                        <h4 class="font-semibold text-gray-700 mb-2">Belum ada reservasi</h4>
                        <p class="text-sm text-gray-400 mb-6">Mulai buat reservasi pertama Anda</p>
                        <a href="{{ route('reservasi.create') }}" class="modern-btn inline-flex items-center gap-2 px-6 py-3 rounded-xl text-white text-sm font-medium">
                            <i class="fa-solid fa-plus"></i>
                            Buat Reservasi
                        </a>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <footer class="px-8 py-6 border-t border-gray-100 bg-white/50">
                <p class="text-xs text-gray-400">&copy; 2026 ALBRK.SHOECARE. All rights reserved.</p>
            </footer>
        </main>
    </div>
</body>
</html>
