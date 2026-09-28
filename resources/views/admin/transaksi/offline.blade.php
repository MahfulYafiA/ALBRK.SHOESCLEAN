@php
    $isSuper = auth()->user()->id_role == 1 || auth()->user()->role === 'superadmin';
    $accent = $isSuper ? 'emerald' : 'blue';
    $primaryColor = $isSuper ? '#10b981' : '#3b82f6';
    $secondaryColor = $isSuper ? '#059669' : '#2563eb';
    $accentSoft = $isSuper ? 'rgba(16, 185, 129, 0.12)' : 'rgba(59, 130, 246, 0.12)';
    $dashboardRoute = $isSuper ? route('superadmin.dashboard') : route('admin.dashboard');
    $storeRoute = $isSuper ? route('superadmin.transaksi.store-offline') : route('admin.transaksi.store-offline');
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Offline - ALBRK.SHOESCARE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '{{ $primaryColor }}',
                        secondary: '{{ $secondaryColor }}',
                        accent: '{{ $primaryColor }}',
                        dark: '#0f172a',
                    },
                    fontFamily: {
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                        body: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-display { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-text { background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $secondaryColor }} 55%, {{ $primaryColor }} 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-panel { background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .dark-input { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(51, 65, 85, 0.8); color: #f8fafc; transition: all 0.3s ease; }
        .dark-input:focus { border-color: {{ $primaryColor }}; box-shadow: 0 0 0 4px {{ $accentSoft }}; outline: none; }
        .btn-gradient { background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $secondaryColor }} 100%); transition: all 0.3s ease; }
        .btn-gradient:hover { background: linear-gradient(135deg, {{ $secondaryColor }} 0%, {{ $primaryColor }} 100%); transform: translateY(-2px); box-shadow: 0 20px 40px -10px {{ $accentSoft }}; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        ::-webkit-scrollbar-thumb { background: {{ $accentSoft }}; border-radius: 3px; }
    </style>
</head>
<body class="text-slate-200 antialiased flex flex-col h-screen overflow-hidden bg-[#0f172a] selection:bg-{{ $accent }}-500 selection:text-white">

    {{-- Background --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-{{ $accent }}-600/10 rounded-full blur-[150px] -translate-y-1/3 translate-x-1/3"></div>
    </div>

    {{-- Header --}}
    <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-slate-700/80 px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40">
        <div class="flex items-center gap-3 md:gap-4">
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-white leading-tight">
                ALBRK.<span class="text-{{ $accent }}-500">{{ $isSuper ? 'SUPER' : 'ADMIN' }}</span>
            </h1>
        </div>
        <div class="flex items-center gap-5">
            <div class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-800/50 px-3 md:px-4 py-2 rounded-full border border-slate-700 hidden sm:block shadow-inner">
                Hari ini: <span class="text-white">{{ now()->format('d M Y') }}</span>
            </div>
            <div class="relative">
                <button type="button" id="userMenuButton" onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center bg-slate-800/40 border border-slate-700 p-1 pr-4 rounded-full shadow-inner hover:border-{{ $accent }}-500/40 transition-all">
                    <div class="w-8 h-8 rounded-full overflow-hidden bg-{{ $accent }}-600 flex items-center justify-center text-[10px] font-black text-white border border-slate-700 shadow-xl shadow-{{ $accent }}-500/20">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ route('profil.foto') }}" alt="Foto profil" class="w-full h-full rounded-full bg-white object-contain p-0.5" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden')">
                            <span class="hidden">{{ $isSuper ? 'SU' : strtoupper(substr(auth()->user()->nama ?? 'AD', 0, 2)) }}</span>
                        @else
                            {{ $isSuper ? 'SU' : strtoupper(substr(auth()->user()->nama ?? 'AD', 0, 2)) }}
                        @endif
                    </div>
                    <div class="ml-3 hidden md:block">
                        <p class="text-[10px] font-black text-white uppercase tracking-widest leading-none">{{ explode(' ', auth()->user()->nama ?? 'Admin')[0] }}</p>
                        <p class="text-[7px] font-bold text-{{ $accent }}-400/80 uppercase mt-0.5 tracking-tighter">{{ $isSuper ? 'Akses Pemilik' : 'Akses Staf' }}</p>
                    </div>
                    <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 ml-3"></i>
                </button>
                <div id="userMenu" class="hidden absolute right-0 mt-3 w-56 rounded-2xl bg-slate-900/95 border border-slate-700 shadow-2xl shadow-black/30 overflow-hidden z-50">
                    <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-{{ $accent }}-500/10 hover:text-{{ $accent }}-300 transition-colors">
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

    {{-- Main Content --}}
    <main class="flex-1 overflow-y-auto custom-scroll px-6 md:px-12 py-8 md:py-10 relative z-10">
        <div class="w-full">
            {{-- Header Title --}}
            <div class="mb-8 md:mb-12">
                <h1 class="font-display text-3xl md:text-5xl font-bold text-white mb-2">
                    Kasir <span class="gradient-text italic">Offline</span>
                </h1>
                <p class="text-gray-400">Input pesanan pelanggan yang datang langsung ke toko secara real-time.</p>
            </div>

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="mb-8 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-5 rounded-2xl flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ $storeRoute }}" method="POST" class="glass-panel w-full rounded-[2rem] border border-white/5 p-6 md:p-10">
                @csrf

                <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 xl:gap-10">
                    {{-- Column 1: Customer --}}
                    <div class="space-y-6">
                        <h3 class="flex items-center gap-3 text-sm font-semibold text-white uppercase tracking-wider border-b border-white/10 pb-4">
                            <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center"><i class="fa-solid fa-user"></i></div>
                            Customer (Walk-in)
                        </h3>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Nama Pelanggan <span class="text-red-400">*</span></label>
                            <input type="text" name="nama" required placeholder="Contoh: Budi Santoso" class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">No. WhatsApp</label>
                            <input type="text" name="no_telp" placeholder="Contoh: 08123456789 (Opsional)" class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat</label>
                            <input type="text" name="alamat" placeholder="Contoh: Jl. Merdeka No. 10" class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium">
                        </div>
                    </div>

                    {{-- Column 2: Order Details --}}
                    <div class="space-y-6">
                        <h3 class="flex items-center gap-3 text-sm font-semibold text-white uppercase tracking-wider border-b border-white/10 pb-4">
                            <div class="w-8 h-8 rounded-lg bg-{{ $accent }}-500/20 text-{{ $accent }}-400 flex items-center justify-center"><i class="fa-solid fa-box-open"></i></div>
                            Detail Cucian
                        </h3>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Layanan Jasa <span class="text-red-400">*</span></label>
                            <select name="id_layanan" required class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium appearance-none">
                                <option value="">-- Pilih Jenis Layanan --</option>
                                @foreach($layanans as $layanan)
                                    <option value="{{ $layanan->id_layanan }}">{{ $layanan->nama_layanan }} - Rp {{ number_format($layanan->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Jumlah Sepatu (Pasang) <span class="text-red-400">*</span></label>
                            <input type="number" name="jumlah_sepatu" value="1" min="1" required class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Metode Layanan <span class="text-red-400">*</span></label>
                            <select name="metode_layanan" required class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium appearance-none">
                                <option value="Drop-off">Drop-off (Bawa ke Toko)</option>
                                <option value="Pick-up">Pick-up (Jemput)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Column 3: Payment --}}
                    <div class="space-y-6 flex flex-col">
                        <h3 class="flex items-center gap-3 text-sm font-semibold text-white uppercase tracking-wider border-b border-white/10 pb-4">
                            <div class="w-8 h-8 rounded-lg bg-{{ $accent }}-500/20 text-{{ $accent }}-400 flex items-center justify-center"><i class="fa-solid fa-cash-register"></i></div>
                            Pembayaran
                        </h3>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Metode Bayar <span class="text-red-400">*</span></label>
                            <select name="metode_bayar" required class="dark-input w-full rounded-xl px-5 py-3.5 text-sm font-medium appearance-none">
                                <option value="Cash">Cash (Tunai)</option>
                                <option value="Transfer">Transfer / QRIS</option>
                            </select>
                        </div>

                        <div class="mt-auto pt-6">
                            <button type="submit" class="w-full btn-gradient text-white py-4 rounded-xl font-semibold text-sm uppercase tracking-wider flex items-center justify-center gap-3">
                                <i class="fa-solid fa-print"></i>
                                Proses & Simpan Transaksi
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="mt-auto w-full shrink-0 border-t border-slate-700/80 bg-[#0f172a]/50 px-6 py-6 text-center">
        <p class="text-xs text-slate-500">&copy; 2026 <span class="font-semibold text-slate-400">ALBRK.SHOESCARE</span></p>
    </footer>
</body>
</html>

