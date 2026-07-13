<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Sandi Baru - ALBRK.SHOECARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
    </style>
</head>
<body class="min-h-screen bg-surface flex items-center justify-center p-4">
    <div class="noise"></div>

    <div class="w-full max-w-xl bg-white rounded-[2rem] shadow-2xl shadow-gray-200/50 p-8 md:p-12 border border-gray-100 relative overflow-hidden">
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 mb-6">
                <div class="w-10 h-10 rounded-xl bg-neutral-950 flex items-center justify-center shadow-lg shadow-gray-200/50">
                    <i class="fa-solid fa-shoe-prints text-white text-sm"></i>
                </div>
                <span class="font-display font-bold text-xl tracking-tight text-gray-900">
                    ALBRK<span class="text-neutral-400">.SHOECARE</span>
                </span>
            </a>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Buat Sandi Baru</h2>
            <p class="text-gray-500 text-xs md:text-sm">Silakan buat kata sandi baru untuk akun Anda.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 text-xs font-semibold text-center">
                <i class="fa-solid fa-circle-exclamation mr-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly class="w-full bg-gray-100 border border-gray-200 px-5 py-4 rounded-xl text-sm font-medium text-gray-400 cursor-not-allowed">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Kata Sandi Baru</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter" class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 mb-2">Ulangi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="input-modern w-full px-5 py-4 rounded-xl text-sm font-medium text-gray-700 placeholder:text-gray-400">
            </div>

            <button type="submit" class="btn-gradient w-full text-white py-4 rounded-xl font-semibold text-sm shadow-lg">
                Simpan Kata Sandi Baru
            </button>
        </form>
    </div>
</body>
</html>
