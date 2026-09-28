@php
    $user = auth()->user();
    $role = $user?->role ?? '';
    $roleId = (int) ($user?->id_role ?? 3);
    $isSuper = $roleId === 1 || $role === 'superadmin';
    $isAdmin = $roleId === 2 || $role === 'admin';
    $isStaff = $isSuper || $isAdmin;

    $accentName = $isSuper ? 'emerald' : ($isAdmin ? 'blue' : 'neutral');
    $accentMain = $isSuper ? '#10b981' : ($isAdmin ? '#3b82f6' : '#6b7280');
    $accentDark = $isSuper ? '#059669' : ($isAdmin ? '#2563eb' : '#4b5563');
    $accentSoft = $isSuper ? 'rgba(16, 185, 129, 0.10)' : ($isAdmin ? 'rgba(59, 130, 246, 0.10)' : 'rgba(107, 114, 128, 0.10)');
    $roleLabel = $isSuper ? 'SUPERADMIN' : ($isAdmin ? 'ADMIN' : 'CUSTOMER');
    $profileShellClass = $isStaff
        ? 'customer-profile admin-profile h-screen overflow-hidden flex flex-col'
        : 'customer-profile bg-gray-200 h-screen overflow-hidden flex flex-col';
@endphp
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil - ALBRK.SHOESCARE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '{{ $accentMain }}',
                        secondary: '{{ $accentDark }}',
                        accent: '{{ $accentMain }}',
                        dark: '#0f172a',
                        surface: '#0f172a',
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

        body {
            background-color: #0f172a;
            --accent-main: {{ $accentMain }};
            --accent-dark: {{ $accentDark }};
            --accent-soft: {{ $accentSoft }};
        }

        .glass {
            background: rgba(15, 23, 42, 0.76);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.42);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            background: rgba(30, 41, 59, 0.62);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -18px rgba(0, 0, 0, 0.55);
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--accent-main) 0%, var(--accent-dark) 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent-main) 100%);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -14px color-mix(in srgb, var(--accent-main) 45%, transparent);
        }

        .input-modern {
            background: rgba(15, 23, 42, 0.64);
            border: 1px solid rgba(51, 65, 85, 0.85);
            color: #f8fafc;
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            background: rgba(15, 23, 42, 0.88);
            border-color: var(--accent-main);
            box-shadow: 0 0 0 4px var(--accent-soft);
            outline: none;
        }

        .noise {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 9999; opacity: 0.015;
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
        }

        .hero-bg {
            background:
                radial-gradient(circle at 15% 20%, var(--accent-soft) 0%, transparent 32%),
                linear-gradient(180deg, #0f172a 0%, #111827 100%);
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(15, 23, 42, 0.4); }
        ::-webkit-scrollbar-thumb { background: rgba(71, 85, 105, 0.8); border-radius: 3px; }

        .customer-profile { background-color: #e5e7eb; color: #111827; }
        .customer-profile .glass { background: rgba(255, 255, 255, 0.94); border-color: #d1d5db; }
        .customer-profile .glass-card { background: #fff; border-color: #d1d5db; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05); }
        .customer-profile .glass-card:hover { background: #fff; box-shadow: 0 20px 40px -18px rgba(15, 23, 42, 0.18); }
        .customer-profile .hero-bg { background: #e5e7eb; }
        .customer-profile .text-white { color: #111827; }
        .customer-profile .btn-gradient.text-white,
        .customer-profile .glass-card > .flex .text-white { color: #fff; }
        .customer-profile .text-slate-100, .customer-profile .text-slate-200 { color: #374151; }
        .customer-profile .text-slate-300, .customer-profile .text-slate-400 { color: #6b7280; }
        .customer-profile .text-slate-500 { color: #9ca3af; }
        .customer-profile .bg-slate-900\/40, .customer-profile .bg-slate-800\/50 { background-color: #f3f4f6; }
        .customer-profile .bg-neutral-500\/10 { background-color: #f3f4f6; }
        .customer-profile .text-neutral-300 { color: #4b5563; }
        .customer-profile .border-slate-700, .customer-profile .border-slate-600 { border-color: #d1d5db; }
        .customer-profile .input-modern { background: #fff; border-color: #d1d5db; color: #111827; }
        .customer-profile .input-modern:focus { background: #fff; }
        .customer-profile ::-webkit-scrollbar-track { background: #e5e7eb; }
        .customer-profile ::-webkit-scrollbar-thumb { background: #9ca3af; }
        .customer-profile .profile-nav-label { color: #6b7280; }
        .customer-profile .profile-nav-title { color: #1f2937; }
        .customer-profile footer { background: #fff; border-color: #e5e7eb; }
        .customer-profile footer p { color: #6b7280; }
        .customer-profile footer span { color: #4b5563; }
        .customer-profile .profile-right-scroll { display: flex; flex-direction: column; gap: 1.5rem; }
        .admin-profile { background-color: #0f172a; color: #e2e8f0; }
        .admin-profile .glass { background: rgba(15, 23, 42, .9); border-color: rgba(255, 255, 255, .08); }
        .admin-profile .glass-card { background: rgba(30, 41, 59, .82); border-color: rgba(255, 255, 255, .08); box-shadow: 0 8px 24px rgba(0, 0, 0, .18); }
        .admin-profile .glass-card:hover { background: rgba(30, 41, 59, .94); box-shadow: 0 20px 40px -18px rgba(0, 0, 0, .45); }
        .admin-profile .hero-bg { background: #0f172a; }
        .admin-profile .text-white { color: #fff; }
        .admin-profile .text-slate-100, .admin-profile .text-slate-200 { color: #e2e8f0; }
        .admin-profile .text-slate-300, .admin-profile .text-slate-400 { color: #94a3b8; }
        .admin-profile .text-slate-500 { color: #64748b; }
        .admin-profile .bg-slate-900\/40, .admin-profile .bg-slate-800\/50 { background-color: rgba(15, 23, 42, .55); }
        .admin-profile .border-slate-700, .admin-profile .border-slate-600 { border-color: #334155; }
        .admin-profile .input-modern { background: rgba(15, 23, 42, .72); border-color: #334155; color: #f8fafc; }
        .admin-profile .input-modern:focus { background: rgba(15, 23, 42, .92); }
        .admin-profile ::-webkit-scrollbar-track { background: rgba(15, 23, 42, .5); }
        .admin-profile ::-webkit-scrollbar-thumb { background: #475569; }
        .admin-profile .profile-nav-label { color: #94a3b8; }
        .admin-profile .profile-nav-title { color: #f8fafc; }
        .admin-profile-alert { width: 100%; max-width: 1106px; padding-left: 0 !important; padding-right: 0 !important; margin-top: 1rem !important; }
        .admin-profile footer { background: rgba(15, 23, 42, .5); border-color: rgba(255, 255, 255, .08); }
        .admin-profile footer p { color: #64748b; }
        .admin-profile footer span { color: #94a3b8; }
        @media (min-width: 1024px) {
            .customer-profile .profile-main { overflow: hidden; }
            .customer-profile .profile-content { display: flex; flex: 1; flex-direction: column; min-height: 0; }
            .customer-profile .profile-grid { flex: 1; grid-template-rows: minmax(0, 1fr); height: 100%; min-height: 0; align-items: stretch; }
            .customer-profile .profile-sidebar { align-self: center; }
            .customer-profile .profile-right-scroll { height: auto; max-height: none; min-height: 0; align-self: center; overflow: visible; }
        }
        @media (min-width: 1280px) {
            .customer-profile .profile-content { width: 1106px; max-width: calc(100vw - 5rem); }
            .customer-profile .profile-grid { grid-template-columns: 350px 724px; }
            .customer-profile .profile-sidebar { width: 350px; height: 748px; }
            .customer-profile .profile-right-scroll { display: grid; width: 724px; height: 748px; max-height: calc(100vh - 250px); grid-template-columns: repeat(2, 350px); grid-auto-rows: 748px; align-content: start; align-items: stretch; }
            .customer-profile .profile-right-scroll > .glass-card { width: 350px; height: 748px; }
        }
    </style>
</head>

<body class="{{ $profileShellClass }} antialiased min-h-screen relative text-slate-100">

    <div class="noise"></div>

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 glass border-b border-white/5 transition-all duration-300 shrink-0">
        <div class="w-full px-6 md:px-10 py-4 flex justify-between items-center">
            <div class="text-left">
                <p class="profile-nav-label text-[10px] font-bold uppercase tracking-[0.14em] mb-1">Pengaturan</p>
                <h1 class="profile-nav-title text-sm md:text-base font-extrabold uppercase tracking-wide">Kelola Profil</h1>
            </div>
        </div>
    </nav>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="w-full px-6 md:px-10 mt-8 max-w-7xl mx-auto {{ $isStaff ? 'admin-profile-alert' : '' }}">
            <div class="bg-{{ $accentName }}-500/10 border border-{{ $accentName }}-500/30 text-{{ $accentName }}-300 px-6 py-4 rounded-2xl mb-2 text-xs md:text-sm font-semibold flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- KONTEN UTAMA --}}
    <main class="w-full px-6 md:px-10 profile-main overflow-y-auto pb-12 flex-grow flex flex-col hero-bg flex-1 min-h-0">

        <div class="max-w-7xl mx-auto w-full profile-content">
            <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-6 xl:gap-8 profile-grid items-center lg:translate-y-5">

                {{-- KIRI: AVATAR / PROFIL --}}
                <div class="glass-card rounded-3xl p-8 md:p-10 profile-sidebar">
                    <div class="flex flex-col items-center">
                        {{-- Avatar Circle --}}
                        <div id="profile-photo-preview" class="w-40 h-40 rounded-full border-4 border-slate-800 bg-{{ $accentName }}-600 shadow-xl shadow-{{ $accentName }}-500/20 overflow-hidden text-white flex items-center justify-center font-display font-black text-6xl mb-6 relative group-hover:scale-105 transition-all duration-500">
                            @if(auth()->user()->foto_profil)
                                <img id="profile-photo-image" src="{{ route('profil.foto') }}" alt="Foto profil" class="w-full h-full rounded-full bg-white object-contain p-0.5" onerror="showProfilePhotoFallback()">
                            @else
                                <img id="profile-photo-image" alt="Foto profil" class="hidden w-full h-full rounded-full bg-white object-contain p-0.5" onerror="showProfilePhotoFallback()">
                            @endif
                            <span id="profile-photo-fallback" class="{{ auth()->user()->foto_profil ? 'hidden' : '' }}">{{ strtoupper(substr(auth()->user()->nama ?? 'PL', 0, 2)) }}</span>
                        </div>

                        {{-- Nama & Role --}}
                        <h3 class="text-xl font-display font-bold text-white uppercase tracking-tight mb-2 text-center">{{ auth()->user()->nama }}</h3>
                        <span class="bg-{{ $accentName }}-500/10 text-{{ $accentName }}-300 px-4 py-1.5 rounded-full text-[10px] uppercase font-bold tracking-widest border border-{{ $accentName }}-500/30 mb-6">
                            {{ $roleLabel }}
                        </span>

                        {{-- Info Email --}}
                        <div class="w-full bg-slate-900/40 rounded-2xl p-4 mb-6 text-center border border-{{ $accentName }}-500/20">
                            <p class="text-xs text-slate-500 mb-1">Email Terdaftar</p>
                            <p class="text-sm font-semibold text-slate-200 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        {{-- Divider --}}
                        <div class="w-full h-px bg-slate-700 mb-6"></div>

                        {{-- Upload Form --}}
                        <form action="{{ route('profil.updateFoto') }}" method="POST" enctype="multipart/form-data" id="form-upload" class="w-full text-left">
                            @csrf @method('PATCH')
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1 text-center">Ganti Foto Profil</label>
                            <div class="relative w-full group/dropzone">
                                <div class="w-full bg-slate-900/40 hover:bg-{{ $accentName }}-500/10 border-2 border-dashed border-slate-600 hover:border-{{ $accentName }}-400 rounded-2xl p-5 flex flex-col items-center justify-center transition-all cursor-pointer">
                                    <i class="fa-solid fa-cloud-arrow-up text-xl text-{{ $accentName }}-400 mb-2"></i>
                                    <p id="file-name" class="text-[10px] font-bold text-slate-500 text-center truncate w-full px-2">Klik untuk pilih foto...</p>
                                </div>
                                <input type="file" name="foto_profil" id="foto" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewProfilePhoto(this)">
                            </div>
                        </form>
                    </div>

                    <div class="pt-6 mt-6 space-y-3 border-t border-slate-700">
                        <button type="submit" form="form-upload" class="btn-gradient w-full text-white py-4 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all shadow-lg active:scale-95">
                            <i class="fa-solid fa-upload mr-2"></i>Upload Foto
                        </button>
                        @if(auth()->user()->foto_profil)
                            <form action="{{ route('profil.hapusFoto') }}" method="POST" class="w-full">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus foto?')" class="w-full bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-600 hover:text-white py-3.5 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all">
                                    <i class="fa-solid fa-trash mr-2"></i>Hapus Foto
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- KANAN: FORM DATA DIRI & PASSWORD --}}
                <div class="profile-right-scroll">
                    {{-- DATA DIRI --}}
                    <div class="glass-card rounded-3xl p-8 md:p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-{{ $accentName }}-600 text-white flex items-center justify-center shadow-lg shadow-{{ $accentName }}-500/20">
                                <i class="fa-solid fa-user-pen"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-display font-bold uppercase tracking-tight text-white">Data Diri</h2>
                                <p class="text-[10px] font-medium text-slate-500">Update identitas utama Anda.</p>
                            </div>
                        </div>

                        <form action="{{ route('profil.update') }}" method="POST" class="flex flex-col flex-grow">
                            @csrf @method('PATCH')
                            <div class="grid grid-cols-1 gap-5">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ auth()->user()->nama }}" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">No. WhatsApp</label>
                                    <input type="text" name="no_hp" value="{{ auth()->user()->no_telp }}" class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                            </div>
                            <div class="mt-5">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Alamat</label>
                                <textarea name="alamat" rows="3" class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold resize-none">{{ auth()->user()->alamat }}</textarea>
                            </div>
                            <button type="submit" class="btn-gradient w-full mt-8 text-white py-4 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all shadow-lg active:scale-95">
                                <i class="fa-solid fa-check mr-2"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    {{-- GANTI PASSWORD --}}
                    <div class="glass-card rounded-3xl p-8 md:p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-{{ $accentName }}-500/10 text-{{ $accentName }}-300 border border-{{ $accentName }}-500/30 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-display font-bold uppercase tracking-tight text-white">Keamanan</h2>
                                <p class="text-[10px] font-medium text-slate-500">Perbarui kata sandi secara berkala.</p>
                            </div>
                        </div>

                        <form action="{{ route('profil.updatePassword') }}" method="POST" class="flex flex-col flex-grow">
                            @csrf @method('PATCH')
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Password Saat Ini</label>
                                    <input type="password" name="current_password" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold" placeholder="Masukkan password lama">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Password Baru</label>
                                    <input type="password" name="new_password" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold" placeholder="Minimal 8 karakter">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2 ml-1">Konfirmasi Password</label>
                                    <input type="password" name="new_password_confirmation" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold" placeholder="Ulangi password baru">
                                </div>
                            </div>
                            <button type="submit" class="btn-gradient w-full mt-8 text-white py-4 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all shadow-lg active:scale-95">
                                <i class="fa-solid fa-key mr-2"></i>Perbarui Password
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="mt-auto w-full shrink-0 border-t border-white/5 bg-[#0f172a]/50 px-6 py-6 text-center">
        <p class="text-xs text-slate-500">&copy; 2026 <span class="font-semibold text-slate-400">ALBRK.SHOESCARE</span></p>
    </footer>
<script>
    function showProfilePhotoFallback() {
        const image = document.getElementById('profile-photo-image');
        image.classList.add('hidden');
        document.getElementById('profile-photo-fallback')?.classList.remove('hidden');
    }

    function previewProfilePhoto(input) {
        const file = input.files?.[0];
        if (!file) return;

        document.getElementById('file-name').textContent = file.name;

        if (!file.type.startsWith('image/')) return;

        const image = document.getElementById('profile-photo-image');
        const fallback = document.getElementById('profile-photo-fallback');
        const previewUrl = URL.createObjectURL(file);
        image.onload = () => URL.revokeObjectURL(previewUrl);
        image.src = previewUrl;
        image.classList.remove('hidden');
        fallback?.classList.add('hidden');
    }
</script>
</body>
</html>
