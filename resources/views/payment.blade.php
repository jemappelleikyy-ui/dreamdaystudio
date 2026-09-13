<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Pembayaran — {{ $booking['id'] }} | DreamDay Studio</title>
    <meta name="description" content="Portal Pembayaran Down Payment (DP) &amp; Pelunasan Resmi DreamDay Studio.">

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
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }
        .animate-shake {
            animation: shake 0.4s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#f9f8f6] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER BAR ==================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Back & Brand -->
            <div class="flex items-center gap-4">
                <a href="{{ route('profile') }}" 
                   class="p-2 rounded-lg text-[#685f58] hover:text-[#27221e] hover:bg-[#f5f0ea] transition flex items-center gap-2 text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Riwayat Pesanan</span>
                </a>
                <div class="h-5 w-px bg-[#e8e2d9] hidden sm:block"></div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <span class="font-serif-luxury text-2xl font-bold tracking-tight text-[#27221e] hover:text-[#5b4b38] transition-colors">
                        DreamDay Studio
                    </span>
                </a>
            </div>

            <!-- Right Side: User Profile -->
            <div class="flex items-center gap-4">
                <a href="{{ route('profile') }}" class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-[#5b4b38]/30 transition group">
                    <img src="{{ asset(session('user_avatar', 'images/profile-avatar.jpg')) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-[#ede7df]">
                    <span class="hidden md:inline font-semibold text-xs text-[#27221e]">{{ session('user_name', '') }}</span>
                </a>
            </div>
        </div>
    </header>

    <!-- ==================== MAIN PAYMENT INTERFACE ==================== -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 w-full flex-1 space-y-8">
        
        <!-- Top Status Banner -->
        <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-8 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
            <div class="space-y-1.5">
                <div class="flex items-center gap-2.5">
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-900 border border-amber-200">
                        @if($paymentType === 'pelunasan')
                            PEMBAYARAN PELUNASAN
                        @else
                            Booking Dikonfirmasi - Menunggu Pembayaran DP
                        @endif
                    </span>
                    <span class="font-mono text-xs font-bold text-[#5b4b38] bg-[#f5f0ea] px-2.5 py-1 rounded-md">
                        #{{ $booking['id'] }}
                    </span>
                </div>
                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e]">
                    @if($paymentType === 'pelunasan')
                        Pelunasan Sisa Tagihan Acara
                    @else
                        Pembayaran Uang Muka (Down Payment {{ $dpPercentage }}%)
                    @endif
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58]">
                    @if($paymentType === 'pelunasan')
                        Selesaikan sisa pembayaran tagihan acara pernikahan Anda dengan metode pembayaran aman.
                    @else
                        Lakukan pembayaran DP untuk mengonfirmasi dan mengunci jadwal reservasi Anda secara resmi.
                    @endif
                </p>
            </div>

            <div class="text-left md:text-right bg-[#faf7f2] p-4 rounded-2xl border border-[#ede7df] shrink-0 min-w-[220px]">
                <span class="text-[0.7rem] uppercase tracking-wider text-[#8d8277] font-semibold block">Total yang Harus Dibayar:</span>
                <span class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#5b4b38]">
                    Rp {{ number_format($targetAmount, 0, ',', '.') }}
                </span>
                <span class="text-[0.65rem] text-[#8d8277] block mt-0.5">
                    @if($paymentType === 'pelunasan')
                        (Sisa Pelunasan 100%)
                    @else
                        (Nominal DP {{ $dpPercentage }}%)
                    @endif
                </span>
            </div>
        </div>

        <!-- Two Column Payment Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- ==================== LEFT COLUMN: PAYMENT METHODS & PROOF UPLOAD ==================== -->
            <div class="lg:col-span-8 space-y-6">
                
                <form id="payment-form" action="{{ route('booking.payment.pay', ['id' => $booking['id']]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <input type="hidden" name="payment_type" id="payment_type" value="{{ $paymentType }}">
                    <input type="hidden" name="payment_method" id="selected_payment_method" value="QRIS Instant">

                    <!-- Payment Method Selector Card -->
                    <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-8 shadow-xs space-y-6">
                        <div>
                            <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">METODE PEMBAYARAN</span>
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e] mt-1">
                                Pilih Metode Pembayaran
                            </h2>
                            <p class="text-xs sm:text-sm text-[#685f58] mt-1">
                                Seluruh metode pembayaran dijamin aman dan terenkripsi.
                            </p>
                        </div>

                        <!-- Payment Methods List -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                            
                            <!-- Method 1: QRIS Instant -->
                            <label class="p-4 rounded-2xl border-2 border-[#5b4b38] bg-[#faf7f2] flex items-center justify-between cursor-pointer payment-method-card transition" onclick="selectPaymentMethod('QRIS Instant')">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pay_radio" checked class="text-[#5b4b38] focus:ring-[#5b4b38]">
                                    <div>
                                        <div class="text-xs sm:text-sm font-bold text-[#27221e]">QRIS Instant</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">BCA, GoPay, OVO, Dana, ShopeePay</div>
                                    </div>
                                </div>
                                <span class="text-[0.65rem] font-bold bg-[#5b4b38] text-white px-2 py-0.5 rounded">INSTAN</span>
                            </label>

                            <!-- Method 2: BCA Virtual Account -->
                            <label class="p-4 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] flex items-center justify-between cursor-pointer payment-method-card bg-white transition" onclick="selectPaymentMethod('BCA Virtual Account')">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pay_radio" class="text-[#5b4b38] focus:ring-[#5b4b38]">
                                    <div>
                                        <div class="text-xs sm:text-sm font-bold text-[#27221e]">BCA Virtual Account</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">Verifikasi Otomatis 24 Jam</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#685f58]">BCA</span>
                            </label>

                            <!-- Method 3: Mandiri / BNI / BRI VA -->
                            <label class="p-4 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] flex items-center justify-between cursor-pointer payment-method-card bg-white transition" onclick="selectPaymentMethod('Bank Mandiri / BNI Virtual Account')">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pay_radio" class="text-[#5b4b38] focus:ring-[#5b4b38]">
                                    <div>
                                        <div class="text-xs sm:text-sm font-bold text-[#27221e]">Mandiri / BNI / BRI VA</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">Semua Bank Nasional</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#685f58]">VA</span>
                            </label>

                            <!-- Method 4: Credit / Debit Card -->
                            <label class="p-4 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] flex items-center justify-between cursor-pointer payment-method-card bg-white transition" onclick="selectPaymentMethod('Kartu Kredit / Debit Visa / Master')">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pay_radio" class="text-[#5b4b38] focus:ring-[#5b4b38]">
                                    <div>
                                        <div class="text-xs sm:text-sm font-bold text-[#27221e]">Credit / Debit Card</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">Visa, Mastercard, JCB</div>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-[#685f58]">VISA</span>
                            </label>

                            <!-- Method 5: Manual Bank Transfer + Upload Bukti -->
                            <label class="sm:col-span-2 p-4 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] flex items-center justify-between cursor-pointer payment-method-card bg-white transition" onclick="selectPaymentMethod('Transfer Bank Manual & Upload Bukti')">
                                <div class="flex items-center gap-3">
                                    <input type="radio" name="pay_radio" class="text-[#5b4b38] focus:ring-[#5b4b38]">
                                    <div>
                                        <div class="text-xs sm:text-sm font-bold text-[#27221e]">Transfer Bank Manual &amp; Upload Bukti Pembayaran</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">BCA Rek: 8277-0192-88 a/n PT DreamDay Studio Indonesia</div>
                                    </div>
                                </div>
                                <span class="text-[0.65rem] font-bold bg-[#ede7df] text-[#5b4b38] px-2 py-0.5 rounded">TRANSFER</span>
                            </label>

                        </div>

                        <!-- Dynamic Display Box (QRIS / VA / Card simulation) -->
                        <div id="method-qris-display" class="p-6 rounded-2xl bg-[#faf8f5] border border-[#ede7df] text-center space-y-4">
                            <span class="text-xs font-semibold text-[#8d8277] uppercase tracking-wider block">Scan Kode QRIS DreamDay Studio</span>
                            
                            <div class="relative w-52 h-52 max-w-[208px] max-h-[208px] mx-auto">
                                <div id="qris-img-container" class="w-full h-full bg-white p-2.5 rounded-2xl border border-[#ded5cb] shadow-xs flex flex-col items-center justify-center transition-all duration-300">
                                    <img id="qris-img" src="{{ asset('images/qris-code.png') }}" alt="QRIS DreamDay Studio" class="w-full h-full object-contain rounded-xl transition-opacity duration-300">
                                </div>

                                <!-- Expired Overlay -->
                                <div id="qris-expired-overlay" class="hidden absolute inset-0 bg-white/95 backdrop-blur-[2px] rounded-2xl border border-rose-200 flex flex-col items-center justify-center p-3 text-center space-y-2">
                                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-rose-700">Kode QR Kadaluarsa</p>
                                        <p class="text-[0.65rem] text-[#8d8277]">Waktu pembayaran telah habis</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-1.5 text-xs text-[#685f58]">
                                <p class="font-bold text-[#27221e]">Nominal Tagihan: <span class="text-[#5b4b38]">Rp {{ number_format($targetAmount, 0, ',', '.') }}</span></p>
                                <p class="text-[0.7rem] text-[#8d8277]">Batas Waktu Pembayaran: <span id="countdown-timer" class="font-mono font-bold text-rose-600">7 Hari</span></p>
                                
                                <!-- Tombol Perbarui Kode -->
                                <div id="renew-qris-box" class="hidden pt-2">
                                    <button type="button" 
                                            onclick="renewQRCode()" 
                                            class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-semibold shadow-xs hover:shadow transition duration-200 cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        <span>Perbarui Kode</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div id="method-va-display" class="hidden p-6 rounded-2xl bg-[#faf8f5] border border-[#ede7df] space-y-3">
                            <span class="text-xs font-semibold text-[#8d8277] uppercase tracking-wider block">Nomor Virtual Account</span>
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl border border-[#ded5cb]">
                                <div>
                                    <span class="text-[0.65rem] text-[#8d8277] uppercase font-bold block">Nomor Rekening VA:</span>
                                    <span class="font-mono text-lg font-bold text-[#27221e] tracking-wider" id="va-number-text">8277 0812 3456 7890</span>
                                </div>
                                <button type="button" onclick="copyVA()" class="px-3.5 py-1.5 rounded-lg bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-semibold cursor-pointer">
                                    Salin Nomor
                                </button>
                            </div>
                            <p class="text-[0.75rem] text-[#685f58]">
                                Transfer tepat sesuai nominal: <strong>Rp {{ number_format($targetAmount, 0, ',', '.') }}</strong> dari m-Banking atau ATM.
                            </p>
                        </div>

                        <!-- Upload Proof Section (Optional / Recommended) -->
                        <div class="space-y-3 pt-3 border-t border-[#f2ece5]">
                            <label class="block text-xs font-bold text-[#27221e]">
                                Upload Bukti Pembayaran / Struk Transfer (Opsional jika bayar via transfer/manual)
                            </label>
                            
                            <div class="border-2 border-dashed border-[#ded5cb] hover:border-[#5b4b38] rounded-2xl p-6 text-center bg-[#fdfcfb] transition cursor-pointer" onclick="document.getElementById('payment_proof_input').click()">
                                <input type="file" 
                                       name="payment_proof" 
                                       id="payment_proof_input" 
                                       accept="image/*" 
                                       class="hidden" 
                                       onchange="previewProofImage(event)">
                                
                                <div id="upload-placeholder" class="space-y-2">
                                    <div class="w-12 h-12 rounded-full bg-[#f5f0ea] text-[#5b4b38] flex items-center justify-center mx-auto">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="text-xs font-semibold text-[#27221e]">
                                        Klik untuk memilih foto bukti transfer atau seret file ke sini
                                    </div>
                                    <p class="text-[0.7rem] text-[#8d8277]">
                                        Format didukung: JPG, PNG, WEBP (Maksimal 5MB)
                                    </p>
                                </div>

                                <div id="upload-preview-box" class="hidden space-y-2">
                                    <img id="upload-preview-img" src="" alt="Bukti Transfer" class="max-h-48 mx-auto rounded-xl shadow-xs border border-[#ede7df]">
                                    <span class="text-xs text-emerald-700 font-semibold block">✓ Bukti transfer siap dikirimkan</span>
                                    <button type="button" onclick="event.stopPropagation(); removeProofImage();" class="text-xs text-rose-600 hover:underline">
                                        Ganti Foto Bukti
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="space-y-1.5">
                            <label for="notes" class="block text-xs font-semibold text-[#554d46]">Catatan Pembayaran (Opsional)</label>
                            <input type="text" 
                                   id="notes" 
                                   name="notes" 
                                   placeholder="Contoh: Pembayaran DP via m-BCA a/n {{ $booking['customer_name'] }}" 
                                   class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38]">
                        </div>

                        <!-- Form Actions -->
                        <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-[#f2ece5]">
                            <a href="{{ route('profile') }}" class="w-full sm:w-auto px-5 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] transition text-center">
                                ← Bayar Nanti
                            </a>
                            <div class="w-full sm:w-auto">
                                <button type="submit" id="btn-submit-payment" class="w-full sm:w-auto px-7 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-sm shadow-md hover:shadow-lg transition duration-200 cursor-pointer flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>
                                        @if($paymentType === 'pelunasan')
                                            Bayar Pelunasan Sekarang (Rp {{ number_format($targetAmount, 0, ',', '.') }})
                                        @else
                                            Bayar DP Sekarang (Rp {{ number_format($targetAmount, 0, ',', '.') }})
                                        @endif
                                    </span>
                                </button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

            <!-- ==================== RIGHT COLUMN: BOOKING SUMMARY & DP BREAKDOWN ==================== -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Summary Card -->
                <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-7 shadow-xl space-y-6">
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e] pb-3 border-b border-[#f2ece5]">
                        Rincian Reservasi
                    </h3>

                    <!-- Service Thumbnail -->
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset($booking['service_image'] ?? 'images/package-cliffside.jpg') }}" alt="{{ $booking['service_title'] }}" class="w-14 h-14 rounded-xl object-cover border border-[#ede7df] shrink-0">
                        <div class="min-w-0">
                            <h4 class="font-bold text-xs sm:text-sm text-[#27221e] truncate">{{ $booking['service_title'] }}</h4>
                            <p class="text-[0.7rem] text-[#8d8277]">📅 {{ date('d F Y', strtotime($booking['event_date'])) }}</p>
                            <p class="text-[0.7rem] text-[#8d8277] truncate">📍 {{ $booking['event_location'] }}</p>
                        </div>
                    </div>

                    <!-- Financial DP Breakdown -->
                    <div class="space-y-2.5 text-xs text-[#554d46] pt-2 border-t border-[#f2ece5]">
                        <div class="flex items-center justify-between">
                            <span>Total Harga Paket Acara</span>
                            <span class="font-semibold text-[#27221e]">Rp {{ number_format($booking['total_price'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center justify-between text-[#5b4b38] font-bold">
                            <span>Down Payment (DP {{ $dpPercentage }}%)</span>
                            <span>Rp {{ number_format($booking['dp_amount'], 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center justify-between text-[#8d8277]">
                            <span>DP Sudah Dibayar</span>
                            <span>Rp {{ number_format($booking['amount_paid'] ?? 0, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex items-center justify-between text-[#27221e] font-semibold">
                            <span>Sisa Tagihan Pelunasan</span>
                            <span>Rp {{ number_format($booking['remaining_amount'] ?? ($booking['total_price'] - $booking['dp_amount']), 0, ',', '.') }}</span>
                        </div>

                        <div class="pt-3 border-t border-[#f2ece5] p-3 rounded-2xl bg-[#faf7f2] border border-[#ede7df] space-y-1">
                            <div class="flex items-center justify-between text-xs font-bold text-[#5b4b38]">
                                <span>Tagihan Saat Ini:</span>
                                <span class="font-serif-luxury text-base sm:text-lg">
                                    Rp {{ number_format($targetAmount, 0, ',', '.') }}
                                </span>
                            </div>
                            <span class="text-[0.65rem] text-[#8d8277] block">
                                Status: <strong class="text-[#27221e]">{{ $booking['status'] }}</strong>
                            </span>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="p-3.5 rounded-xl bg-[#faf8f5] border border-[#ede7df] space-y-1 text-xs text-[#685f58]">
                        <span class="text-[0.7rem] uppercase font-bold text-[#8d8277] block">Pemesan:</span>
                        <p class="font-semibold text-[#27221e]">{{ $booking['customer_name'] }}</p>
                        <p>{{ $booking['customer_phone'] }}</p>
                        <p>{{ $booking['customer_email'] }}</p>
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-12 px-4 sm:px-8 mt-20">
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
            </div>
        </div>
    </footer>

    <!-- Payment Interactive JS -->
    <script>
        function selectPaymentMethod(methodName) {
            document.getElementById('selected_payment_method').value = methodName;
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.className = "p-4 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] flex items-center justify-between cursor-pointer payment-method-card bg-white transition";
            });
            event.currentTarget.className = "p-4 rounded-2xl border-2 border-[#5b4b38] bg-[#faf7f2] flex items-center justify-between cursor-pointer payment-method-card transition";
            const radio = event.currentTarget.querySelector('input[type="radio"]');
            if (radio) radio.checked = true;

            const qrisBox = document.getElementById('method-qris-display');
            const vaBox = document.getElementById('method-va-display');

            if (methodName.includes('Virtual Account')) {
                qrisBox.classList.add('hidden');
                vaBox.classList.remove('hidden');
            } else {
                qrisBox.classList.remove('hidden');
                vaBox.classList.add('hidden');
            }
        }

        function copyVA() {
            const text = document.getElementById('va-number-text').textContent.replace(/\s+/g, '');
            navigator.clipboard.writeText(text);
            alert('Nomor Virtual Account berhasil disalin: ' + text);
        }

        function previewProofImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-preview-img').src = e.target.result;
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('upload-preview-box').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        function removeProofImage() {
            document.getElementById('payment_proof_input').value = '';
            document.getElementById('upload-preview-img').src = '';
            document.getElementById('upload-placeholder').classList.remove('hidden');
            document.getElementById('upload-preview-box').classList.add('hidden');
        }

        // ==================== 7-DAY COUNTDOWN & QRIS REFRESH LOGIC ====================
        const BOOKING_ID = "{{ $booking['id'] }}";
        const QRIS_STORAGE_KEY = 'dreamday_qris_expiry_' + BOOKING_ID;
        const SEVEN_DAYS_MS = 7 * 24 * 60 * 60 * 1000;
        const SERVER_EXPIRES_AT = "{{ !empty($booking['expires_at']) ? \Carbon\Carbon::parse($booking['expires_at'])->toIso8601String() : '' }}";
        let countdownTimerInterval = null;

        function initCountdown() {
            let expiryTime = null;
            if (SERVER_EXPIRES_AT) {
                expiryTime = new Date(SERVER_EXPIRES_AT).getTime();
            } else {
                expiryTime = localStorage.getItem(QRIS_STORAGE_KEY);
                if (!expiryTime) {
                    expiryTime = Date.now() + SEVEN_DAYS_MS;
                    localStorage.setItem(QRIS_STORAGE_KEY, expiryTime);
                } else {
                    expiryTime = parseInt(expiryTime, 10);
                }
            }

            if (countdownTimerInterval) {
                clearInterval(countdownTimerInterval);
            }
            
            updateCountdownDisplay(expiryTime);
            countdownTimerInterval = setInterval(() => updateCountdownDisplay(expiryTime), 1000);
        }

        function updateCountdownDisplay(expiryTime) {
            const currentExpiry = expiryTime || parseInt(localStorage.getItem(QRIS_STORAGE_KEY) || (Date.now() + SEVEN_DAYS_MS), 10);
            const remainingMs = currentExpiry - Date.now();

            const timerEl = document.getElementById('countdown-timer');
            const overlayEl = document.getElementById('qris-expired-overlay');
            const renewBox = document.getElementById('renew-qris-box');

            if (remainingMs <= 0) {
                if (timerEl) timerEl.textContent = '0 Hari (Kadaluarsa)';
                if (overlayEl) overlayEl.classList.remove('hidden');
                if (renewBox) renewBox.classList.remove('hidden');
                if (countdownTimerInterval) clearInterval(countdownTimerInterval);
                return;
            }

            // Still active
            if (overlayEl) overlayEl.classList.add('hidden');
            if (renewBox) renewBox.classList.add('hidden');

            const totalSeconds = Math.floor(remainingMs / 1000);
            const days = Math.max(1, Math.ceil(totalSeconds / 86400));

            if (timerEl) {
                timerEl.textContent = `${days} Hari`;
            }
        }

        function renewQRCode() {
            const newExpiry = Date.now() + SEVEN_DAYS_MS;
            localStorage.setItem(QRIS_STORAGE_KEY, newExpiry);

            const overlayEl = document.getElementById('qris-expired-overlay');
            const renewBox = document.getElementById('renew-qris-box');
            const qrisImg = document.getElementById('qris-img');

            // Quick refresh animation
            if (qrisImg) {
                qrisImg.style.opacity = '0.2';
                setTimeout(() => {
                    qrisImg.style.opacity = '1';
                }, 250);
            }

            if (overlayEl) overlayEl.classList.add('hidden');
            if (renewBox) renewBox.classList.add('hidden');

            initCountdown();
        }

        // Initialize countdown on DOM load
        document.addEventListener('DOMContentLoaded', function() {
            initCountdown();
        });
    </script>

</body>
</html>
