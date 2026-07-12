<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Offline - ALBRK.SHOECARE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                        accent: '#ec4899',
                        dark: '#0f0a1a',
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
        .gradient-text { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .glass-panel { background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.05); }
        .dark-input { background-color: rgba(15, 23, 42, 0.6); border: 1px solid rgba(51, 65, 85, 0.8); color: #f8fafc; transition: all 0.3s ease; }
        .dark-input:focus { border-color: #6366f1; box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1); outline: none; }
        .btn-gradient { background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); transition: all 0.3s ease; }
        .btn-gradient:hover { background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); transform: translateY(-2px); box-shadow: 0 20px 40px -10px rgba(99, 102, 241, 0.5); }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(99, 102, 241, 0.3); border-radius: 3px; }
    </style>
</head>
<body class="text-gray-200 antialiased flex flex-col min-h-screen" style="background: linear-gradient(135deg, #0f0a1a 0%, #1a1035 100%);">

    {{-- Background --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-gradient-to-br from-primary/20 to-secondary/10 rounded-full blur-[150px] -translate-y-1/3 translate-x-1/3"></div>
    </div>

    {{-- Header --}}
    <header class="sticky top-0 z-50 bg-dark/80 backdrop-blur-xl border-b border-white/5 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:bg-white/10 transition-all flex items-center justify-center">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                        <i class="fa-solid fa-shoe-prints text-white text-sm"></i>
                    </div>
                    <h1 class="font-display font-bold text-xl text-white">ALBRK<span class="text-primary">.SHOECARE</span></h1>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="hidden md:flex items-center gap-2 bg-white/5 px-4 py-1.5 rounded-full border border-white/10">
                    <i class="fa-solid fa-calendar text-gray-400 text-xs"></i>
                    <span class="text-xs font-medium text-gray-400">{{ now()->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-3 bg-white/5 border border-white/10 rounded-full px-4 py-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center text-white text-xs font-bold">
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover rounded-full">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? 'SA', 0, 2)) }}
                        @endif
                    </div>
                    <span class="text-xs font-semibold text-white hidden sm:block">{{ auth()->user()->nama ?? 'Staff' }}</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-1 px-6 py-8 relative z-10">
        <div class="max-w-[1400px] mx-auto">
            {{-- Header Title --}}
            <div class="mb-8 md:mb-12">
                <div class="inline-flex items-center gap-2 bg-primary/10 border border-primary/20 px-4 py-1.5 rounded-full mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
                    </span>
                    <span class="text-xs font-semibold text-primary uppercase tracking-wider">Cashier System</span>
                </div>
                <h1 class="font-display text-3xl md:text-5xl font-bold text-white mb-2">
                    Kasir <span class="gradient-text italic">Offline.</span>
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
            <form action="{{ route('admin.transaksi.store-offline') }}" method="POST" class="glass-panel rounded-3xl border border-white/5 p-6 md:p-10">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
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
                            <div class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center"><i class="fa-solid fa-box-open"></i></div>
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
                            <div class="w-8 h-8 rounded-lg bg-orange-500/20 text-orange-400 flex items-center justify-center"><i class="fa-solid fa-cash-register"></i></div>
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
    <footer class="border-t border-white/5 py-6 px-6 text-center">
        <p class="text-gray-600 text-xs">&copy; 2026 <span class="text-primary font-semibold">ALBRK.SHOECARE</span> Admin Panel</p>
    </footer>
</body>
</html>
