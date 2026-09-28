<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan - ALBRK.SHOESCARE</title>
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

        .custom-scroll { scrollbar-width: none; -ms-overflow-style: none; }
        .custom-scroll::-webkit-scrollbar { display: none; }

        @media print {
            .no-print { display: none !important; }
            main { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; background: white !important;}
            body { background: white !important; overflow: auto !important; }
            .glass-panel { background: white !important; border: 1px solid #e2e8f0 !important; box-shadow: none !important; backdrop-filter: none !important; }
            .print-text-dark { color: #0f172a !important; }
            .print-border-light { border-color: #e2e8f0 !important; }
            th { color: #64748b !important; }
            td { color: #0f172a !important; border-bottom: 1px solid #f1f5f9 !important; }
            .print-bg-light { background: #f8fafc !important; }
        }
    </style>
</head>
<body class="text-slate-200 antialiased flex h-screen overflow-hidden relative">

    {{-- KONTEN UTAMA (TANPA SIDEBAR SAMA SEKALI) --}}
    <main class="flex-1 flex flex-col h-screen min-w-0 bg-[#0f172a] relative z-10">
        
        {{-- TOP NAVIGATION --}}
        <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-slate-700/80 px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40 no-print">
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-white leading-tight">
                ALBRK.<span class="{{ auth()->user()->id_role == 1 ? 'text-emerald-500' : 'text-blue-500' }}">{{ auth()->user()->id_role == 1 ? 'SUPER' : 'ADMIN' }}</span>
            </h1>
            <div class="flex items-center gap-5">
                <div class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-800/50 px-3 md:px-4 py-2 rounded-full border border-slate-700 hidden sm:block shadow-inner">
                    Hari ini: <span class="text-white">{{ now()->format('d M Y') }}</span>
                </div>
                <div class="relative">
                    <button type="button" id="userMenuButton" onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center bg-slate-800/40 border border-slate-700 p-1 pr-4 rounded-full shadow-inner hover:border-blue-500/40 transition-all">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-blue-600 flex items-center justify-center text-[10px] font-black text-white border border-slate-700 shadow-xl shadow-blue-500/20">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ route('profil.foto') }}" alt="Foto profil" class="w-full h-full rounded-full bg-white object-contain p-0.5" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden')">
                                <span class="hidden">{{ strtoupper(substr(auth()->user()->nama ?? 'AD', 0, 2)) }}</span>
                            @else
                                {{ strtoupper(substr(auth()->user()->nama ?? 'AD', 0, 2)) }}
                            @endif
                        </div>
                        <div class="ml-3 hidden md:block">
                            <p class="text-[10px] font-black text-white uppercase tracking-widest leading-none">{{ explode(' ', auth()->user()->nama ?? 'Admin')[0] }}</p>
                            <p class="text-[7px] font-bold text-blue-400/80 uppercase mt-0.5 tracking-tighter">Akses Staf</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 ml-3"></i>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-3 w-56 rounded-2xl bg-slate-900/95 border border-slate-700 shadow-2xl shadow-black/30 overflow-hidden z-50">
                        <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition-colors"><i class="fa-solid fa-user-gear w-4 text-center"></i> Kelola Profil</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors text-left"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Keluar</button></form>
                    </div>
                </div>
            </div>
        </header>

        {{-- AREA SCROLLABLE --}}
        <div class="p-6 lg:p-12 flex-1 overflow-y-auto custom-scroll relative">
            
            {{-- Background Glow --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] {{ auth()->user()->id_role == 1 ? 'bg-emerald-500/10' : 'bg-indigo-600/10' }} blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4 no-print"></div>

            {{-- HEADER HALAMAN & TOTAL OMSET --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-6 md:mb-8 relative z-10">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-white print-text-dark tracking-tighter leading-none mb-2">
                        Laporan <span class="italic text-blue-400 print-text-dark">Omset</span>
                    </h1>
                    <p class="text-slate-400 print-text-dark font-medium text-sm">Monitoring resmi pendapatan sistem ALBRK.SHOESCARE</p>
                </div>

                {{-- KARTU TOTAL OMSET --}}
                <div class="glass-panel w-full md:w-auto px-8 py-6 rounded-[2rem] text-right shadow-2xl relative overflow-hidden shrink-0 border border-white/10 print-border-light print-bg-light">
                    <div class="absolute top-0 right-0 w-16 h-16 {{ auth()->user()->id_role == 1 ? 'bg-emerald-500/20' : 'bg-indigo-500/20' }} rounded-full -translate-y-1/2 translate-x-1/2 blur-md no-print"></div>
                    <p class="text-[9px] md:text-[10px] font-black {{ auth()->user()->id_role == 1 ? 'text-emerald-400' : 'text-indigo-400' }} uppercase tracking-[0.3em] mb-1 relative z-10">Total Omset Keseluruhan</p>
                    <h3 class="text-2xl md:text-4xl font-black text-white print-text-dark tracking-tighter relative z-10 italic">
                        Rp {{ number_format($totalOmzet ?? 0, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
            
            {{-- ✅ REVISI DOSEN: FILTER TANGGAL --}}
            <div class="glass-panel rounded-3xl p-5 md:p-6 mb-8 relative z-10 no-print border border-white/5 shadow-lg">
                <form action="{{ url()->current() }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <div class="w-full md:w-auto flex-1">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1"><i class="fa-regular fa-calendar mr-1"></i> Dari Tanggal</label>
                        {{-- Atribut [color-scheme:dark] membuat kalender otomatis mode gelap --}}
                        <input type="date" name="tgl_mulai" value="{{ request('tgl_mulai', $tgl_mulai ?? '') }}" class="w-full bg-slate-800/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all [color-scheme:dark]">
                    </div>
                    <div class="w-full md:w-auto flex-1">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1"><i class="fa-regular fa-calendar-check mr-1"></i> Sampai Tanggal</label>
                        <input type="date" name="tgl_selesai" value="{{ request('tgl_selesai', $tgl_selesai ?? '') }}" class="w-full bg-slate-800/50 border border-slate-700 text-white rounded-xl px-5 py-3.5 text-sm focus:ring-2 focus:ring-indigo-500 outline-none transition-all [color-scheme:dark]">
                    </div>
                    <div class="w-full md:w-auto flex gap-3 h-full">
                        <button type="submit" class="w-full md:w-auto {{ auth()->user()->id_role == 1 ? 'bg-emerald-600 hover:bg-emerald-500 shadow-emerald-500/20' : 'bg-indigo-600 hover:bg-indigo-500 shadow-indigo-500/20' }} text-white px-8 py-3.5 rounded-xl font-black text-[10px] md:text-xs uppercase tracking-widest transition-all shadow-lg flex items-center justify-center">
                            <i class="fa-solid fa-filter mr-2"></i> Terapkan
                        </button>
                        
                        {{-- Tombol Reset hanya muncul jika filter sedang aktif --}}
                        @if(request('tgl_mulai') || request('tgl_selesai'))
                        <a href="{{ url()->current() }}" class="w-full md:w-auto bg-slate-700 hover:bg-slate-600 border border-slate-600 text-white px-6 py-3.5 rounded-xl font-black text-[10px] md:text-xs uppercase tracking-widest transition-all flex items-center justify-center" title="Hapus Filter">
                            <i class="fa-solid fa-rotate-right"></i>
                        </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- TABEL DATA --}}
            <div class="glass-panel rounded-[2.5rem] border border-white/5 shadow-2xl overflow-hidden mb-8 md:mb-10 relative z-10 print-border-light">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[700px] md:min-w-0">
                        <thead>
                            <tr class="bg-slate-800/50 print-bg-light border-b border-slate-700 print-border-light text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-8 py-6">Tanggal Selesai</th>
                                <th class="px-8 py-6">Pelanggan</th>
                                <th class="px-8 py-6">Detail Layanan</th>
                                <th class="px-8 py-6 text-right whitespace-nowrap">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50 print-border-light text-sm">
                            @forelse($laporanOmzet ?? $laporan as $l)
                            <tr class="hover:bg-slate-800/30 transition-all group">
                                <td class="px-8 py-6 font-bold text-slate-300 uppercase text-[11px]">
                                    {{ $l->updated_at->format('d M Y') }}
                                    <span class="block text-[9px] font-normal text-slate-500 mt-1">{{ $l->updated_at->format('H:i') }} WIB</span>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-black text-white print-text-dark uppercase italic leading-tight">{{ $l->user->nama ?? 'Pelanggan Langsung' }}</p>
                                    <p class="text-[9px] font-bold text-slate-500 mt-1 uppercase tracking-widest">ID #{{ $l->id_reservasi }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="bg-slate-800 text-slate-300 px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-slate-700">
                                        {{ $l->detail->map(fn ($detail) => $detail->layanan?->nama_layanan)->filter()->join(', ') ?: $l->layanan->pluck('nama_layanan')->join(', ') ?: 'Layanan' }}
                                    </span>
                                    <span class="block text-[9px] font-bold text-slate-500 mt-2 uppercase tracking-widest">
                                        {{-- ✅ UPDATE STRUKTUR: Mengambil jumlah dari tabel tr_detail_reservasi --}}
                                        {{ $l->detail->first()->jumlah ?? 1 }} PASANG
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right font-black {{ auth()->user()->id_role == 1 ? 'text-emerald-400' : 'text-indigo-400' }} italic text-base tracking-tighter">
                                    Rp {{ number_format($l->total_harga, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-24 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <i class="fa-solid fa-receipt text-6xl mb-4 text-slate-400"></i>
                                        <p class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-400">Data belum tersedia / Filter tidak ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FOOTER & TOMBOL CETAK --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 no-print relative z-10">
                <div class="flex items-center gap-4 opacity-50">
                    <span class="w-2 h-2 rounded-full {{ auth()->user()->id_role == 1 ? 'bg-emerald-500' : 'bg-indigo-500' }} animate-pulse shadow-[0_0_10px_currentColor]"></span>
                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] italic">
                        Laporan resmi yang diverifikasi sistem.
                    </p>
                </div>
                
                <button onclick="window.print()" class="w-full md:w-auto bg-slate-800 border border-slate-700 hover:bg-white hover:text-slate-900 text-white px-8 py-4 rounded-[1.5rem] font-black uppercase text-[10px] tracking-[0.2em] transition-all flex items-center justify-center gap-3 shadow-lg active:scale-95 group">
                    <i class="fa-solid fa-file-export group-hover:-translate-y-1 transition-transform"></i> Unduh Laporan Resmi
                </button>
            </div>

        </div>
        <footer class="mt-auto w-full shrink-0 border-t border-slate-700/80 bg-[#0f172a]/50 px-6 py-6 text-center no-print">
            <p class="text-xs text-slate-500">&copy; 2026 <span class="font-semibold text-slate-400">ALBRK.SHOESCARE</span></p>
        </footer>
    </main>

</body>
</html>

