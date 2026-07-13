<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi - ALBRK.SHOECARE</title>

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

        input[type="radio"]:checked + div {
            border-color: #111111;
            background-color: rgba(17, 17, 17, 0.03);
            box-shadow: 0 0 15px rgba(17, 17, 17, 0.1);
        }
        input[type="radio"]:checked + div .radio-dot { opacity: 1; transform: scale(1); }
        input[type="radio"]:checked + div h4 { color: #111111; }

        input[type=number]::-webkit-inner-spin-button, input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(0,0,0,0.05); }
        ::-webkit-scrollbar-thumb { background: rgba(0, 0, 0, 0.15); border-radius: 3px; }
    </style>
</head>
<body class="antialiased selection:bg-neutral-900 selection:text-white flex flex-col min-h-screen overflow-hidden relative">

    <div class="noise"></div>

    <header class="sticky top-0 z-50 glass border-b border-gray-200 transition-all duration-300 px-6 md:px-12 py-4 flex justify-between items-center shrink-0">
        <div class="flex items-center gap-3 md:gap-4">
            <a href="{{ url('/dashboard') }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-white border border-gray-200 text-gray-400 hover:text-gray-700 hover:bg-gray-50 transition-all flex items-center justify-center shadow-sm group active:scale-95">
                <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <h1 class="block font-display font-bold text-xl md:text-2xl uppercase tracking-tighter italic text-gray-900 leading-tight">
                ALBRK<span class="text-gray-400">.SHOECARE</span>
            </h1>
        </div>
        <div class="text-right shrink-0">
            <p class="text-[8px] md:text-[10px] font-semibold uppercase tracking-widest text-gray-400 leading-none mb-1">Pemesanan</p>
            <p class="font-bold text-xs md:text-sm text-gray-900 uppercase tracking-widest">Sesi Baru</p>
        </div>
    </header>

    <main class="flex-1 overflow-y-auto w-full relative z-10 p-4 md:p-6 lg:p-10 hero-bg">

        <div class="max-w-5xl mx-auto">

            <div class="mb-8 md:mb-10 text-center px-2">
                <div class="inline-flex items-center gap-2 bg-white border border-gray-200 px-4 py-1.5 rounded-full mb-4 shadow-sm">
                    <span class="w-1.5 h-1.5 rounded-full bg-neutral-900 animate-pulse"></span>
                    <p class="text-[8px] md:text-[9px] font-bold text-gray-500 uppercase tracking-[0.4em]">Order & Booking</p>
                </div>
                <h1 class="text-3xl md:text-5xl font-display font-bold text-gray-900 tracking-tighter mb-2 uppercase italic leading-none">
                    Form <span class="italic font-semibold text-gray-500">Reservasi.</span>
                </h1>
                <p class="text-gray-500 font-medium text-xs md:text-sm mt-2">Pilih jenis layanan dan atur detail pesanan sepatu Anda.</p>
            </div>

            @if ($errors->any())
                <div class="mb-8 md:mb-10 bg-red-50 border border-red-200 text-red-700 p-6 rounded-3xl shadow-sm">
                    <div class="flex items-center gap-3 mb-2">
                        <i class="fa-solid fa-circle-exclamation text-lg"></i>
                        <h4 class="font-bold uppercase tracking-widest text-[10px]">Ada kendala pada input Anda:</h4>
                    </div>
                    <ul class="list-disc list-inside text-xs font-semibold space-y-1 ml-1 text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="formReservasi" action="{{ route('reservasi.store') }}" method="POST" class="glass-card rounded-3xl p-6 md:p-10 lg:p-14 space-y-10 md:space-y-12">
                @csrf

                {{-- STEP 1: PILIH LAYANAN --}}
                <div>
                    <h3 class="font-display font-bold text-base md:text-lg uppercase tracking-widest mb-6 flex items-center gap-3 text-gray-900">
                        <span class="bg-neutral-900 text-white w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-[10px] md:text-xs shadow-lg">1</span>
                        Pilih Jenis Layanan
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-5">
                        @foreach($layanans as $l)
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="id_layanan" value="{{ $l->id_layanan }}" data-harga="{{ $l->harga }}" class="sr-only layanan-radio" {{ old('id_layanan') == $l->id_layanan ? 'checked' : '' }} required>
                            <div class="border-2 border-gray-200 bg-white/60 rounded-2xl p-5 md:p-6 hover:border-gray-400 hover:bg-white transition-all h-full flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-3 gap-2">
                                        <h4 class="font-display font-bold text-lg md:text-xl text-gray-800 italic tracking-tight leading-tight transition-colors">{{ $l->nama_layanan }}</h4>
                                        <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center mt-1 group-hover:border-gray-400 bg-white shrink-0">
                                            <div class="radio-dot w-2.5 h-2.5 bg-neutral-900 rounded-full opacity-0 transform scale-0 transition-all duration-300"></div>
                                        </div>
                                    </div>
                                    <p class="text-[10px] md:text-[11px] text-gray-500 font-medium mb-5 leading-relaxed line-clamp-3">{{ $l->deskripsi }}</p>
                                </div>
                                <p class="text-gray-900 font-bold text-base md:text-lg tracking-tighter">Rp {{ number_format($l->harga, 0, ',', '.') }} <span class="text-[9px] md:text-[10px] text-gray-400 font-semibold uppercase tracking-widest not-italic">/ Ps</span></p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- STEP 2: METODE PENYERAHAN --}}
                <div>
                    <h3 class="font-display font-bold text-base md:text-lg uppercase tracking-widest mb-6 flex items-center gap-3 text-gray-900">
                        <span class="bg-neutral-900 text-white w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-[10px] md:text-xs shadow-lg">2</span>
                        Metode Penyerahan
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="metode_layanan" value="Drop-off" class="sr-only delivery-radio" {{ old('metode_layanan', 'Drop-off') == 'Drop-off' ? 'checked' : '' }} required>
                            <div class="border-2 border-gray-200 bg-white/60 rounded-2xl p-6 md:p-8 hover:border-gray-400 hover:bg-white transition-all h-full">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-display font-bold text-lg md:text-xl text-gray-800 italic tracking-tight transition-colors">Antar ke Toko</h4>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center group-hover:border-gray-400 bg-white shrink-0">
                                        <div class="radio-dot w-2.5 h-2.5 bg-neutral-900 rounded-full opacity-0 transform scale-0 transition-all duration-300"></div>
                                    </div>
                                </div>
                                <p class="text-[10px] md:text-[11px] text-gray-500 font-medium">Bawa langsung sepatu kotor Anda ke bengkel kami.</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="metode_layanan" value="Pick-up" class="sr-only delivery-radio" {{ old('metode_layanan') == 'Pick-up' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 bg-white/60 rounded-2xl p-6 md:p-8 hover:border-gray-400 hover:bg-white transition-all h-full">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-display font-bold text-lg md:text-xl text-gray-800 italic tracking-tight transition-colors">Dijemput Kurir</h4>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center group-hover:border-gray-400 bg-white shrink-0">
                                        <div class="radio-dot w-2.5 h-2.5 bg-neutral-900 rounded-full opacity-0 transform scale-0 transition-all duration-300"></div>
                                    </div>
                                </div>
                                <p class="text-[10px] md:text-[11px] text-gray-500 font-medium">Tim kurir kami akan mengambil sepatu ke lokasi Anda.</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- STEP 3: DETAIL & ALAMAT --}}
                <div>
                    <h3 class="font-display font-bold text-base md:text-lg uppercase tracking-widest mb-6 flex items-center gap-3 text-gray-900">
                        <span class="bg-neutral-900 text-white w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-[10px] md:text-xs shadow-lg">3</span>
                        Detail Pesanan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-start">
                        <div>
                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-3 ml-2">Jumlah Sepatu (Pasang)</label>
                            <input type="number" id="jumlah_sepatu" name="jumlah_sepatu" min="1" value="{{ old('jumlah_sepatu', 1) }}" required
                                   class="input-modern w-full text-gray-900 text-lg rounded-2xl p-4 md:p-5 font-bold shadow-sm">
                        </div>

                        <div id="areaAlamat" class="hidden transition-all duration-300">
                            <label class="block text-[9px] font-bold text-gray-500 uppercase tracking-[0.2em] mb-3 ml-2">Alamat Penjemputan</label>
                            <textarea name="alamat_jemput" id="alamat_jemput" rows="2" placeholder="Masukkan alamat lengkap penjemputan..."
                                      class="input-modern w-full text-gray-900 text-sm rounded-2xl p-4 md:p-5 font-medium resize-none shadow-sm">{{ old('alamat_jemput') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- STEP 4: PEMBAYARAN --}}
                <div>
                    <h3 class="font-display font-bold text-base md:text-lg uppercase tracking-widest mb-6 flex items-center gap-3 text-gray-900">
                        <span class="bg-neutral-900 text-white w-7 h-7 md:w-8 md:h-8 rounded-full flex items-center justify-center text-[10px] md:text-xs shadow-lg">4</span>
                        Metode Pembayaran
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5">
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="metode_pembayaran" value="Bayar di Toko" class="sr-only payment-radio" {{ old('metode_pembayaran') == 'Bayar di Toko' ? 'checked' : '' }} required>
                            <div class="border-2 border-gray-200 bg-white/60 rounded-2xl p-6 md:p-8 hover:border-gray-400 hover:bg-white transition-all h-full">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-display font-bold text-lg md:text-xl text-gray-800 italic tracking-tight transition-colors">Bayar di Kasir</h4>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center group-hover:border-gray-400 bg-white shrink-0">
                                        <div class="radio-dot w-2.5 h-2.5 bg-neutral-900 rounded-full opacity-0 transform scale-0 transition-all duration-300"></div>
                                    </div>
                                </div>
                                <p class="text-[10px] md:text-[11px] text-gray-500 font-medium">Tunai/QRIS langsung saat serah-terima di bengkel.</p>
                            </div>
                        </label>

                        <label class="relative cursor-pointer group">
                            <input type="radio" name="metode_pembayaran" value="Payment Gateway" class="sr-only payment-radio" {{ old('metode_pembayaran') == 'Payment Gateway' ? 'checked' : '' }}>
                            <div class="border-2 border-gray-200 bg-white/60 rounded-2xl p-6 md:p-8 hover:border-gray-400 hover:bg-white transition-all h-full">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-display font-bold text-lg md:text-xl text-gray-800 italic tracking-tight transition-colors">QRIS / Bank (Otomatis)</h4>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center group-hover:border-gray-400 bg-white shrink-0">
                                        <div class="radio-dot w-2.5 h-2.5 bg-neutral-900 rounded-full opacity-0 transform scale-0 transition-all duration-300"></div>
                                    </div>
                                </div>
                                <p class="text-[10px] md:text-[11px] text-gray-500 font-medium">Pembayaran instan via QRIS, E-Wallet, atau Virtual Account.</p>
                            </div>
                        </label>
                    </div>

                    {{-- Info Box Midtrans --}}
                    <div id="areaTransfer" class="hidden mt-6 bg-gray-50/80 p-6 md:p-8 rounded-2xl border border-gray-200 transition-all text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Midtrans.png" class="h-6 md:h-8 mx-auto mb-4" alt="Midtrans">
                        <h4 class="font-bold text-gray-900 uppercase tracking-widest text-xs md:text-sm mb-2">Sistem Pembayaran Terotomatisasi</h4>
                        <p class="text-[10px] md:text-[11px] text-gray-500 font-medium max-w-lg mx-auto">
                            Setelah Anda menekan tombol konfirmasi, Anda akan diarahkan ke halaman pembayaran Midtrans. Status pembayaran akan otomatis terverifikasi tanpa perlu upload bukti secara manual.
                        </p>
                    </div>

                    {{-- AREA INFO BAYAR DI TOKO --}}
                    <div id="areaBayarToko" class="hidden mt-6 bg-gray-50 p-6 md:p-8 rounded-2xl border border-gray-200 transition-all">
                        <div class="flex flex-col md:flex-row items-start gap-5">
                            <div class="w-12 h-12 rounded-full bg-white border border-gray-200 flex items-center justify-center shrink-0 shadow-sm text-gray-600">
                                <i class="fa-solid fa-store text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm md:text-base uppercase tracking-widest mb-2">Panduan Pembayaran Kasir</h4>
                                <p class="text-[11px] md:text-xs text-gray-500 leading-relaxed font-medium">
                                    Selesaikan reservasi ini, lalu selesaikan pembayaran secara Tunai (Cash) atau Scan QRIS saat serah terima sepatu di kasir kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TOTAL & SUBMIT --}}
                <div class="bg-white border border-gray-100 p-8 md:p-10 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-6 mt-6 shadow-lg shadow-gray-200/50">
                    <div class="text-center md:text-left">
                        <p class="text-[9px] font-bold uppercase tracking-widest text-gray-400 mb-1">Total Tagihan</p>
                        <h2 class="text-4xl md:text-5xl font-display font-bold text-gray-900 italic tracking-tighter" id="totalTagihan">Rp 0</h2>
                    </div>
                    <button type="submit" id="btnSubmit" class="btn-gradient w-full md:w-auto px-12 lg:px-16 py-5 lg:py-6 text-white font-bold uppercase text-[10px] md:text-xs tracking-[0.3em] rounded-2xl shadow-lg flex items-center justify-center gap-3">
                        Lanjut Checkout <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('formReservasi');
            const btnSubmit = document.getElementById('btnSubmit');
            const jumlahInput = document.getElementById('jumlah_sepatu');
            const totalText = document.getElementById('totalTagihan');

            const areaTransfer = document.getElementById('areaTransfer');
            const areaBayarToko = document.getElementById('areaBayarToko');

            const areaAlamat = document.getElementById('areaAlamat');
            const inputAlamat = document.getElementById('alamat_jemput');

            const layananRadios = document.querySelectorAll('input[name="id_layanan"]');
            const paymentRadios = document.querySelectorAll('input[name="metode_pembayaran"]');
            const deliveryRadios = document.querySelectorAll('input[name="metode_layanan"]');

            function hitungTotal() {
                let harga = 0;
                let jumlah = parseInt(jumlahInput.value) || 1;
                const selectedLayanan = document.querySelector('input[name="id_layanan"]:checked');

                if (selectedLayanan) {
                    harga = parseInt(selectedLayanan.getAttribute('data-harga'));
                }

                let total = harga * jumlah;
                totalText.innerText = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(total);
            }

            function toggleAlamatArea() {
                const selectedDelivery = document.querySelector('input[name="metode_layanan"]:checked');
                if (selectedDelivery && selectedDelivery.value === 'Pick-up') {
                    areaAlamat.classList.remove('hidden');
                    inputAlamat.required = true;
                } else {
                    areaAlamat.classList.add('hidden');
                    inputAlamat.required = false;
                }
            }

            function toggleUploadArea() {
                const selectedPayment = document.querySelector('input[name="metode_pembayaran"]:checked');
                if (selectedPayment && selectedPayment.value === 'Payment Gateway') {
                    areaTransfer.classList.remove('hidden');
                    areaBayarToko.classList.add('hidden');
                } else if (selectedPayment && selectedPayment.value === 'Bayar di Toko') {
                    areaBayarToko.classList.remove('hidden');
                    areaTransfer.classList.add('hidden');
                } else {
                    areaTransfer.classList.add('hidden');
                    areaBayarToko.classList.add('hidden');
                }
            }

            form.addEventListener('submit', function() {
                setTimeout(() => {
                    btnSubmit.disabled = true;
                    btnSubmit.innerHTML = 'MEMPROSES... <i class="fa-solid fa-circle-notch fa-spin ml-2"></i>';
                    btnSubmit.classList.add('opacity-75');
                }, 50);
            });

            layananRadios.forEach(radio => radio.addEventListener('change', hitungTotal));
            jumlahInput.addEventListener('input', hitungTotal);
            paymentRadios.forEach(radio => radio.addEventListener('change', toggleUploadArea));
            deliveryRadios.forEach(radio => radio.addEventListener('change', toggleAlamatArea));

            hitungTotal();
            toggleAlamatArea();
            toggleUploadArea();
        });
    </script>
</body>
</html>
