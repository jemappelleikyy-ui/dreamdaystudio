<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice &amp; Bukti Reservasi — {{ $booking['id'] }} | DreamDay Studio</title>
    <meta name="description" content="Bukti pembayaran dan konfirmasi reservasi resmi DreamDay Studio.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-serif-luxury {
            font-family: 'Playfair Display', Georgia, serif;
        }
        .font-sans-modern {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }
        @media print {
            header, footer, .no-print {
                display: none !important;
            }
            main {
                padding: 0 !important;
            }
            .invoice-card {
                border: none !important;
                box-shadow: none !important;
            }
        }
    </style>
</head>
<body class="bg-[#f9f8f6] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER BAR ==================== -->
    <header class="w-full bg-white border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                <span class="font-serif-luxury text-2xl font-bold tracking-tight text-[#27221e] group-hover:text-[#5b4b38] transition-colors">DreamDay Studio</span>
            </a>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('profile') }}" class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-[#5b4b38]/30 transition group">
                    <img src="{{ asset(session('user_avatar', 'images/profile-avatar.jpg')) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-[#ede7df]">
                    <span class="hidden sm:inline font-semibold text-xs text-[#27221e]">{{ session('user_name', '') }}</span>
                </a>
            </div>
        </div>
    </header>

    @php
        $st = strtoupper(trim($booking['status'] ?? 'MENUNGGU PEMBAYARAN DP'));
        $total = (int) ($booking['total_price'] ?? 0);
        $dpPct = (int) ($booking['dp_percentage'] ?? 30);
        $dpAmount = (int) ($booking['dp_amount'] ?? round($total * $dpPct / 100));
        $amountPaid = (int) ($booking['amount_paid'] ?? 0);
        $remaining = (int) ($booking['remaining_amount'] ?? max(0, $total - $amountPaid));
        $isLunas = in_array($st, ['LUNAS', 'SELESAI', 'TERVERIFIKASI', 'COMPLETED']) || $remaining == 0;
    @endphp

    <!-- ==================== MAIN INVOICE & NOTIFICATION ==================== -->
    <main class="max-w-3xl mx-auto px-4 sm:px-6 py-10 sm:py-14 w-full flex-1 space-y-8">
        
        <!-- Status Alert Header -->
        <div class="text-center space-y-3 no-print">
            @if($isLunas)
                <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-md animate-bounce">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                    Pembayaran Lunas &amp; Reservasi Terkonfirmasi!
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58] max-w-md mx-auto">
                    Terima kasih, seluruh tagihan acara Anda telah lunas. Notifikasi konfirmasi dan tanda terima resmi telah dikirimkan ke email Anda.
                </p>
            @elseif($st === 'DP DIBAYAR')
                <div class="w-16 h-16 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center mx-auto shadow-md">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                    Pembayaran DP Berhasil Diverifikasi!
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58] max-w-md mx-auto">
                    Jadwal acara pernikahan Anda telah resmi terkunci di sistem kami. Anda dapat melakukan pembayaran pelunasan kapan saja sebelum hari H.
                </p>
            @elseif(in_array($st, ['MENUNGGU VERIFIKASI DP', 'MENUNGGU VERIFIKASI PELUNASAN']))
                <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mx-auto shadow-md">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                    Pembayaran Sedang Dalam Verifikasi
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58] max-w-md mx-auto">
                    Bukti pembayaran Anda telah kami terima dan sedang diverifikasi oleh tim administrasi DreamDay Studio.
                </p>
            @else
                <div class="w-16 h-16 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center mx-auto shadow-md">
                    <svg class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                    Booking Dikonfirmasi!
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58] max-w-md mx-auto">
                    Reservasi Anda telah terdaftar di sistem. Silakan selesaikan pembayaran DP untuk mengunci jadwal.
                </p>
            @endif
        </div>

        <!-- Official Printable Invoice Card -->
        <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-10 shadow-xl space-y-8 invoice-card">
            
            <!-- Invoice Top Header -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-6 border-b border-[#f2ece5]">
                <div>
                    <span class="font-serif-luxury text-2xl font-bold text-[#5b4b38]">DreamDay Studio</span>
                    <p class="text-xs text-[#8d8277] mt-0.5">Official Booking Receipt &amp; Invoice</p>
                </div>
                <div class="sm:text-right space-y-1">
                    <div class="text-xs text-[#8d8277]">Nomor Booking:</div>
                    <div class="font-mono text-base font-bold text-[#27221e] tracking-wider">{{ $booking['id'] }}</div>
                    @if($isLunas)
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800 border border-emerald-200">
                            COMPLETED / LUNAS
                        </span>
                    @elseif($st === 'DP DIBAYAR')
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-teal-100 text-teal-800 border border-teal-200">
                            DP DIBAYAR (AKTIF)
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-amber-100 text-amber-800 border border-amber-200">
                            {{ $st }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- 2 Column Customer & Event Meta -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs text-[#27221e]">
                <!-- Column 1: Customer Details -->
                <div class="space-y-1.5">
                    <h4 class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">Data Pemesan</h4>
                    <p class="font-bold text-sm text-[#27221e]">{{ $booking['customer_name'] }}</p>
                    <p class="text-[#685f58]">{{ $booking['customer_email'] }}</p>
                    <p class="text-[#685f58]">{{ $booking['customer_phone'] }}</p>
                    @if(!empty($booking['payment_method']))
                        <p class="text-[#8d8277] pt-1">Metode Bayar: <strong>{{ $booking['payment_method'] }}</strong></p>
                    @endif
                </div>

                <!-- Column 2: Event Details -->
                <div class="space-y-1.5">
                    <h4 class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">Jadwal &amp; Lokasi Acara</h4>
                    <p><span class="text-[#8d8277]">Tanggal:</span> <strong>{{ !empty($booking['event_date']) ? date('d F Y', strtotime($booking['event_date'])) : '-' }}</strong></p>
                    <p><span class="text-[#8d8277]">Waktu:</span> <strong>{{ $booking['event_time'] ?? '-' }}</strong></p>
                    <p><span class="text-[#8d8277]">Lokasi:</span> <strong>{{ $booking['event_location'] ?? '-' }}</strong></p>
                    <p><span class="text-[#8d8277]">Kapasitas:</span> <strong>{{ $booking['guest_count'] ?? '-' }}</strong></p>
                </div>
            </div>

            <!-- Special Requests / Notes -->
            <div class="pt-4 border-t border-[#f2ece5] space-y-1.5">
                <h4 class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">Catatan / Permintaan Khusus Acara</h4>
                <p class="text-xs text-[#554d46] whitespace-pre-wrap">{{ $booking['notes'] ?? '-' }}</p>
            </div>

            <!-- Service Item Details -->
            <div class="space-y-3 pt-4 border-t border-[#f2ece5]">
                <h4 class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">Rincian Layanan</h4>
                
                <div class="flex items-center justify-between p-4 rounded-2xl bg-[#faf8f5] border border-[#ede7df]">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset($booking['service_image'] ?? 'images/package-cliffside.jpg') }}" alt="{{ $booking['service_title'] }}" class="w-12 h-12 rounded-xl object-cover border border-[#ede7df]">
                        <div>
                            <h5 class="font-bold text-sm text-[#27221e]">{{ $booking['service_title'] }}</h5>
                            <p class="text-[0.7rem] text-[#8d8277]">Paket Utama Termasuk Fasilitas Standar</p>
                        </div>
                    </div>
                    <span class="font-bold text-sm text-[#27221e]">
                        Rp {{ number_format($booking['subtotal'] ?? 0, 0, ',', '.') }}
                    </span>
                </div>

                @if(!empty($booking['addons']) && is_array($booking['addons']))
                    <div class="space-y-1.5 pl-2 text-xs text-[#554d46]">
                        <span class="text-[0.7rem] font-semibold text-[#8d8277]">Opsi Tambahan Terpilih:</span>
                        @foreach($booking['addons'] as $addon)
                            <div class="flex items-center justify-between pl-2">
                                <span>• {{ $addon }}</span>
                                <span class="font-medium text-emerald-700">Termasuk</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- DP & Pricing Breakdown Total -->
            <div class="space-y-2.5 pt-4 border-t border-[#f2ece5] text-xs text-[#685f58]">
                <div class="flex items-center justify-between">
                    <span>Subtotal Layanan</span>
                    <span class="font-semibold text-[#27221e]">Rp {{ number_format($booking['subtotal'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span>Pajak &amp; Biaya Layanan (10%)</span>
                    <span>Rp {{ number_format($booking['tax'] ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm font-bold text-[#27221e] pt-1">
                    <span>Total Biaya Keseluruhan Acara</span>
                    <span class="font-serif-luxury text-base text-[#27221e]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <!-- Structured DP Breakdown Box -->
                <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#ede7df] space-y-2 mt-3">
                    <div class="flex items-center justify-between font-bold text-xs text-[#5b4b38]">
                        <span>Ketentuan DP ({{ $dpPct }}%)</span>
                        <span>Rp {{ number_format($dpAmount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-emerald-700 font-semibold">
                        <span>Total Pembayaran Telah Diterima (DP / Cicilan)</span>
                        <span>Rp {{ number_format($amountPaid, 0, ',', '.') }}</span>
                    </div>
                    <div class="pt-2 border-t border-[#e8dfd3] flex items-center justify-between text-sm sm:text-base font-bold {{ $remaining == 0 ? 'text-emerald-700' : 'text-[#5b4b38]' }}">
                        <span>Sisa Pembayaran (Pelunasan)</span>
                        <span class="font-serif-luxury text-lg sm:text-xl">
                            Rp {{ number_format($remaining, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Footer Notes -->
            <div class="pt-4 text-center text-[0.7rem] text-[#8d8277] border-t border-[#f2ece5]">
                <p>Dokumen ini adalah bukti transaksi resmi yang sah dari DreamDay Studio.</p>
                <p>Diterbitkan pada {{ $booking['created_at'] ?? date('d M Y, H:i') }} WIB</p>
            </div>

        </div>

        <!-- Action Buttons (No Print) -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 no-print pt-2">
            @if(!$isLunas && $st === 'DP DIBAYAR')
                <a href="{{ route('booking.payment', ['id' => $booking['id'], 'type' => 'pelunasan']) }}" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm text-center shadow-md transition duration-200 cursor-pointer">
                    Bayar Pelunasan Sekarang (Rp {{ number_format($remaining, 0, ',', '.') }}) →
                </a>
            @elseif(in_array($st, ['MENUNGGU PEMBAYARAN DP', 'DP DITOLAK']))
                <a href="{{ route('booking.payment', ['id' => $booking['id']]) }}" 
                   class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-xs sm:text-sm text-center shadow-md transition duration-200 cursor-pointer">
                    Bayar DP Sekarang (Rp {{ number_format($dpAmount, 0, ',', '.') }}) →
                </a>
            @endif

            <a href="{{ route('profile') }}" 
               class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-semibold text-xs sm:text-sm text-center shadow-md transition duration-200 cursor-pointer">
                Lihat di Riwayat Pesanan →
            </a>
            
            <button type="button" 
                    onclick="window.print()" 
                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-[#ded5cb] hover:border-[#b0a597] bg-white hover:bg-[#faf8f5] text-[#27221e] font-medium text-xs sm:text-sm text-center flex items-center justify-center gap-2 transition cursor-pointer">
                <svg class="w-4 h-4 text-[#685f58]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                <span>Cetak / Simpan PDF</span>
            </button>

            <a href="{{ route('home') }}" 
               class="w-full sm:w-auto px-6 py-3.5 rounded-xl border border-transparent hover:bg-[#f2ece5] text-[#685f58] hover:text-[#27221e] font-medium text-xs sm:text-sm text-center transition">
                Kembali ke Beranda
            </a>
        </div>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-12 px-4 sm:px-8 mt-20 no-print">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-xs text-[#685f58]">
            <div class="space-y-1.5 text-center md:text-left">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
                    <span class="font-serif-luxury text-2xl font-bold tracking-tight text-[#6b513a] group-hover:text-[#523d2b] transition-colors">DreamDay Studio</span>
                </a>
                <p class="text-xs text-[#8d8277]">
                    Crafting timeless elegance for your most cherished moments.
                </p>
                <p class="text-[0.7rem] text-[#a69c92] pt-1">
                    © 2026 DreamDay Studio. All rights reserved.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-xs text-[#554d46] font-medium">
                <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                <span class="text-[#cfc5ba] hidden sm:inline">•</span>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                <span class="text-[#cfc5ba] hidden sm:inline">•</span>
                <a href="{{ route('list-service') }}" class="hover:text-[#27221e] transition-colors">Vendor Portal</a>
                <span class="text-[#cfc5ba] hidden sm:inline">•</span>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
            </div>
        </div>
    </footer>

</body>
</html>
