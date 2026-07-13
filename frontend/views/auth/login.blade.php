<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - ALBRK.SHOECARE</title>

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

        .btn-gradient {
            background: linear-gradient(135deg, #111111 0%, #525252 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #000000 0%, #262626 100%);
            transform: translateY(-2px);
            box-shadow: 0 20px 40px -14px rgba(23, 23, 23, 0.42);
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(23, 23, 23, 0.08);
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

        .side-pattern {
            background:
                radial-gradient(circle at 15% 20%, rgba(212, 212, 212, 0.45) 0%, transparent 32%),
                linear-gradient(180deg, #f5f5f5 0%, #ffffff 100%);
        }

        .noise {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 9999; opacity: 0.015;
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
        }

        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -10px rgba(15, 23, 42, 0.12);
        }
    </style>
</head>
<body class="min-h-screen bg-surface flex items-center justify-center p-4">

    <div class="noise"></div>

    <div class="w-full max-w-5xl flex rounded-3xl overflow-hidden shadow-2xl shadow-gray-200/50 relative">
        {{-- Left Side: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 side-pattern relative overflow-hidden">
            {{-- Decorative Elements --}}
            <div class="relative z-10 flex flex-col justify-end p-12 text-gray-900">
                <div class="mb-8">
                    <a href="/" class="flex items-center gap-3 mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-neutral-950 flex items-center justify-center shadow-lg shadow-neutral-200/50">
                            <i class="fa-solid fa-shoe-prints text-white text-lg"></i>
                        </div>
                        <span class="font-display font-bold text-2xl tracking-tight text-gray-900">
                            ALBRK<span class="text-neutral-400">.SHOECARE</span>
                        </span>
                    </a>

                    <h2 class="font-display text-4xl lg:text-5xl font-bold leading-tight mb-4">
                        Rawat Sepatu,<br>
                        <span class="italic text-neutral-500">Tingkatkan Gaya.</span>
                    </h2>
                    <p class="text-gray-500 text-base max-w-sm leading-relaxed">
                        Akses dashboard untuk reservasi online dan pantau proses treatment sepatu Anda secara real-time.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-check text-sm text-neutral-700"></i>
                        </div>
                        <span class="text-sm text-gray-600">Reservasi Online 24/7</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-check text-sm text-neutral-700"></i>
                        </div>
                        <span class="text-sm text-gray-600">Pantau Status Real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-check text-sm text-neutral-700"></i>
                        </div>
                        <span class="text-sm text-gray-600">Treatment Premium Quality</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Side: Form --}}
        <div class="w-full lg:w-1/2 p-8 sm:p-12 lg:p-16 bg-white flex flex-col justify-center">

            <div class="mb-10">
                <a href="/" class="flex items-center gap-3 mb-8 lg:hidden">
                    <div class="w-12 h-12 rounded-2xl bg-neutral-950 flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-shoe-prints text-white text-lg"></i>
                    </div>
                    <span class="font-display font-bold text-2xl tracking-tight text-gray-900">
                        ALBRK<span class="text-neutral-400">.SHOECARE</span>
                    </span>
                </a>

                <h1 class="font-display text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
                <p class="text-gray-500">Masuk untuk mengelola reservasi sepatu Anda.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6 text-sm font-medium">
                    <i class="fa-solid fa-circle-exclamation mr-2"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5" id="loginForm">
                @csrf

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="nama@email.com"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required id="password"
                            placeholder="Masukkan password"
                            class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400 pr-12">
                        <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fa-solid fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-neutral-600 focus:ring-neutral-500 bg-gray-50">
                        <span class="text-sm text-gray-500">Ingat saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-neutral-600 hover:text-neutral-900 transition-colors">
                        Lupa password?
                    </a>
                </div>

                <button type="submit" id="submitBtn"
                    class="btn-gradient w-full text-white py-4 rounded-xl font-semibold text-sm tracking-wide mt-2">
                    <span id="btnText">Masuk Sekarang</span>
                    <span id="btnLoading" class="hidden">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>Memproses...
                    </span>
                </button>
            </form>

            <div class="relative flex items-center my-6">
                <div class="flex-grow border-t border-gray-200"></div>
                <span class="flex-shrink mx-4 text-xs font-semibold uppercase tracking-wider text-gray-400">atau</span>
                <div class="flex-grow border-t border-gray-200"></div>
            </div>

            <a href="{{ route('login.google') }}"
                class="w-full bg-white border-2 border-gray-200 text-gray-700 py-4 rounded-xl font-semibold text-sm hover:border-gray-400 hover:text-gray-900 transition-all flex items-center justify-center gap-3 shadow-sm">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Masuk dengan Google
            </a>

            <p class="text-center text-sm text-gray-500 mt-8">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-neutral-700 hover:text-neutral-900 transition-colors">Daftar sekarang</a>
            </p>

            <a href="{{ url('/') }}" class="block text-center text-sm text-gray-400 hover:text-gray-600 mt-4 transition-colors">
                <i class="fa-solid fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        const form = document.getElementById('loginForm');
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
