<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - ALBRK.SHOECARE</title>
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
        
        /* --- BACKGROUND PREMIUM GLOBAL --- */
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
        .orb-1, .orb-2, .orb-3 {
            position: fixed; border-radius: 50%; filter: blur(140px); z-index: -2;
            animation: floatOrb 15s infinite alternate ease-in-out;
        }
        .orb-1 { width: 600px; height: 600px; background: rgba(37, 99, 235, 0.15); top: -100px; left: -100px; }
        .orb-2 { width: 700px; height: 700px; background: rgba(6, 182, 212, 0.15); bottom: -200px; right: -100px; animation-delay: -5s; }
        .orb-3 { width: 500px; height: 500px; background: rgba(139, 92, 246, 0.1); top: 40%; left: 30%; animation-delay: -10s; }
        
        @keyframes floatOrb {
            0% { transform: translate(0, 0) scale(1) rotate(0deg); }
            100% { transform: translate(100px, 80px) scale(1.2) rotate(10deg); }
        }

        /* --- GLASSMORPHISM --- */
        .glass-nav { 
            background: rgba(255, 255, 255, 0.65); 
            backdrop-filter: blur(28px); 
            -webkit-backdrop-filter: blur(28px); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.5); 
        }
        
        .glass-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.5));
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 16px 48px -12px rgba(31, 38, 135, 0.08);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .glass-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 32px 64px -16px rgba(37, 99, 235, 0.15);
            border-color: rgba(6, 182, 212, 0.3);
        }

        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="antialiased selection:bg-indigo-500 selection:text-white flex flex-col h-screen overflow-hidden relative">

    {{-- BACKGROUND ELEMENTS --}}
    <div class="noise"></div>
    <div class="bg-mesh"></div>
    <div class="orb-1"></div>
    <div class="orb-2"></div>
    <div class="orb-3"></div>

    {{-- TOP NAVIGATION --}}
    <header class="glass-nav px-6 md:px-12 py-4 flex justify-between items-center shrink-0 z-40 relative">
        <div class="flex items-center gap-3 md:gap-4">
            <a href="{{ url('/dashboard') }}" class="w-9 h-9 md:w-10 md:h-10 rounded-full bg-white border border-slate-200 text-slate-400 hover:text-indigo-500 hover:bg-indigo-50 transition-all flex items-center justify-center shadow-sm group active:scale-95" title="Kembali ke Dasbor">
                <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-1 transition-transform"></i>
            </a>
            
            <h1 class="block font-black text-xl md:text-2xl uppercase tracking-tighter italic text-slate-900 leading-tight">
                ALBRK.<span class="text-indigo-500">MEMBER</span>
            </h1>
        </div>
        
        <div class="text-right shrink-0">
            <p class="text-[8px] md:text-[10px] font-bold uppercase tracking-widest text-slate-500 leading-none mb-1">Riwayat Pesanan</p>
            <p class="font-black text-xs md:text-sm text-slate-900 uppercase tracking-widest">Semua Data</p>
        </div>
    </header>

    {{-- MAIN SCROLLABLE CONTENT --}}
    <main class="flex-1 overflow-y-auto custom-scroll w-full relative z-10 p-4 md:p-6 lg:p-10">
        <div class="max-w-5xl mx-auto">
            
            <div class="mb-8 md:mb-10 text-center px-2">
                <div class="inline-flex items-center gap-2 bg-indigo-50 border border-indigo-100 px-4 py-1.5 rounded-full mb-4">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse shadow-[0_0_10px_rgba(6,182,212,0.5)]"></span>
                    <p class="text-[8px] md:text-[9px] font-black text-cyan-600 uppercase tracking-[0.4em]">Tracking & Billing</p>
                </div>
                <h1 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tighter mb-2 uppercase italic leading-none">
                    Riwayat <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-500 to-blue-500">Cucian.</span>
                </h1>
                <p class="text-slate-500 font-medium text-xs md:text-sm mt-2">Pantau setiap tahap pengerjaan sepatu kesayangan Anda.</p>
            </div>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="mb-8 bg-emerald-50 border border-emerald-200 text-emerald-600 p-5 rounded-[1.5rem] flex items-center justify-center gap-3 shadow-lg shadow-emerald-500/10 animate-pulse">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span class="text-xs font-black uppercase tracking-widest">{{ session('success') }}</span>
                </div>
            @endif

            <div class="space-y-5 md:space-y-6">
                @forelse($riwayat as $r)
                <div class="glass-card rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-8 group flex flex-col">
                    
                    {{-- BAGIAN ATAS: Info, Progress, Tombol Aksi --}}
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 md:gap-8">
                        
                        {{-- Info Pesanan --}}
                        <div class="flex items-center gap-4 md:gap-6 w-full lg:w-1/3">
                            <div class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-[1.2rem] flex items-center justify-center border border-slate-200 shadow-sm shrink-0 group-hover:border-indigo-500/30 transition-colors">
                                <i class="fa-solid fa-box-open text-indigo-500 text-xl md:text-2xl group-hover:scale-110 transition-transform"></i>
                            </div>
                            <div>
                                <p class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-400 mb-0.5 md:mb-1">Order ID #ORD-{{ $r->id_reservasi }}</p>
                                <h3 class="text-lg md:text-xl font-black italic text-slate-900 leading-tight group-hover:text-cyan-600 transition-colors">
                                    {{ $r->detail->first()?->layanan->nama_layanan ?? 'Layanan' }}
                                </h3>
                                <p class="text-xs md:text-sm font-bold text-slate-600 mt-1">Total: <span class="text-cyan-600 font-black">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</span></p>
                            </div>
                        </div>

                        {{-- Progress Bar --}}
                        <div class="flex-1 w-full max-w-md px-2 md:px-4">
                            <div class="relative py-4">
                                <div class="absolute top-1/2 left-0 w-full h-1.5 bg-slate-200/60 -translate-y-1/2 rounded-full"></div>
                                @php
                                    $progress = '15%';
                                    if(in_array($r->status, ['Diproses', 'Dicuci'])) $progress = '50%';
                                    if(in_array($r->status, ['Selesai', 'Siap Diambil', 'Menunggu Kurir', 'Sedang Diantar'])) $progress = '100%';
                                @endphp
                                <div class="absolute top-1/2 left-0 h-1.5 bg-gradient-to-r from-cyan-400 to-blue-500 -translate-y-1/2 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(6,182,212,0.5)]" 
                                     style="width: {{ $progress }}"></div>

                                <div class="relative flex justify-between">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full border-4 border-white shadow-sm {{ $r->status != '' ? 'bg-indigo-500' : 'bg-slate-300' }} transition-colors z-10"></div>
                                        <span class="text-[8px] md:text-[9px] font-black uppercase tracking-widest {{ $r->status != '' ? 'text-cyan-600' : 'text-slate-400' }}">Booking</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full border-4 border-white shadow-sm {{ in_array($r->status, ['Diproses', 'Dicuci', 'Selesai', 'Siap Diambil', 'Menunggu Kurir', 'Sedang Diantar']) ? 'bg-blue-500' : 'bg-slate-300' }} transition-colors z-10"></div>
                                        <span class="text-[8px] md:text-[9px] font-black uppercase tracking-widest {{ in_array($r->status, ['Diproses', 'Dicuci', 'Selesai', 'Siap Diambil', 'Menunggu Kurir', 'Sedang Diantar']) ? 'text-indigo-600' : 'text-slate-400' }}">Process</span>
                                    </div>
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-4 h-4 md:w-5 md:h-5 rounded-full border-4 border-white shadow-sm {{ in_array($r->status, ['Selesai', 'Siap Diambil', 'Menunggu Kurir', 'Sedang Diantar']) ? 'bg-purple-500' : 'bg-slate-300' }} transition-colors z-10"></div>
                                        <span class="text-[8px] md:text-[9px] font-black uppercase tracking-widest {{ in_array($r->status, ['Selesai', 'Siap Diambil', 'Menunggu Kurir', 'Sedang Diantar']) ? 'text-purple-600' : 'text-slate-400' }}">Ready</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="shrink-0 w-full lg:w-auto flex flex-col items-center lg:items-end justify-center">
                            
                            @if($r->status == 'Menunggu Pembayaran')
                                <a href="{{ route('reservasi.pembayaran', $r->id_reservasi) }}" class="bg-indigo-500 text-white px-8 py-4 rounded-[1rem] font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-500/30 w-full text-center hover:scale-105 active:scale-95">Bayar Sekarang</a>
                            
                            {{-- LOGIKA BARU: Jika Transaksi BENAR-BENAR SELESAI (Barang sudah diterima) --}}
                            @elseif($r->status == 'Selesai' && $r->status_pengambilan == 'Sudah Diambil')
                                <div class="flex flex-col items-center lg:items-end gap-2 w-full">
                                    <div class="px-6 py-3 rounded-xl bg-slate-50 border border-slate-200 text-slate-400 font-black text-[10px] md:text-xs uppercase tracking-widest italic w-full shadow-sm flex items-center justify-center lg:justify-end gap-2 opacity-75">
                                        <i class="fa-solid fa-check-double text-emerald-500"></i> Pesanan Selesai
                                    </div>
                                    <div class="text-[9px] font-bold text-slate-400 text-center lg:text-right w-full">
                                        Terima kasih telah mempercayakan sepatu Anda.
                                    </div>
                                </div>

                            {{-- Jika Selesai tapi belum pilih metode --}}
                            @elseif($r->status == 'Selesai' && ($r->metode_pengembalian == 'Belum Ditentukan' || empty($r->metode_pengembalian)))
                                <div class="flex flex-col items-center lg:items-end gap-3 w-full">
                                    <span class="text-[9px] font-black text-red-500 uppercase tracking-widest animate-pulse bg-red-50 px-4 py-1.5 rounded-full border border-red-100 flex items-center gap-2">
                                        <i class="fa-solid fa-bell"></i> Pilih Pengembalian
                                    </span>
                                    <div class="flex w-full lg:w-auto gap-2">
                                        <form action="{{ route('reservasi.pilih-pengembalian', $r->id_reservasi) }}" method="POST" class="flex-1 lg:flex-none">
                                            @csrf
                                            <input type="hidden" name="metode" value="Ambil di Toko">
                                            <button type="submit" class="w-full bg-white border-2 border-cyan-200 text-cyan-600 hover:bg-indigo-50 hover:border-cyan-400 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                                Ambil Sendiri
                                            </button>
                                        </form>
                                        <button type="button" onclick="openCourierModal('{{ $r->id_reservasi }}')" 
                                            class="flex-1 lg:flex-none bg-slate-900 border-2 border-slate-900 text-white hover:bg-indigo-600 hover:border-cyan-600 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm">
                                            Antar Kurir
                                        </button>
                                    </div>
                                </div>

                            {{-- Proses Pengambilan / Pengantaran Berjalan --}}
                            @elseif($r->metode_pengembalian != 'Belum Ditentukan' && !empty($r->metode_pengembalian))
                                <div class="text-center lg:text-right w-full">
                                    @if($r->metode_pengembalian == 'Ambil di Toko')
                                        <div class="px-6 py-3 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-600 font-black text-[10px] md:text-xs uppercase tracking-widest italic w-full shadow-sm flex items-center justify-center lg:justify-end gap-2">
                                            <i class="fa-solid fa-store"></i> Siap Diambil di Toko
                                        </div>
                                    @else
                                        <div class="px-6 py-3 rounded-xl bg-blue-50 border border-blue-100 text-indigo-600 font-black text-[10px] md:text-xs uppercase tracking-widest italic w-full shadow-sm flex items-center justify-center lg:justify-end gap-2">
                                            <i class="fa-solid fa-motorcycle {{ $r->status == 'Sedang Diantar' ? 'animate-bounce' : '' }}"></i> 
                                            {{ $r->status == 'Sedang Diantar' ? 'Sedang Diantar' : 'Menunggu Kurir' }}
                                        </div>
                                        @if($r->alamat_pengantaran)
                                        <div class="text-[9px] font-bold text-slate-500 mt-2 flex items-start gap-1 justify-center lg:justify-end text-right max-w-[200px] ml-auto">
                                            <i class="fa-solid fa-location-dot text-red-500 mt-0.5"></i> 
                                            <span class="truncate">{{ $r->alamat_pengantaran }}</span>
                                        </div>
                                        @endif
                                    @endif
                                    
                                </div>

                            @else
                                <div class="px-8 py-4 rounded-xl bg-white border border-slate-200 text-slate-500 font-black text-[10px] md:text-xs uppercase tracking-widest text-center italic w-full shadow-sm">
                                    {{ $r->status }}
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- ✅ UPDATE REVISI DOSEN: Kotak Info Pembayaran --}}
                    @if($r->pembayaran)
                    <div class="mt-6 pt-5 md:pt-6 border-t border-slate-200/60 w-full">
                        <div class="flex items-center gap-2 mb-3 md:mb-4">
                            <i class="fa-solid fa-file-invoice-dollar text-indigo-500 text-sm"></i>
                            <h4 class="text-[10px] md:text-xs font-black uppercase tracking-widest text-slate-700">Detail Pembayaran</h4>
                        </div>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 bg-white/50 p-4 md:p-5 rounded-2xl border border-slate-100">
                            <div>
                                <p class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Metode</p>
                                <p class="text-[10px] md:text-xs font-black text-slate-900 truncate">{{ $r->pembayaran->metode_bayar }}</p>
                            </div>
                            <div>
                                <p class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Status</p>
                                <span class="px-2.5 py-1 rounded-md text-[9px] md:text-[10px] font-black uppercase {{ $r->status_bayar == 'Lunas' ? 'bg-emerald-100 text-emerald-600 border border-emerald-200' : 'bg-red-100 text-red-500 border border-red-200' }}">
                                    {{ $r->status_bayar }}
                                </span>
                            </div>
                            <div>
                                <p class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Tanggal</p>
                                <p class="text-[10px] md:text-xs font-black text-slate-900">
                                    {{ $r->pembayaran->tanggal ? \Carbon\Carbon::parse($r->pembayaran->tanggal)->format('d M Y') : '-' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[8px] md:text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total</p>
                                <p class="text-[10px] md:text-xs font-black text-cyan-600">Rp {{ number_format($r->total_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                @empty
                <div class="text-center py-20 glass-card rounded-[3rem] px-6">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <i class="fa-solid fa-box-open text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-tighter mb-1">Belum Ada Riwayat</h3>
                    <p class="text-slate-500 font-medium text-sm mb-6">Anda belum pernah melakukan pemesanan cucian sepatu.</p>
                    <a href="{{ route('reservasi.create') }}" class="bg-indigo-500 text-white px-8 py-4 rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-500/30 hover:scale-105 active:scale-95 inline-block">
                        Buat Pesanan Baru
                    </a>
                </div>
                @endforelse
            </div>

            {{-- FOOTER --}}
            <div class="mt-auto pt-10 pb-4 flex justify-center items-center shrink-0 z-10">
                <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 text-center">© 2026 ALBRK.MEMBER LOUNGE</p>
            </div>
        </div>
    </main>

    {{-- MODAL ANTAR KURIR (LIGHT THEME) --}}
    <div id="courierModal" class="fixed inset-0 z-[100] hidden bg-slate-900/60 backdrop-blur-md flex items-center justify-center p-4 transition-opacity">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] p-8 shadow-2xl border border-white relative">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -z-10"></div>
            
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-black text-xl text-slate-900 uppercase italic tracking-tighter">Detail <span class="text-indigo-500">Kurir.</span></h3>
                <button onclick="closeCourierModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="courierForm" method="POST">
                @csrf
                <input type="hidden" name="metode" value="Diantar ke Alamat">
                
                <div class="space-y-5">
                    <div>
                        <label class="text-[9px] font-black text-cyan-600 uppercase tracking-widest mb-2 block ml-1">Nomor WhatsApp Aktif</label>
                        <input type="text" name="wa_pengantaran" required placeholder="Contoh: 0812345xxx" value="{{ auth()->user()->no_telp ?? '' }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] px-5 py-4 text-sm font-bold text-slate-900 focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 outline-none transition-all shadow-sm">
                    </div>
                    <div>
                        <label class="text-[9px] font-black text-cyan-600 uppercase tracking-widest mb-2 block ml-1">Alamat Pengantaran Sepatu</label>
                        <textarea name="alamat_pengantaran" required placeholder="Tulis alamat lengkap (No rumah, jalan, patokan)"
                            class="w-full bg-slate-50 border border-slate-200 rounded-[1.2rem] px-5 py-4 text-sm font-bold text-slate-900 focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 outline-none transition-all h-28 resize-none shadow-sm">{{ auth()->user()->alamat ?? '' }}</textarea>
                    </div>
                </div>

                <button type="submit" class="w-full mt-8 bg-indigo-600 text-white py-4 rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-[0.2em] shadow-xl shadow-indigo-500/30 hover:bg-indigo-600 hover:shadow-slate-900/20 transition-all duration-300 active:scale-95">
                    Konfirmasi Pengantaran
                </button>
            </form>
        </div>
    </div>

    <script>
        function openCourierModal(id) {
            const modal = document.getElementById('courierModal');
            const form = document.getElementById('courierForm');
            
            // Set action URL secara dinamis berdasarkan ID Reservasi
            form.action = "{{ url('/reservasi/pilih-pengembalian') }}/" + id;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeCourierModal() {
            const modal = document.getElementById('courierModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal saat klik area luar
        window.onclick = function(event) {
            const modal = document.getElementById('courierModal');
            if (event.target == modal) {
                closeCourierModal();
            }
        }
    </script>

</body>
</html>