<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil - ALBRK.SHOECARE</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#111111',
                        secondary: '#525252',
                        accent: '#737373',
                        dark: '#111111',
                        surface: '#f5f5f5',
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

        body { background-color: #f5f5f5; }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(23, 23, 23, 0.08);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(23, 23, 23, 0.08);
            transition: all 0.4s ease;
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -14px rgba(15, 23, 42, 0.15);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #111111 0%, #525252 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #000000 0%, #262626 100%);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -14px rgba(23, 23, 23, 0.42);
        }

        .input-modern {
            background: #ffffff;
            border: 1px solid #e5e5e5;
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            background: #ffffff;
            border-color: #111111;
            box-shadow: 0 0 0 4px rgba(17, 17, 17, 0.08);
            outline: none;
        }

        .noise {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 9999; opacity: 0.015;
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
        }

        .hero-bg {
            background:
                radial-gradient(circle at 15% 20%, rgba(212, 212, 212, 0.45) 0%, transparent 32%),
                linear-gradient(180deg, #f5f5f5 0%, #ffffff 100%);
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.15); border-radius: 3px; }
    </style>
</head>

<body class="antialiased min-h-screen relative text-gray-900">

    <div class="noise"></div>

    {{-- NAVBAR --}}
    <nav class="sticky top-0 z-50 glass border-b border-gray-200 transition-all duration-300">
        <div class="w-full px-6 md:px-10 py-4 flex justify-between items-center">
            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors group">
                <div class="w-8 h-8 rounded-full border border-gray-200 flex items-center justify-center group-hover:border-gray-400 group-hover:bg-gray-50 transition-all">
                    <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-1 transition-transform"></i>
                </div>
                Dashboard
            </a>
            <div class="text-right">
                <p class="text-[9px] font-semibold text-gray-400 uppercase tracking-widest mb-0.5">Pengaturan</p>
                <h1 class="text-xs md:text-sm font-bold text-gray-900 uppercase">Kelola Akun</h1>
            </div>
        </div>
    </nav>

    {{-- NOTIFIKASI --}}
    <div class="w-full px-6 md:px-10 mt-8 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-2 text-xs md:text-sm font-semibold flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-check text-lg"></i> {{ session('success') }}
            </div>
        @endif
    </div>

    {{-- KONTEN UTAMA --}}
    <main class="w-full px-6 md:px-10 mt-4 pb-12 flex-grow flex flex-col hero-bg">

        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-display font-bold uppercase tracking-tight text-gray-900 leading-none">
                Kelola <span class="italic font-semibold text-gray-500">Profil</span>
            </h1>
            <p class="text-gray-500 font-medium text-xs md:text-sm mt-3">Data diri Anda aman di sistem ALBRK.SHOECARE.</p>
        </div>

        <div class="max-w-7xl mx-auto w-full">
            <div class="grid grid-cols-1 lg:grid-cols-[350px_1fr] gap-6 xl:gap-8 items-start">

                {{-- KIRI: AVATAR / PROFIL --}}
                <div class="glass-card rounded-3xl p-8 md:p-10 sticky top-28">
                    <div class="flex flex-col items-center">
                        {{-- Avatar Circle --}}
                        <div class="w-40 h-40 rounded-full border-4 border-white bg-neutral-900 shadow-xl overflow-hidden text-white flex items-center justify-center font-display font-black text-6xl mb-6 relative group-hover:scale-105 transition-all duration-500">
                            @if(auth()->user()->foto_profil)
                                <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" alt="Foto" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                            @endif
                        </div>

                        {{-- Nama & Role --}}
                        <h3 class="text-xl font-display font-bold text-gray-900 uppercase tracking-tight mb-2 text-center">{{ auth()->user()->nama }}</h3>
                        <span class="bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-[10px] uppercase font-bold tracking-widest border border-gray-200 mb-6">
                            {{ auth()->user()->id_role == 1 ? 'SUPERADMIN' : (auth()->user()->id_role == 2 ? 'ADMIN' : 'CUSTOMER') }}
                        </span>

                        {{-- Info Email --}}
                        <div class="w-full bg-gray-50 rounded-2xl p-4 mb-6 text-center">
                            <p class="text-xs text-gray-400 mb-1">Email Terdaftar</p>
                            <p class="text-sm font-semibold text-gray-700 truncate">{{ auth()->user()->email }}</p>
                        </div>

                        {{-- Divider --}}
                        <div class="w-full h-px bg-gray-200 mb-6"></div>

                        {{-- Upload Form --}}
                        <form action="{{ route('profil.updateFoto') }}" method="POST" enctype="multipart/form-data" id="form-upload" class="w-full text-left">
                            @csrf @method('PATCH')
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1 text-center">Ganti Foto Profil</label>
                            <div class="relative w-full group/dropzone">
                                <div class="w-full bg-gray-50 hover:bg-gray-100 border-2 border-dashed border-gray-300 hover:border-gray-400 rounded-2xl p-5 flex flex-col items-center justify-center transition-all cursor-pointer">
                                    <i class="fa-solid fa-cloud-arrow-up text-xl text-gray-400 mb-2"></i>
                                    <p id="file-name" class="text-[10px] font-bold text-gray-400 text-center truncate w-full px-2">Klik untuk pilih foto...</p>
                                </div>
                                <input type="file" name="foto_profil" id="foto" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="document.getElementById('file-name').innerText = this.files[0].name">
                            </div>
                        </form>
                    </div>

                    <div class="pt-6 mt-6 space-y-3 border-t border-gray-100">
                        <button type="submit" form="form-upload" class="btn-gradient w-full text-white py-4 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all shadow-lg active:scale-95">
                            <i class="fa-solid fa-upload mr-2"></i>Upload Foto
                        </button>
                        @if(auth()->user()->foto_profil)
                            <form action="{{ route('profil.hapusFoto') }}" method="POST" class="w-full">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus foto?')" class="w-full bg-red-50 text-red-600 border border-red-200 hover:bg-red-600 hover:text-white py-3.5 rounded-xl font-bold uppercase text-[10px] tracking-widest transition-all">
                                    <i class="fa-solid fa-trash mr-2"></i>Hapus Foto
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                {{-- KANAN: FORM DATA DIRI & PASSWORD --}}
                <div class="space-y-6">
                    {{-- DATA DIRI --}}
                    <div class="glass-card rounded-3xl p-8 md:p-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 rounded-2xl bg-neutral-900 text-white flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-user-pen"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-display font-bold uppercase tracking-tight text-gray-900">Data Diri</h2>
                                <p class="text-[10px] font-medium text-gray-400">Update identitas utama Anda.</p>
                            </div>
                        </div>

                        <form action="{{ route('profil.update') }}" method="POST" class="flex flex-col flex-grow">
                            @csrf @method('PATCH')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ auth()->user()->nama }}" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">No. WhatsApp</label>
                                    <input type="text" name="no_hp" value="{{ auth()->user()->no_telp }}" class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                                </div>
                            </div>
                            <div class="mt-5">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold">
                            </div>
                            <div class="mt-5">
                                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Alamat</label>
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
                            <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-600 border border-gray-200 flex items-center justify-center shadow-lg">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-display font-bold uppercase tracking-tight text-gray-900">Keamanan</h2>
                                <p class="text-[10px] font-medium text-gray-400">Perbarui kata sandi secara berkala.</p>
                            </div>
                        </div>

                        <form action="{{ route('profil.updatePassword') }}" method="POST" class="flex flex-col flex-grow">
                            @csrf @method('PATCH')
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password Saat Ini</label>
                                    <input type="password" name="current_password" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold" placeholder="Masukkan password lama">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password Baru</label>
                                    <input type="password" name="new_password" required class="input-modern w-full px-5 py-4 rounded-xl text-sm font-semibold" placeholder="Minimal 8 karakter">
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Konfirmasi Password</label>
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
    <footer class="bg-white border-t border-gray-200 py-6 px-6 text-center">
        <p class="text-gray-400 text-xs">&copy; 2026 <span class="text-gray-600 font-semibold">ALBRK.SHOECARE</span></p>
    </footer>
</body>
</html>
