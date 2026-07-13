<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembayaran - ALBRK.SHOECARE</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { 
            --primary: #2563eb; 
            --surface: #f8fafc; 
            --text: #0f172a; 
        }
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--surface); 
            color: var(--text); 
            overflow-x: hidden; 
        }
        
        .noise { 
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; 
            pointer-events: none; z-index: 9999; opacity: 0.035; 
            background: url('data:image/svg+xml;utf8,%3Csvg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg"%3E%3Cfilter id="noiseFilter"%3E%3CfeTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch"/%3E%3C/filter%3E%3Crect width="100%25" height="100%25" filter="url(%23noiseFilter)"/%3E%3C/svg%3E'); 
        }
        .bg-mesh {
            position: fixed; inset: 0; z-index: -3;
            background-color: #f8fafc;
            background-image: radial-gradient(#cbd5e1 1px, transparent 1px);
            background-size: 32px 32px; 
            opacity: 0.5;
        }
        .orb-1, .orb-2 {
            position: fixed; border-radius: 50%; filter: blur(140px); z-index: -2;
            animation: floatOrb 15s infinite alternate ease-in-out;
        }
        .orb-1 { width: 600px; height: 600px; background: rgba(37, 99, 235, 0.15); top: -100px; left: -100px; }
        .orb-2 { width: 700px; height: 700px; background: rgba(6, 182, 212, 0.15); bottom: -200px; right: -100px; animation-delay: -5s; }
        
        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1); }
            100% { transform: translate(100px, 80px) scale(1.2); }
        }

        .glass-nav { 
            background: rgba(255, 255, 255, 0.65); 
            backdrop-filter: blur(28px); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.5); 
        }
        
        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.7));
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 0 24px 48px -12px rgba(31, 38, 135, 0.08);
        }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen relative">

    <div class="noise"></div>
    <div class="bg-mesh"></div>
    <div class="orb-1"></div>
    <div class="orb-2"></div>

    <header class="glass-nav px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40 sticky top-0">
        <div class="flex items-center gap-3 md:gap-4">
            <a href="{{ route('reservasi.riwayat') }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-white border border-slate-200 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all flex items-center justify-center shadow-sm group active:scale-95" title="Kembali ke Riwayat">
                <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-slate-900 leading-tight">
                ALBRK.<span class="text-indigo-600">CHECKOUT</span>
            </h1>
        </div>
        <div class="hidden sm:block text-right">
            <p class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-400">Secure Payment</p>
        </div>
    </header>

    <main class="flex-1 w-full relative z-10 p-4 md:p-10 lg:p-16 flex flex-col items-center">
        <div class="w-full max-w-4xl">

            <div class="mb-10 text-center">
                <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                    <p class="text-[8px] md:text-[9px] font-black text-indigo-600 uppercase tracking-[0.4em]">Konfirmasi Pembayaran</p>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tighter uppercase italic leading-none">Selesaikan <span class="text-indigo-600">Pesanan.</span></h2>
                <p class="text-slate-500 font-medium text-xs md:text-sm mt-3">Lanjutkan proses pembayaran menggunakan QRIS atau Virtual Account pilihan Anda.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                {{-- KIRI: INFORMASI TAGIHAN --}}
                <div class="lg:col-span-6 space-y-6">
                    <div class="glass-card rounded-[2.5rem] p-8 border-indigo-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full -z-10"></div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total yang harus dibayar</p>
                        <h3 class="text-3xl md:text-4xl font-black text-indigo-600 italic tracking-tighter">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</h3>
                        <div class="mt-6 pt-6 border-t border-slate-100 space-y-3">
                            <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest">
                                <span class="text-slate-400">Order ID</span>
                                <span class="text-slate-900">#ORD-{{ $reservasi->id_reservasi }}</span>
                            </div>
                            <div class="flex justify-between text-[11px] font-bold uppercase tracking-widest">
                                <span class="text-slate-400">Jumlah Sepatu</span>
                                <span class="text-slate-900">{{ $reservasi->jumlah_sepatu }} Pasang</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KANAN: TOMBOL MIDTRANS --}}
                <div class="lg:col-span-6">
                    <div class="glass-card rounded-[2.5rem] p-8 md:p-12 h-full flex flex-col justify-center items-center text-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e0/Midtrans.png" class="h-8 md:h-10 mb-6 drop-shadow-sm" alt="Midtrans">
                        <h2 class="text-xl md:text-2xl font-black text-slate-900 mb-2 uppercase italic tracking-tight">QRIS & Virtual Account</h2>
                        <p class="text-[11px] md:text-xs text-slate-500 mb-8 font-medium leading-relaxed">
                            Sistem akan otomatis mendeteksi pembayaran Anda seketika setelah transaksi berhasil di jendela Midtrans.
                        </p>
                        
                        <button id="pay-button" class="w-full bg-indigo-600 text-white py-5 rounded-[1.5rem] font-black uppercase text-xs tracking-[0.2em] shadow-xl shadow-indigo-500/30 hover:bg-slate-900 hover:shadow-slate-900/20 transition-all active:scale-95 flex items-center justify-center gap-3">
                            Bayar Sekarang <i class="fa-solid fa-qrcode text-lg"></i>
                        </button>
                    </div>
                </div>

            </div>

            {{-- Footer Link --}}
            <div class="text-center mt-12 mb-6">
                <a href="{{ route('reservasi.riwayat') }}" class="text-[10px] md:text-xs font-black uppercase tracking-[0.2em] text-slate-400 hover:text-red-600 transition-colors">Kembali ke Riwayat</a>
            </div>
        </div>
    </main>

    {{-- SCRIPT MIDTRANS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function () {
            // Loading State
            const btn = document.getElementById('pay-button');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'MEMPROSES... <i class="fa-solid fa-circle-notch fa-spin ml-2"></i>';
            btn.classList.replace('bg-indigo-600', 'bg-slate-400');
            btn.classList.remove('shadow-indigo-500/30');

            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) { 
                    window.location.href = "{{ route('reservasi.riwayat') }}"; 
                },
                onPending: function (result) { 
                    alert("Pembayaran tertunda, silakan selesaikan instruksi pembayaran."); 
                    btn.innerHTML = originalText;
                    btn.classList.replace('bg-slate-400', 'bg-indigo-600');
                    btn.classList.add('shadow-indigo-500/30');
                },
                onError: function (result) { 
                    alert("Pembayaran gagal atau dibatalkan."); 
                    btn.innerHTML = originalText;
                    btn.classList.replace('bg-slate-400', 'bg-indigo-600');
                    btn.classList.add('shadow-indigo-500/30');
                },
                onClose: function () {
                    btn.innerHTML = originalText;
                    btn.classList.replace('bg-slate-400', 'bg-indigo-600');
                    btn.classList.add('shadow-indigo-500/30');
                }
            });
        };
    </script>
</body>
</html>