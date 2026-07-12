<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ALBRK.SHOECARE - Perawatan Sepatu Premium')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#475569',
                        secondary: '#64748b',
                        accent: '#334155',
                        dark: '#1e293b',
                        surface: '#f8fafc',
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

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #64748b; }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #475569 0%, #64748b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Glassmorphism - Light Theme */
        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .glass-dark {
            background: rgba(30, 41, 59, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Animated Gradient Border */
        .gradient-border {
            position: relative;
        }
        .gradient-border::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #475569, #64748b, #94a3b8, #475569);
            background-size: 300% 300%;
            border-radius: inherit;
            z-index: -1;
            animation: gradient-rotate 4s linear infinite;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gradient-border:hover::before {
            opacity: 1;
        }

        @keyframes gradient-rotate {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        /* Pulse Glow - Muted Gray Theme */
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(71, 85, 105, 0.4); }
            50% { box-shadow: 0 0 40px rgba(71, 85, 105, 0.6); }
        }
        .pulse-glow {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        /* Smooth Transitions */
        .smooth-transition {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(71, 85, 105, 0.3);
        }

        /* Noise Texture */
        .noise {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.02;
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
        }

        /* Hero Background - Light Theme */
        .hero-bg {
            background:
                radial-gradient(ellipse at 20% 50%, rgba(71, 85, 105, 0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 50%, rgba(100, 116, 139, 0.05) 0%, transparent 50%),
                radial-gradient(ellipse at 50% 100%, rgba(148, 163, 184, 0.05) 0%, transparent 50%),
                linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
        }

        /* Selection Color */
        ::selection {
            background: #475569;
            color: white;
        }
    </style>
</head>
<body class="antialiased bg-surface text-gray-700 overflow-x-hidden">
    <div class="noise"></div>

    {{-- NAVBAR --}}
    <nav class="fixed w-full z-50 glass border-b border-gray-200 transition-all duration-300" data-aos="fade-down" data-aos-duration="800">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center shadow-lg shadow-slate-500/30 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-shoe-prints text-white text-sm"></i>
                    </div>
                    <span class="font-display font-bold text-xl lg:text-2xl tracking-tight">
                        ALBRK<span class="gradient-text">.SHOECARE</span>
                    </span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-8">
                    <a href="#beranda" class="nav-link text-sm font-medium text-gray-500 hover:text-slate-700 transition-colors">Beranda</a>
                    <a href="#layanan" class="nav-link text-sm font-medium text-gray-500 hover:text-slate-700 transition-colors">Layanan</a>
                    <a href="#tentang" class="nav-link text-sm font-medium text-gray-500 hover:text-slate-700 transition-colors">Tentang</a>
                    <a href="#kontak" class="nav-link text-sm font-medium text-gray-500 hover:text-slate-700 transition-colors">Kontak</a>
                </div>

                {{-- Auth Buttons --}}
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden sm:flex items-center gap-3 bg-slate-100 border border-slate-200 px-4 py-2.5 rounded-full hover:border-slate-400 hover:shadow-lg transition-all smooth-transition">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center">
                                @if(auth()->user()->foto_profil)
                                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover rounded-full">
                                @else
                                    <span class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}</span>
                                @endif
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ explode(' ', auth()->user()->nama)[0] }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-500 hover:text-slate-700 transition-colors hidden sm:block">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-slate-500 to-slate-600 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:shadow-lg hover:shadow-slate-500/30 transition-all smooth-transition">
                            Daftar
                        </a>
                    @endauth

                    {{-- Mobile Menu Button --}}
                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-slate-200 transition-colors">
                        <i class="fa-solid fa-bars text-gray-500"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute top-full left-0 right-0 shadow-xl">
            <div class="px-4 py-4 space-y-2">
                <a href="#beranda" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">Beranda</a>
                <a href="#layanan" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">Layanan</a>
                <a href="#tentang" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">Tentang</a>
                <a href="#kontak" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-slate-50 hover:text-slate-700 transition-colors">Kontak</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-slate-700 bg-slate-100">Dashboard</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="pt-16 lg:pt-20">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="bg-slate-800 text-white relative overflow-hidden">
        {{-- Decorative Elements --}}
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-slate-700/50 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-slate-600/30 rounded-full blur-3xl"></div>

        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 py-16 lg:py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="/" class="flex items-center gap-2 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-500 to-slate-600 flex items-center justify-center">
                            <i class="fa-solid fa-shoe-prints text-white text-sm"></i>
                        </div>
                        <span class="font-display font-bold text-xl">
                            ALBRK<span class="text-slate-300">.SHOECARE</span>
                        </span>
                    </a>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Solusi perawatan sepatu premium dengan standar kualitas tinggi. Percayakan sepatu Anda kepada kami.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-700/50 border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-slate-600 hover:border-slate-500 hover:text-white transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-700/50 border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-slate-600 hover:border-slate-500 hover:text-white transition-all">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-slate-700/50 border border-slate-600 flex items-center justify-center text-slate-400 hover:bg-slate-600 hover:border-slate-500 hover:text-white transition-all">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-slate-300 mb-6">Menu</h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-slate-400 hover:text-white transition-colors text-sm">Beranda</a></li>
                        <li><a href="#layanan" class="text-slate-400 hover:text-white transition-colors text-sm">Layanan</a></li>
                        <li><a href="#tentang" class="text-slate-400 hover:text-white transition-colors text-sm">Tentang Kami</a></li>
                        <li><a href="#kontak" class="text-slate-400 hover:text-white transition-colors text-sm">Kontak</a></li>
                    </ul>
                </div>

                {{-- Services --}}
                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-slate-300 mb-6">Layanan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Fast Clean</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Deep Clean</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Unyellowing</a></li>
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors text-sm">Premium Treatment</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-slate-300 mb-6">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-slate-400 mt-1"></i>
                            <span class="text-slate-400 text-sm">Ds. Purworejo Rt. 05 Rw. 01, Kec. Geger, Kab. Madiun</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-phone text-slate-400"></i>
                            <span class="text-slate-400 text-sm">+62 822-3125-9408</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fa-solid fa-clock text-slate-400"></i>
                            <span class="text-slate-400 text-sm">09:00 - 21:00 WIB</span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="mt-16 pt-8 border-t border-slate-700 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-500 text-sm">
                    &copy; 2026 ALBRK.SHOECARE. All rights reserved.
                </p>
                <div class="flex items-center gap-2 bg-slate-700/50 px-4 py-2 rounded-full border border-slate-600">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="text-xs font-medium text-slate-400">System Online</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 100,
            easing: 'ease-out-cubic',
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>
