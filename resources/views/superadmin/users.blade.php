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
        input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px #1e293b inset !important;
            -webkit-text-fill-color: #f8fafc !important;
            caret-color: #f8fafc;
        }
    </style>
</head>
<body class="text-slate-200 antialiased flex h-screen overflow-hidden relative">

    @php
        // ✅ LOGIKA DINAMIS: Cek Role
        $isSuper = auth()->user()->id_role == 1;
        $accent = $isSuper ? 'emerald' : 'blue';
    @endphp

    {{-- KONTEN UTAMA --}}
    <main class="flex-1 flex flex-col min-w-0 bg-[#0f172a] relative z-10 h-screen">
        
        {{-- TOP NAVIGATION --}}
        <header class="bg-[#0f172a]/40 backdrop-blur-xl border-b border-slate-700/80 px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40">
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-white leading-tight">
                ALBRK.<span class="text-emerald-500">SUPER</span>
            </h1>
            <div class="flex items-center gap-5">
                <div class="text-[9px] md:text-[10px] font-black text-slate-400 uppercase tracking-widest bg-slate-800/50 px-3 md:px-4 py-2 rounded-full border border-slate-700 hidden sm:block shadow-inner">
                    Hari ini: <span class="text-white">{{ now()->format('d M Y') }}</span>
                </div>
                <div class="relative">
                    <button type="button" id="userMenuButton" onclick="document.getElementById('userMenu').classList.toggle('hidden')" class="flex items-center bg-slate-800/40 border border-slate-700 p-1 pr-4 rounded-full shadow-inner hover:border-emerald-500/40 transition-all">
                        <div class="w-8 h-8 rounded-full overflow-hidden bg-emerald-600 flex items-center justify-center text-[10px] font-black text-white border border-slate-700 shadow-xl shadow-emerald-500/20">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ route('profil.foto') }}" alt="Foto profil" class="w-full h-full rounded-full bg-white object-contain p-0.5" onerror="this.classList.add('hidden'); this.nextElementSibling.classList.remove('hidden')">
                                <span class="hidden">SU</span>
                            @else
                                SU
                            @endif
                        </div>
                        <div class="ml-3 hidden md:block">
                            <p class="text-[10px] font-black text-white uppercase tracking-widest leading-none">{{ explode(' ', auth()->user()->nama ?? 'Superadmin')[0] }}</p>
                            <p class="text-[7px] font-bold text-emerald-400/80 uppercase mt-0.5 tracking-tighter">Akses Pemilik</p>
                        </div>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-500 ml-3"></i>
                    </button>
                    <div id="userMenu" class="hidden absolute right-0 mt-3 w-56 rounded-2xl bg-slate-900/95 border border-slate-700 shadow-2xl shadow-black/30 overflow-hidden z-50">
                        <a href="{{ route('profil.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-300 hover:bg-emerald-500/10 hover:text-emerald-300 transition-colors"><i class="fa-solid fa-user-gear w-4 text-center"></i> Profil</a>
                        <form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors text-left"><i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i> Keluar</button></form>
                    </div>
                </div>
            </div>
        </header>
        {{-- AREA SCROLLABLE --}}
        <div class="p-6 md:p-12 flex-1 overflow-y-auto custom-scroll relative">
            
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-{{ $accent }}-600/10 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/4"></div>

            @if(session('success'))
                <div class="bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 px-6 py-4 rounded-2xl mb-8 text-xs font-bold shadow-lg flex items-center gap-3 backdrop-blur-sm relative z-10">
                    <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
                </div>
            @endif

            {{-- HEADER HALAMAN --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8 md:mb-10 relative z-10">
                <div>
                    <h1 class="text-3xl md:text-5xl font-black text-white tracking-tighter leading-none mb-2">
                        Manajemen <span class="italic text-emerald-400">Pelanggan</span>
                    </h1>
                    <p class="text-slate-400 font-medium text-sm">Kelola seluruh hak akses Admin dan data Pelanggan ALBRK.</p>
                </div>

                <button onclick="openModal()" class="w-full md:w-auto bg-{{ $accent }}-500 text-white px-8 py-4 rounded-[1.5rem] font-black uppercase text-[10px] tracking-[0.2em] transition-all flex items-center justify-center gap-3 shadow-lg hover:-translate-y-1 active:scale-95 shrink-0 group">
                    <i class="fa-solid fa-user-plus group-hover:scale-110 transition-transform"></i> Tambah User Baru
                </button>
            </div>

            {{-- STATISTIK SINGKAT (DIUPDATE KE ID_ROLE) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10 relative z-10">
                <div class="glass-panel p-6 md:p-8 rounded-[2rem] flex justify-between items-center transition-all hover:bg-slate-800/80">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Total Pengguna</p>
                        <span class="text-3xl md:text-4xl font-black text-white italic">{{ $users->count() }}</span>
                    </div>
                    <div class="w-12 h-12 bg-slate-800 text-slate-400 border border-slate-700 rounded-full flex items-center justify-center text-xl shadow-inner"><i class="fa-solid fa-users"></i></div>
                </div>
                
                <div class="glass-panel relative overflow-hidden p-6 md:p-8 rounded-[2rem] flex justify-between items-center border-emerald-500/30">
                    <div class="absolute inset-0 bg-emerald-500/10"></div>
                    <div class="relative z-10">
                        <p class="text-[9px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-2">Admin & Staff</p>
                        {{-- Hitung id_role 2 --}}
                        <span class="text-3xl md:text-4xl font-black text-emerald-400 italic">{{ $users->where('id_role', 2)->count() }}</span>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/50 text-emerald-400 rounded-full flex items-center justify-center text-xl relative z-10 shadow-[0_0_15px_rgba(16,185,129,0.3)]"><i class="fa-solid fa-user-tie"></i></div>
                </div>
                
                <div class="glass-panel p-6 md:p-8 rounded-[2rem] flex justify-between items-center transition-all hover:bg-slate-800/80">
                    <div>
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Pelanggan</p>
                        {{-- Hitung id_role 3 --}}
                        <span class="text-3xl md:text-4xl font-black text-white italic">{{ $users->where('id_role', 3)->count() }}</span>
                    </div>
                    <div class="w-12 h-12 bg-slate-800 text-indigo-400 border border-slate-700 rounded-full flex items-center justify-center text-xl shadow-inner"><i class="fa-solid fa-bag-shopping"></i></div>
                </div>
            </div>
            
            {{-- TABEL DATA USER --}}
            <div class="glass-panel rounded-[2.5rem] border border-white/5 shadow-2xl overflow-hidden mb-10 relative z-10">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-[800px] md:min-w-0">
                        <thead>
                            <tr class="bg-slate-800/50 border-b border-slate-700 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                                <th class="px-8 py-6">Nama Pengguna</th>
                                <th class="px-8 py-6">Email & Kontak</th>
                                <th class="px-8 py-6 text-center">Role</th>
                                <th class="px-8 py-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/50 text-sm">
                            @forelse($users as $u)
                            <tr class="hover:bg-slate-800/30 transition-all group">
                                <td class="px-8 py-6">
                                    <p class="font-black text-white uppercase italic leading-tight group-hover:text-{{ $accent }}-400 transition-colors">{{ $u->nama }}</p>
                                    <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-1">Daftar: {{ $u->created_at->format('d/m/Y') }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="text-xs text-slate-300 font-medium">{{ $u->email }}</p>
                                    <p class="text-[10px] text-slate-500 font-bold tracking-widest mt-1">
                                        <i class="fa-brands fa-whatsapp text-emerald-500 mr-1"></i> {{ $u->no_telp ?? '-' }}
                                    </p>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    @if($u->status === 'Nonaktif')
                                        <span class="bg-red-500/20 text-red-400 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-red-500/30">Nonaktif</span>
                                    @elseif($u->id_role == 1)
                                        <span class="bg-emerald-500/20 text-emerald-400 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-emerald-500/30">Superadmin</span>
                                    @elseif($u->id_role == 2)
                                        <span class="bg-indigo-500/20 text-indigo-400 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-indigo-500/30">Admin</span>
                                    @else
                                        <span class="bg-slate-700 text-slate-300 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-[0.2em] border border-slate-600">Pelanggan</span>
                                    @endif
                                </td>
                                <td class="px-8 py-6 text-right">
                                    {{-- Proteksi: Tidak bisa edit/hapus diri sendiri atau Superadmin lain --}}
                                    @if($u->id_user == auth()->user()->id_user || $u->id_role == 1)
                                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] italic pr-2">{{ $u->id_user == auth()->user()->id_user ? 'Akun Anda' : 'Protected' }}</span>
                                    @else
                                        <div class="flex items-center justify-end gap-2">
                                            {{-- Tombol Edit --}}
                                            <button type="button" onclick="openEditModal({{ $u->id_user }}, '{{ $u->nama }}', '{{ $u->email }}', '{{ $u->no_telp ?? '' }}', {{ $u->id_role }})" class="w-10 h-10 rounded-full bg-amber-500/10 text-amber-500 border border-amber-500/20 hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center active:scale-90" title="Edit">
                                                <i class="fa-solid fa-pen-to-square text-sm"></i>
                                            </button>
                                            {{-- Tombol Nonaktifkan/Aktifkan --}}
                                            @if($u->status === 'Nonaktif')
                                                <form action="{{ route('superadmin.users.toggle', $u->id_user) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-10 h-10 rounded-full bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 hover:bg-emerald-500 hover:text-white transition-all flex items-center justify-center active:scale-90" title="Aktifkan">
                                                        <i class="fa-solid fa-check text-sm"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('superadmin.users.toggle', $u->id_user) }}" method="POST" class="m-0">
                                                    @csrf
                                                    <button type="submit" class="w-10 h-10 rounded-full bg-orange-500/10 text-orange-500 border border-orange-500/20 hover:bg-orange-500 hover:text-white transition-all flex items-center justify-center active:scale-90" title="Nonaktifkan">
                                                        <i class="fa-solid fa-ban text-sm"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('superadmin.users.destroy', $u->id_user) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini beserta semua data reservasinya?');" class="m-0">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-10 h-10 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all flex items-center justify-center active:scale-90" title="Hapus">
                                                    <i class="fa-solid fa-trash-can text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-24 text-center opacity-30">Belum ada data pengguna</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FOOTER --}}
        </div>
        <footer class="mt-auto w-full shrink-0 border-t border-slate-700/80 bg-[#0f172a]/50 px-6 py-6 text-center">
            <p class="text-xs text-slate-500">&copy; 2026 <span class="font-semibold text-slate-400">ALBRK.SHOESCARE</span></p>
        </footer>
    </main>

    {{-- MODAL TAMBAH USER (DARK THEME) --}}
    <div id="modalAdmin" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

        <div class="relative w-full max-w-md bg-slate-900 border border-slate-700 rounded-[2.5rem] shadow-2xl p-8 md:p-10 max-h-[90vh] overflow-y-auto custom-scroll">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black uppercase tracking-tight text-white">Tambah <span class="text-{{ $accent }}-500 italic">User</span></h3>
                <button onclick="closeModal()" class="w-10 h-10 rounded-full bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form id="addUserForm" action="{{ route('superadmin.users.store') }}" method="POST" autocomplete="off" class="space-y-5 m-0">
                @csrf
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="nama" required placeholder="Nama User" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 focus:bg-slate-800 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">No WhatsApp</label>
                    <input type="text" name="no_telp" required placeholder="0812xxxx" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Login</label>
                    <input type="email" name="email" required placeholder="email@albrk.com" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Role</label>
                    <select name="id_role" required class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none transition-all">
                        <option value="2">Admin</option>
                        <option value="3">Pelanggan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="Min 8 karakter" autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly')" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>

                <div class="pt-6 mt-6 border-t border-slate-800">
                    <button type="submit" class="w-full bg-{{ $accent }}-500 text-white py-4 rounded-[1.2rem] font-black uppercase text-[11px] tracking-widest hover:bg-{{ $accent }}-400 transition-all shadow-lg shadow-{{ $accent }}-500/20 active:scale-95">
                        Simpan User Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT USER (DARK THEME) --}}
    <div id="modalEdit" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/80 backdrop-blur-sm transition-opacity"></div>

        <div class="relative w-full max-w-md bg-slate-900 border border-slate-700 rounded-[2.5rem] shadow-2xl p-8 md:p-10 max-h-[90vh] overflow-y-auto custom-scroll">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-black uppercase tracking-tight text-white">Edit <span class="text-{{ $accent }}-500 italic">User</span></h3>
                <button onclick="closeEditModal()" class="w-10 h-10 rounded-full bg-slate-800 text-slate-400 hover:bg-red-500 hover:text-white transition-colors flex items-center justify-center">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <form id="formEdit" method="POST" class="space-y-5 m-0">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="nama" id="edit_nama" required placeholder="Nama User" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 focus:bg-slate-800 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">No WhatsApp</label>
                    <input type="text" name="no_telp" id="edit_telp" placeholder="0812xxxx" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Email Login</label>
                    <input type="email" name="email" id="edit_email" required placeholder="email@albrk.com" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Role</label>
                    <select name="id_role" id="edit_role" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none transition-all">
                        <option value="2">Admin</option>
                        <option value="3">Pelanggan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 ml-1">Kata Sandi Baru <span class="text-slate-500">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" placeholder="Min 8 karakter" class="w-full bg-slate-800/50 border border-slate-700 px-5 py-4 rounded-xl text-sm font-bold text-white focus:border-{{ $accent }}-500 outline-none">
                </div>

                <div class="pt-6 mt-6 border-t border-slate-800">
                    <button type="submit" class="w-full bg-{{ $accent }}-500 text-white py-4 rounded-[1.2rem] font-black uppercase text-[11px] tracking-widest hover:bg-{{ $accent }}-400 transition-all shadow-lg shadow-{{ $accent }}-500/20 active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        const modal = document.getElementById('modalAdmin');
        const modalEdit = document.getElementById('modalEdit');

        function openModal() {
            document.getElementById('addUserForm')?.reset();
            modal.classList.replace('hidden', 'flex');
        }
        function closeModal() { modal.classList.replace('flex', 'hidden'); }

        function openEditModal(id, nama, email, telp, role) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_telp').value = telp;
            document.getElementById('edit_role').value = role;
            document.getElementById('formEdit').action = '/superadmin/users/' + id;
            modalEdit.classList.replace('hidden', 'flex');
        }

        function closeEditModal() { modalEdit.classList.replace('flex', 'hidden'); }
    </script>
</body>
</html>







