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
    </style>
</head>
<body class="min-h-screen bg-surface flex items-center justify-center p-4">

    <div class="noise"></div>

    <div class="w-full max-w-5xl flex rounded-3xl overflow-hidden shadow-2xl shadow-gray-200/50 relative">
        {{-- Left Side: Branding --}}
        <div class="hidden lg:flex lg:w-1/2 side-pattern relative overflow-hidden">
            <div class="relative z-10 flex flex-col justify-end p-12 text-gray-900">
                <a href="/" class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-2xl bg-neutral-950 flex items-center justify-center shadow-lg shadow-neutral-200/50">
                        <i class="fa-solid fa-shoe-prints text-white text-lg"></i>
                    </div>
                    <span class="font-display font-bold text-2xl tracking-tight text-gray-900">
                        ALBRK<span class="text-neutral-400">.SHOECARE</span>
                    </span>
                </a>

                <div class="mb-8">
                    <h2 class="font-display text-4xl lg:text-5xl font-bold leading-tight mb-4">
                        Mulai Perawatan<br>
                        <span class="italic text-neutral-500">Sepatu Anda.</span>
                    </h2>
                    <p class="text-gray-500 text-base max-w-sm leading-relaxed">
                        Daftar sekarang dan nikmati kemudahan reservasi online serta pantau treatment sepatu Anda secara real-time.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check text-sm text-neutral-700"></i>
                        </div>
                        <span class="text-sm text-gray-600">Reservasi Online Mudah</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-bell text-sm text-neutral-700"></i>
                        </div>
                        <span class="text-sm text-gray-600">Notifikasi Status Real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-neutral-950/10 flex items-center justify-center">
                            <i class="fa-solid fa-star text-sm text-neutral-700"></i>
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

                <h1 class="font-display text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Buat Akun</h1>
                <p class="text-gray-500">Daftar untuk mulai reservasi treatment sepatu.</p>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-2xl mb-6 text-sm">
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
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required
                        placeholder="Masukkan nama lengkap"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">No. WhatsApp</label>
                    <input type="text" name="no_telp" value="{{ old('no_telp') }}" required
                        placeholder="08xxxxxxxxxx"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        placeholder="nama@email.com"
                        class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Password</label>
                        <input type="password" name="password" required minlength="8"
                            placeholder="Min. 8 karakter"
                            class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Konfirmasi</label>
                        <input type="password" name="password_confirmation" required
                            placeholder="Ulangi password"
                            class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
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

            <p class="text-center text-sm text-gray-500 mt-8">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-neutral-700 hover:text-neutral-900 transition-colors">Masuk di sini</a>
            </p>

            <a href="{{ url('/') }}" class="block text-center text-sm text-gray-400 hover:text-gray-600 mt-4 transition-colors">
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
