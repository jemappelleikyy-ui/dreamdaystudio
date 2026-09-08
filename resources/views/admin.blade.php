<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Specialist Dashboard — DreamDay Studio</title>
    <meta name="description" content="Dashboard Pengelolaan Kategori, Produk Layanan, Reservasi, Pembayaran DP &amp; Pelunasan DreamDay Studio.">

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
        .category-tab-active {
            border-color: #5b4b38 !important;
            background-color: #faf7f2 !important;
            box-shadow: 0 4px 20px -2px rgba(91, 75, 56, 0.12);
        }
    </style>
</head>
<body class="bg-[#f9f8f6] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER ADMIN ==================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Left Side: Hamburger Menu + Admin Brand Logo -->
            <div class="flex items-center gap-3 sm:gap-4">
                
                <!-- Hamburger Menu Button (Paling Kiri) -->
                <div class="relative">
                    <button type="button" 
                            id="admin-menu-toggle-btn"
                            onclick="toggleAdminNavDropdown()"
                            aria-expanded="false"
                            title="Menu Navigasi Admin"
                            class="p-2.5 rounded-2xl border border-[#ded5cb] hover:border-[#5b4b38] bg-white hover:bg-[#faf8f5] text-[#27221e] hover:text-[#5b4b38] transition-all duration-200 cursor-pointer flex items-center justify-center shadow-2xs group relative">
                        <svg class="w-5 h-5 text-[#5b4b38] transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <span id="hamburger-chat-unread-badge" class="{{ ($totalUnread ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-1.5 min-w-[18px] h-[18px] px-1 bg-[#25D366] text-white text-[0.6rem] font-black rounded-full flex items-center justify-center border-2 border-white shadow-xs">
                            {{ ($totalUnread ?? 0) > 99 ? '99+' : ($totalUnread ?? 0) }}
                        </span>
                    </button>

                    <!-- Dropdown Menu / Nav Flyout -->
                    <div id="admin-nav-dropdown" 
                         class="hidden absolute left-0 top-full mt-3 w-72 bg-white rounded-3xl border border-[#ede7df] shadow-2xl p-3 z-50 animate-fadeIn space-y-1">
                        <div class="px-3 py-2 border-b border-[#f2ece5] mb-1">
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8d8277] block">NAVIGASI ADMIN</span>
                            <span class="font-serif-luxury text-sm font-bold text-[#27221e]">Menu &amp; Fitur Portal</span>
                        </div>

                        <!-- Item 1: Kategori & Produk (Buka Drawer Kategori) -->
                        <button type="button" 
                                onclick="closeAdminNavDropdown(); toggleCategoriesDrawer();" 
                                class="w-full text-left flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-semibold text-[#27221e] hover:bg-[#faf7f2] hover:text-[#5b4b38] transition group cursor-pointer">
                            <div class="w-8 h-8 rounded-xl bg-[#faf7f2] group-hover:bg-[#5b4b38] group-hover:text-white text-[#5b4b38] flex items-center justify-center transition shrink-0 border border-[#ede7df]">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-xs font-bold leading-tight">Kategori &amp; Produk</span>
                                <span class="text-[0.65rem] text-[#8d8277] block">Kelola layanan, paket &amp; harga (Drawer)</span>
                            </div>
                        </button>

                        <!-- Item 2: Daftar Booking Masuk -->
                        <a href="#section-bookings" 
                           onclick="closeAdminNavDropdown()"
                           class="flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-semibold text-[#27221e] hover:bg-[#faf7f2] hover:text-[#5b4b38] transition group">
                            <div class="w-8 h-8 rounded-xl bg-[#faf7f2] group-hover:bg-[#5b4b38] group-hover:text-white text-[#5b4b38] flex items-center justify-center transition shrink-0 border border-[#ede7df]">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <span class="block text-xs font-bold leading-tight">Daftar Booking Masuk</span>
                                <span class="text-[0.65rem] text-[#8d8277] block">Verifikasi DP &amp; pelunasan</span>
                            </div>
                        </a>

                        <!-- Item 3: Layanan Chat Admin (Buka Drawer Chat) -->
                        <button type="button" 
                                onclick="closeAdminNavDropdown(); toggleChatDrawer();" 
                                class="w-full text-left flex items-center gap-3 px-3.5 py-3 rounded-2xl text-xs font-semibold text-[#27221e] hover:bg-[#faf7f2] hover:text-[#5b4b38] transition group cursor-pointer">
                            <div class="w-8 h-8 rounded-xl bg-[#faf7f2] group-hover:bg-[#5b4b38] group-hover:text-white text-[#5b4b38] flex items-center justify-center transition shrink-0 border border-[#ede7df]">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="block text-xs font-bold leading-tight">Layanan Chat Admin</span>
                                    <span id="dropdown-chat-unread-badge" class="{{ ($totalUnread ?? 0) > 0 ? '' : 'hidden' }} px-2 py-0.5 rounded-full text-[0.65rem] font-black bg-[#25D366] text-white shadow-xs">
                                        {{ ($totalUnread ?? 0) > 99 ? '99+' : ($totalUnread ?? 0) }} Pesan
                                    </span>
                                </div>
                                <span class="text-[0.65rem] text-[#8d8277] block">Pusat pesan multi-kontak (Drawer)</span>
                            </div>
                        </button>


                        <!-- Divider & Portal Utama Link -->
                        <div class="pt-2 mt-1 border-t border-[#f2ece5] space-y-1">
                            <a href="{{ route('home') }}" 
                               target="_blank"
                               class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-xs text-[#685f58] hover:text-[#27221e] hover:bg-[#faf7f2] transition">
                                <svg class="w-3.5 h-3.5 text-[#8d8277]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <span>Buka Halaman User</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="h-6 w-px bg-[#e8e2d9]"></div>

                <!-- Admin Brand Logo & Name -->
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <div>
                        <span class="font-serif-luxury text-xl sm:text-2xl font-bold tracking-tight text-[#27221e] group-hover:text-[#5b4b38] transition-colors block leading-tight">
                            DreamDay Studio
                        </span>
                        <span class="text-[0.65rem] uppercase tracking-wider font-bold text-[#5b4b38] block">
                            Admin Specialist Portal
                        </span>
                    </div>
                </a>
            </div>


            <!-- Right Side: Profile & Quick Links -->
            <div class="flex items-center gap-3 sm:gap-4">
                <button type="button" 
                        id="btn-open-chat-drawer"
                        onclick="toggleChatDrawer()" 
                        class="relative p-2.5 sm:px-3.5 sm:py-2 rounded-2xl border border-[#ded5cb] hover:border-[#25D366] bg-white hover:bg-[#f0faf3] text-[#27221e] transition-all duration-200 cursor-pointer flex items-center gap-2 text-xs font-semibold shadow-2xs group">
                    <div class="relative flex items-center justify-center">
                        <svg class="w-4 h-4 text-[#5b4b38] group-hover:text-[#25D366] transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <span class="hidden sm:inline font-bold">Pesan Masuk</span>
                    
                    <!-- WhatsApp-style Counter Badge on Header Button -->
                    <span id="header-chat-unread-badge" 
                          class="{{ ($totalUnread ?? 0) > 0 ? '' : 'hidden' }} inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 rounded-full text-[0.65rem] font-black bg-[#25D366] text-white shadow-sm border-2 border-white ring-2 ring-[#25D366]/30 animate-pulse">
                        {{ ($totalUnread ?? 0) > 99 ? '99+' : ($totalUnread ?? 0) }}
                    </span>
                </button>


                <div class="h-6 w-px bg-[#e8e2d9] hidden sm:block"></div>

                <div class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-full bg-[#5b4b38] text-white flex items-center justify-center font-bold text-xs shadow-xs">
                        AD
                    </div>
                    <div class="hidden sm:block text-left">
                        <span class="text-xs font-bold text-[#27221e] block leading-tight">{{ session('admin_name', 'Admin DreamDay') }}</span>
                        <span class="text-[0.65rem] text-[#8d8277] block">{{ session('admin_email', 'admindreamday@gmail.com') }}</span>
                    </div>
                </div>

                <a href="{{ route('admin.logout') }}" 
                   title="Keluar dari Admin Portal"
                   class="p-2 rounded-xl text-[#8d8277] hover:text-rose-600 hover:bg-rose-50 transition cursor-pointer">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </a>
            </div>

        </div>
    </header>

    @if(session('success_message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success_message') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-emerald-700 hover:text-emerald-900 cursor-pointer">✕</button>
            </div>
        </div>
    @endif

    @if(session('error_message'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('error_message') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove()" class="text-rose-700 hover:text-rose-900 cursor-pointer">✕</button>
            </div>
        </div>
    @endif

    <!-- ==================== MAIN ADMIN DASHBOARD SECTION ==================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10 w-full flex-1 space-y-12">
        
        <!-- Welcome Hero & DP Settings Row -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            
            <!-- Left Hero Text -->
            <div class="lg:col-span-7 space-y-1">
                <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">PANEL KENDALI UTAMA</span>
                <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e]">
                    Admin Dashboard DreamDay Studio
                </h1>
                <p class="text-xs sm:text-sm text-[#685f58]">
                    Kelola kategori layanan, edit produk &amp; paket acara, verifikasi pembayaran DP &amp; pelunasan, serta monitoring reservasi nyata dari database.
                </p>
            </div>

            <!-- Right: DP Configuration Card -->
            <div class="lg:col-span-5 bg-white border border-[#ede7df] rounded-2xl p-4 sm:p-5 shadow-xs">
                <form action="{{ route('admin.settings.dp') }}" method="POST" class="flex flex-col sm:flex-row items-center justify-between gap-3">
                    @csrf
                    <div class="space-y-0.5 text-left w-full sm:w-auto">
                        <span class="text-[0.7rem] uppercase font-bold text-[#8d8277] block">Pengaturan Sistem DP</span>
                        <span class="text-xs font-bold text-[#27221e]">Persentase Uang Muka (DP)</span>
                    </div>
                    <div class="flex items-center gap-2.5 w-full sm:w-auto">
                        <div class="flex items-center rounded-xl border border-[#ded5cb] bg-white focus-within:ring-2 focus-within:ring-[#5b4b38]/30 focus-within:border-[#5b4b38] px-3.5 py-2 shadow-2xs">
                            <input type="number" 
                                   name="dp_percentage" 
                                   id="dp_percentage_input"
                                   min="5" 
                                   max="90" 
                                   value="{{ $dpPercentage ?? 30 }}" 
                                   required 
                                   class="w-10 bg-transparent text-sm font-bold text-[#27221e] focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none text-right pr-1">
                            <span class="text-xs font-bold text-[#8d8277] select-none pl-0.5">%</span>
                        </div>
                        <button type="submit" class="px-4 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-xs transition duration-200 cursor-pointer shrink-0">
                            Simpan DP
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Metric Summary Cards Grid (100% Real Database Calculations) -->
        @php
            $allBookings = collect($bookings);
            $totalCount = $allBookings->count();
            $pendingConfirmationCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['status'] ?? '')), ['MENUNGGU KONFIRMASI ADMIN', 'MENUNGGU KONFIRMASI', 'PENDING']))->count();
            $confirmedPendingDpCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['status'] ?? '')), ['BOOKING DIKONFIRMASI', 'MENUNGGU PEMBAYARAN DP']) && in_array(strtoupper(trim($b['payment_status'] ?? '')), ['BELUM DIBAYAR', 'MENUNGGU PEMBAYARAN DP']))->count();
            $pendingDpCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['payment_status'] ?? '')), ['MENUNGGU VERIFIKASI', 'MENUNGGU VERIFIKASI DP']) || strtoupper(trim($b['status'] ?? '')) === 'MENUNGGU VERIFIKASI DP')->count();
            $dpPaidCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['payment_status'] ?? '')), ['DP DIBAYAR']) || in_array(strtoupper(trim($b['status'] ?? '')), ['DP DIBAYAR', 'BOOKING AKTIF']))->count();
            $lunasCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['status'] ?? '')), ['LUNAS', 'SELESAI', 'TERVERIFIKASI', 'COMPLETED']) || strtoupper(trim($b['payment_status'] ?? '')) === 'LUNAS')->count();
            $cancelledCount = $allBookings->filter(fn($b) => in_array(strtoupper(trim($b['status'] ?? '')), ['DIBATALKAN', 'CANCELLED', 'DP DITOLAK']) || in_array(strtoupper(trim($b['payment_status'] ?? '')), ['KADALUARSA', 'PEMBAYARAN DITOLAK', 'DIBATALKAN']))->count();
            $totalRevenue = $allBookings->sum('total_price');
            $totalPaid = $allBookings->sum('amount_paid');
            $allServices = collect($services ?? []);
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            
            <!-- Metric 1: Total Bookings -->
            <div class="bg-white border border-[#ede7df] rounded-2xl p-5 shadow-xs flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-medium text-[#8d8277]">Total Booking Database</span>
                    <div class="text-2xl font-bold text-[#27221e]">{{ $totalCount }} Pesanan</div>
                    <span class="text-[0.7rem] text-emerald-600 font-semibold">Real-time dari DB</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-[#faf7f2] text-[#5b4b38] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
            </div>

            <!-- Metric 2: Menunggu Konfirmasi Admin -->
            <div class="bg-white border border-[#ede7df] rounded-2xl p-5 shadow-xs flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-medium text-[#8d8277]">Perlu Konfirmasi Admin</span>
                    <div class="text-2xl font-bold text-amber-600">{{ $pendingConfirmationCount }} Booking Baru</div>
                    <span class="text-[0.7rem] text-amber-700 font-semibold">Tahap 1: Persetujuan Admin</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Metric 3: Verifikasi DP -->
            <div class="bg-white border border-[#ede7df] rounded-2xl p-5 shadow-xs flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-medium text-[#8d8277]">Verifikasi Bukti DP</span>
                    <div class="text-2xl font-bold text-teal-700">{{ $pendingDpCount }} Transaksi</div>
                    <span class="text-[0.7rem] text-teal-600 font-semibold">Tahap 2: Cek Bukti Transfer</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-700 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <!-- Metric 4: DP Dibayar & Aktif -->
            <div class="bg-white border border-[#ede7df] rounded-2xl p-5 shadow-xs flex items-center justify-between">
                <div class="space-y-1">
                    <span class="text-xs font-medium text-[#8d8277]">DP Dibayar / Aktif</span>
                    <div class="text-2xl font-bold text-[#5b4b38]">{{ $dpPaidCount }} Jadwal Terkunci</div>
                    <span class="text-[0.7rem] text-[#5b4b38] font-semibold">{{ $lunasCount }} Lunas / Selesai</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-[#faf7f2] text-[#5b4b38] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>

        </div>


        <!-- ==================== SECTION: LIHAT BOOKING MASUK (100% DATABASE REAL) ==================== -->
        <section id="section-bookings" class="bg-white border border-[#ede7df] rounded-3xl shadow-xs overflow-hidden">
            
            <!-- Table Header Bar -->
            <div class="p-6 sm:p-8 border-b border-[#f2ece5] flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">RESERVASI NYATA</span>
                    <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e]">
                        Daftar Booking &amp; Status Pembayaran DP
                    </h2>
                    <p class="text-xs text-[#8d8277] mt-0.5">
                        Menampilkan seluruh reservasi yang tersimpan di database tanpa data dummy/pajangan.
                    </p>
                </div>

                <!-- Filter Status Pills -->
                <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                    <button type="button" onclick="filterBookings('ALL')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#5b4b38] text-white filter-btn cursor-pointer">
                        Semua ({{ $totalCount }})
                    </button>
                    <button type="button" onclick="filterBookings('MENUNGGU KONFIRMASI ADMIN')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-amber-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        Menunggu Konfirmasi ({{ $pendingConfirmationCount }})
                    </button>
                    <button type="button" onclick="filterBookings('BOOKING DIKONFIRMASI')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-sky-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        Menunggu DP ({{ $confirmedPendingDpCount }})
                    </button>
                    <button type="button" onclick="filterBookings('MENUNGGU VERIFIKASI')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-amber-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        Verifikasi DP ({{ $pendingDpCount }})
                    </button>
                    <button type="button" onclick="filterBookings('DP DIBAYAR')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-teal-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        DP Dibayar / Aktif ({{ $dpPaidCount }})
                    </button>
                    <button type="button" onclick="filterBookings('SELESAI')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-emerald-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        Selesai ({{ $lunasCount }})
                    </button>
                    <button type="button" onclick="filterBookings('DIBATALKAN')" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-rose-800 hover:bg-[#ede7df] filter-btn cursor-pointer">
                        Dibatalkan / Kadaluarsa ({{ $cancelledCount }})
                    </button>
                </div>
            </div>

            <!-- Bookings Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs sm:text-sm">
                    <thead>
                        <tr class="bg-[#faf8f5] border-b border-[#ede7df] text-[0.7rem] uppercase tracking-wider text-[#8d8277]">
                            <th class="py-4 px-5 font-bold">ID Booking</th>
                            <th class="py-4 px-5 font-bold">Pemesan</th>
                            <th class="py-4 px-5 font-bold">Layanan &amp; Acara</th>
                            <th class="py-4 px-5 font-bold">Rincian Finansial (DP)</th>
                            <th class="py-4 px-5 font-bold">Status Booking &amp; Pembayaran</th>
                            <th class="py-4 px-5 font-bold text-right">Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#f2ece5] text-[#27221e]">
                        @if(!empty($bookings) && count($bookings) > 0)
                            @foreach($bookings as $booking)
                                @php
                                    $bStatus = trim($booking['status'] ?? 'Menunggu Konfirmasi Admin');
                                    $pStatus = trim($booking['payment_status'] ?? 'Belum Dibayar');
                                    $bStatusUpper = strtoupper($bStatus);
                                    $pStatusUpper = strtoupper($pStatus);

                                    $total = (int) ($booking['total_price'] ?? 0);
                                    $dpPct = (int) ($booking['dp_percentage'] ?? 30);
                                    $dpAmount = (int) ($booking['dp_amount'] ?? round($total * $dpPct / 100));
                                    $amountPaid = (int) ($booking['amount_paid'] ?? 0);
                                    $remaining = (int) ($booking['remaining_amount'] ?? max(0, $total - $amountPaid));

                                    // Filter category key for JS filtering
                                    $filterKey = match(true) {
                                        in_array($bStatusUpper, ['MENUNGGU KONFIRMASI ADMIN', 'MENUNGGU KONFIRMASI', 'PENDING']) => 'MENUNGGU KONFIRMASI ADMIN',
                                        in_array($pStatusUpper, ['MENUNGGU VERIFIKASI', 'MENUNGGU VERIFIKASI DP']) || $bStatusUpper === 'MENUNGGU VERIFIKASI DP' => 'MENUNGGU VERIFIKASI',
                                        in_array($pStatusUpper, ['DP DIBAYAR']) || in_array($bStatusUpper, ['DP DIBAYAR', 'BOOKING AKTIF']) => 'DP DIBAYAR',
                                        in_array($bStatusUpper, ['BOOKING DIKONFIRMASI', 'MENUNGGU PEMBAYARAN DP']) => 'BOOKING DIKONFIRMASI',
                                        in_array($bStatusUpper, ['SELESAI', 'LUNAS', 'TERVERIFIKASI', 'COMPLETED']) || $pStatusUpper === 'LUNAS' => 'SELESAI',
                                        default => 'DIBATALKAN'
                                    };

                                    // Booking Status Badge Styles
                                    $bBadgeClass = match($bStatusUpper) {
                                        'MENUNGGU KONFIRMASI ADMIN', 'MENUNGGU KONFIRMASI', 'PENDING' => 'bg-amber-50 text-amber-800 border-amber-300',
                                        'BOOKING DIKONFIRMASI' => 'bg-sky-50 text-sky-800 border-sky-300',
                                        'BOOKING AKTIF', 'DP DIBAYAR' => 'bg-emerald-50 text-emerald-800 border-emerald-300 font-black',
                                        'SELESAI', 'LUNAS', 'TERVERIFIKASI', 'COMPLETED' => 'bg-purple-50 text-purple-800 border-purple-300',
                                        'DIBATALKAN', 'CANCELLED' => 'bg-rose-50 text-rose-800 border-rose-300',
                                        default => 'bg-[#ede7df] text-[#685f58] border-[#ded5cb]'
                                    };

                                    // Payment Status Badge Styles
                                    $pBadgeClass = match($pStatusUpper) {
                                        'BELUM DIBAYAR' => 'bg-gray-100 text-gray-700 border-gray-300',
                                        'MENUNGGU PEMBAYARAN DP' => 'bg-indigo-50 text-indigo-800 border-indigo-300',
                                        'MENUNGGU VERIFIKASI', 'MENUNGGU VERIFIKASI DP' => 'bg-amber-100 text-amber-800 border-amber-400 font-bold animate-pulse',
                                        'DP DIBAYAR' => 'bg-teal-50 text-teal-800 border-teal-300 font-bold',
                                        'LUNAS' => 'bg-emerald-100 text-emerald-800 border-emerald-300 font-bold',
                                        'KADALUARSA', 'PEMBAYARAN DITOLAK', 'DP DITOLAK' => 'bg-rose-100 text-rose-800 border-rose-300',
                                        default => 'bg-[#ede7df] text-[#685f58] border-[#ded5cb]'
                                    };
                                @endphp
                                <tr class="hover:bg-[#fcfaf7] transition booking-row" data-status="{{ $filterKey }}" data-booking-id="{{ $booking['id'] }}">
                                    <!-- Column 1: ID & Created -->
                                    <td class="py-4 px-5 align-top">
                                        <span class="font-mono font-bold text-[#5b4b38] bg-[#f5f0ea] px-2.5 py-1 rounded-md inline-block">
                                            #{{ $booking['id'] }}
                                        </span>
                                        <div class="text-[0.65rem] text-[#8d8277] mt-1">{{ $booking['created_at'] ?? 'Baru saja' }}</div>
                                    </td>

                                    <!-- Column 2: Customer Meta -->
                                    <td class="py-4 px-5 align-top">
                                        <div class="font-bold text-sm text-[#27221e]">{{ $booking['customer_name'] }}</div>
                                        <div class="text-xs text-[#685f58]">{{ $booking['customer_email'] }}</div>
                                        <div class="text-xs text-[#8d8277]">{{ $booking['customer_phone'] }}</div>
                                    </td>

                                    <!-- Column 3: Service & Event Date -->
                                    <td class="py-4 px-5 align-top">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset($booking['service_image'] ?? 'images/package-cliffside.jpg') }}" alt="Service" class="w-12 h-12 rounded-xl object-cover border border-[#ede7df] shrink-0">
                                            <div>
                                                <div class="font-bold text-xs sm:text-sm text-[#27221e]">{{ $booking['service_title'] }}</div>
                                                <div class="text-xs text-[#685f58] mt-0.5">
                                                    📅 {{ !empty($booking['event_date']) ? date('d M Y', strtotime($booking['event_date'])) : '-' }}
                                                </div>
                                                <div class="text-[0.7rem] text-[#8d8277]">
                                                    📍 {{ $booking['event_location'] }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Column 4: Price & DP Breakdown -->
                                    <td class="py-4 px-5 align-top space-y-0.5">
                                        <div class="font-bold text-xs sm:text-sm text-[#27221e]">
                                            Total: Rp {{ number_format($total, 0, ',', '.') }}
                                        </div>
                                        <div class="text-[0.75rem] text-[#5b4b38] font-semibold">
                                            DP ({{ $dpPct }}%): Rp {{ number_format($dpAmount, 0, ',', '.') }}
                                        </div>
                                        <div class="text-[0.7rem] text-emerald-700">
                                            Dibayar: <strong>Rp {{ number_format($amountPaid, 0, ',', '.') }}</strong>
                                        </div>
                                        <div class="text-[0.7rem] text-rose-700">
                                            Sisa: <strong>Rp {{ number_format($remaining, 0, ',', '.') }}</strong>
                                        </div>
                                        @if(!empty($booking['payment_method']))
                                            <div class="text-[0.65rem] text-[#8d8277] pt-0.5">
                                                Metode: <span class="font-medium text-[#27221e]">{{ $booking['payment_method'] }}</span>
                                            </div>
                                        @endif
                                        @if(!empty($booking['payment_proof']))
                                            <div class="pt-0.5">
                                                <button type="button" 
                                                        onclick="viewProofModal('{{ asset($booking['payment_proof']) }}')" 
                                                        class="inline-flex items-center gap-1 text-[0.65rem] text-[#5b4b38] hover:underline font-bold cursor-pointer">
                                                    <span>📷 Lihat Bukti Transfer</span>
                                                </button>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Column 5: Status Badge (Booking & Payment Separated) -->
                                    <td class="py-4 px-5 align-top space-y-1.5">
                                        <div>
                                            <span class="text-[0.6rem] font-bold text-[#8d8277] uppercase block">Status Booking:</span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[0.65rem] font-bold uppercase tracking-wider border {{ $bBadgeClass }}">
                                                {{ $bStatus }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-[0.6rem] font-bold text-[#8d8277] uppercase block">Status Pembayaran:</span>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-[0.65rem] font-bold uppercase tracking-wider border {{ $pBadgeClass }}">
                                                {{ $pStatus }}
                                            </span>
                                        </div>
                                        @if(!empty($booking['time_left_formatted']) && !$booking['is_expired'] && in_array($pStatusUpper, ['MENUNGGU PEMBAYARAN DP']))
                                            <div class="text-[0.65rem] text-amber-700 font-semibold flex items-center gap-1">
                                                <span>⏳ Sisa Waktu DP:</span>
                                                <span class="font-mono font-bold">{{ $booking['time_left_formatted'] }}</span>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Column 6: Admin Action Buttons -->
                                    <td class="py-4 px-5 align-top text-right space-y-2">
                                        @if(in_array($bStatusUpper, ['MENUNGGU KONFIRMASI ADMIN', 'MENUNGGU KONFIRMASI', 'PENDING']))
                                            <!-- Prominent Action 1: Confirm Booking -->
                                            <div class="flex items-center justify-end gap-1.5">
                                                <button type="button" 
                                                        onclick="confirmBooking({{ $booking['id'] }})" 
                                                        title="Terima booking dan buka akses pembayaran DP 7 hari"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold shadow-xs transition cursor-pointer">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span>Terima Booking</span>
                                                </button>
                                                <button type="button" 
                                                        onclick="rejectBooking({{ $booking['id'] }})" 
                                                        title="Tolak booking ini"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-rose-300 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition cursor-pointer">
                                                    <span>✕ Tolak</span>
                                                </button>
                                            </div>
                                        @elseif(in_array($pStatusUpper, ['MENUNGGU VERIFIKASI', 'MENUNGGU VERIFIKASI DP']) || $bStatusUpper === 'MENUNGGU VERIFIKASI DP')
                                            <!-- Prominent Action 2: Verify DP Payment -->
                                            <div>
                                                <button type="button" 
                                                        onclick="openVerificationModal({{ json_encode($booking) }})" 
                                                        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold shadow-xs transition cursor-pointer animate-pulse">
                                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <span>Verifikasi Bukti DP</span>
                                                </button>
                                            </div>
                                        @endif

                                        <div>
                                            <button type="button" 
                                                    onclick="openVerificationModal({{ json_encode($booking) }})" 
                                                    class="inline-flex items-center gap-1 px-3 py-1 rounded-lg border border-[#ded5cb] hover:bg-[#faf7f2] text-[#5b4b38] text-xs font-semibold transition cursor-pointer">
                                                <span>Detail &amp; Kelola</span>
                                            </button>
                                        </div>

                                        <div>
                                            <button type="button" 
                                                    onclick="openChatWithCustomer('{{ addslashes($booking['customer_name']) }}', '{{ $booking['customer_email'] }}')" 
                                                    class="text-[0.7rem] text-[#685f58] hover:text-[#5b4b38] font-medium transition inline-flex items-center gap-1 cursor-pointer">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                <span>Chat Pemesan</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <!-- Professional Empty State When No Bookings in Database -->
                            <tr>
                                <td colspan="6" class="py-16 px-6 text-center">
                                    <div class="max-w-md mx-auto space-y-3">
                                        <div class="w-16 h-16 rounded-2xl bg-[#faf7f2] text-[#5b4b38] flex items-center justify-center mx-auto border border-[#ede7df] shadow-xs">
                                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="space-y-1">
                                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Belum Ada Booking</h3>
                                            <p class="text-xs sm:text-sm text-[#8d8277]">
                                                Booking baru yang dibuat pelanggan akan otomatis muncul di sini secara real-time dari database.
                                            </p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </section>

    </main>


    <!-- ==================== MODAL: TAMBAH KATEGORI BARU ==================== -->
    <div id="modal-add-category" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-3 border-b border-[#f2ece5]">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">FORM KATEGORI</span>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Tambah Kategori Baru</h3>
                </div>
                <button type="button" onclick="closeAddCategoryModal()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.categories.create') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                
                <div class="space-y-1.5">
                    <label for="add_cat_name" class="block font-bold text-[#27221e]">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="add_cat_name" 
                           required 
                           placeholder="Contoh: Venues, Documentation, MUA, dll." 
                           class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                </div>

                <div class="space-y-1.5">
                    <label for="add_cat_desc" class="block font-bold text-[#27221e]">Deskripsi Kategori</label>
                    <textarea name="description" 
                              id="add_cat_desc" 
                              rows="3" 
                              placeholder="Deskripsi singkat seputar kategori layanan ini..." 
                              class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block font-bold text-[#27221e]">Foto Sampul Kategori</label>
                    <input type="file" 
                           name="image" 
                           accept="image/*" 
                           class="w-full px-3 py-2 rounded-xl border border-[#ded5cb] text-xs text-[#685f58] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#5b4b38] file:text-white hover:file:bg-[#483b2c] cursor-pointer">
                    <p class="text-[0.65rem] text-[#8d8277]">Format: JPG, PNG, WEBP. Ukuran maks: 5MB.</p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" id="add_cat_active" value="1" checked class="rounded text-[#5b4b38] focus:ring-[#5b4b38]">
                    <label for="add_cat_active" class="font-semibold text-[#27221e] cursor-pointer">Aktifkan kategori ini agar langsung tersedia di sistem booking</label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#f2ece5]">
                    <button type="button" onclick="closeAddCategoryModal()" class="px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-md cursor-pointer">
                        Simpan Kategori
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- ==================== MODAL: EDIT KATEGORI ==================== -->
    <div id="modal-edit-category" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-3 border-b border-[#f2ece5]">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">EDIT KATEGORI</span>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Ubah Data Kategori</h3>
                </div>
                <button type="button" onclick="closeEditCategoryModal()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <form id="form-edit-category" action="" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                
                <div class="space-y-1.5">
                    <label for="edit_cat_name" class="block font-bold text-[#27221e]">Nama Kategori <span class="text-rose-500">*</span></label>
                    <input type="text" 
                           name="name" 
                           id="edit_cat_name" 
                           required 
                           class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                </div>

                <div class="space-y-1.5">
                    <label for="edit_cat_desc" class="block font-bold text-[#27221e]">Deskripsi Kategori</label>
                    <textarea name="description" 
                              id="edit_cat_desc" 
                              rows="3" 
                              class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block font-bold text-[#27221e]">Foto Sampul Kategori</label>
                    <div class="flex items-center gap-3">
                        <img id="edit_cat_preview" src="" alt="Preview" class="w-12 h-12 rounded-xl object-cover border border-[#ede7df]">
                        <input type="file" 
                               name="image" 
                               accept="image/*" 
                               class="flex-1 px-3 py-2 rounded-xl border border-[#ded5cb] text-xs text-[#685f58] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#5b4b38] file:text-white hover:file:bg-[#483b2c] cursor-pointer">
                    </div>
                    <p class="text-[0.65rem] text-[#8d8277]">Biarkan kosong jika tidak ingin mengganti foto saat ini.</p>
                </div>

                <div class="flex items-center gap-2 pt-1">
                    <input type="checkbox" name="is_active" id="edit_cat_active" value="1" class="rounded text-[#5b4b38] focus:ring-[#5b4b38]">
                    <label for="edit_cat_active" class="font-semibold text-[#27221e] cursor-pointer">Status Aktif (Dapat dipilih pelanggan untuk booking)</label>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-[#f2ece5]">
                    <button type="button" 
                            id="btn-delete-cat-from-edit"
                            onclick="" 
                            class="px-4 py-2.5 rounded-xl border border-rose-200 text-xs font-semibold text-rose-600 hover:bg-rose-50 cursor-pointer flex items-center gap-1.5 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus Kategori</span>
                    </button>
                    <div class="flex items-center gap-2">
                        <button type="button" onclick="closeEditCategoryModal()" class="px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-md cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <!-- ==================== MODAL: KONFIRMASI HAPUS KATEGORI ==================== -->
    <div id="modal-delete-category" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-md w-full p-6 sm:p-8 space-y-6 text-center">
            
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto border border-rose-200 shadow-xs">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <div class="space-y-2">
                <span class="text-[0.7rem] font-bold uppercase tracking-wider text-rose-600">KONFIRMASI TINDAKAN</span>
                <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Hapus Kategori?</h3>
                <p class="text-xs text-[#685f58] leading-relaxed">
                    Apakah Anda yakin ingin menghapus kategori <span id="delete-cat-name" class="font-bold text-[#27221e]"></span> dari database?
                </p>
                <div id="delete-cat-warning" class="hidden text-left bg-amber-50 border border-amber-200 p-3 rounded-2xl text-[0.7rem] text-amber-800 space-y-1">
                    <span class="font-bold flex items-center gap-1">
                        <svg class="w-4 h-4 text-amber-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        Perhatian:
                    </span>
                    <p id="delete-cat-warning-text" class="text-amber-700 leading-relaxed pl-5"></p>
                </div>
            </div>

            <form id="form-delete-category" action="" method="POST" class="flex items-center justify-center gap-3 pt-2">
                @csrf
                <button type="button" onclick="closeDeleteCategoryModal()" class="flex-1 py-3 px-4 rounded-xl border border-[#ded5cb] text-xs font-semibold text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="flex-1 py-3 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-md cursor-pointer transition">
                    Ya, Hapus
                </button>
            </form>

        </div>
    </div>


    <!-- ==================== MODAL: TAMBAH PRODUK / LAYANAN BARU ==================== -->
    <div id="modal-add-service" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-3 border-b border-[#f2ece5]">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">PRODUK BARU</span>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Tambah Produk / Layanan Baru</h3>
                </div>
                <button type="button" onclick="closeAddServiceModal()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <form action="{{ route('admin.services.create') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="add_srv_title" class="block font-bold text-[#27221e]">Nama Produk / Layanan <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="title" 
                               id="add_srv_title" 
                               required 
                               placeholder="Contoh: The Royal Glasshouse Grand Ballroom" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_category" class="block font-bold text-[#27221e]">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category" id="add_srv_category" required class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] font-semibold focus:ring-2 focus:ring-[#5b4b38]/30">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_price" class="block font-bold text-[#27221e]">Harga Paket (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" 
                               name="price" 
                               id="add_srv_price" 
                               required 
                               min="100000" 
                               step="100000"
                               placeholder="Contoh: 85000000" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] font-bold focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_location" class="block font-bold text-[#27221e]">Lokasi</label>
                        <input type="text" 
                               name="location" 
                               id="add_srv_location" 
                               placeholder="Contoh: Senayan, Jakarta Pusat" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_capacity" class="block font-bold text-[#27221e]">Kapasitas / Durasi</label>
                        <input type="text" 
                               name="capacity" 
                               id="add_srv_capacity" 
                               placeholder="Contoh: 800 Tamu / Full Day" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_rating" class="block font-bold text-[#27221e]">Rating &amp; Ulasan</label>
                        <input type="text" 
                               name="rating" 
                               id="add_srv_rating" 
                               value="5.0 (Baru)" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="add_srv_badge" class="block font-bold text-[#27221e]">Badge Tag</label>
                        <input type="text" 
                               name="badge" 
                               id="add_srv_badge" 
                               placeholder="Contoh: Exclusive Luxury" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="add_srv_desc" class="block font-bold text-[#27221e]">Deskripsi Layanan</label>
                    <textarea name="description" 
                              id="add_srv_desc" 
                              rows="3" 
                              placeholder="Deskripsi fasilitas, keunggulan, dan rincian paket layanan ini..." 
                              class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30"></textarea>
                </div>

                <div class="space-y-1.5">
                    <label class="block font-bold text-[#27221e]">Foto Sampul Produk Layanan</label>
                    <input type="file" 
                           name="image" 
                           accept="image/*" 
                           class="w-full px-3 py-2 rounded-xl border border-[#ded5cb] text-xs text-[#685f58] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#5b4b38] file:text-white hover:file:bg-[#483b2c] cursor-pointer">
                    <p class="text-[0.65rem] text-[#8d8277]">Format: JPG, PNG, WEBP. Ukuran maks: 5MB.</p>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#f2ece5]">
                    <button type="button" onclick="closeAddServiceModal()" class="px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold shadow-md cursor-pointer">
                        Simpan Produk
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- ==================== MODAL: EDIT PRODUK / LAYANAN ==================== -->
    <div id="modal-edit-service" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 space-y-6">
            
            <div class="flex items-center justify-between pb-3 border-b border-[#f2ece5]">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">EDIT PRODUK</span>
                    <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Ubah Data Produk / Layanan</h3>
                </div>
                <button type="button" onclick="closeEditServiceModal()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <form id="form-edit-service" action="" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs">
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="edit_srv_title" class="block font-bold text-[#27221e]">Nama Produk / Layanan <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="title" 
                               id="edit_srv_title" 
                               required 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_category" class="block font-bold text-[#27221e]">Kategori <span class="text-rose-500">*</span></label>
                        <select name="category" id="edit_srv_category" required class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] font-semibold focus:ring-2 focus:ring-[#5b4b38]/30">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_price" class="block font-bold text-[#27221e]">Harga Paket (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" 
                               name="price" 
                               id="edit_srv_price" 
                               required 
                               min="100000" 
                               step="100000"
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] font-bold focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_location" class="block font-bold text-[#27221e]">Lokasi</label>
                        <input type="text" 
                               name="location" 
                               id="edit_srv_location" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_capacity" class="block font-bold text-[#27221e]">Kapasitas / Durasi</label>
                        <input type="text" 
                               name="capacity" 
                               id="edit_srv_capacity" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_rating" class="block font-bold text-[#27221e]">Rating &amp; Ulasan</label>
                        <input type="text" 
                               name="rating" 
                               id="edit_srv_rating" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>

                    <div class="space-y-1.5">
                        <label for="edit_srv_badge" class="block font-bold text-[#27221e]">Badge Tag</label>
                        <input type="text" 
                               name="badge" 
                               id="edit_srv_badge" 
                               class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30">
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label for="edit_srv_desc" class="block font-bold text-[#27221e]">Deskripsi Layanan</label>
                    <textarea name="description" 
                              id="edit_srv_desc" 
                              rows="3" 
                              class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/30"></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block font-bold text-[#27221e]">Foto Sampul Produk</label>
                    <div class="flex items-center gap-3">
                        <img id="edit_srv_preview" src="" alt="Preview" class="w-14 h-14 rounded-xl object-cover border border-[#ede7df]">
                        <input type="file" 
                               name="image" 
                               accept="image/*" 
                               class="flex-1 px-3 py-2 rounded-xl border border-[#ded5cb] text-xs text-[#685f58] file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#5b4b38] file:text-white hover:file:bg-[#483b2c] cursor-pointer">
                    </div>
                    <p class="text-[0.65rem] text-[#8d8277]">Biarkan kosong jika tidak ingin mengganti foto saat ini.</p>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#f2ece5]">
                    <button type="button" onclick="closeEditServiceModal()" class="px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-md cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- ==================== MODAL: KONFIRMASI HAPUS PRODUK ==================== -->
    <div id="modal-delete-service" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-md w-full p-6 sm:p-8 space-y-5 text-center">
            
            <div class="w-14 h-14 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mx-auto border border-rose-200">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>

            <div class="space-y-1.5">
                <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Hapus Produk Layanan?</h3>
                <p class="text-xs text-[#685f58]">
                    Apakah Anda yakin ingin menghapus produk <strong id="delete-srv-name" class="text-[#27221e]">-</strong>?
                </p>
                <p class="text-[0.7rem] text-[#8d8277] bg-[#faf7f2] p-2.5 rounded-xl border border-[#ede7df] mt-2">
                    Tindakan ini akan menghapus produk dari katalog database secara permanen.
                </p>
            </div>

            <form id="form-delete-service" action="" method="POST" class="flex items-center justify-center gap-3 pt-2">
                @csrf
                <button type="button" onclick="closeDeleteServiceModal()" class="px-5 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-md cursor-pointer">
                    Ya, Hapus Produk
                </button>
            </form>

        </div>
    </div>

    <!-- ==================== MODAL: VERIFIKASI & UPDATE STATUS BOOKING & DP ==================== -->
    <div id="modal-verification" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto p-6 sm:p-8 space-y-6">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between pb-4 border-b border-[#f2ece5]">
                <div>
                    <span class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277]">PORTAL KELOLA &amp; VERIFIKASI BOOKING</span>
                    <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e]">
                        Detail &amp; Aksi Reservasi
                    </h3>
                </div>
                <button type="button" onclick="closeVerificationModal()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">
                    ✕
                </button>
            </div>

            <!-- Booking Info Body -->
            <div class="space-y-4 text-xs text-[#27221e]">
                
                <!-- Service & ID Header Card -->
                <div class="p-4 rounded-2xl bg-[#faf8f5] border border-[#ede7df] space-y-2">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <span class="font-mono font-bold text-[#5b4b38] text-sm" id="modal-booking-id">#DDS-2026</span>
                        <div class="flex items-center gap-1.5 flex-wrap">
                            <span id="modal-booking-status" class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase bg-amber-100 text-amber-800 border border-amber-200">
                                MENUNGGU KONFIRMASI ADMIN
                            </span>
                            <span id="modal-payment-status" class="px-2.5 py-0.5 rounded-full text-[0.65rem] font-bold uppercase bg-gray-100 text-gray-800 border border-gray-200">
                                BELUM DIBAYAR
                            </span>
                        </div>
                    </div>
                    <h4 class="font-bold text-sm text-[#27221e]" id="modal-service-title">Nama Layanan</h4>
                    <p class="text-[#685f58]" id="modal-customer-info">Pemesan: -</p>
                    
                    <!-- Expiry countdown if applicable -->
                    <div id="modal-expiry-container" class="hidden pt-2 border-t border-[#ede7df] flex items-center justify-between text-[0.7rem] text-amber-800 bg-amber-50/70 p-2 rounded-xl">
                        <span class="font-medium">Batas Waktu Pembayaran DP:</span>
                        <span class="font-mono font-bold" id="modal-expiry-text">24:00:00</span>
                    </div>
                </div>

                <!-- Financial DP Breakdown -->
                <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#e8dfd3] space-y-2">
                    <span class="text-[0.7rem] uppercase font-bold text-[#8d8277] block">Rincian Finansial:</span>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div>
                            <span class="text-[#8d8277]">Total Biaya Acara:</span>
                            <div class="font-bold text-[#27221e]" id="modal-total-price">Rp 0</div>
                        </div>
                        <div>
                            <span class="text-[#8d8277]">Persentase DP:</span>
                            <div class="font-bold text-[#5b4b38]" id="modal-dp-percentage">30%</div>
                        </div>
                        <div>
                            <span class="text-[#8d8277]">Nominal Tagihan DP:</span>
                            <div class="font-bold text-[#5b4b38]" id="modal-dp-amount">Rp 0</div>
                        </div>
                        <div>
                            <span class="text-[#8d8277]">Sisa Pelunasan:</span>
                            <div class="font-bold text-rose-700" id="modal-remaining-amount">Rp 0</div>
                        </div>
                    </div>
                    <div class="pt-2 border-t border-[#ede7df] flex items-center justify-between">
                        <span class="text-[#8d8277]">Metode Pembayaran:</span>
                        <span class="font-bold text-[#27221e]" id="modal-payment-method">-</span>
                    </div>
                </div>

                <!-- Bukti Pembayaran Preview Section -->
                <div id="modal-proof-section" class="p-4 rounded-2xl border border-[#ede7df] space-y-2 hidden">
                    <span class="font-bold text-[#554d46] block">Bukti Pembayaran Diupload Pelanggan:</span>
                    <div class="text-center">
                        <img id="modal-proof-img" src="" alt="Bukti Transfer" class="max-h-56 mx-auto rounded-xl border border-[#ded5cb] shadow-xs cursor-pointer" onclick="window.open(this.src, '_blank')">
                        <p class="text-[0.65rem] text-[#8d8277] mt-1">Klik gambar untuk melihat ukuran penuh</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 p-4 rounded-2xl border border-[#ede7df]">
                    <div>
                        <span class="text-[#8d8277]">Tanggal Acara:</span>
                        <div class="font-semibold" id="modal-event-date">-</div>
                    </div>
                    <div>
                        <span class="text-[#8d8277]">Waktu Sesi:</span>
                        <div class="font-semibold" id="modal-event-time">-</div>
                    </div>
                    <div>
                        <span class="text-[#8d8277]">Lokasi:</span>
                        <div class="font-semibold" id="modal-event-location">-</div>
                    </div>
                    <div>
                        <span class="text-[#8d8277]">Jumlah Tamu:</span>
                        <div class="font-semibold" id="modal-guest-count">-</div>
                    </div>
                </div>

                <!-- Quick Action Buttons -->
                <div class="space-y-3 pt-2">
                    <span class="font-bold text-xs text-[#27221e] block">Aksi Respons Cepat:</span>
                    
                    <!-- Group 1: Konfirmasi Booking (Tahap 1) -->
                    <div id="confirmation-actions-group" class="grid grid-cols-2 gap-3 hidden">
                        <button type="button" 
                                onclick="confirmBookingFromModal()" 
                                class="w-full py-3 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>✓ Terima &amp; Buka DP (7 Hari)</span>
                        </button>
                        <button type="button" 
                                onclick="rejectBookingFromModal()" 
                                class="w-full py-3 px-4 rounded-xl border border-rose-300 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✕ Tolak Booking</span>
                        </button>
                    </div>

                    <!-- Group 2: Verifikasi Pembayaran DP (Tahap 2) -->
                    <div id="dp-actions-group" class="grid grid-cols-2 gap-3 hidden">
                        <button type="button" 
                                onclick="submitPaymentVerification('accept_dp')" 
                                class="w-full py-3 px-4 rounded-xl bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✓ Terima DP (Kunci Jadwal)</span>
                        </button>
                        <button type="button" 
                                onclick="submitPaymentVerification('reject_dp')" 
                                class="w-full py-3 px-4 rounded-xl border border-rose-300 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✕ Tolak Bukti DP</span>
                        </button>
                    </div>

                    <!-- Group 3: Pelunasan Action Group -->
                    <div id="pelunasan-actions-group" class="grid grid-cols-2 gap-3 hidden">
                        <button type="button" 
                                onclick="submitPaymentVerification('accept_pelunasan')" 
                                class="w-full py-3 px-4 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✓ Tandai Selesai / Lunas</span>
                        </button>
                        <button type="button" 
                                onclick="submitPaymentVerification('reject_pelunasan')" 
                                class="w-full py-3 px-4 rounded-xl border border-rose-300 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs transition flex items-center justify-center gap-1.5 cursor-pointer">
                            <span>✕ Tolak Pelunasan</span>
                        </button>
                    </div>
                </div>

                <!-- Manual Status Override Form -->
                <form id="form-update-status" action="{{ route('admin.booking.update_status') }}" method="POST" class="space-y-3 pt-3 border-t border-[#f2ece5]">
                    @csrf
                    <input type="hidden" name="booking_id" id="form-modal-booking-id" value="">
                    
                    <div class="space-y-1.5">
                        <label for="select-status" class="block text-xs font-bold text-[#554d46]">Ubah Status Booking Manual:</label>
                        <select name="status" id="select-status" class="w-full px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] font-medium focus:ring-2 focus:ring-[#5b4b38]/30">
                            <option value="Menunggu Konfirmasi Admin">Menunggu Konfirmasi Admin</option>
                            <option value="Booking Dikonfirmasi">Booking Dikonfirmasi (Menunggu Pembayaran DP 7 Hari)</option>
                            <option value="Menunggu Verifikasi">Menunggu Verifikasi Bukti DP</option>
                            <option value="Booking Aktif">Booking Aktif (DP Dibayar &amp; Jadwal Terkunci)</option>
                            <option value="Selesai">Selesai / Lunas</option>
                            <option value="Dibatalkan">Dibatalkan</option>
                            <option value="Kadaluarsa">Kadaluarsa</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" onclick="closeVerificationModal()" class="px-4 py-2 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] cursor-pointer">
                            Tutup
                        </button>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-xs cursor-pointer">
                            Simpan Perubahan Manual
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <!-- Modal Bukti Bayar Preview Zoom -->
    <!-- ==================== MODAL: BUKTI BAYAR PREVIEW ZOOM ==================== -->
    <div id="modal-proof-zoom" class="fixed inset-0 z-50 bg-black/80 backdrop-blur-xs flex items-center justify-center p-4 hidden" onclick="this.classList.add('hidden')">
        <div class="max-w-2xl w-full bg-white p-4 sm:p-6 rounded-3xl text-center space-y-3" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between pb-2 border-b border-[#f2ece5]">
                <h4 class="font-bold text-sm text-[#27221e]">Pratinjau Bukti Transfer Pembayaran</h4>
                <button type="button" onclick="document.getElementById('modal-proof-zoom').classList.add('hidden')" class="p-1.5 rounded-lg text-[#8d8277] hover:text-[#27221e] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>
            <img id="zoom-proof-img" src="" alt="Bukti Transfer Zoom" class="max-h-[75vh] mx-auto rounded-2xl object-contain border border-[#ede7df]">
        </div>
    </div>

    <!-- ==================== DRAWER: BACKDROP OVERLAY ==================== -->
    <div id="drawer-chat-backdrop" onclick="toggleChatDrawer()" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none"></div>

    <!-- ==================== DRAWER: PUSAT PERCAKAPAN & LIVE CHAT MULTI-USER ==================== -->
    <div id="drawer-chat" class="fixed inset-y-0 right-0 z-50 w-full sm:w-[500px] md:w-[560px] lg:w-[600px] bg-white border-l border-[#ede7df] shadow-2xl flex flex-col justify-between transform translate-x-full transition-transform duration-300 ease-in-out">
        
        <!-- 1. Drawer Header -->
        <div class="p-4 sm:p-5 border-b border-[#f2ece5] bg-[#faf8f5] space-y-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#5b4b38] text-white flex items-center justify-center shadow-xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-serif-luxury text-base sm:text-lg font-bold text-[#27221e]">
                                Layanan Chat Admin
                            </h3>
                            <span class="inline-flex items-center gap-1 px-2 py-0.2 rounded-full text-[0.6rem] font-bold bg-emerald-100 text-emerald-800">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
                            </span>
                        </div>
                        <span class="text-[0.65rem] text-[#8d8277] block">
                            Pusat pesan multi-kontak calon pengantin
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span id="drawer-header-unread-badge" class="{{ ($totalUnread ?? 0) > 0 ? '' : 'hidden' }} px-2.5 py-0.5 rounded-full text-[0.65rem] font-black bg-[#25D366] text-white shadow-xs">
                        {{ ($totalUnread ?? 0) }} Pesan Baru
                    </span>
                    <button type="button" onclick="toggleChatDrawer()" class="p-2 rounded-xl text-[#8d8277] hover:text-[#27221e] hover:bg-[#ede7df] cursor-pointer transition">
                        ✕
                    </button>
                </div>
            </div>

            <!-- 2. Multi-User Contact Selector & Search Bar -->
            <div class="pt-2 border-t border-[#ede7df]/80 space-y-2">
                <div class="flex items-center justify-between text-[0.65rem] font-bold text-[#8d8277] uppercase tracking-wider">
                    <span>PILIH KONTAK PELANGGAN</span>
                    <span id="drawer-total-contacts-count">{{ count($conversations ?? []) }} Kontak Terdaftar</span>
                </div>

                <!-- Search Input for Contacts -->
                <div class="relative">
                    <input type="text" 
                           id="drawer-chat-search" 
                           oninput="filterDrawerContacts(this.value)"
                           placeholder="Cari nama atau email pemesan..." 
                           class="w-full pl-8 pr-3 py-1.5 rounded-xl border border-[#ded5cb] bg-white text-xs text-[#27221e] placeholder-[#a69c92] focus:outline-none focus:ring-1 focus:ring-[#5b4b38]">
                    <svg class="w-3.5 h-3.5 text-[#8d8277] absolute left-2.5 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>

                <!-- Horizontal Scrollable Contact Chips Strip -->
                <div id="drawer-contacts-strip" class="flex items-center gap-2 overflow-x-auto pb-1 pt-0.5 scrollbar-thin">
                    @if(!empty($conversations) && count($conversations) > 0)
                        @foreach($conversations as $em => $c)
                            <button type="button" 
                                    onclick="selectAdminChatUser('{{ $em }}')"
                                    data-email="{{ $em }}"
                                    data-name="{{ $c['name'] }}"
                                    id="drawer-contact-chip-{{ Str::slug($em) }}"
                                    class="drawer-contact-chip shrink-0 flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs transition cursor-pointer {{ $loop->first ? 'bg-[#5b4b38] text-white border-[#5b4b38] shadow-xs' : 'bg-white text-[#27221e] border-[#ded5cb] hover:border-[#5b4b38] hover:bg-[#faf8f5]' }}">
                                <img src="{{ asset($c['avatar'] ?? 'images/profile-avatar.jpg') }}" alt="{{ $c['name'] }}" class="w-5 h-5 rounded-full object-cover border border-white/40 shrink-0">
                                <span class="font-bold truncate max-w-[100px]">{{ $c['name'] }}</span>
                                <span id="chip-unread-{{ Str::slug($em) }}" class="unread-pill px-1.5 py-0.2 rounded-full bg-[#25D366] text-white font-black text-[0.6rem] shadow-xs {{ ($c['unread_count'] ?? 0) > 0 ? '' : 'hidden' }}">{{ $c['unread_count'] ?? 0 }}</span>
                            </button>
                        @endforeach
                    @else
                        <span class="text-xs text-[#8d8277] italic py-1">Belum ada percakapan masuk.</span>
                    @endif
                </div>
            </div>

            <!-- 3. Active Contact Banner Inside Drawer -->
            @php
                $initialDrawerConv = !empty($conversations) ? reset($conversations) : null;
            @endphp
            <div class="p-3 rounded-2xl bg-white border border-[#ede7df] flex items-center justify-between shadow-2xs">
                <div class="flex items-center gap-3">
                    <img src="{{ asset($initialDrawerConv['avatar'] ?? 'images/profile-avatar.jpg') }}" 
                         id="drawer-active-avatar" 
                         alt="Avatar" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-[#5b4b38] shadow-xs">
                    <div>
                        <div class="flex items-center gap-2">
                            <h4 class="font-bold text-xs sm:text-sm text-[#27221e]" id="chat-customer-name">
                                {{ $initialDrawerConv['name'] ?? 'Pilih Kontak' }}
                            </h4>
                            <span class="text-[0.6rem] text-[#5b4b38] bg-[#f5efe8] font-bold px-1.5 py-0.2 rounded">
                                Calon Pengantin
                            </span>
                        </div>
                        <p class="text-[0.65rem] text-[#8d8277]">
                            <span id="drawer-customer-email">{{ $initialDrawerConv['email'] ?? '-' }}</span> • 
                            <span id="drawer-customer-phone">{{ $initialDrawerConv['phone'] ?? '+62 812-3456-7890' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Chat Bubble Thread Body -->
        <div id="chat-messages-container" class="flex-1 p-3.5 overflow-y-auto space-y-2 text-xs bg-[#fdfcfb] custom-scrollbar">
            @php
                $lastDrawerDate = null;
            @endphp
            @if($initialDrawerConv && !empty($initialDrawerConv['messages']))
                @foreach($initialDrawerConv['messages'] as $msg)
                    @php
                        $msgDate = $msg['date_label'] ?? 'Hari Ini';
                    @endphp

                    <!-- Minimal WhatsApp Date Divider Chip -->
                    @if($msgDate !== $lastDrawerDate)
                        <div class="flex items-center justify-center my-1.5">
                            <span class="bg-[#ede7df] text-[#73685e] text-[9.5px] font-medium tracking-normal px-2.5 py-0.5 rounded-md shadow-2xs">
                                {{ $msgDate }}
                            </span>
                        </div>

                        @php
                            $lastDrawerDate = $msgDate;
                        @endphp
                    @endif

                    @if(($msg['sender'] ?? 'customer') === 'customer')
                        <!-- Customer Message (Left) -->
                        <div class="flex justify-start max-w-[85%] mr-auto animate-fadeIn">
                            <div class="bg-white border border-[#ede7df] text-[#27221e] text-[12.5px] px-3 py-1.5 rounded-2xl rounded-tl-xs shadow-2xs leading-relaxed max-w-full">
                                <div class="flex items-center gap-1 mb-0.5">
                                    <span class="font-bold text-[10.5px] text-[#5b4b38]">{{ $msg['name'] }}</span>
                                    <span class="text-[8.5px] text-[#8d8277] bg-[#f2ece5] px-1 rounded font-medium">Customer</span>
                                </div>
                                <span class="break-words">{{ $msg['message'] }}</span>
                                <span class="inline-flex items-center text-[9px] text-[#9c938a] float-right ml-2.5 mt-1 select-none shrink-0">
                                    <span>{{ $msg['time'] }}</span>
                                </span>
                            </div>
                        </div>
                    @else
                        <!-- Admin Reply (Right) -->
                        <div class="flex justify-end max-w-[85%] ml-auto animate-fadeIn">
                            <div class="bg-[#5b4b38] text-white text-[12.5px] px-3 py-1.5 rounded-2xl rounded-tr-xs shadow-2xs leading-relaxed max-w-full">
                                <span class="break-words">{{ $msg['message'] }}</span>
                                <span class="inline-flex items-center gap-0.5 text-[9px] text-white/65 float-right ml-2.5 mt-1 select-none shrink-0">
                                    <span>{{ $msg['time'] }}</span>
                                    <svg class="w-3 h-3 text-sky-300 inline" viewBox="0 0 16 15" fill="currentColor">
                                        <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-16 space-y-2">
                    <p class="text-xs text-[#8d8277]">Belum ada percakapan dalam kontak ini.</p>
                </div>
            @endif
        </div>



        <!-- 5. Quick Reply Chips -->
        <div class="p-3 border-t border-[#f2ece5] bg-[#faf8f5] flex items-center gap-2 overflow-x-auto whitespace-nowrap text-[0.65rem]">
            <span class="font-bold text-[#8d8277] uppercase text-[0.6rem] pr-1 shrink-0">Balas Cepat:</span>
            <button type="button" onclick="applyQuickReply('Halo Kak, jadwal dan paket tersebut masih tersedia untuk tanggal pilihan Anda.')" class="px-2.5 py-1 rounded-full bg-white border border-[#ded5cb] text-[#685f58] hover:border-[#5b4b38] hover:text-[#5b4b38] cursor-pointer shrink-0">
                ✨ Jadwal Tersedia
            </button>
            <button type="button" onclick="applyQuickReply('Pembayaran DP Anda telah kami terima dan verifikasi resmi. Jadwal acara Anda telah terkunci.')" class="px-2.5 py-1 rounded-full bg-white border border-[#ded5cb] text-[#685f58] hover:border-[#5b4b38] hover:text-[#5b4b38] cursor-pointer shrink-0">
                🔒 DP Terverifikasi
            </button>
            <button type="button" onclick="applyQuickReply('Pembayaran pelunasan telah kami validasi lunas. Invoice resmi telah diterbitkan.')" class="px-2.5 py-1 rounded-full bg-white border border-[#ded5cb] text-[#685f58] hover:border-[#5b4b38] hover:text-[#5b4b38] cursor-pointer shrink-0">
                📜 Pelunasan Lunas
            </button>
            <button type="button" onclick="applyQuickReply('Tim wedding coordinator kami akan segera menghubungi Anda via WhatsApp untuk konsultasi teknis.')" class="px-2.5 py-1 rounded-full bg-white border border-[#ded5cb] text-[#685f58] hover:border-[#5b4b38] hover:text-[#5b4b38] cursor-pointer shrink-0">
                📲 Koordinasi WA
            </button>
        </div>

        <!-- 6. Chat Input Form -->
        <form id="admin-chat-form" onsubmit="handleAdminDrawerChatSubmit(event)" class="p-3 sm:p-4 border-t border-[#ede7df] bg-white flex items-center gap-2">
            @csrf
            <input type="hidden" id="drawer-active-target-email" name="user_email" value="{{ $initialDrawerConv['email'] ?? 'sekar.ayu@example.com' }}">
            <input type="hidden" id="drawer-active-target-id" name="user_id" value="{{ $initialDrawerConv['user_id'] ?? '' }}">

            <input type="text" 
                   id="admin-chat-input" 
                   name="message" 
                   required 
                   autocomplete="off"
                   placeholder="Ketik balasan pesan ke customer..." 
                   class="flex-1 px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30">
            <button type="submit" class="py-2.5 px-4 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-xs transition cursor-pointer flex items-center gap-1.5 shrink-0">
                <span>Kirim</span>
                <svg class="w-3.5 h-3.5 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
            </button>
        </form>

    </div>

    <!-- ==================== DRAWER: BACKDROP OVERLAY UNTUK KATEGORI & PRODUK ==================== -->
    <div id="drawer-categories-backdrop" onclick="toggleCategoriesDrawer()" class="fixed inset-0 bg-black/40 backdrop-blur-xs z-50 transition-opacity duration-300 opacity-0 pointer-events-none"></div>

    <!-- ==================== DRAWER: MANAJEMEN KATEGORI & KATALOG PRODUK ==================== -->
    <div id="drawer-categories" class="fixed inset-y-0 right-0 z-50 w-full sm:w-[650px] md:w-[780px] lg:w-[920px] bg-white border-l border-[#ede7df] shadow-2xl flex flex-col justify-between overflow-y-auto transform translate-x-full transition-transform duration-300 ease-in-out">
        
        <!-- 1. Drawer Header -->
        <div class="p-5 sm:p-6 border-b border-[#f2ece5] bg-[#faf8f5] sticky top-0 z-20 space-y-3">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-[#5b4b38] text-white flex items-center justify-center shadow-xs shrink-0">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-serif-luxury text-lg sm:text-xl font-bold text-[#27221e]">
                                Kategori &amp; Katalog Produk
                            </h3>
                            <span class="text-xs font-bold text-[#8d8277] bg-[#eee6dc] px-2.5 py-0.5 rounded-full">
                                {{ count($categories) }} Kategori
                            </span>
                        </div>
                        <p class="text-xs text-[#8d8277]">
                            Kelola kategori, paket layanan, dan daftar harga produk DreamDay Studio.
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2 shrink-0">
                    <button type="button" 
                            onclick="openAddCategoryModal()" 
                            class="px-4 py-2 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-xs shadow-xs transition duration-200 cursor-pointer flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>+ Tambah Kategori</span>
                    </button>
                    <button type="button" onclick="toggleCategoriesDrawer()" class="p-2 rounded-xl text-[#8d8277] hover:text-[#27221e] hover:bg-[#ede7df] cursor-pointer transition">
                        ✕
                    </button>
                </div>
            </div>
        </div>

        <!-- 2. Drawer Body: Categories Grid & Product Catalog -->
        <div class="flex-1 p-5 sm:p-6 space-y-6">
            
            <!-- Category Cards Grid -->
            <div>
                <div class="flex items-center justify-between pb-3">
                    <span class="text-[0.7rem] font-bold text-[#8d8277] uppercase tracking-wider">KATEGORI LAYANAN TERSEDIA</span>
                    <span class="text-xs text-[#8d8277]">Klik kartu untuk memfilter produk</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($categories as $index => $cat)
                        @php
                            $prodCount = $allServices->where('category', $cat->name)->count();
                            $bCount = $cat->getRelatedBookingsCount();
                        @endphp
                        <div id="cat-card-{{ $cat->slug }}" 
                             onclick="selectCategory('{{ $cat->name }}', '{{ $cat->slug }}')"
                             class="category-card p-4 rounded-2xl border-2 {{ $index === 0 ? 'category-tab-active border-[#5b4b38]' : 'border-[#ede7df] bg-white' }} hover:border-[#5b4b38] transition-all duration-200 cursor-pointer flex flex-col justify-between space-y-3 group shadow-2xs">
                            
                            <div class="flex items-start justify-between gap-2">
                                <div class="flex items-center gap-3">
                                    <img src="{{ asset($cat->image ?: 'images/service-venue.jpg') }}" 
                                         alt="{{ $cat->name }}" 
                                         class="w-12 h-12 rounded-xl object-cover border border-[#ede7df] shadow-2xs group-hover:scale-105 transition-transform shrink-0">
                                    <div>
                                        <div class="flex items-center gap-1.5">
                                            <h4 class="font-bold text-sm text-[#27221e] group-hover:text-[#5b4b38] transition-colors">{{ $cat->name }}</h4>
                                            @if($cat->is_active)
                                                <span class="w-2 h-2 rounded-full bg-emerald-500" title="Kategori Aktif"></span>
                                            @else
                                                <span class="w-2 h-2 rounded-full bg-rose-400" title="Kategori Nonaktif"></span>
                                            @endif
                                        </div>
                                        <span class="text-[0.65rem] text-[#8d8277] font-medium block">
                                            {{ $prodCount }} Produk
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center gap-1" onclick="event.stopPropagation()">
                                    <button type="button" 
                                            onclick="openEditCategoryModal({{ json_encode($cat) }})" 
                                            title="Edit Kategori"
                                            class="p-1.5 rounded-lg border border-[#ded5cb] hover:border-[#5b4b38] hover:bg-[#faf7f2] text-xs text-[#5b4b38] transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </button>
                                    <button type="button" 
                                            onclick="openDeleteCategoryModal({{ $cat->id }}, '{{ addslashes($cat->name) }}', {{ $prodCount }}, {{ $bCount }})" 
                                            title="Hapus Kategori"
                                            class="p-1.5 rounded-lg border border-rose-200 hover:border-rose-500 hover:bg-rose-50 text-xs text-rose-600 transition cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <p class="text-[0.7rem] text-[#685f58] line-clamp-2 leading-relaxed">
                                {{ $cat->description ?: 'Layanan berkualitas tinggi untuk momen pernikahan Anda.' }}
                            </p>

                            <div class="pt-2 border-t border-[#f2ece5] flex items-center justify-between text-xs">
                                <span class="text-[#5b4b38] font-bold text-[0.7rem] flex items-center gap-1">
                                    <span>Pilih Kategori</span>
                                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                                </span>
                                <span class="text-[0.6rem] text-[#8d8277] bg-[#f5f0ea] px-2 py-0.5 rounded font-bold">
                                    {{ $bCount }} Booking
                                </span>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Catalog Sub-Section -->
            <div class="p-5 sm:p-6 rounded-3xl bg-[#faf8f5] border border-[#ede7df] space-y-4">
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-4 border-b border-[#ede7df]">
                    <div>
                        <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8d8277]">PRODUK TERSEDIA PADA KATEGORI</span>
                        <h4 class="font-serif-luxury text-lg sm:text-xl font-bold text-[#27221e] flex items-center gap-2">
                            <span>Katalog Produk:</span>
                            <span id="active-category-title" class="text-[#5b4b38]">
                                {{ $categories->first()->name ?? 'Venues' }}
                            </span>
                        </h4>
                    </div>

                    <button type="button" 
                            onclick="openAddServiceModal()" 
                            class="px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs transition duration-200 cursor-pointer flex items-center gap-1.5 shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>+ Tambah Produk</span>
                    </button>
                </div>

                <!-- Product Grid -->
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($allServices as $srv)
                        <div class="product-item-card bg-white border border-[#ede7df] hover:border-[#5b4b38] rounded-2xl p-3.5 shadow-2xs hover:shadow-md transition duration-200 flex flex-col justify-between space-y-3" data-category="{{ $srv->category }}">
                            
                            <div class="space-y-2.5">
                                <div class="relative aspect-video rounded-xl overflow-hidden border border-[#ede7df]">
                                    <img src="{{ asset($srv->image ?: 'images/service-venue.jpg') }}" 
                                         alt="{{ $srv->title }}" 
                                         class="w-full h-full object-cover">
                                    <span class="absolute top-2 left-2 text-[0.6rem] font-bold bg-[#5b4b38] text-white px-2 py-0.5 rounded shadow-xs">
                                        {{ $srv->category }}
                                    </span>
                                    @if($srv->badge)
                                        <span class="absolute top-2 right-2 text-[0.6rem] font-bold bg-white/90 backdrop-blur-xs text-[#27221e] px-2 py-0.5 rounded shadow-xs">
                                            {{ $srv->badge }}
                                        </span>
                                    @endif
                                </div>

                                <div class="space-y-0.5">
                                    <h5 class="font-bold text-xs sm:text-sm text-[#27221e] line-clamp-1" title="{{ $srv->title }}">{{ $srv->title }}</h5>
                                    <div class="text-xs font-serif-luxury font-bold text-[#5b4b38]">
                                        {{ $srv->price_formatted ?: ('Rp ' . number_format($srv->price, 0, ',', '.')) }}
                                    </div>
                                    <div class="text-[0.65rem] text-[#8d8277] flex items-center justify-between pt-0.5">
                                        <span class="truncate">📍 {{ $srv->location ?: 'Indonesia' }}</span>
                                        <span>👥 {{ $srv->capacity ?: '-' }}</span>
                                    </div>
                                </div>

                                <p class="text-[0.7rem] text-[#685f58] line-clamp-2 leading-relaxed">
                                    {{ $srv->description ?: 'Paket layanan terbaik dari vendor terpercaya DreamDay Studio.' }}
                                </p>
                            </div>

                            <div class="pt-2.5 border-t border-[#f2ece5] flex items-center justify-between gap-2">
                                <button type="button" 
                                        onclick="openEditServiceModal({{ json_encode($srv) }})" 
                                        class="flex-1 py-1.5 px-2.5 rounded-xl bg-[#faf7f2] hover:bg-[#5b4b38] text-[#5b4b38] hover:text-white border border-[#ded5cb] hover:border-[#5b4b38] text-xs font-bold transition duration-200 cursor-pointer flex items-center justify-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <span>Edit</span>
                                </button>

                                <button type="button" 
                                        onclick="openDeleteServiceModal({{ $srv->id }}, '{{ addslashes($srv->title) }}')" 
                                        title="Hapus Produk"
                                        class="py-1.5 px-2.5 rounded-xl border border-rose-200 hover:bg-rose-50 text-xs font-bold text-rose-600 transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Empty State for Products in Category -->
                <div id="no-products-msg" class="hidden text-center py-10 px-4 bg-white rounded-2xl border border-[#ede7df]">
                    <div class="w-10 h-10 rounded-xl bg-[#faf7f2] text-[#5b4b38] flex items-center justify-center mx-auto mb-2 border border-[#ede7df]">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h5 class="font-bold text-xs text-[#27221e]">Belum Ada Produk di Kategori Ini</h5>
                    <p class="text-[0.7rem] text-[#8d8277] mt-0.5">Klik tombol "+ Tambah Produk" untuk menambahkan produk baru.</p>
                </div>

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
                <a href="{{ route('home') }}" class="hover:text-[#27221e] transition-colors">Portal Utama</a>
                <span class="text-[#cfc5ba] hidden sm:inline">•</span>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Ketentuan Layanan</a>
            </div>
        </div>
    </footer>

    <!-- JavaScript Interactive Handlers -->
    <script>
        function formatRupiah(number) {
            return 'Rp ' + (number || 0).toLocaleString('id-ID');
        }

        let activeCategoryName = "{{ $categories->first()->name ?? 'Venues' }}";

        function selectCategory(categoryName, categorySlug) {
            activeCategoryName = categoryName;
            const titleEl = document.getElementById('active-category-title');
            if (titleEl) titleEl.textContent = categoryName;

            // Highlight card
            document.querySelectorAll('.category-card').forEach(card => {
                card.classList.remove('category-tab-active', 'border-[#5b4b38]');
                card.classList.add('border-[#ede7df]', 'bg-white');
            });
            const activeCard = document.getElementById('cat-card-' + categorySlug);
            if (activeCard) {
                activeCard.classList.add('category-tab-active', 'border-[#5b4b38]');
                activeCard.classList.remove('border-[#ede7df]', 'bg-white');
            }

            // Filter products
            let visibleCount = 0;
            document.querySelectorAll('.product-item-card').forEach(item => {
                const itemCat = item.getAttribute('data-category');
                if (itemCat === categoryName) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            const emptyMsg = document.getElementById('no-products-msg');
            if (emptyMsg) {
                if (visibleCount === 0) {
                    emptyMsg.classList.remove('hidden');
                } else {
                    emptyMsg.classList.add('hidden');
                }
            }
        }

        // Initialize category on load
        document.addEventListener('DOMContentLoaded', () => {
            const firstCat = "{{ $categories->first()->name ?? 'Venues' }}";
            const firstSlug = "{{ $categories->first()->slug ?? 'venues' }}";
            selectCategory(firstCat, firstSlug);

            // Scroll chat containers to bottom
            scrollChatToBottom();
        });

        // ==================== MULTI-USER CHAT DRAWER MANAGEMENT LOGIC ====================
        let conversationsData = @json($conversations ?? []);
        let currentActiveEmail = "{{ $conversations ? array_key_first($conversations) : 'sekar.ayu@example.com' }}";

        function scrollChatToBottom() {
            const drawerCont = document.getElementById('chat-messages-container');
            if (drawerCont) drawerCont.scrollTop = drawerCont.scrollHeight;
        }

        function toggleCategoriesDrawer() {
            const drawer = document.getElementById('drawer-categories');
            const backdrop = document.getElementById('drawer-categories-backdrop');
            if (drawer) {
                const isClosed = drawer.classList.contains('translate-x-full');
                if (isClosed) {
                    drawer.classList.remove('translate-x-full');
                    if (backdrop) {
                        backdrop.classList.remove('opacity-0', 'pointer-events-none');
                        backdrop.classList.add('opacity-100', 'pointer-events-auto');
                    }
                } else {
                    drawer.classList.add('translate-x-full');
                    if (backdrop) {
                        backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                        backdrop.classList.add('opacity-0', 'pointer-events-none');
                    }
                }
            }
        }

        function toggleChatDrawer() {
            const drawer = document.getElementById('drawer-chat');
            const backdrop = document.getElementById('drawer-chat-backdrop');
            if (drawer) {
                const isClosed = drawer.classList.contains('translate-x-full');
                if (isClosed) {
                    drawer.classList.remove('translate-x-full');
                    if (backdrop) {
                        backdrop.classList.remove('opacity-0', 'pointer-events-none');
                        backdrop.classList.add('opacity-100', 'pointer-events-auto');
                    }
                    setTimeout(scrollChatToBottom, 100);

                    // When drawer is opened, auto-select customer with unread messages and mark as read
                    let targetEmail = currentActiveEmail;
                    for (const [em, c] of Object.entries(conversationsData)) {
                        if ((c.unread_count || 0) > 0) {
                            targetEmail = em;
                            break;
                        }
                    }
                    if (targetEmail) {
                        selectAdminChatUser(targetEmail);
                    }
                } else {
                    drawer.classList.add('translate-x-full');
                    if (backdrop) {
                        backdrop.classList.remove('opacity-100', 'pointer-events-auto');
                        backdrop.classList.add('opacity-0', 'pointer-events-none');
                    }
                }
            }
        }


        function filterDrawerContacts(query) {
            const q = query.toLowerCase().trim();
            document.querySelectorAll('.drawer-contact-chip').forEach(chip => {
                const name = (chip.getAttribute('data-name') || '').toLowerCase();
                const email = (chip.getAttribute('data-email') || '').toLowerCase();
                if (!q || name.includes(q) || email.includes(q)) {
                    chip.style.display = '';
                } else {
                    chip.style.display = 'none';
                }
            });
        }

        function selectAdminChatUser(email) {
            if (!email) return;
            currentActiveEmail = email;
            const conv = conversationsData[email];
            if (!conv) return;

            // 1. Update contact chip active styling in drawer
            document.querySelectorAll('.drawer-contact-chip').forEach(c => {
                c.className = "drawer-contact-chip shrink-0 flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs transition cursor-pointer bg-white text-[#27221e] border-[#ded5cb] hover:border-[#5b4b38] hover:bg-[#faf8f5]";
            });
            const activeChip = document.getElementById('drawer-contact-chip-' + email.replace(/[^a-zA-Z0-9]/g, '-'));
            if (activeChip) {
                activeChip.className = "drawer-contact-chip shrink-0 flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs transition cursor-pointer bg-[#5b4b38] text-white border-[#5b4b38] shadow-xs";
            }

            // Instantly hide and clear unread pill on this chip
            const slug = email.replace(/[^a-zA-Z0-9]/g, '-');
            const chipPill = document.getElementById('chip-unread-' + slug);
            if (chipPill) {
                chipPill.classList.add('hidden');
                chipPill.textContent = '0';
            }

            // Immediately reduce unread count in local data
            if (conv.unread_count > 0) {
                const unreadForThisUser = conv.unread_count;
                conv.unread_count = 0;
                lastTotalUnreadCount = Math.max(0, lastTotalUnreadCount - unreadForThisUser);
                updateAllUnreadBadges(lastTotalUnreadCount);
            }

            // 2. Update Drawer Header Info
            const avatarUrl = '/' + (conv.avatar || 'images/profile-avatar.jpg').replace(/^\/+/, '');
            const drawerAvatarEl = document.getElementById('drawer-active-avatar');
            if (drawerAvatarEl) drawerAvatarEl.src = avatarUrl;

            const drawerNameEl = document.getElementById('chat-customer-name');
            if (drawerNameEl) drawerNameEl.textContent = conv.name || 'Customer';

            const emailEl = document.getElementById('drawer-customer-email');
            if (emailEl) emailEl.textContent = conv.email;

            const phoneEl = document.getElementById('drawer-customer-phone');
            if (phoneEl) phoneEl.textContent = conv.phone || '+62 812-3456-7890';

            const targetEmailInput = document.getElementById('drawer-active-target-email');
            if (targetEmailInput) targetEmailInput.value = conv.email;

            const targetIdInput = document.getElementById('drawer-active-target-id');
            if (targetIdInput) targetIdInput.value = conv.user_id || '';

            // 3. Render Message Bubbles in Drawer
            renderDrawerMessages(conv.messages, avatarUrl, conv.name);

            // 4. Mark as read via AJAX and sync server state
            fetch("{{ route('admin.chat.mark_read') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ user_email: email })
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    if (conversationsData[email]) {
                        conversationsData[email].unread_count = 0;
                    }
                    if (data.total_unread !== undefined) {
                        lastTotalUnreadCount = data.total_unread;
                        updateAllUnreadBadges(data.total_unread);
                    }
                }
            })
            .catch(e => console.log(e));
        }

        function renderDrawerMessages(msgs, avatarUrl, customerName) {
            const drawerCont = document.getElementById('chat-messages-container');
            if (!drawerCont) return;

            let drawerHtml = '';
            let lastDate = null;

            if (msgs && msgs.length > 0) {
                msgs.forEach(m => {
                    const msgDate = m.date_label || 'Hari Ini';
                    if (msgDate !== lastDate) {
                        drawerHtml += `
                            <div class="flex items-center justify-center my-1.5">
                                <span class="bg-[#ede7df] text-[#73685e] text-[9.5px] font-medium tracking-normal px-2.5 py-0.5 rounded-md shadow-2xs">
                                    ${escapeHtml(msgDate)}
                                </span>
                            </div>
                        `;
                        lastDate = msgDate;
                    }

                    const isCustomer = (m.sender === 'customer');
                    const timeStr = m.time || '';

                    if (isCustomer) {
                        drawerHtml += `
                            <div class="flex justify-start max-w-[85%] mr-auto animate-fadeIn">
                                <div class="bg-white border border-[#ede7df] text-[#27221e] text-[12.5px] px-3 py-1.5 rounded-2xl rounded-tl-xs shadow-2xs leading-relaxed max-w-full">
                                    <div class="flex items-center gap-1 mb-0.5">
                                        <span class="font-bold text-[10.5px] text-[#5b4b38]">${escapeHtml(m.name || customerName)}</span>
                                        <span class="text-[8.5px] text-[#8d8277] bg-[#f2ece5] px-1 rounded font-medium">Customer</span>
                                    </div>
                                    <span class="break-words">${escapeHtml(m.message)}</span>
                                    <span class="inline-flex items-center text-[8.5px] text-[#9c938a] float-right ml-2.5 mt-1 select-none shrink-0">
                                        <span>${escapeHtml(timeStr)}</span>
                                    </span>
                                </div>
                            </div>
                        `;
                    } else {
                        drawerHtml += `
                            <div class="flex justify-end max-w-[85%] ml-auto animate-fadeIn">
                                <div class="bg-[#5b4b38] text-white text-[12.5px] px-3 py-1.5 rounded-2xl rounded-tr-xs shadow-2xs leading-relaxed max-w-full">
                                    <span class="break-words">${escapeHtml(m.message)}</span>
                                    <span class="inline-flex items-center gap-0.5 text-[8.5px] text-white/60 float-right ml-2.5 mt-1 select-none shrink-0">
                                        <span>${escapeHtml(timeStr)}</span>
                                        <svg class="w-2.5 h-2.5 text-sky-300 inline" viewBox="0 0 16 15" fill="currentColor">
                                            <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.063-.51z"/>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        `;
                    }

                });
            } else {
                drawerHtml = '<div class="text-center py-16 space-y-2"><p class="text-xs text-[#8d8277]">Belum ada pesan dalam percakapan ini.</p></div>';
            }

            drawerCont.innerHTML = drawerHtml;
            scrollChatToBottom();
        }


        function handleAdminDrawerChatSubmit(e) {
            e.preventDefault();
            const input = document.getElementById('admin-chat-input');
            const message = input.value.trim();
            if (!message) return;

            const email = currentActiveEmail;
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const mins = String(now.getMinutes()).padStart(2, '0');
            const timeStr = `${hours}:${mins}`;

            const newMsgObj = {
                sender: 'admin',
                name: 'Admin DreamDay',
                message: message,
                time: timeStr,
                date_label: 'HARI INI',
                is_read: true
            };

            if (conversationsData[email]) {
                conversationsData[email].messages = conversationsData[email].messages || [];
                conversationsData[email].messages.push(newMsgObj);
                conversationsData[email].last_message = message;
                conversationsData[email].last_time = timeStr;
                conversationsData[email].last_sender = 'admin';
                renderDrawerMessages(conversationsData[email].messages, '/' + (conversationsData[email].avatar || 'images/profile-avatar.jpg').replace(/^\/+/, ''), conversationsData[email].name);
            }

            input.value = '';
            scrollChatToBottom();


            // 2. Send via AJAX
            fetch("{{ route('admin.chat.reply') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    message: message,
                    user_email: email,
                    user_id: conversationsData[email]?.user_id || null
                })
            }).catch(err => console.log('Admin reply error:', err));
        }

        function openChatWithCustomer(name, email = null) {
            let matchedEmail = email;
            if (!matchedEmail && name) {
                for (const [em, c] of Object.entries(conversationsData)) {
                    if (c.name && c.name.toLowerCase() === name.toLowerCase()) {
                        matchedEmail = em;
                        break;
                    }
                }
            }
            if (!matchedEmail && email) {
                matchedEmail = email;
            }

            if (matchedEmail && conversationsData[matchedEmail]) {
                selectAdminChatUser(matchedEmail);
            } else if (name) {
                const fallbackEmail = email || `${name.toLowerCase().replace(/[^a-z0-9]/g, '')}@gmail.com`;
                if (!conversationsData[fallbackEmail]) {
                    conversationsData[fallbackEmail] = {
                        email: fallbackEmail,
                        name: name,
                        avatar: 'images/profile-avatar.jpg',
                        phone: '+62 812-3456-7890',
                        unread_count: 0,
                        messages: []
                    };
                }
                selectAdminChatUser(fallbackEmail);
            }
            toggleChatDrawer();
            const input = document.getElementById('admin-chat-input');
            if (input) input.focus();
        }

        function markAllChatsAsRead() {
            fetch("{{ route('admin.chat.mark_all_read') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data && data.success) {
                    for (const em in conversationsData) {
                        conversationsData[em].unread_count = 0;
                        const slug = em.replace(/[^a-zA-Z0-9]/g, '-');
                        const chipPill = document.getElementById('chip-unread-' + slug);
                        if (chipPill) {
                            chipPill.classList.add('hidden');
                            chipPill.textContent = '0';
                        }
                    }
                    lastTotalUnreadCount = 0;
                    updateAllUnreadBadges(0);
                }
            })
            .catch(e => console.log(e));
        }

        // Admin Navbar Hamburger Dropdown
        function toggleAdminNavDropdown() {
            const dropdown = document.getElementById('admin-nav-dropdown');
            const btn = document.getElementById('admin-menu-toggle-btn');
            if (dropdown) {
                const isHidden = dropdown.classList.contains('hidden');
                if (isHidden) {
                    dropdown.classList.remove('hidden');
                    if (btn) btn.setAttribute('aria-expanded', 'true');
                } else {
                    dropdown.classList.add('hidden');
                    if (btn) btn.setAttribute('aria-expanded', 'false');
                }
            }
        }

        function closeAdminNavDropdown() {
            const dropdown = document.getElementById('admin-nav-dropdown');
            const btn = document.getElementById('admin-menu-toggle-btn');
            if (dropdown) {
                dropdown.classList.add('hidden');
                if (btn) btn.setAttribute('aria-expanded', 'false');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            const dropdown = document.getElementById('admin-nav-dropdown');
            const btn = document.getElementById('admin-menu-toggle-btn');
            if (dropdown && !dropdown.classList.contains('hidden')) {
                if (!dropdown.contains(e.target) && !btn.contains(e.target)) {
                    closeAdminNavDropdown();
                }
            }
        });

        function applyQuickReply(text) {
            const input = document.getElementById('admin-chat-input');
            if (input) {
                input.value = text;
                input.focus();
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text || '';
            return div.innerHTML;
        }

        let lastTotalUnreadCount = {{ (int) ($totalUnread ?? 0) }};

        function playWhatsAppTone() {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                if (ctx.state === 'suspended') {
                    ctx.resume();
                }
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.type = 'sine';
                osc.frequency.setValueAtTime(800, ctx.currentTime);
                osc.frequency.exponentialRampToValueAtTime(1200, ctx.currentTime + 0.08);
                gain.gain.setValueAtTime(0.2, ctx.currentTime);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.25);
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.start();
                osc.stop(ctx.currentTime + 0.25);
            } catch (e) {}
        }

        function updateAllUnreadBadges(total) {
            const totalNum = parseInt(total) || 0;
            const badgeText = totalNum > 99 ? '99+' : String(totalNum);

            // 1. Header Button Badge
            const headerBadge = document.getElementById('header-chat-unread-badge');
            if (headerBadge) {
                if (totalNum > 0) {
                    headerBadge.textContent = badgeText;
                    headerBadge.classList.remove('hidden');
                } else {
                    headerBadge.classList.add('hidden');
                }
            }

            // 2. Hamburger Button Badge
            const burgerBadge = document.getElementById('hamburger-chat-unread-badge');
            if (burgerBadge) {
                if (totalNum > 0) {
                    burgerBadge.textContent = badgeText;
                    burgerBadge.classList.remove('hidden');
                } else {
                    burgerBadge.classList.add('hidden');
                }
            }

            // 3. Dropdown Menu Item Badge
            const dropBadge = document.getElementById('dropdown-chat-unread-badge');
            if (dropBadge) {
                if (totalNum > 0) {
                    dropBadge.textContent = `${badgeText} Pesan`;
                    dropBadge.classList.remove('hidden');
                } else {
                    dropBadge.classList.add('hidden');
                }
            }

            // 4. Drawer Header Badge
            const drawerBadge = document.getElementById('drawer-header-unread-badge');
            if (drawerBadge) {
                if (totalNum > 0) {
                    drawerBadge.textContent = `${badgeText} Pesan Baru`;
                    drawerBadge.classList.remove('hidden');
                } else {
                    drawerBadge.classList.add('hidden');
                }
            }
        }

        // Periodic Background Sync for Admin Conversations (Every 3 seconds)
        setInterval(() => {
            fetch("{{ route('admin.chat.conversations') }}")
                .then(res => res.json())
                .then(data => {
                    if (data && data.success && data.conversations) {
                        const newTotal = parseInt(data.total_unread) || 0;
                        if (newTotal > lastTotalUnreadCount) {
                            playWhatsAppTone();
                        }
                        lastTotalUnreadCount = newTotal;

                        data.conversations.forEach(c => {
                            const em = c.email;
                            const slug = em.replace(/[^a-zA-Z0-9]/g, '-');
                            
                            // Update chip unread pill
                            const chipPill = document.getElementById('chip-unread-' + slug);
                            if (chipPill) {
                                if (c.unread_count > 0 && em !== currentActiveEmail) {
                                    chipPill.textContent = c.unread_count > 99 ? '99+' : c.unread_count;
                                    chipPill.classList.remove('hidden');
                                } else {
                                    chipPill.classList.add('hidden');
                                }
                            }

                            if (conversationsData[em]) {
                                // If active conversation received new messages, re-render
                                if (em === currentActiveEmail && c.messages.length !== (conversationsData[em].messages?.length || 0)) {
                                    conversationsData[em] = c;
                                    const avatarUrl = '/' + (c.avatar || 'images/profile-avatar.jpg').replace(/^\/+/, '');
                                    renderDrawerMessages(c.messages, avatarUrl, c.name);

                                    fetch("{{ route('admin.chat.mark_read') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({ user_email: em })
                                    }).catch(e => {});
                                } else {
                                    conversationsData[em] = c;
                                }
                            } else {
                                // New customer started chatting! Add to conversations data
                                conversationsData[em] = c;
                                const stripEl = document.getElementById('drawer-contacts-strip');
                                if (stripEl) {
                                    const newChipHtml = `
                                        <button type="button" 
                                                onclick="selectAdminChatUser('${em}')"
                                                data-email="${em}"
                                                data-name="${escapeHtml(c.name)}"
                                                id="drawer-contact-chip-${slug}"
                                                class="drawer-contact-chip shrink-0 flex items-center gap-2 px-3 py-1.5 rounded-xl border text-xs transition cursor-pointer bg-white text-[#27221e] border-[#ded5cb] hover:border-[#5b4b38] hover:bg-[#faf8f5] animate-fadeIn">
                                            <img src="/${(c.avatar || 'images/profile-avatar.jpg').replace(/^\/+/, '')}" alt="${escapeHtml(c.name)}" class="w-5 h-5 rounded-full object-cover border border-white/40 shrink-0">
                                            <span class="font-bold truncate max-w-[100px]">${escapeHtml(c.name)}</span>
                                            <span id="chip-unread-${slug}" class="unread-pill px-1.5 py-0.2 rounded-full bg-[#25D366] text-white font-black text-[0.6rem] shadow-xs ${c.unread_count > 0 ? '' : 'hidden'}">${c.unread_count}</span>
                                        </button>
                                    `;
                                    stripEl.insertAdjacentHTML('afterbegin', newChipHtml);
                                }
                            }
                        });

                        // Update Total Unread Badges in Header, Hamburger, Dropdown & Drawer
                        updateAllUnreadBadges(newTotal);
                    }
                })
                .catch(e => {});
        }, 3000);


        // Category Modals
        function openAddCategoryModal() {
            document.getElementById('modal-add-category').classList.remove('hidden');
        }

        function closeAddCategoryModal() {
            document.getElementById('modal-add-category').classList.add('hidden');
        }

        function openEditCategoryModal(cat) {
            document.getElementById('edit_cat_name').value = cat.name;
            document.getElementById('edit_cat_desc').value = cat.description || '';
            document.getElementById('edit_cat_preview').src = '/' + (cat.image || 'images/service-venue.jpg').replace(/^\/+/, '');
            document.getElementById('edit_cat_active').checked = !!cat.is_active;
            
            const form = document.getElementById('form-edit-category');
            form.action = '/admin/categories/' + cat.id + '/update';

            const delBtn = document.getElementById('btn-delete-cat-from-edit');
            if (delBtn) {
                delBtn.onclick = function() {
                    closeEditCategoryModal();
                    openDeleteCategoryModal(cat.id, cat.name);
                };
            }

            document.getElementById('modal-edit-category').classList.remove('hidden');
        }

        function closeEditCategoryModal() {
            document.getElementById('modal-edit-category').classList.add('hidden');
        }

        function openDeleteCategoryModal(id, name, prodCount = 0, bCount = 0) {
            document.getElementById('delete-cat-name').textContent = '"' + name + '"';
            const form = document.getElementById('form-delete-category');
            form.action = '/admin/categories/' + id + '/delete';

            const warningEl = document.getElementById('delete-cat-warning');
            const warningTextEl = document.getElementById('delete-cat-warning-text');
            if (prodCount > 0 || bCount > 0) {
                if (warningTextEl) warningTextEl.textContent = `Kategori ini memiliki ${prodCount} produk dan ${bCount} booking terkait. Menghapus kategori ini akan menonaktifkannya secara aman agar data transaksi lama tetap utuh.`;
                if (warningEl) warningEl.classList.remove('hidden');
            } else {
                if (warningTextEl) warningTextEl.textContent = 'Kategori ini tidak memiliki produk atau booking terkait dan akan dihapus secara permanen dari database.';
                if (warningEl) warningEl.classList.add('hidden');
            }

            document.getElementById('modal-delete-category').classList.remove('hidden');
        }

        function closeDeleteCategoryModal() {
            document.getElementById('modal-delete-category').classList.add('hidden');
        }


        // Service / Product Modals
        function openAddServiceModal() {
            document.getElementById('add_srv_category').value = activeCategoryName;
            document.getElementById('modal-add-service').classList.remove('hidden');
        }

        function closeAddServiceModal() {
            document.getElementById('modal-add-service').classList.add('hidden');
        }

        function openEditServiceModal(srv) {
            document.getElementById('edit_srv_title').value = srv.title;
            document.getElementById('edit_srv_category').value = srv.category;
            document.getElementById('edit_srv_price').value = srv.price;
            document.getElementById('edit_srv_location').value = srv.location || '';
            document.getElementById('edit_srv_capacity').value = srv.capacity || '';
            document.getElementById('edit_srv_rating').value = srv.rating || '5.0 (Baru)';
            document.getElementById('edit_srv_badge').value = srv.badge || '';
            document.getElementById('edit_srv_desc').value = srv.description || '';
            document.getElementById('edit_srv_preview').src = '/' + (srv.image || 'images/service-venue.jpg').replace(/^\/+/, '');

            const form = document.getElementById('form-edit-service');
            form.action = '/admin/services/' + srv.id + '/update';

            document.getElementById('modal-edit-service').classList.remove('hidden');
        }

        function closeEditServiceModal() {
            document.getElementById('modal-edit-service').classList.add('hidden');
        }

        function openDeleteServiceModal(id, title) {
            document.getElementById('delete-srv-name').textContent = title;
            const form = document.getElementById('form-delete-service');
            form.action = '/admin/services/' + id + '/delete';

            document.getElementById('modal-delete-service').classList.remove('hidden');
        }

        function closeDeleteServiceModal() {
            document.getElementById('modal-delete-service').classList.add('hidden');
        }

        function formatRupiah(amount) {
            const num = parseInt(amount) || 0;
            return 'Rp ' + num.toLocaleString('id-ID');
        }

        // Bookings Filter & Modals
        function filterBookings(status) {
            const rows = document.querySelectorAll('.booking-row');
            const btns = document.querySelectorAll('.filter-btn');

            btns.forEach(btn => {
                btn.className = "px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#faf7f2] text-[#685f58] hover:bg-[#ede7df] filter-btn cursor-pointer";
            });
            event.currentTarget.className = "px-3 py-1.5 rounded-lg text-xs font-semibold bg-[#5b4b38] text-white filter-btn cursor-pointer";

            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'ALL' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        let currentActiveBooking = null;

        function confirmBooking(bookingId) {
            if (!confirm('Terima booking ini? Akses pembayaran DP selama 7 hari akan langsung dibuka untuk pelanggan.')) return;

            fetch("{{ route('admin.booking.confirm') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ booking_id: bookingId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Booking berhasil dikonfirmasi! Akses pembayaran DP telah dibuka.');
                } else {
                    alert(data.message || 'Gagal mengonfirmasi booking.');
                }
                window.location.reload();
            })
            .catch(err => window.location.reload());
        }

        function rejectBooking(bookingId) {
            if (!confirm('Apakah Anda yakin ingin menolak booking ini? Status booking akan dibatalkan.')) return;

            fetch("{{ route('admin.booking.reject') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({ booking_id: bookingId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message || 'Booking telah ditolak.');
                } else {
                    alert(data.message || 'Gagal menolak booking.');
                }
                window.location.reload();
            })
            .catch(err => window.location.reload());
        }

        function confirmBookingFromModal() {
            if (!currentActiveBooking) return;
            confirmBooking(currentActiveBooking.id);
        }

        function rejectBookingFromModal() {
            if (!currentActiveBooking) return;
            rejectBooking(currentActiveBooking.id);
        }

        function openVerificationModal(booking) {
            currentActiveBooking = booking;
            document.getElementById('modal-booking-id').textContent = '#' + booking.id;
            document.getElementById('form-modal-booking-id').value = booking.id;

            const bStatus = booking.status || 'Menunggu Konfirmasi Admin';
            const pStatus = booking.payment_status || 'Belum Dibayar';
            const bUpper = bStatus.toUpperCase();
            const pUpper = pStatus.toUpperCase();

            document.getElementById('modal-booking-status').textContent = bStatus;
            document.getElementById('modal-payment-status').textContent = pStatus;
            document.getElementById('modal-service-title').textContent = booking.service_title;
            document.getElementById('modal-customer-info').textContent = `Pemesan: ${booking.customer_name} (${booking.customer_phone}) • ${booking.customer_email}`;
            
            document.getElementById('modal-total-price').textContent = formatRupiah(booking.total_price);
            document.getElementById('modal-dp-percentage').textContent = (booking.dp_percentage || 30) + '%';
            document.getElementById('modal-dp-amount').textContent = formatRupiah(booking.dp_amount);
            document.getElementById('modal-remaining-amount').textContent = formatRupiah(booking.remaining_amount);
            document.getElementById('modal-payment-method').textContent = booking.payment_method || 'Belum dipilih';

            document.getElementById('modal-event-date').textContent = booking.event_date || '-';
            document.getElementById('modal-event-time').textContent = booking.event_time || '-';
            document.getElementById('modal-event-location').textContent = booking.event_location || '-';
            document.getElementById('modal-guest-count').textContent = booking.guest_count || '-';
            document.getElementById('select-status').value = booking.status;

            // Handle Expiry Display
            const expiryContainer = document.getElementById('modal-expiry-container');
            const expiryText = document.getElementById('modal-expiry-text');
            if (booking.time_left_formatted && !booking.is_expired && pUpper === 'MENUNGGU PEMBAYARAN DP') {
                expiryText.textContent = booking.time_left_formatted + ' (Hingga ' + (booking.expires_at_formatted || '7 hari') + ')';
                expiryContainer.classList.remove('hidden');
            } else {
                expiryContainer.classList.add('hidden');
            }

            // Handle Quick Actions Visibility
            const confirmGroup = document.getElementById('confirmation-actions-group');
            const dpGroup = document.getElementById('dp-actions-group');
            const pelunasanGroup = document.getElementById('pelunasan-actions-group');

            confirmGroup.classList.add('hidden');
            dpGroup.classList.add('hidden');
            pelunasanGroup.classList.add('hidden');

            if (['MENUNGGU KONFIRMASI ADMIN', 'MENUNGGU KONFIRMASI', 'PENDING'].includes(bUpper)) {
                confirmGroup.classList.remove('hidden');
            } else if (['MENUNGGU VERIFIKASI', 'MENUNGGU VERIFIKASI DP'].includes(pUpper) || bUpper === 'MENUNGGU VERIFIKASI DP') {
                dpGroup.classList.remove('hidden');
            } else if (['DP DIBAYAR', 'BOOKING AKTIF'].includes(bUpper) || pUpper === 'DP DIBAYAR') {
                pelunasanGroup.classList.remove('hidden');
            }

            // Handle Proof Image
            const proofSection = document.getElementById('modal-proof-section');
            const proofImg = document.getElementById('modal-proof-img');
            if (booking.payment_proof) {
                proofImg.src = '/' + booking.payment_proof.replace(/^\/+/, '');
                proofSection.classList.remove('hidden');
            } else {
                proofSection.classList.add('hidden');
            }

            document.getElementById('modal-verification').classList.remove('hidden');
        }

        function closeVerificationModal() {
            document.getElementById('modal-verification').classList.add('hidden');
        }

        function viewProofModal(src) {
            document.getElementById('zoom-proof-img').src = src;
            document.getElementById('modal-proof-zoom').classList.remove('hidden');
        }

        function submitPaymentVerification(action) {
            if (!currentActiveBooking) return;
            const bookingId = currentActiveBooking.id;

            fetch("{{ route('admin.booking.verify_payment') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify({
                    booking_id: bookingId,
                    action: action
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.reload();
                } else {
                    alert('Gagal memproses verifikasi.');
                }
            })
            .catch(err => {
                window.location.reload();
            });
        }
    </script>
</body>
</html>

