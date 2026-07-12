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
        body { background-color: #020617; }

        .gradient-text {
            background: linear-gradient(135deg, #5eead4 0%, #cbd5e1 52%, #f8fafc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 py-8 md:p-6 selection:bg-slate-600 selection:text-white">
    <div class="w-full max-w-xl bg-slate-900 rounded-[2rem] shadow-2xl shadow-slate-950/50 p-8 md:p-12 border border-slate-800 relative overflow-hidden">
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="flex items-center justify-center gap-2 mb-6">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-600 to-slate-700 flex items-center justify-center">
                    <i class="fa-solid fa-shoe-prints text-white text-sm"></i>
                </div>
                <span class="font-display font-bold text-xl tracking-tight">
                    ALBRK<span class="gradient-text">.SHOECARE</span>
                </span>
            </a>
            <h2 class="text-2xl font-bold text-white mb-2">Buat Sandi Baru</h2>
            <p class="text-gray-400 text-xs md:text-sm">Silakan buat kata sandi baru untuk akun Anda.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-900/30 border border-red-800 text-red-300 px-4 py-3 rounded-xl mb-6 text-xs font-semibold text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Alamat Email</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" readonly class="w-full bg-slate-800 border border-slate-700 px-5 py-4 rounded-xl text-sm font-medium text-gray-400 cursor-not-allowed">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Kata Sandi Baru</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full bg-slate-800 border border-slate-700 px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500 focus:outline-none focus:border-teal-600 focus:ring-4 focus:ring-teal-500/10 transition-all">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-gray-400 mb-2">Ulangi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi baru" class="w-full bg-slate-800 border border-slate-700 px-5 py-4 rounded-xl text-sm font-medium text-gray-200 placeholder:text-gray-500 focus:outline-none focus:border-teal-600 focus:ring-4 focus:ring-teal-500/10 transition-all">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-teal-700 to-slate-700 text-white py-4 rounded-xl font-semibold text-sm hover:from-teal-600 hover:to-slate-600 shadow-lg shadow-teal-950/30 transition-all duration-300">
                Simpan Kata Sandi Baru
            </button>
        </form>
    </div>
</body>
</html>
