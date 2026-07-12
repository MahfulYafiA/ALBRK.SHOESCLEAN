@php
    $heroPath = asset('images/adidasspezial.png');
    $tentangPath = asset('images/fototentangkami.jpeg');

    if (\Illuminate\Support\Facades\Schema::hasTable('ms_pengaturan')) {
        $heroSetting = \Illuminate\Support\Facades\DB::table('ms_pengaturan')
            ->where('key', 'hero_image')
            ->first();
        $tentangSetting = \Illuminate\Support\Facades\DB::table('ms_pengaturan')
            ->where('key', 'tentang_image')
            ->first();

        if ($heroSetting && $heroSetting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($heroSetting->value)) {
            $heroPath = route('media.public', ['path' => $heroSetting->value]);
        }

        if ($tentangSetting && $tentangSetting->value && \Illuminate\Support\Facades\Storage::disk('public')->exists($tentangSetting->value)) {
            $tentangPath = route('media.public', ['path' => $tentangSetting->value]);
        }
    }
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALBRK.SHOECARE - Perawatan Sepatu Premium</title>
    <meta name="description" content="ALBRK.SHOECARE - Solusi perawatan sepatu premium di Kabupaten Madiun. Fast Clean, Deep Clean, Unyellowing, dan treatment lainnya.">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
        * {
            font-family: 'Inter', sans-serif;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        *::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }
        html, body {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
            scroll-padding-top: 5rem;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        html::-webkit-scrollbar,
        body::-webkit-scrollbar {
            width: 0;
            height: 0;
            display: none;
        }
        body { margin: 0; }
        .font-display { font-family: 'Space Grotesk', sans-serif; }

        .gradient-text {
            color: #111111;
            background: none;
            -webkit-text-fill-color: currentColor;
        }

        .glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(23, 23, 23, 0.08);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .animate-float { animation: float 6s ease-in-out infinite; }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 30px rgba(82, 82, 82, 0.16); }
            50% { box-shadow: 0 0 56px rgba(82, 82, 82, 0.26); }
        }
        .pulse-glow { animation: pulse-glow 3s ease-in-out infinite; }

        .card-hover {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 28px 52px -18px rgba(15, 23, 42, 0.22);
        }

        .noise {
            position: fixed; inset: 0;
            pointer-events: none; z-index: 9999; opacity: 0.02;
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E');
        }

        [data-aos] { max-width: 100%; }

        .hero-bg {
            background:
                radial-gradient(circle at 15% 20%, rgba(212, 212, 212, 0.45) 0%, transparent 32%),
                linear-gradient(180deg, #f5f5f5 0%, #ffffff 100%);
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

        .landing-visual {
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.88) 0%, rgba(245, 245, 245, 0.92) 48%, rgba(229, 229, 229, 0.86) 100%);
        }

        .mono-grid {
            background-image:
                linear-gradient(rgba(23, 23, 23, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(23, 23, 23, 0.06) 1px, transparent 1px);
            background-size: 32px 32px;
        }

        ::selection { background: #111111; color: white; }
    </style>
</head>
<body class="antialiased bg-surface text-dark overflow-x-hidden">

    <div class="noise"></div>

    <nav class="fixed w-full z-50 glass border-b border-gray-200 transition-all duration-300" data-aos="fade-down" data-aos-duration="800">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">

                <a href="/" class="flex items-center gap-3 group">
                    <span class="font-display font-bold text-xl lg:text-2xl tracking-tight text-neutral-950">
                        ALBRK<span class="text-neutral-500">.SHOECARE</span>
                    </span>
                </a>

                <div class="hidden lg:flex items-center gap-10">
                    <a href="#beranda" class="nav-link text-sm font-medium text-gray-500 hover:text-neutral-700 transition-colors">Beranda</a>
                    <a href="#layanan" class="nav-link text-sm font-medium text-gray-500 hover:text-neutral-700 transition-colors">Layanan</a>
                    <a href="#tentang" class="nav-link text-sm font-medium text-gray-500 hover:text-neutral-700 transition-colors">Tentang</a>
                    <a href="#kontak" class="nav-link text-sm font-medium text-gray-500 hover:text-neutral-700 transition-colors">Kontak</a>
                </div>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden sm:flex items-center gap-3 bg-white border border-neutral-200 px-4 py-2.5 rounded-full hover:border-neutral-400 hover:shadow-lg transition-all">
                            <div class="w-8 h-8 rounded-full bg-neutral-900 flex items-center justify-center">
                                @if(auth()->user()->foto_profil)
                                    <img src="{{ asset('storage/' . auth()->user()->foto_profil) }}" class="w-full h-full object-cover rounded-full grayscale">
                                @else
                                    <span class="text-white text-xs font-bold">{{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}</span>
                                @endif
                            </div>
                            <span class="text-sm font-semibold text-gray-700">{{ explode(' ', auth()->user()->nama)[0] }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-500 hover:text-neutral-700 transition-colors hidden sm:block">Masuk</a>
                        <a href="{{ route('register') }}" class="btn-gradient text-white px-6 py-2.5 rounded-full text-sm font-semibold">
                            Daftar
                        </a>
                    @endauth

                    <button onclick="document.getElementById('mobileMenu').classList.toggle('hidden')" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl bg-neutral-100 hover:bg-neutral-200 transition-colors">
                        <i class="fa-solid fa-bars text-gray-500"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobileMenu" class="hidden lg:hidden bg-white border-t border-gray-100 absolute top-full left-0 right-0 shadow-xl">
            <div class="px-4 py-4 space-y-1">
                <a href="#beranda" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-neutral-50 hover:text-neutral-700 transition-colors">Beranda</a>
                <a href="#layanan" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-neutral-50 hover:text-neutral-700 transition-colors">Layanan</a>
                <a href="#tentang" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-neutral-50 hover:text-neutral-700 transition-colors">Tentang</a>
                <a href="#kontak" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-500 hover:bg-neutral-50 hover:text-neutral-700 transition-colors">Kontak</a>
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section id="beranda" class="relative min-h-[100svh] flex items-center hero-bg overflow-hidden pt-20">
        <div class="w-full px-4 sm:px-6 lg:px-8 py-8 lg:py-10 relative z-10">
            <div class="grid lg:grid-cols-[0.95fr_1.05fr] gap-10 lg:gap-12 items-center">
                {{-- Text Content --}}
                <div class="text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex items-center gap-2 bg-white border border-neutral-200 px-4 py-2 rounded-full text-sm font-medium text-neutral-600 mb-8 shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-neutral-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-neutral-900"></span>
                        </span>
                        Solusi Perawatan Sepatu Premium
                    </div>

                    <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-bold tracking-tight leading-[0.9] mb-8">
                        <span class="block text-gray-900" data-aos="fade-up" data-aos-delay="100">Rawat</span>
                        <span class="block gradient-text italic" data-aos="fade-up" data-aos-delay="200">Tanpa Harus</span>
                        <span class="block gradient-text italic" data-aos="fade-up" data-aos-delay="300">Antri.</span>
                    </h1>

                    <p class="text-gray-500 text-base lg:text-lg max-w-lg mx-auto lg:mx-0 mb-10" data-aos="fade-up" data-aos-delay="400">
                        Tingkatkan performa dan estetika sepatu Anda dengan treatment premium. Reservasi online, pantau real-time, hasil memuaskan.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start" data-aos="fade-up" data-aos-delay="500">
                        <a href="{{ route('reservasi.create') }}" class="btn-gradient text-white px-8 py-4 rounded-full text-sm font-semibold inline-flex items-center justify-center gap-3">
                            Buat Reservasi
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                        <a href="#layanan" class="bg-white border border-neutral-200 text-gray-700 px-8 py-4 rounded-full text-sm font-semibold hover:border-neutral-400 hover:text-gray-900 transition-all inline-flex items-center justify-center gap-3">
                            <i class="fa-solid fa-play text-xs"></i>
                            Lihat Layanan
                        </a>
                    </div>
                </div>

                {{-- Hero Image --}}
                <div class="relative w-full max-w-[720px] mx-auto lg:ml-auto lg:mr-0" data-aos="fade-left" data-aos-duration="1200">
                    <div class="relative rounded-2xl overflow-hidden border border-neutral-200 bg-white shadow-2xl shadow-neutral-300/40 animate-float">
                        <img src="{{ $heroPath }}" alt="Sepatu Premium" class="w-full aspect-[4/3] lg:aspect-[5/4] object-cover grayscale">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-white/10"></div>
                    </div>

                    {{-- Floating Card --}}
                    <div class="absolute -bottom-4 left-4 sm:-left-5 bg-white/95 backdrop-blur-xl p-4 sm:p-5 rounded-xl shadow-xl border border-neutral-200 pulse-glow" data-aos="fade-up" data-aos-delay="700">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-neutral-950 flex items-center justify-center">
                                <i class="fa-solid fa-star text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900">100%</p>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Garansi Kepuasan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LAYANAN SECTION --}}
    <section id="layanan" class="py-24 hero-bg relative overflow-hidden">
        <div class="w-full px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="inline-block bg-neutral-100 text-neutral-600 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-4">Layanan Kami</span>
                <h2 class="font-display text-4xl lg:text-5xl xl:text-6xl font-bold tracking-tight text-gray-900 mb-4">
                    Treatment <span class="gradient-text">Terbaik</span>
                </h2>
                <p class="text-gray-500 text-lg max-w-2xl mx-auto">
                    Pilihan layanan lengkap untuk segala jenis dan kondisi sepatu Anda
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($layanans as $index => $layanan)
                    @php
                        $nama_lower = strtolower($layanan->nama_layanan);
                        $service_icon = 'fa-shoe-prints';
                        if(str_contains($nama_lower, 'fast')) { $service_icon = 'fa-bolt'; }
                        elseif(str_contains($nama_lower, 'deep')) { $service_icon = 'fa-brush'; }
                        elseif(str_contains($nama_lower, 'unyellow')) { $service_icon = 'fa-wand-magic-sparkles'; }

                        $harga_k = number_format($layanan->harga, 0, ',', '.');
                    @endphp

                    <div class="bg-white rounded-xl overflow-hidden shadow-lg shadow-gray-200/50 card-hover border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="h-56 overflow-hidden landing-visual mono-grid flex items-center justify-center border-b border-neutral-100">
                            <div class="w-24 h-24 rounded-2xl bg-neutral-950 text-white flex items-center justify-center shadow-2xl shadow-neutral-300/70">
                                <i class="fa-solid {{ $service_icon }} text-4xl"></i>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="font-display text-xl font-bold text-gray-900 mb-3">{{ $layanan->nama_layanan }}</h3>
                            <p class="text-gray-500 text-sm mb-6 line-clamp-2">{{ $layanan->deskripsi }}</p>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-xs text-gray-400 uppercase tracking-wider">Mulai dari</span>
                                    <p class="text-2xl font-bold text-gray-900">Rp {{ $harga_k }}</p>
                                </div>
                                <a href="{{ route('reservasi.create') }}" class="bg-neutral-100 hover:bg-neutral-950 text-neutral-900 hover:text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-all">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12" data-aos="fade-up">
                <a href="{{ route('reservasi.create') }}" class="btn-gradient text-white px-8 py-4 rounded-full text-sm font-semibold inline-flex items-center gap-3">
                    <i class="fa-solid fa-calendar-plus"></i>
                    Reservasi Sekarang
                </a>
            </div>
        </div>
    </section>

    {{-- TENTANG SECTION --}}
    <section id="tentang" class="min-h-[calc(100svh-5rem)] bg-white flex items-center py-12 lg:py-16">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="relative" data-aos="fade-right">
                    <div class="relative rounded-2xl overflow-hidden border border-neutral-200 shadow-2xl bg-white h-[52svh] min-h-[420px] max-h-[560px]">
                        <img src="{{ $tentangPath }}" alt="Tentang ALBRK.SHOECARE" class="absolute inset-0 w-full h-full object-cover grayscale">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-white/10"></div>
                    </div>

                    {{-- Floating Badge --}}
                    <div class="absolute -bottom-8 right-4 sm:-right-8 bg-white p-5 sm:p-6 rounded-xl shadow-xl border border-neutral-200" data-aos="fade-up" data-aos-delay="300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl bg-neutral-950 flex items-center justify-center">
                                <i class="fa-solid fa-trophy text-white text-2xl"></i>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900">5+</p>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun Pengalaman</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:pl-8" data-aos="fade-left">
                    <span class="inline-block bg-neutral-100 text-neutral-600 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-6">Tentang Kami</span>
                    <h2 class="font-display text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 mb-6">
                        Perawatan Premium.<br><span class="gradient-text">Jaminan Kualitas.</span>
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed mb-8">
                        ALBRK.SHOECARE hadir dari dedikasi tinggi terhadap standar perawatan sepatu premium. Kami menggunakan formulasi pembersih berkualitas yang terbukti aman untuk segala jenis material sepatu.
                    </p>

                    <div class="space-y-6 mb-10">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-neutral-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-check text-neutral-900 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Bahan Premium</h4>
                                <p class="text-gray-500 text-sm">Menggunakan cairan pembersih berkualitas tinggi</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-neutral-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-shield-halved text-neutral-900 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Garansi Hasil</h4>
                                <p class="text-gray-500 text-sm">100% garansi kepuasan pelanggan</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-neutral-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-clock text-neutral-900 text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Proses Cepat</h4>
                                <p class="text-gray-500 text-sm">Estimasi selesai 24-48 jam</p>
                            </div>
                        </div>
                    </div>

                    <a href="#kontak" class="btn-gradient text-white px-8 py-4 rounded-full text-sm font-semibold inline-flex items-center gap-3">
                        <i class="fa-brands fa-whatsapp"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- KONTAK SECTION --}}
    <section id="kontak" class="py-24 bg-white">
        <div class="w-full px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16">
                <div data-aos="fade-right">
                    <span class="inline-block bg-neutral-100 text-neutral-700 px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-wider mb-6">Hubungi Kami</span>
                    <h2 class="font-display text-4xl lg:text-5xl font-bold tracking-tight text-gray-900 mb-6">
                        Kunjungi <span class="gradient-text">Workshop</span> Kami
                    </h2>
                    <p class="text-gray-500 text-lg mb-10">
                        Datang langsung ke workshop kami atau hubungi melalui WhatsApp untuk konsultasi gratis
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-neutral-950 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-location-dot text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Alamat</h4>
                                <p class="text-gray-500">Ds. Purworejo Rt. 05 Rw. 01<br>Kec. Geger, Kab. Madiun</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-neutral-950 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-phone text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Telepon</h4>
                                <p class="text-gray-500">+62 822-3125-9408</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 rounded-xl bg-neutral-950 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-clock text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-1">Jam Operasional</h4>
                                <p class="text-gray-500">Setiap Hari: 09:00 - 21:00 WIB</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-neutral-100 rounded-xl overflow-hidden shadow-xl border border-neutral-200 h-[400px] lg:h-auto" data-aos="fade-left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.264700874315!2d111.516142675883!3d-7.654637775736637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79bf3544520935%3A0x673c6a46a6f685c!2sALBRK.SHOECARE!5e0!3m2!1sid!2sid!4v1709663784534!5m2!1sid!2sid"
                        class="w-full h-full border-0 grayscale"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-dark text-white relative overflow-hidden">
        <div class="relative z-10 w-full px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="lg:col-span-1">
                    <a href="/" class="flex items-center gap-3 mb-6">
                        <span class="font-display font-bold text-xl">
                            ALBRK<span class="text-neutral-400">.SHOECARE</span>
                        </span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Solusi perawatan sepatu premium dengan standar kualitas tinggi.
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800/50 border border-neutral-700 flex items-center justify-center text-gray-400 hover:bg-neutral-700 hover:border-neutral-500 hover:text-white transition-all">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800/50 border border-neutral-700 flex items-center justify-center text-gray-400 hover:bg-neutral-700 hover:border-neutral-500 hover:text-white transition-all">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-neutral-800/50 border border-neutral-700 flex items-center justify-center text-gray-400 hover:bg-neutral-700 hover:border-neutral-500 hover:text-white transition-all">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-gray-300 mb-6">Menu</h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Beranda</a></li>
                        <li><a href="#layanan" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Layanan</a></li>
                        <li><a href="#tentang" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Tentang</a></li>
                        <li><a href="#kontak" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-gray-300 mb-6">Layanan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Fast Clean</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Deep Clean</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Unyellowing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-gray-200 transition-colors text-sm">Premium Treatment</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-display font-semibold text-sm uppercase tracking-wider text-gray-300 mb-6">Kontak</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="text-gray-400 flex items-start gap-3">
                            <i class="fa-solid fa-location-dot text-neutral-400 mt-1"></i>
                            Ds. Purworejo, Kec. Geger, Madiun
                        </li>
                        <li class="text-gray-400 flex items-center gap-3">
                            <i class="fa-solid fa-phone text-neutral-400"></i>
                            +62 822-3125-9408
                        </li>
                        <li class="text-gray-400 flex items-center gap-3">
                            <i class="fa-solid fa-clock text-neutral-400"></i>
                            09:00 - 21:00 WIB
                        </li>
                    </ul>
                </div>
            </div>

            <p class="mt-8 text-gray-500 text-sm">
                &copy; 2026 ALBRK.SHOECARE. All rights reserved.
            </p>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 100,
            easing: 'ease-out-cubic',
        });

        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('shadow-lg');
            } else {
                nav.classList.remove('shadow-lg');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach((link) => {
            link.addEventListener('click', (event) => {
                const target = document.querySelector(link.getAttribute('href'));
                const nav = document.querySelector('nav');
                const mobileMenu = document.getElementById('mobileMenu');

                if (!target) return;

                event.preventDefault();
                const offset = target.id === 'beranda' ? 0 : nav.offsetHeight - 1;

                window.scrollTo({
                    top: Math.max(target.offsetTop - offset, 0),
                    behavior: 'smooth',
                });

                history.replaceState(null, '', link.getAttribute('href'));
                mobileMenu?.classList.add('hidden');
            });
        });
    </script>
</body>
</html>
