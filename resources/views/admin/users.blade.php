<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan - ALBRK.SHOESCARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    </style>
</head>
<body class="text-slate-200 antialiased flex h-screen overflow-hidden relative">

    {{-- KONTEN UTAMA (TANPA SIDEBAR SAMA SEKALI) --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#0f172a] relative z-10 h-screen">
        
        {{-- TOP NAVIGATION --}}
        <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-slate-700/80 px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40">
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-white leading-tight">
                ALBRK.<span class="text-blue-500">ADMIN</span>
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
                        <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-blue-500/10 hover:text-blue-300 transition-colors">
                            <i class="fa-solid fa-user-gear w-4 text-center"></i> Kelola Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors text-left">
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        {{-- AREA SCROLLABLE --}}
        <div class="p-6 lg:p-12 flex-1 overflow-y-auto custom-scroll relative">
            
            {{-- Background Glow Biru --}}
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-600/10 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4"></div>

            {{-- ALERT MESSAGES --}}
            @if(session('success'))
                <div class="bg-indigo-500/20 border border-indigo-500/50 text-indigo-400 px-6 py-4 rounded-2xl mb-8 text-xs font-bold shadow-lg flex items-center gap-3 backdrop-blur-sm relative z-10">
                    <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
                </div>
            @endif

            {{-- HEADER HALAMAN --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8 md:mb-10 relative z-10">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter leading-none mb-2">
                        Manajemen <span class="italic text-blue-400">Pelanggan</span>
                    </h1>
                    <p class="text-slate-400 font-medium text-sm">Daftar pelanggan terdaftar di sistem ALBRK.</p>
                </div>
            </div>

            {{-- STATISTIK SINGKAT --}}
            <div class="mb-8 md:mb-10 w-full max-w-sm relative z-10">
                <div class="glass-panel p-6 md:p-8 rounded-[2rem] flex justify-between items-center transition-all border-indigo-500/30 overflow-hidden relative">
                    <div class="absolute inset-0 bg-indigo-500/10"></div>
                    <div class="relative z-10">
                        <p class="text-[9px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-2">Total Pelanggan</p>
                        <span class="text-3xl md:text-4xl font-black text-white italic">{{ $totalPelanggan ?? $users->count() }}</span>
                    </div>
                    <div class="w-12 h-12 bg-indigo-500/20 border border-indigo-500/50 text-indigo-400 rounded-full flex items-center justify-center text-xl relative z-10 shadow-[0_0_15px_rgba(59,130,246,0.3)]"><i class="fa-solid fa-users"></i></div>
                </div>
            </div>
            
            {{-- TABEL DATA --}}
            <div class="glass-panel rounded-[2.5rem] border border-white/5 shadow-2xl overflow-hidden mb-10 relative z-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px] md:min-w-0">
                        <thead>
                            <tr class="bg-slate-800/50 border-b border-slate-700 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-8 py-6">Nama Pelanggan</th>
                                <th class="px-8 py-6">Email & Kontak</th>
                                <th class="px-8 py-6 text-center">Tipe Akun</th>
                                <th class="px-8 py-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50 text-sm">
                            @forelse($users as $u)
                            <tr class="hover:bg-slate-800/30 transition-all group">
                                <td class="px-8 py-6">
                                    <p class="font-black text-white uppercase italic leading-tight group-hover:text-indigo-400 transition-colors">{{ $u->nama }}</p>
                                    <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-1">Daftar: {{ $u->created_at->format('d/m/Y') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs text-slate-300 font-medium">{{ $u->email }}</p>
                                    <p class="text-[10px] text-slate-500 font-bold tracking-widest mt-1">
                                        <i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i> {{ $u->no_telp ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <span class="bg-slate-700 text-slate-300 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-slate-600">Pelanggan</span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <form action="{{ route('admin.users.destroy', $u->id_user) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini? Seluruh data riwayat reservasi pelanggan ini juga akan terhapus.');" class="m-0">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-10 h-10 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center ml-auto active:scale-90">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-24 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <i class="fa-solid fa-users-slash text-6xl mb-4 text-slate-400"></i>
                                        <p class="text-[11px] font-black uppercase tracking-[0.3em] text-slate-400">Belum ada pelanggan terdaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <footer class="mt-auto w-full shrink-0 border-t border-slate-700/80 bg-[#0f172a]/50 px-6 py-6 text-center">
            <p class="text-xs text-slate-500">&copy; 2026 <span class="font-semibold text-slate-400">ALBRK.SHOESCARE</span></p>
        </footer>
    </main>

</body>
</html>


