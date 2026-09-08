<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $service['title'] }} — DreamDay Studio</title>
    <meta name="description" content="{{ $service['description'] }}">

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
    </style>
</head>
@php
    $listUrl = route('single-services');
    $listName = 'Services';
    if (isset($service['category'])) {
        $catLower = strtolower($service['category']);
        if (str_contains($catLower, 'venue')) {
            $listUrl = route('venues.index');
            $listName = 'Venues';
        } elseif (str_contains($catLower, 'paket') || str_contains($catLower, 'package')) {
            $listUrl = route('full-event-packages');
            $listName = 'Packages';
        } else {
            $listUrl = route('single-services');
            $listName = 'Services';
        }
    }
@endphp
<body class="bg-white text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">    <!-- ==================== HEADER BAR ==================== -->
    <header class="w-full bg-white border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Back Button & Brand Logo -->
            <div class="flex items-center gap-4">
                <a href="{{ $listUrl }}" class="p-2 rounded-lg text-[#685f58] hover:text-[#27221e] hover:bg-[#f5f0ea] transition flex items-center gap-2 text-sm font-medium group cursor-pointer" title="Kembali ke {{ $listName }}">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline font-semibold">Kembali</span>
                </a>
                <div class="h-5 w-px bg-[#e8e2d9] hidden sm:block"></div>
                <a href="{{ route('home') }}" class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#6b513a] hover:text-[#523d2b] transition-colors">
                    DreamDay Studio
                </a>
            </div>

            <!-- Right Side: Header Quick Links & User Avatar -->
            <div class="flex items-center gap-4 sm:gap-6 text-xs text-[#685f58]">
                @if(session('is_logged_in'))
                    <a href="{{ route('profile') }}" 
                       class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-[#5b4b38]/30 transition group cursor-pointer"
                       title="Profil {{ session('user_name', '') }}">
                        <img src="{{ asset(session('user_avatar', 'images/profile-avatar.jpg')) }}" 
                             alt="Foto Profil {{ session('user_name', '') }}" 
                             class="w-8 h-8 rounded-full object-cover border-2 border-[#d6ccc2] group-hover:border-[#5b4b38] shadow-xs group-hover:scale-105 transition-all duration-200">
                        <span class="hidden md:inline font-semibold text-xs text-[#27221e] group-hover:text-[#5b4b38]">
                            {{ session('user_name', '') }}
                        </span>
                    </a>
                @endif
                <div class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                    <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                    <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
                </div>
            </div>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 w-full flex-1 space-y-10">
        
        <!-- Breadcrumb Navigation -->
        <nav class="flex items-center gap-2 text-xs text-[#8d8277]">
            <a href="{{ route('home') }}" class="hover:text-[#5b4b38] transition">Beranda</a>
            <span>/</span>
            <a href="{{ $listUrl }}" class="hover:text-[#5b4b38] transition">{{ $listName }}</a>
            <span>/</span>
            <span class="text-[#27221e] font-semibold truncate">{{ $service['title'] }}</span>
        </nav>

        <!-- Hero Media Showcase Banner -->
        <div class="relative w-full aspect-[16/9] sm:aspect-[21/9] rounded-3xl overflow-hidden shadow-lg border border-[#ede7df]">
            <img src="{{ asset($service['image']) }}" 
                 alt="{{ $service['title'] }}" 
                 class="w-full h-full object-cover">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-10">
                <div class="space-y-2 max-w-3xl">
                    <span class="inline-block bg-[#5b4b38] text-white text-[0.7rem] font-bold uppercase tracking-widest px-3 py-1 rounded-md shadow-xs">
                        {{ $service['category'] }}
                    </span>
                    <h1 class="font-serif-luxury text-2xl sm:text-4xl md:text-5xl font-bold text-white tracking-tight leading-tight">
                        {{ $service['title'] }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-xs sm:text-sm text-[#e2dcd4] pt-1">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <strong class="text-white">{{ $service['rating'] }}</strong>
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-[#ede7df]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $service['location'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2 Column Details & Booking Sidebar Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Left 8 Columns: Detail Specifications -->
            <div class="lg:col-span-8 space-y-10">
                
                <!-- Section 1: Overview -->
                <section class="space-y-4">
                    <h2 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                        Deskripsi Layanan
                    </h2>
                    <p class="text-sm sm:text-base text-[#685f58] leading-relaxed">
                        {{ $service['description'] }}
                    </p>
                </section>

                <!-- Section 2: Included Features -->
                <section class="space-y-4 pt-6 border-t border-[#ede7df]">
                    <h2 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                        Fasilitas &amp; Layanan Termasuk
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
                        @foreach($service['highlights'] as $hl)
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#faf8f5] border border-[#ede7df]">
                                <span class="p-1 rounded-full bg-[#5b4b38] text-white shrink-0 mt-0.5">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-xs sm:text-sm font-medium text-[#27221e]">{{ $hl }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Section 3: Available Add-ons -->
                <section class="space-y-4 pt-6 border-t border-[#ede7df]">
                    <div class="flex items-center justify-between">
                        <h2 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                            Pilihan Opsi Tambahan (Add-ons)
                        </h2>
                        <span class="text-xs text-[#8d8277]">Dapat dipilih pada form pemesanan</span>
                    </div>
                    <div class="space-y-3">
                        @foreach($service['addons'] as $addon)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-[#ede7df] hover:border-[#cfc4b6] bg-white transition">
                                <div class="space-y-0.5">
                                    <h3 class="text-xs sm:text-sm font-semibold text-[#27221e]">{{ $addon['name'] }}</h3>
                                    <p class="text-[0.7rem] text-[#8d8277]">Kustomisasi eksklusif saat reservasi</p>
                                </div>
                                <span class="text-xs sm:text-sm font-bold text-[#5b4b38] shrink-0">
                                    {{ $addon['price_formatted'] }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Section 4: Availability Schedule (2 Bulan Kedepan) -->
                @if(isset($availabilities) && $availabilities->count() > 0)
                <section class="space-y-4 pt-6 border-t border-[#ede7df]">
                    <div>
                        <h2 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                            Jadwal Ketersediaan Reservasi
                        </h2>
                        <p class="text-xs text-[#8d8277] mt-0.5">Ketersediaan slot tanggal acara untuk 2 bulan kedepan (60 hari)</p>
                    </div>

                    <!-- Month Switcher Tabs -->
                    <div class="flex items-center gap-2 pt-1 border-b border-[#ede7df]">
                        <button type="button" onclick="switchAvailMonth('all')" id="tab-avail-all" class="avail-tab-btn px-4 py-2 text-xs font-bold border-b-2 border-[#5b4b38] text-[#5b4b38] transition cursor-pointer">
                            Semua (60 Hari)
                        </button>
                        <button type="button" onclick="switchAvailMonth('m1')" id="tab-avail-m1" class="avail-tab-btn px-4 py-2 text-xs font-bold border-b-2 border-transparent text-[#8d8277] hover:text-[#27221e] transition cursor-pointer">
                            Bulan 1 ({{ \Carbon\Carbon::today()->isoFormat('MMMM Y') }})
                        </button>
                        <button type="button" onclick="switchAvailMonth('m2')" id="tab-avail-m2" class="avail-tab-btn px-4 py-2 text-xs font-bold border-b-2 border-transparent text-[#8d8277] hover:text-[#27221e] transition cursor-pointer">
                            Bulan 2 ({{ \Carbon\Carbon::today()->addMonth()->isoFormat('MMMM Y') }})
                        </button>
                    </div>

                    <!-- 60-Day Scrollable Strip -->
                    <div id="avail-container" class="flex gap-3 overflow-x-auto pb-4 pt-2 scrollbar-thin" style="scrollbar-width: thin;">
                        @foreach($availabilities as $avail)
                            @php
                                $cDate = \Carbon\Carbon::parse($avail->date);
                                $monthKey = $cDate->month === \Carbon\Carbon::today()->month ? 'm1' : 'm2';
                                $isBooked = ($avail->status === 'dibooking');
                                
                                // Color rules:
                                // Sudah Ada Reservasi (Booked) = MERAH (Red)
                                // Belum Ada Reservasi (Available) = HIJAU (Green)
                                $cardBg = $isBooked 
                                    ? 'bg-[#ffebee] border-[#ef5350] shadow-xs' 
                                    : 'bg-[#e8f5e9] border-[#81c784] shadow-xs';
                                $textColor = $isBooked ? 'text-[#c62828]' : 'text-[#1b5e20]';
                                $badgeBg = $isBooked ? 'bg-[#ffcdd2] text-[#b71c1c]' : 'bg-[#c8e6c9] text-[#1b5e20]';
                                $statusBadge = $isBooked ? 'Sudah Ada Reservasi' : 'Belum Ada Reservasi';
                                $dayName = $cDate->isoFormat('ddd');
                            @endphp
                            @if(!$isBooked)
                                <a href="{{ route('booking', ['service' => $service['slug'], 'date' => $avail->date]) }}" 
                                   class="avail-card flex-none text-center border-2 rounded-2xl p-3 {{ $cardBg }} min-w-[96px] sm:min-w-[104px] transition-all duration-200 hover:scale-105 block cursor-pointer group hover:shadow-md" 
                                   data-month="{{ $monthKey }}"
                                   title="Klik untuk pesan tanggal ini">
                                    <div class="text-[0.7rem] font-bold text-[#685f58] uppercase">{{ $dayName }}</div>
                                    <div class="text-sm sm:text-base font-extrabold whitespace-nowrap my-1 {{ $textColor }} group-hover:underline">{{ $cDate->isoFormat('D MMM') }}</div>
                                    <div class="text-[0.6rem] font-bold tracking-tight px-1.5 py-0.5 rounded-md {{ $badgeBg }} inline-block">{{ $statusBadge }}</div>
                                </a>
                            @else
                                <div class="avail-card flex-none text-center border-2 rounded-2xl p-3 {{ $cardBg }} min-w-[96px] sm:min-w-[104px] transition-all duration-200 opacity-90" 
                                     data-month="{{ $monthKey }}"
                                     title="Tanggal telah memiliki reservasi aktif">
                                    <div class="text-[0.7rem] font-bold text-[#685f58] uppercase">{{ $dayName }}</div>
                                    <div class="text-sm sm:text-base font-extrabold whitespace-nowrap my-1 {{ $textColor }}">{{ $cDate->isoFormat('D MMM') }}</div>
                                    <div class="text-[0.6rem] font-bold tracking-tight px-1.5 py-0.5 rounded-md {{ $badgeBg }} inline-block">{{ $statusBadge }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </section>
                @endif

                <!-- Section 5: Terms & Guarantees -->
                <section class="p-6 rounded-2xl bg-[#fcfaf7] border border-[#ede7df] space-y-3 text-xs text-[#685f58]">
                    <h3 class="font-semibold text-sm text-[#27221e] flex items-center gap-2">
                        <svg class="w-4 h-4 text-[#5b4b38]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        Jaminan Kepuasan &amp; Syarat Pemesanan
                    </h3>
                    <ul class="list-disc list-inside space-y-1 text-[#786e66]">
                        <li>Konsultasi detail dan penyesuaian jadwal dapat dilakukan langsung dengan Wedding Advisor kami.</li>
                        <li>Perubahan tanggal acara dapat diajukan hingga maksimal 30 hari sebelum pelaksanaan.</li>
                        <li>Pembayaran aman terenkripsi dengan notifikasi instan dan bukti invoice resmi.</li>
                    </ul>
                </section>

            </div>

            <!-- Right 4 Columns: Sticky Booking Action Card -->
            <div class="lg:col-span-4 lg:sticky lg:top-28">
                <div class="bg-white border border-[#ede7df] rounded-3xl p-6 sm:p-8 shadow-xl space-y-6">
                    
                    <!-- Pricing Header -->
                    <div class="space-y-1 pb-4 border-b border-[#f2ece5]">
                        <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">
                            MULAI DARI
                        </span>
                        <div class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#5b4b38]">
                            {{ $service['price_formatted'] }}
                        </div>
                        <p class="text-xs text-[#8d8277]">Termasuk koordinator &amp; garansi pelaksanaan</p>
                    </div>

                    <!-- Flow Information Checklist -->
                    <div class="space-y-2.5 text-xs text-[#685f58]">
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Jadwal tersedia untuk reservasi 2026 &amp; 2027</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Konfirmasi instan &amp; pembayaran bertahap/lunas</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Dedicated event specialist</span>
                        </div>
                    </div>

                    <!-- CTA Actions (Flowchart Step: Pilih Layanan -> Form Pemesanan) -->
                    <div class="space-y-3 pt-2">
                        @if(session('is_logged_in'))
                            {{-- Logged in: go straight to booking --}}
                            <a href="{{ route('booking', ['service' => $service['slug']]) }}" 
                               class="w-full py-4 px-6 rounded-2xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-semibold text-sm text-center block shadow-md hover:shadow-lg transition duration-200 cursor-pointer">
                                Pilih Layanan &amp; Pesan Sekarang →
                            </a>
                        @else
                            {{-- Not logged in: intercept with smooth auth guard overlay --}}
                            <button type="button"
                                    onclick="requireLoginToBook('{{ route('booking', ['service' => $service['slug']]) }}')"
                                    class="w-full py-4 px-6 rounded-2xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-semibold text-sm text-center block shadow-md hover:shadow-lg transition duration-200 cursor-pointer">
                                Pilih Layanan &amp; Pesan Sekarang →
                            </button>
                        @endif

                        
                        <a href="https://wa.me/6281234567890?text=Halo%20DreamDay%20Studio,%20saya%20tertarik%20dengan%20{{ urlencode($service['title']) }}" 
                           target="_blank" 
                           class="w-full py-3 px-6 rounded-2xl border border-[#ded5cb] hover:border-[#b0a597] bg-[#faf8f5] hover:bg-white text-[#27221e] font-medium text-xs text-center flex items-center justify-center gap-2 transition duration-200">
                            <svg class="w-4 h-4 text-emerald-600 fill-current" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                            </svg>
                            <span>Tanya Wedding Advisor (WhatsApp)</span>
                        </a>
                    </div>

                </div>
            </div>

        </div>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-12 px-4 sm:px-8 mt-20">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-8 text-xs text-[#685f58]">
            
            <!-- Left Side: Brand & Tagline -->
            <div class="space-y-2 text-center md:text-left">
                <a href="{{ route('home') }}" class="font-serif-luxury text-2xl font-bold tracking-tight text-[#6b513a] hover:text-[#523d2b] transition-colors">
                    DreamDay Studio
                </a>
                <p class="text-xs text-[#8d8277]">
                    Crafting timeless elegance for your most cherished moments.
                </p>
                <p class="text-[0.7rem] text-[#a69c92] pt-2">
                    © 2026 DreamDay Studio. All rights reserved.
                </p>
            </div>

            <!-- Right Side: Links -->
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-8 text-xs text-[#554d46] font-medium">
                <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                <a href="{{ route('list-service') }}" class="hover:text-[#27221e] transition-colors">Vendor Portal</a>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
            </div>

        </div>
    </footer>

    @include('partials.customer-chat')

    <!-- ==================== AUTH GUARD MODAL (Login Required) ==================== -->
    <div id="auth-guard-modal"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300 ease-out"
         aria-modal="true" role="dialog" aria-label="Login diperlukan">
        
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeAuthModal()"></div>
        
        <!-- Modal Card -->
        <div class="relative z-10 bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center transform scale-90 transition-transform duration-300 ease-out" id="auth-modal-card">
            
            <!-- Emblem Logo -->
            <div class="flex justify-center mb-5">
                <div class="relative">
                    <div class="absolute inset-0 rounded-full bg-[#5b4b38]/10 animate-ping"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="relative w-14 h-14 object-contain">
                </div>
            </div>

            <!-- Headline -->
            <h3 class="font-serif-luxury text-2xl font-bold text-[#27221e] mb-2 tracking-tight">
                Login Diperlukan
            </h3>
            <p class="text-sm text-[#786e66] leading-relaxed mb-7">
                Silakan login atau daftar terlebih dahulu untuk melanjutkan pemesanan layanan ini.
            </p>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a id="auth-modal-login-btn"
                   href="{{ route('login') }}"
                   class="flex-1 py-3 px-5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-semibold text-sm text-center shadow-md hover:shadow-lg transition duration-200">
                    Login Sekarang
                </a>
                <button type="button"
                        onclick="closeAuthModal()"
                        class="flex-1 py-3 px-5 rounded-xl border border-[#ded5cb] hover:border-[#b0a597] bg-[#faf8f5] hover:bg-white text-[#27221e] font-medium text-sm transition duration-200">
                    Kembali
                </button>
            </div>

            <!-- Sign Up Link -->
            <p class="mt-5 text-xs text-[#9a8e85]">
                Belum punya akun? 
                <a href="{{ route('login') }}" class="text-[#6b513a] font-semibold hover:underline">Daftar gratis sekarang</a>
            </p>

        </div>
    </div>

    <script>
        let _authGuardBookingUrl = null;

        function requireLoginToBook(bookingUrl) {
            _authGuardBookingUrl = bookingUrl;
            const modal = document.getElementById('auth-guard-modal');
            const card  = document.getElementById('auth-modal-card');
            const loginBtn = document.getElementById('auth-modal-login-btn');

            // Store the intended URL in the login button so server can redirect back
            if (loginBtn && bookingUrl) {
                loginBtn.href = '{{ route("login") }}?from=' + encodeURIComponent(bookingUrl);
            }

            // Show modal
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            card.classList.remove('scale-90');
            card.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }

        function closeAuthModal() {
            const modal = document.getElementById('auth-guard-modal');
            const card  = document.getElementById('auth-modal-card');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
            card.classList.add('scale-90');
            card.classList.remove('scale-100');
            document.body.style.overflow = '';
        }

        // Month Switcher for Availability Schedule (60 Days / 2 Months)
        function switchAvailMonth(type) {
            const tabs = document.querySelectorAll('.avail-tab-btn');
            tabs.forEach(tab => {
                tab.classList.remove('border-[#5b4b38]', 'text-[#5b4b38]');
                tab.classList.add('border-transparent', 'text-[#8d8277]');
            });

            const activeTab = document.getElementById('tab-avail-' + type);
            if (activeTab) {
                activeTab.classList.add('border-[#5b4b38]', 'text-[#5b4b38]');
                activeTab.classList.remove('border-transparent', 'text-[#8d8277]');
            }

            const cards = document.querySelectorAll('.avail-card');
            cards.forEach(card => {
                const month = card.getAttribute('data-month');
                if (type === 'all' || month === type) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });

            const container = document.getElementById('avail-container');
            if (container) {
                container.scrollLeft = 0;
            }
        }
    </script>

</body>
</html>
