<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ALBRK.SHOECARE</title>

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

        .gradient-text {
            background: linear-gradient(135deg, #5eead4 0%, #cbd5e1 52%, #f8fafc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-gradient {
            background: linear-gradient(135deg, #0f766e 0%, #334155 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #0d9488 0%, #1e293b 100%);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -14px rgba(20, 184, 166, 0.45);
        }

        .input-modern {
            background: #1e293b;
            border: 1px solid #334155;
            transition: all 0.3s ease;
        }
        .input-modern:focus {
            background: #0f172a;
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.12);
            outline: none;
        }

        .side-pattern {
            background:
                linear-gradient(135deg, rgba(15, 118, 110, 0.95) 0%, rgba(51, 65, 85, 0.95) 100%);
        }
    </style>
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center p-4">

    <div class="w-full flex rounded-3xl overflow-hidden shadow-2xl shadow-slate-900/50">
        {{-- Left Side: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 side-pattern relative overflow-hidden">
            <div class="relative z-10 flex flex-col justify-end p-12 text-white">
                <div class="mb-8">
                    <h2 class="font-display text-4xl lg:text-5xl font-bold leading-tight mb-4">
                        Mulai Perawatan<br>
                        <span class="italic opacity-90">Sepatu Anda.</span>
                    </h2>
                    <p class="text-white/70 text-base max-w-sm leading-relaxed">
                        Daftar sekarang dan nikmati kemudahan reservasi online serta pantau treatment sepatu Anda secara real-time.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80">Reservasi Online Mudah</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-bell text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80">Notifikasi Status Real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                            <i class="fa-solid fa-star text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80">Treatment Premium Quality</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 bg-slate-900 flex flex-col justify-center">
            <div class="mb-10">
                <a href="/" class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center shadow-lg shadow-teal-700/20">
                        <i class="fa-solid fa-shoe-prints text-white text-lg"></i>
                    </div>
                    <span class="font-display font-bold text-2xl tracking-tight">
                        ALBRK<span class="gradient-text">.SHOECARE</span>
                    </span>
                </a>

                <h1 class="font-display text-3xl lg:text-4xl font-bold text-white mb-2">Buat Akun</h1>
                <p class="text-gray-400">Daftar untuk mulai reservasi treatment sepatu.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-900/30 border border-red-800 text-red-300 px-5 py-4 rounded-2xl mb-6 text-sm">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span class="font-semibold">Terdapat kesalahan:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-xs">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-5" id="registerForm">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        placeholder="Masukkan nama lengkap"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">No. WhatsApp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                        placeholder="08xxxxxxxxxx"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="nama@email.com"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Password</label>
                        <input type="password" name="password" required minlength="8"
                            placeholder="Min. 8 karakter"
                            class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Konfirmasi</label>
                        <input type="password" name="password_confirmation" required
                            placeholder="Ulangi password"
                            class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500">
                    </div>
                </div>

                <button type="submit" id="submitBtn"
                    class="btn-gradient w-full text-white py-4 rounded-xl font-semibold text-sm tracking-wide mt-2">
                    <span id="btnText">Daftar Sekarang</span>
                    <span id="btnLoading" class="hidden">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>Memproses...
                    </span>
                </button>
            </form>

            <p class="text-center text-sm text-gray-400 mt-8">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-teal-300 hover:text-teal-100 transition-colors">Masuk di sini</a>
            </p>

            <a href="{{ url('/') }}" class="block text-center text-sm text-gray-500 hover:text-gray-300 mt-4 transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        const form = document.getElementById('registerForm');
        const btn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnLoading = document.getElementById('btnLoading');

        form.addEventListener('submit', function() {
            btnText.classList.add('hidden');
            btnLoading.classList.remove('hidden');
            btn.disabled = true;
            btn.classList.add('opacity-75');
        });
    </script>
</body>
</html>
