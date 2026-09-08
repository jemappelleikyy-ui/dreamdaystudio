<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking &amp; Reservasi — {{ $service['title'] }} | DreamDay Studio</title>
    <meta name="description" content="Formulir pemesanan dan konfirmasi reservasi layanan eksklusif DreamDay Studio.">

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
        .step-transition {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body class="bg-[#f9f8f6] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER BAR ==================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Back & Brand -->
            <div class="flex items-center gap-4">
                <a href="{{ route('service.detail', ['slug' => $service['slug']]) }}" 
                   class="p-2 rounded-lg text-[#685f58] hover:text-[#27221e] hover:bg-[#f5f0ea] transition flex items-center gap-2 text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Detail Layanan</span>
                </a>
                <div class="h-5 w-px bg-[#e8e2d9] hidden sm:block"></div>
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <span class="font-serif-luxury text-2xl font-bold tracking-tight text-[#27221e] hover:text-[#5b4b38] transition-colors">
                        DreamDay Studio
                    </span>
                </a>
            </div>

            <!-- Right Side: User Profile / Login -->
            <div class="flex items-center gap-4">
                @if(session('is_logged_in'))
                    <a href="{{ route('profile') }}" class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-[#5b4b38]/30 transition group">
                        <img src="{{ asset(session('user_avatar', 'images/profile-avatar.jpg')) }}" alt="Avatar" class="w-9 h-9 rounded-full object-cover border border-[#ede7df]">
                        <span class="hidden md:inline font-semibold text-xs text-[#27221e]">{{ session('user_name', '') }}</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[#27221e] hover:text-[#5b4b38]">Log In</a>
                @endif
            </div>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT WIZARD ==================== -->
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 w-full flex-1 space-y-8">
        
        <!-- Step Progress Bar (Horizontal 1 -> 2 -> 3 from Left to Right) -->
        <div class="bg-white border border-[#ede7df] rounded-2xl p-5 sm:p-7 shadow-xs">
            <div class="relative max-w-2xl mx-auto">
                
                <!-- Horizontal Connecting Line (Left to Right) -->
                <div class="absolute left-8 right-8 top-5 h-0.5 bg-[#ede7df] z-0">
                    <div id="step-progress-fill" class="h-full bg-[#5b4b38] transition-all duration-300 w-0"></div>
                </div>

                <!-- 3 Steps Horizontal Flex Container -->
                <div class="flex items-center justify-between relative z-10 w-full">
                    
                    <!-- Step 1: Form Pemesanan (Left) -->
                    <div id="step-indicator-1" class="flex flex-col items-center gap-2 cursor-pointer group flex-1" onclick="goToStep(1)">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#5b4b38] text-white shadow-xs step-circle ring-4 ring-white transition-all duration-200">
                            1
                        </div>
                        <span class="text-xs font-bold text-[#27221e] step-label text-center">
                            Form Pemesanan
                        </span>
                    </div>

                    <!-- Step 2: Form Layanan (Middle) -->
                    <div id="step-indicator-2" class="flex flex-col items-center gap-2 cursor-pointer group flex-1" onclick="goToStep(2)">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#ede7df] text-[#685f58] step-circle ring-4 ring-white transition-all duration-200">
                            2
                        </div>
                        <span class="text-xs font-medium text-[#8d8277] step-label text-center">
                            Form Layanan
                        </span>
                    </div>

                    <!-- Step 3: Konfirmasi Booking (Right) -->
                    <div id="step-indicator-3" class="flex flex-col items-center gap-2 cursor-pointer group flex-1" onclick="goToStep(3)">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#ede7df] text-[#685f58] step-circle ring-4 ring-white transition-all duration-200">
                            3
                        </div>
                        <span class="text-xs font-medium text-[#8d8277] step-label text-center">
                            Konfirmasi Booking
                        </span>
                    </div>

                </div>

            </div>
        </div>

        <!-- Two Column Form & Order Summary Layout -->
        <form id="booking-main-form" action="{{ route('booking.checkout') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf
            
            <input type="hidden" name="service_slug" id="service_slug" value="{{ $service['slug'] }}">
            <input type="hidden" name="service_title" id="service_title" value="{{ $service['title'] }}">
            <input type="hidden" name="service_image" id="service_image" value="{{ $service['image'] }}">
            <input type="hidden" name="subtotal" id="form_subtotal" value="{{ $service['price'] }}">
            <input type="hidden" name="tax" id="form_tax" value="{{ $service['price'] * 0.1 }}">
            <input type="hidden" name="total_price" id="form_total" value="{{ $service['price'] * 1.1 }}">

            <!-- ==================== LEFT COLUMN: WIZARD STEPS ==================== -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- ==================== STEP 1: ISI FORM PEMESANAN ==================== -->
                <div id="step-panel-1" class="bg-white border border-[#ede7df] rounded-2xl p-6 sm:p-8 shadow-xs space-y-6 step-panel">
                    <div>
                        <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">LANGKAH 1 DARI 3</span>
                        <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-1">
                            Isi Form Pemesanan
                        </h2>
                        <p class="text-xs sm:text-sm text-[#685f58] mt-1">
                            Lengkapi informasi kontak dan jadwal acara untuk reservasi Anda.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-2">
                        <!-- Customer Name -->
                        <div class="space-y-1.5">
                            <label for="customer_name" class="block text-xs font-semibold text-[#554d46]">Nama Lengkap Pemesan *</label>
                            <input type="text" 
                                   id="customer_name" 
                                   name="customer_name" 
                                   value="{{ old('customer_name', session('user_name', '')) }}" 
                                   placeholder="Contoh: Muhammad Rizky"
                                   required 
                                   class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                        </div>

                        <!-- Customer Email -->
                        <div class="space-y-1.5">
                            <label for="customer_email" class="block text-xs font-semibold text-[#554d46]">Email Kontak *</label>
                            <input type="email" 
                                   id="customer_email" 
                                   name="customer_email" 
                                   value="{{ old('customer_email', session('user_email', '')) }}" 
                                   placeholder="contoh@gmail.com"
                                   required 
                                   class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                        </div>

                        <!-- Customer Phone -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="customer_phone" class="block text-xs font-semibold text-[#554d46]">Nomor WhatsApp / HP *</label>
                                <span id="phone-error-hint" class="text-[0.7rem] text-rose-600 font-bold hidden animate-pulse">Wajib diisi!</span>
                            </div>
                            <input type="tel" 
                                   id="customer_phone" 
                                   name="customer_phone" 
                                   value="{{ old('customer_phone', session('user_phone', '')) }}" 
                                   placeholder="Contoh: 081234567890" 
                                   required 
                                   class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                            <p class="text-[0.7rem] text-[#8d8277]">Nomor ini akan digunakan Admin untuk konfirmasi pesanan via WhatsApp.</p>
                        </div>

                        <!-- Event Date -->
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="event_date" class="block text-xs font-semibold text-[#554d46]">Tanggal Acara *</label>
                                <span id="date-avail-status" class="text-[0.7rem] font-bold transition-all"></span>
                            </div>
                            <input type="date" 
                                   id="event_date" 
                                   name="event_date" 
                                   value="{{ old('event_date', $defaultDate ?? date('Y-m-d', strtotime('+30 days'))) }}" 
                                   required 
                                   class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                            <div class="flex items-center justify-between text-[0.72rem] text-[#685f58] pt-0.5">
                                <span>Jadwal Terpilih:</span>
                                <span id="event_date_formatted_display" class="font-bold text-[#5b4b38] bg-[#f5efe6] px-2.5 py-0.5 rounded-lg border border-[#e8dfd3]">-</span>
                            </div>
                            <p id="date-avail-hint" class="text-[0.7rem] text-[#8d8277]">Pilih tanggal pelaksanaan acara pernikahan / acara Anda.</p>
                        </div>

                        <!-- Event Time -->
                        <div class="space-y-1.5">
                            <label for="event_time" class="block text-xs font-semibold text-[#554d46]">Waktu &amp; Sesi Acara *</label>
                            <select id="event_time" 
                                    name="event_time" 
                                    class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                                <option value="Sore - Malam (16:00 - 22:00 WIB)" selected>Sore - Malam (16:00 - 22:00 WIB)</option>
                                <option value="Pagi - Siang (09:00 - 14:00 WIB)">Pagi - Siang (09:00 - 14:00 WIB)</option>
                                <option value="Full Day Experience (10:00 - 23:00 WIB)">Full Day Experience (10:00 - 23:00 WIB)</option>
                            </select>
                        </div>

                        <!-- Estimated Guests -->
                        <div class="space-y-1.5">
                            <label for="guest_count" class="block text-xs font-semibold text-[#554d46]">Estimasi Jumlah Tamu *</label>
                            <select id="guest_count" 
                                    name="guest_count" 
                                    class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                                <option value="50 - 150 Tamu (Intimate)">50 - 150 Tamu (Intimate)</option>
                                <option value="150 - 300 Tamu (Standard)" selected>150 - 300 Tamu (Standard)</option>
                                <option value="300 - 600 Tamu (Grand)">300 - 600 Tamu (Grand)</option>
                                <option value="600+ Tamu (Royal)">600+ Tamu (Royal)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Event Location -->
                    <div class="space-y-1.5">
                        <label for="event_location" class="block text-xs font-semibold text-[#554d46]">Lokasi / Kota Pelaksanaan *</label>
                        <input type="text" 
                               id="event_location" 
                               name="event_location" 
                               value="{{ $service['location'] }}" 
                               required 
                               class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 flex justify-end">
                        <button type="button" onclick="goToStep(2)" class="px-6 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium text-sm shadow-xs transition cursor-pointer flex items-center gap-2">
                            <span>Lanjut: Form Layanan</span>
                            <span>→</span>
                        </button>
                    </div>
                </div>

                <!-- ==================== STEP 2: ISI FORM LAYANAN ==================== -->
                <div id="step-panel-2" class="bg-white border border-[#ede7df] rounded-2xl p-6 sm:p-8 shadow-xs space-y-6 step-panel hidden">
                    <div>
                        <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">LANGKAH 2 DARI 3</span>
                        <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-1">
                            Isi Form Layanan &amp; Kustomisasi
                        </h2>
                        <p class="text-xs sm:text-sm text-[#685f58] mt-1">
                            Pilih paket utama dan tambahkan opsi pelengkap sesuai impian pernikahan Anda.
                        </p>
                    </div>

                    <!-- Selected Base Package Info -->
                    <div class="p-4 rounded-xl bg-[#faf8f5] border border-[#ede7df] flex items-center gap-4">
                        <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-16 h-16 rounded-xl object-cover border border-[#ede7df]">
                        <div class="flex-1">
                            <h3 class="font-bold text-sm sm:text-base text-[#27221e]">{{ $service['title'] }}</h3>
                            <p class="text-xs text-[#8d8277]">{{ $service['category'] }} • {{ $service['location'] }}</p>
                            <p class="text-xs font-bold text-[#5b4b38] mt-0.5">{{ $service['price_formatted'] }} (Paket Utama)</p>
                        </div>
                    </div>

                    <!-- Custom Add-ons Selection -->
                    <div class="space-y-3">
                        <h3 class="font-semibold text-sm text-[#27221e]">
                            Pilih Opsi Tambahan (Add-ons):
                        </h3>
                        
                        @foreach($service['addons'] as $addon)
                            <label class="flex items-center justify-between p-4 rounded-xl border border-[#ded5cb] hover:border-[#5b4b38] transition cursor-pointer bg-white">
                                <div class="flex items-center gap-3">
                                    <input type="checkbox" 
                                           name="addons[]" 
                                           value="{{ $addon['name'] }}" 
                                           data-price="{{ $addon['price'] }}" 
                                           class="addon-checkbox w-4 h-4 rounded text-[#5b4b38] focus:ring-[#5b4b38]" 
                                           onchange="recalculateTotal()">
                                    <div>
                                        <div class="text-xs sm:text-sm font-semibold text-[#27221e]">{{ $addon['name'] }}</div>
                                        <div class="text-[0.7rem] text-[#8d8277]">Termasuk setup &amp; koordinasi kru</div>
                                    </div>
                                </div>
                                <span class="text-xs sm:text-sm font-bold text-[#5b4b38]">
                                    {{ $addon['price_formatted'] }}
                                </span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Special Requests / Notes -->
                    <div class="space-y-1.5">
                        <label for="notes" class="block text-xs font-semibold text-[#554d46]">Catatan / Permintaan Khusus Acara</label>
                        <textarea id="notes" 
                                  name="notes" 
                                  rows="3" 
                                  placeholder="Contoh: Tema warna warm blush & champagne gold, request koordinasi dengan MUA..." 
                                  class="w-full px-4 py-3 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition"></textarea>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="pt-4 flex items-center justify-between border-t border-[#f2ece5]">
                        <button type="button" onclick="goToStep(1)" class="px-5 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] transition cursor-pointer">
                            ← Kembali
                        </button>
                        <button type="button" onclick="goToStep(3)" class="px-6 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium text-sm shadow-xs transition cursor-pointer flex items-center gap-2">
                            <span>Lanjut: Konfirmasi Booking</span>
                            <span>→</span>
                        </button>
                    </div>
                </div>

                <!-- ==================== STEP 3: KONFIRMASI BOOKING ==================== -->
                <div id="step-panel-3" class="bg-white border border-[#ede7df] rounded-2xl p-6 sm:p-8 shadow-xs space-y-6 step-panel hidden">
                    <div>
                        <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">LANGKAH 3 DARI 3</span>
                        <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-1">
                            Konfirmasi Rincian Booking
                        </h2>
                        <p class="text-xs sm:text-sm text-[#685f58] mt-1">
                            Periksa ringkasan pesanan sebelum reservasi Anda dibuat secara resmi.
                        </p>
                    </div>

                    <!-- Review Cards Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Card 1: Data Acara -->
                        <div class="p-4 rounded-xl bg-[#faf8f5] border border-[#ede7df] space-y-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#8d8277]">Data Acara</h4>
                            <div class="text-xs space-y-1 text-[#27221e]">
                                <p><span class="text-[#8d8277]">Tanggal:</span> <strong id="review-date">-</strong></p>
                                <p><span class="text-[#8d8277]">Waktu:</span> <strong id="review-time">-</strong></p>
                                <p><span class="text-[#8d8277]">Lokasi:</span> <strong id="review-location">-</strong></p>
                                <p><span class="text-[#8d8277]">Jumlah Tamu:</span> <strong id="review-guests">-</strong></p>
                            </div>
                        </div>

                        <!-- Card 2: Data Pemesan -->
                        <div class="p-4 rounded-xl bg-[#faf8f5] border border-[#ede7df] space-y-2">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-[#8d8277]">Data Pemesan</h4>
                            <div class="text-xs space-y-1 text-[#27221e]">
                                <p><span class="text-[#8d8277]">Nama:</span> <strong id="review-name">-</strong></p>
                                <p><span class="text-[#8d8277]">Email:</span> <strong id="review-email">-</strong></p>
                                <p><span class="text-[#8d8277]">WhatsApp:</span> <strong id="review-phone">-</strong></p>
                            </div>
                        </div>
                    </div>

                    <!-- Selected Add-ons Review -->
                    <div class="p-4 rounded-xl border border-[#ede7df] space-y-2">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-[#8d8277]">Add-ons Terpilih</h4>
                        <div id="review-addons-list" class="text-xs text-[#554d46] space-y-1">
                            <span class="italic text-[#8d8277]">Tidak ada opsi tambahan dipilih</span>
                        </div>
                    </div>

                    <!-- Down Payment Highlight Info Card -->
                    <div class="p-5 rounded-2xl bg-[#faf7f2] border border-[#e8dfd3] space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold bg-[#5b4b38] text-white">SISTEM PEMBAYARAN DP</span>
                            <span class="text-xs font-bold text-[#5b4b38]">Ketentuan Pembayaran Bertahap</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs text-[#554d46]">
                            <div class="p-3 bg-white rounded-xl border border-[#ede7df]">
                                <span class="text-[0.7rem] text-[#8d8277] block">Uang Muka (DP {{ $dpPercentage }}%):</span>
                                <span class="text-base font-bold text-[#5b4b38]" id="review-dp-amount">Rp 0</span>
                                <p class="text-[0.65rem] text-[#8d8277] mt-0.5">Dibayar untuk konfirmasi &amp; penguncian jadwal</p>
                            </div>
                            <div class="p-3 bg-white rounded-xl border border-[#ede7df]">
                                <span class="text-[0.7rem] text-[#8d8277] block">Sisa Pembayaran (Pelunasan):</span>
                                <span class="text-base font-bold text-[#27221e]" id="review-remaining-amount">Rp 0</span>
                                <p class="text-[0.65rem] text-[#8d8277] mt-0.5">Dibayarkan setelah DP terverifikasi</p>
                            </div>
                        </div>
                        <p class="text-[0.75rem] text-[#685f58] leading-relaxed">
                            💡 <strong>Informasi Alur Booking &amp; Pembayaran:</strong> Setelah mengonfirmasi rincian acara di bawah, data reservasi Anda akan dikirimkan langsung ke Admin dengan status <strong>Menunggu Konfirmasi Admin</strong>. Setelah pesanan disetujui Admin, Anda akan menerima akses pembayaran Down Payment (DP {{ $dpPercentage }}%) dengan batas waktu 7 hari untuk mengamankan dan mengunci jadwal venue.
                        </p>
                    </div>

                    <!-- Agreement Checkbox -->
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-[#fcfaf7] border border-[#ede7df]">
                        <input type="checkbox" id="terms_agreement" required checked class="w-4 h-4 mt-0.5 rounded text-[#5b4b38] focus:ring-[#5b4b38]">
                        <label for="terms_agreement" class="text-xs text-[#685f58] cursor-pointer">
                            Saya mengonfirmasi bahwa seluruh rincian acara di atas sudah benar dan menyetujui <a href="{{ route('home') }}#terms" target="_blank" class="text-[#5b4b38] font-semibold underline">Syarat &amp; Ketentuan Layanan</a> DreamDay Studio.
                        </label>
                    </div>

                    <!-- Navigation Buttons & Submit -->
                    <div class="pt-4 flex items-center justify-between border-t border-[#f2ece5]">
                        <button type="button" onclick="goToStep(2)" class="px-5 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] transition cursor-pointer">
                            ← Kembali
                        </button>
                        <button type="submit" id="btn-submit-booking" class="px-7 py-3.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-sm shadow-md hover:shadow-lg transition duration-200 cursor-pointer flex items-center gap-2">
                            <span>Kirim Permintaan Booking</span>
                            <span>→</span>
                        </button>
                    </div>
                </div>

            </div>

            <!-- ==================== RIGHT COLUMN: LIVE ORDER SUMMARY ==================== -->
            <div class="lg:col-span-4 lg:sticky lg:top-28">
                <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-7 shadow-xl space-y-6">
                    
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e] pb-3 border-b border-[#f2ece5]">
                        Ringkasan Pemesanan
                    </h3>

                    <!-- Service Thumbnail & Title -->
                    <div class="flex items-center gap-3.5">
                        <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-14 h-14 rounded-xl object-cover border border-[#ede7df] shrink-0">
                        <div class="min-w-0">
                            <h4 class="font-bold text-xs sm:text-sm text-[#27221e] truncate">{{ $service['title'] }}</h4>
                            <p class="text-[0.7rem] text-[#8d8277]">{{ $service['category'] }}</p>
                        </div>
                    </div>

                    <!-- Price Calculations Table -->
                    <div class="space-y-2.5 text-xs text-[#554d46] pt-2 border-t border-[#f2ece5]">
                        <div class="flex items-center justify-between">
                            <span>Harga Paket Dasar</span>
                            <span class="font-semibold text-[#27221e]">{{ $service['price_formatted'] }}</span>
                        </div>

                        <div class="flex items-center justify-between" id="summary-addons-row">
                            <span>Opsi Tambahan (Add-ons)</span>
                            <span class="font-semibold text-[#27221e]" id="summary-addons-total">Rp 0</span>
                        </div>

                        <div class="flex items-center justify-between text-[#8d8277]">
                            <span>Pajak &amp; Biaya Layanan (10%)</span>
                            <span class="font-medium" id="summary-tax">Rp 14.500.000</span>
                        </div>

                        <div class="pt-3 border-t border-[#f2ece5] flex items-center justify-between text-sm sm:text-base font-bold text-[#27221e]">
                            <span>Total Biaya Acara</span>
                            <span class="font-serif-luxury text-lg sm:text-xl text-[#27221e]" id="summary-grand-total">
                                Rp 159.500.000
                            </span>
                        </div>

                        <!-- Down Payment Box in Summary -->
                        <div class="p-3.5 rounded-2xl bg-[#faf7f2] border border-[#e8dfd3] space-y-2 mt-2">
                            <div class="flex items-center justify-between font-bold text-xs text-[#5b4b38]">
                                <span>Estimasi DP ({{ $dpPercentage }}%)</span>
                                <span class="font-serif-luxury text-sm font-bold text-[#5b4b38]" id="summary-dp-amount">
                                    Rp 47.850.000
                                </span>
                            </div>
                            <div class="flex items-center justify-between text-[0.7rem] text-[#8d8277]">
                                <span>Sisa Pelunasan</span>
                                <span class="font-medium text-[#685f58]" id="summary-remaining-amount">
                                    Rp 111.650.000
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="p-3.5 rounded-xl bg-[#faf8f5] border border-[#ede7df] space-y-2 text-[0.7rem] text-[#685f58]">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Garansi Perlindungan &amp; Transaksi Aman</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#5b4b38] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Pembayaran DP Setelah Konfirmasi Admin</span>
                        </div>
                    </div>

                </div>
            </div>

    </main>

    <!-- ==================== POPUP: TANGGAL SUDAH DIRESERVASI (EKSKLUSIF & PROFESIONAL) ==================== -->
    <div id="modal-date-booked-warning" class="fixed inset-0 z-50 bg-black/65 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300 opacity-0 pointer-events-none">
        <div id="modal-date-booked-card" class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-lg w-full p-6 sm:p-8 text-center space-y-6 transform scale-95 transition-all duration-300 relative overflow-hidden">
            
            <!-- Luxury Top Accent Bar -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-amber-600 via-rose-600 to-amber-700"></div>

            <!-- Premium Badge & Icon -->
            <div class="flex flex-col items-center gap-3 pt-2">
                <div class="w-16 h-16 rounded-2xl bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center shadow-inner relative">
                    <svg class="w-8 h-8 text-rose-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l4 4m0-4l-4 4" class="text-rose-700 font-bold" />
                    </svg>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-rose-600 text-white text-[9px] font-bold items-center justify-center">!</span>
                    </span>
                </div>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[0.7rem] font-bold uppercase tracking-wider bg-rose-100 text-rose-800 border border-rose-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                    Slot Jadwal Telah Terisi
                </span>
            </div>

            <!-- Title & Detailed Friendly Copy -->
            <div class="space-y-2.5">
                <h3 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] leading-snug">
                    Tanggal Sudah Direservasi
                </h3>
                <p class="text-xs sm:text-sm text-[#685f58] leading-relaxed">
                    Mohon maaf, tanggal <span id="modal-date-booked-text" class="font-bold text-[#c62828] bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200">-</span> untuk layanan <span class="font-bold text-[#27221e]">{{ $service['title'] }}</span> saat ini <span class="font-semibold text-rose-700">sudah memiliki reservasi aktif</span> oleh pemesan lain.
                </p>
                <p class="text-xs text-[#8d8277] italic bg-[#faf8f5] p-3 rounded-xl border border-[#ede7df]">
                    Demi menjaga komitmen mutu dan standar layanan eksklusif, setiap slot tanggal hanya dialokasikan untuk 1 penyelenggara. Silakan memilih tanggal alternatif lainnya.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-2.5 pt-2">
                <button type="button" 
                        onclick="closeDateBookedModal(true)" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-semibold text-sm shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Pilih Tanggal Lain</span>
                </button>

                <a href="https://wa.me/6281234567890?text=Halo%20DreamDay%20Studio,%20saya%20ingin%20konsultasi%20jadwal%20alternatif%20untuk%20{{ urlencode($service['title']) }}" 
                   target="_blank" 
                   class="w-full py-3 px-6 rounded-xl border border-[#ded5cb] hover:border-[#b0a597] bg-white text-[#27221e] font-medium text-xs flex items-center justify-center gap-2 transition duration-200">
                    <svg class="w-4 h-4 text-emerald-600 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                    </svg>
                    <span>Konsultasi Slot Jadwal (WhatsApp)</span>
                </a>
            </div>

        </div>
    </div>

    <!-- ==================== POPUP: RESERVASI BERHASIL DIPROSES ==================== -->
    <div id="modal-booking-processing" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-md w-full p-6 sm:p-8 text-center space-y-5 animate-in fade-in zoom-in duration-300">
            <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center mx-auto border border-amber-200 shadow-xs">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="space-y-2">
                <span class="text-[0.7rem] uppercase font-bold tracking-widest text-[#8d8277]">DREAMDAY STUDIO</span>
                <h3 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                    Booking Berhasil Dikirim!
                </h3>
                <p class="text-xs sm:text-sm text-[#685f58] leading-relaxed">
                    Booking Anda berhasil dikirim dan sedang menunggu konfirmasi admin. Pilihan pembayaran DP akan aktif setelah admin menyetujui reservasi Anda.
                </p>
            </div>
            <div class="flex items-center justify-center gap-2 pt-2">
                <div class="w-2 h-2 rounded-full bg-[#5b4b38] animate-ping"></div>
                <span class="text-xs font-semibold text-[#5b4b38]">Menuju Riwayat Booking...</span>
            </div>
        </div>
    </div>

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
                <span class="text-[#cfc5ba] hidden sm:inline">•</span>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
            </div>
        </div>
    </footer>

    <!-- Script for Multi-step Wizard & Real-time Calculator -->
    <script>
        const basePrice = {{ $service['price'] }};
        const dpPct = {{ $dpPercentage }};
        let currentStep = 1;

        function formatRupiah(number) {
            return 'Rp ' + number.toLocaleString('id-ID');
        }

        function recalculateTotal() {
            const checkboxes = document.querySelectorAll('.addon-checkbox:checked');
            let addonsTotal = 0;
            const selectedAddonNames = [];

            checkboxes.forEach(cb => {
                const price = parseFloat(cb.getAttribute('data-price')) || 0;
                addonsTotal += price;
                selectedAddonNames.push(cb.value);
            });

            const subtotal = basePrice + addonsTotal;
            const tax = subtotal * 0.1;
            const grandTotal = subtotal + tax;
            const dpAmount = Math.round(grandTotal * dpPct / 100);
            const remainingAmount = Math.max(0, grandTotal - dpAmount);

            // Update display
            document.getElementById('summary-addons-total').textContent = formatRupiah(addonsTotal);
            document.getElementById('summary-tax').textContent = formatRupiah(tax);
            document.getElementById('summary-grand-total').textContent = formatRupiah(grandTotal);
            document.getElementById('summary-dp-amount').textContent = formatRupiah(dpAmount);
            document.getElementById('summary-remaining-amount').textContent = formatRupiah(remainingAmount);
            
            const reviewDp = document.getElementById('review-dp-amount');
            if (reviewDp) reviewDp.textContent = formatRupiah(dpAmount);
            const reviewRemaining = document.getElementById('review-remaining-amount');
            if (reviewRemaining) reviewRemaining.textContent = formatRupiah(remainingAmount);

            // Update form hidden inputs
            document.getElementById('form_subtotal').value = subtotal;
            document.getElementById('form_tax').value = tax;
            document.getElementById('form_total').value = grandTotal;

            // Update review addons list
            const reviewList = document.getElementById('review-addons-list');
            if (reviewList) {
                if (selectedAddonNames.length > 0) {
                    reviewList.innerHTML = selectedAddonNames.map(name => `<div>• ${name}</div>`).join('');
                } else {
                    reviewList.innerHTML = '<span class="italic text-[#8d8277]">Tidak ada opsi tambahan dipilih</span>';
                }
            }
        }

        function updateReviewData() {
            document.getElementById('review-name').textContent = document.getElementById('customer_name').value || '-';
            document.getElementById('review-email').textContent = document.getElementById('customer_email').value || '-';
            document.getElementById('review-phone').textContent = document.getElementById('customer_phone').value || '-';
            document.getElementById('review-date').textContent = document.getElementById('event_date').value || '-';
            document.getElementById('review-time').textContent = document.getElementById('event_time').value || '-';
            document.getElementById('review-location').textContent = document.getElementById('event_location').value || '-';
            document.getElementById('review-guests').textContent = document.getElementById('guest_count').value || '-';
        }

        function validateStep1() {
            const nameInput = document.getElementById('customer_name');
            const emailInput = document.getElementById('customer_email');
            const phoneInput = document.getElementById('customer_phone');
            const dateInput = document.getElementById('event_date');
            const locInput = document.getElementById('event_location');
            const phoneHint = document.getElementById('phone-error-hint');

            let isValid = true;

            // Reset error styles
            [nameInput, emailInput, phoneInput, dateInput, locInput].forEach(input => {
                if (input) {
                    input.classList.remove('border-rose-500', 'ring-2', 'ring-rose-200');
                }
            });
            if (phoneHint) phoneHint.classList.add('hidden');

            if (!phoneInput || !phoneInput.value.trim()) {
                if (phoneInput) {
                    phoneInput.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                    phoneInput.focus();
                }
                if (phoneHint) phoneHint.classList.remove('hidden');
                isValid = false;
            }

            if (!nameInput || !nameInput.value.trim()) {
                if (nameInput) {
                    nameInput.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                    if (isValid) nameInput.focus();
                }
                isValid = false;
            }

            if (!emailInput || !emailInput.value.trim()) {
                if (emailInput) {
                    emailInput.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                    if (isValid) emailInput.focus();
                }
                isValid = false;
            }

            if (!dateInput || !dateInput.value.trim()) {
                if (dateInput) {
                    dateInput.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                    if (isValid) dateInput.focus();
                }
                isValid = false;
            } else if (bookedDatesList.includes(dateInput.value.trim())) {
                showDateBookedModal(dateInput.value.trim());
                return false;
            }

            return isValid;
        }

        function goToStep(step) {
            if (step > 1 && currentStep === 1) {
                if (!validateStep1()) {
                    return;
                }
            }

            if (step === 3) {
                updateReviewData();
            }

            // Update Progress Fill Line
            const progressFill = document.getElementById('step-progress-fill');
            if (progressFill) {
                if (step === 1) progressFill.style.width = '0%';
                else if (step === 2) progressFill.style.width = '50%';
                else if (step === 3) progressFill.style.width = '100%';
            }

            // Hide all panels
            for (let i = 1; i <= 3; i++) {
                const panel = document.getElementById(`step-panel-${i}`);
                if (panel) panel.classList.add('hidden');
                
                const ind = document.getElementById(`step-indicator-${i}`);
                if (ind) {
                    const circle = ind.querySelector('.step-circle');
                    const label = ind.querySelector('.step-label');
                    if (i < step) {
                        circle.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-emerald-600 text-white step-circle ring-4 ring-white shadow-xs transition-all duration-200";
                        circle.innerHTML = "✓";
                        label.className = "text-xs font-semibold text-emerald-700 step-label text-center";
                    } else if (i === step) {
                        circle.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#5b4b38] text-white shadow-xs step-circle ring-4 ring-white transition-all duration-200";
                        circle.innerHTML = i;
                        label.className = "text-xs font-bold text-[#27221e] step-label text-center";
                    } else {
                        circle.className = "w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm bg-[#ede7df] text-[#685f58] step-circle ring-4 ring-white transition-all duration-200";
                        circle.innerHTML = i;
                        label.className = "text-xs font-medium text-[#8d8277] step-label text-center";
                    }
                }
            }

            const targetPanel = document.getElementById(`step-panel-${step}`);
            if (targetPanel) targetPanel.classList.remove('hidden');
            currentStep = step;
            window.scrollTo({ top: 120, behavior: 'smooth' });
        }

        // ==================== INTERACTIVE AVAILABILITY & DATE CHECK ====================
        const bookedDatesList = @json($bookedDates ?? []);
        const serverBookedError = @json(session('error_booked_date') ?? null);
        let selectedDateStr = document.getElementById('event_date') ? document.getElementById('event_date').value : '';

        const monthNamesIndo = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        function formatDateIndo(dateStr) {
            if (!dateStr) return '-';
            const parts = dateStr.split('-');
            if (parts.length !== 3) return dateStr;
            const y = parseInt(parts[0], 10);
            const m = parseInt(parts[1], 10);
            const d = parseInt(parts[2], 10);
            return `${d} ${monthNamesIndo[m - 1]} ${y}`;
        }

        function checkDateAvailability(dateStr) {
            if (!dateStr) return true;
            const isBooked = bookedDatesList.includes(dateStr);
            const statusPill = document.getElementById('date-avail-status');
            const hintPill = document.getElementById('date-avail-hint');
            const dateInput = document.getElementById('event_date');
            const formattedDisplay = document.getElementById('event_date_formatted_display');

            if (formattedDisplay) {
                formattedDisplay.textContent = formatDateIndo(dateStr);
            }

            if (statusPill) {
                if (isBooked) {
                    statusPill.className = "text-[0.7rem] font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-md border border-rose-200 animate-pulse";
                    statusPill.innerHTML = "✕ Sudah Ada Reservasi";
                    if (dateInput) {
                        dateInput.classList.add('border-rose-500', 'ring-2', 'ring-rose-200');
                    }
                    if (hintPill) {
                        hintPill.className = "text-[0.7rem] text-rose-600 font-medium";
                        hintPill.textContent = "Tanggal ini telah terisi oleh reservasi lain. Silakan pilih tanggal lain.";
                    }
                } else {
                    statusPill.className = "text-[0.7rem] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200";
                    statusPill.innerHTML = "✓ Jadwal Tersedia";
                    if (dateInput) {
                        dateInput.classList.remove('border-rose-500', 'ring-2', 'ring-rose-200');
                    }
                    if (hintPill) {
                        hintPill.className = "text-[0.7rem] text-[#8d8277]";
                        hintPill.textContent = "Pilih tanggal pelaksanaan acara pernikahan / acara Anda.";
                    }
                }
            }
            return !isBooked;
        }

        function showDateBookedModal(dateStr) {
            const targetDate = dateStr || (document.getElementById('event_date') ? document.getElementById('event_date').value : '');
            const modal = document.getElementById('modal-date-booked-warning');
            const card = document.getElementById('modal-date-booked-card');
            const textSpan = document.getElementById('modal-date-booked-text');

            if (textSpan) {
                textSpan.textContent = formatDateIndo(targetDate) + ` (${targetDate})`;
            }

            if (modal && card) {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
                card.classList.remove('scale-95');
                card.classList.add('scale-100');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDateBookedModal(focusDateInput = true) {
            const modal = document.getElementById('modal-date-booked-warning');
            const card = document.getElementById('modal-date-booked-card');

            if (modal && card) {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
                card.classList.add('scale-95');
                card.classList.remove('scale-100');
                document.body.style.overflow = '';
            }

            if (focusDateInput) {
                const dateInput = document.getElementById('event_date');
                if (dateInput) {
                    dateInput.focus();
                    dateInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            recalculateTotal();

            const dateInput = document.getElementById('event_date');
            if (dateInput) {
                checkDateAvailability(dateInput.value);

                dateInput.addEventListener('change', (e) => {
                    const val = e.target.value;
                    const isAvail = checkDateAvailability(val);
                    if (!isAvail) {
                        showDateBookedModal(val);
                    }
                });
            }

            // If server returned flash error for booked date
            if (serverBookedError) {
                showDateBookedModal(serverBookedError);
            }

            const form = document.getElementById('booking-main-form');
            if (form) {
                form.addEventListener('submit', (e) => {
                    if (!validateStep1()) {
                        e.preventDefault();
                        goToStep(1);
                        return false;
                    }
                    const procModal = document.getElementById('modal-booking-processing');
                    if (procModal) {
                        procModal.classList.remove('hidden');
                    }
                });
            }
        });
    </script>

    @include('partials.customer-chat')

</body>
</html>
