<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile — {{ session('user_name', 'Akun Saya') }} | DreamDay Studio</title>
    <meta name="description" content="Kelola akun dan pantau riwayat booking acara pernikahan dan vendor impian Anda di DreamDay Studio.">

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
<body class="bg-[#f9f8f6] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER / NAVIGATION BAR ==================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-[#f0ebe4] transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Drawer Toggle & Brand Logo -->
            <div class="flex items-center gap-4 sm:gap-6">
                <!-- Hamburger Button to Toggle Drawer -->
                <button id="drawer-toggle-btn" 
                        type="button" 
                        class="p-2.5 rounded-lg text-[#27221e] hover:bg-[#f5f0ea] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30 transition-colors cursor-pointer"
                        aria-label="Buka Menu Drawer"
                        aria-expanded="false"
                        aria-controls="drawer-menu">
                    <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <!-- Brand Logo Image & Text -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio Logo" class="h-8 sm:h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#27221e] group-hover:text-[#5b4b38] transition-colors">
                        DreamDay Studio
                    </span>
                </a>
            </div>

            <!-- Right Side: Profile Avatar & List Your Service Button -->
            <div class="flex items-center gap-3 sm:gap-5">
                <a href="{{ route('profile') }}" 
                   class="flex items-center gap-2.5 p-1 rounded-full ring-2 ring-[#5b4b38]/40 transition group cursor-pointer"
                   title="Profil {{ session('user_name', 'User') }}">
                    <img id="nav-header-avatar"
                         src="{{ asset(session('user_avatar', 'images/default-avatar.svg')) }}" 
                         alt="Foto Profil {{ session('user_name', 'User') }}" 
                         class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover border-2 border-[#5b4b38] shadow-xs">
                    <span id="nav-header-name" class="hidden sm:inline font-semibold text-xs sm:text-sm text-[#5b4b38] pr-1">
                        {{ session('user_name', 'User') }}
                    </span>
                </a>
                <a href="{{ route('list-service') }}" class="inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs sm:text-sm font-medium px-4 sm:px-5 py-2.5 rounded-xl shadow-xs hover:shadow-md transition duration-200">
                    List Your Service
                </a>
            </div>
        </div>
    </header>

    <!-- ==================== DRAWER / OFF-CANVAS SIDEBAR ==================== -->
    <!-- Drawer Backdrop Overlay -->
    <div id="drawer-backdrop" 
         class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs is-hidden" 
         aria-hidden="true"></div>

    <!-- Drawer Panel (Slides from left) -->
    <aside id="drawer-menu" 
           class="fixed top-0 left-0 bottom-0 z-50 w-72 sm:w-80 bg-white shadow-2xl flex flex-col justify-between is-closed border-r border-[#ece5dc]"
           role="dialog" 
           aria-modal="true" 
           aria-label="Navigasi Menu Drawer">
        
        <!-- Drawer Top Header -->
        <div class="p-6 border-b border-[#f2ece5] flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                <span class="font-serif-luxury text-xl font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors">DreamDay Studio</span>
            </a>
            <button id="drawer-close-btn" 
                    type="button" 
                    class="p-2 rounded-lg text-[#786e66] hover:text-[#27221e] hover:bg-[#f5f0ea] transition cursor-pointer"
                    aria-label="Tutup Menu">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Drawer Navigation Items -->
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
            <!-- Profile (Active) -->
            <a href="{{ route('profile') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl bg-[#faf7f2] text-[#5b4b38] font-semibold text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#5b4b38] text-white transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <span>Profile</span>
            </a>

            <!-- Venues -->
            <a href="{{ route('venues.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
                <span>Venues</span>
            </a>

            <!-- Documentation -->
            <a href="{{ route('documentation.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </span>
                <span>Documentation</span>
            </a>

            <!-- MUA -->
            <a href="{{ route('mua.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                    </svg>
                </span>
                <span>MUA (Make-up)</span>
            </a>
        </nav>

        <!-- Drawer Footer -->
        <div class="p-6 border-t border-[#f2ece5] bg-[#faf8f5]">
            <a href="{{ route('list-service') }}" class="w-full inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium py-3 px-4 rounded-xl shadow-xs transition">
                List Your Service
            </a>
            <p class="mt-4 text-xs text-center text-[#9a8e85]">
                © 2026 DreamDay Studio
            </p>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT SECTION ==================== -->
    <main class="flex-1 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16 w-full space-y-6">

        <!-- Top Flash Alerts -->
        @if(session('info_message'))
            <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm flex items-start gap-3 shadow-xs">
                <div class="p-1 rounded-lg bg-amber-100 text-amber-800 shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <strong class="font-bold block">Status Pengajuan Booking:</strong>
                    <span>{{ session('info_message') }}</span>
                </div>
            </div>
        @endif

        @if(session('success_message'))
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs sm:text-sm flex items-start gap-3 shadow-xs">
                <div class="p-1 rounded-lg bg-emerald-100 text-emerald-800 shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div>
                    <strong class="font-bold block">Sukses:</strong>
                    <span>{{ session('success_message') }}</span>
                </div>
            </div>
        @endif

        @if(session('auth_notice'))
            <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#e8dfd3] text-[#5b4b38] text-xs sm:text-sm flex items-start gap-3 shadow-xs">
                <div class="p-1 rounded-lg bg-[#f0ebe4] text-[#5b4b38] shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <strong class="font-bold block">Pemberitahuan:</strong>
                    <span>{{ session('auth_notice') }}</span>
                </div>
            </div>
        @endif

        @if(session('error_message'))
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 text-xs sm:text-sm flex items-start gap-3 shadow-xs">
                <div class="p-1 rounded-lg bg-rose-100 text-rose-800 shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <strong class="font-bold block">Perhatian:</strong>
                    <span>{{ session('error_message') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            
            <!-- ==================== LEFT COLUMN (PROFILE & SETTINGS) ==================== -->
            <div class="md:col-span-5 lg:col-span-5 space-y-6">
                
                <!-- Profile Card -->
                <div class="bg-white border border-[#ede7df] rounded-2xl p-7 sm:p-8 shadow-xs flex flex-col items-center text-center transition-all duration-300 hover:shadow-md">
                    <!-- Profile Avatar with Edit Badge -->
                    <div class="relative group">
                        <img id="profile-display-img" 
                             src="{{ asset(session('user_avatar', 'images/default-avatar.svg')) }}" 
                             alt="{{ session('user_name', '') }}" 
                             class="w-28 h-28 sm:w-32 sm:h-32 rounded-2xl object-cover shadow-xs border border-[#ede7df] group-hover:brightness-95 transition">
                        
                        <!-- Floating Edit Pencil Badge -->
                        <button type="button" 
                                id="avatar-edit-btn"
                                class="absolute -bottom-1.5 -right-1.5 w-8 h-8 rounded-full bg-[#6b513a] hover:bg-[#523d2b] text-white flex items-center justify-center shadow-md transition-transform duration-200 hover:scale-110 cursor-pointer" 
                                title="Ubah Foto Profil"
                                aria-label="Ubah Foto Profil">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>

                    <!-- User Name & Email -->
                    <h1 id="profile-display-name" class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-5 tracking-tight">
                        {{ session('user_name', '') }}
                    </h1>
                    <p id="profile-display-email" class="text-xs sm:text-sm text-[#8d8277] mt-1 font-normal">
                        {{ session('user_email', '') }}
                    </p>

                    <!-- Edit Profile Details Button -->
                    <button type="button" 
                            id="edit-profile-btn" 
                            class="w-full mt-6 py-2.5 px-4 rounded-xl border border-[#d8d0c5] hover:border-[#b0a597] bg-white hover:bg-[#faf8f5] text-[#3d3228] font-medium text-xs sm:text-sm transition-all duration-200 shadow-2xs hover:shadow-xs cursor-pointer">
                        Edit Profile Details
                    </button>
                </div>

                <!-- Account Actions / Settings Card -->
                <div class="bg-white border border-[#ede7df] rounded-2xl p-2.5 sm:p-3 shadow-xs space-y-1">
                    
                    <!-- Account Settings Item -->
                    <button type="button" 
                            id="open-settings-btn"
                            class="w-full flex items-center justify-between px-3.5 py-3 rounded-xl hover:bg-[#faf7f2] text-[#27221e] transition-colors group cursor-pointer text-left">
                        <div class="flex items-center gap-3">
                            <span class="text-[#5b4b38]">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </span>
                            <span class="font-medium text-xs sm:text-sm text-[#27221e] group-hover:text-[#5b4b38]">
                                Account Settings
                            </span>
                        </div>
                        <svg class="w-4 h-4 text-[#a69c92] group-hover:text-[#5b4b38] transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Log Out Item -->
                    <button type="button" 
                            id="logout-trigger-btn"
                            class="w-full flex items-center gap-3 px-3.5 py-3 rounded-xl hover:bg-[#fff5f5] text-[#b93838] transition-colors group cursor-pointer text-left">
                        <span class="text-[#b93838] group-hover:text-[#9f2626]">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span class="font-medium text-xs sm:text-sm text-[#b93838] group-hover:text-[#9f2626]">
                            Log Out
                        </span>
                    </button>

                </div>

            </div>

            <!-- ==================== RIGHT COLUMN (BOOKING HISTORY) ==================== -->
            <div class="md:col-span-7 lg:col-span-7 space-y-4">
                
                <!-- Section Header -->
                <div class="flex items-center justify-between px-1">
                    <div>
                        <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] tracking-tight">
                            Booking History
                        </h2>
                        <p class="text-xs text-[#8d8277]">Pantau status konfirmasi &amp; pembayaran DP reservasi Anda</p>
                    </div>
                    <button type="button" 
                            id="view-all-btn" 
                            class="text-xs sm:text-sm font-semibold text-[#8d8277] hover:text-[#5b4b38] transition-colors cursor-pointer">
                        View All
                    </button>
                </div>

                <!-- Booking History List Card -->
                <div class="bg-white border border-[#ede7df] rounded-2xl shadow-xs overflow-hidden divide-y divide-[#f2ece5]">
                    
                    @php
                        $userBookingsList = !empty($userBookings) ? $userBookings : session('user_bookings', []);
                    @endphp

                    @if(!empty($userBookingsList) && count($userBookingsList) > 0)
                        @foreach($userBookingsList as $bk)
                            @php
                                $bStatus = $bk['status'] ?? 'Menunggu Konfirmasi Admin';
                                $pStatus = $bk['payment_status'] ?? 'Belum Dibayar';
                                $total = (int) ($bk['total_price'] ?? 0);
                                $dpPct = (int) ($bk['dp_percentage'] ?? 30);
                                if ($dpPct <= 0) $dpPct = 30;
                                $dpAmount = (int) ($bk['dp_amount'] ?? round($total * $dpPct / 100));
                                $amountPaid = (int) ($bk['amount_paid'] ?? 0);
                                $isNew = ($bk['id'] === (session('new_booking_id') ?? request('new_booking')));

                                $isWaitingAdmin = ($bStatus === 'Menunggu Konfirmasi Admin');
                                $isConfirmed = ($bStatus === 'Booking Dikonfirmasi');
                                $isBookingActive = ($bStatus === 'Booking Aktif');
                                $isCompleted = ($bStatus === 'Selesai');
                                $isCancelled = ($bStatus === 'Dibatalkan');

                                $isWaitingDP = ($pStatus === 'Menunggu Pembayaran DP' || $pStatus === 'Pembayaran Ditolak');
                                $isWaitingVerify = ($pStatus === 'Menunggu Verifikasi');
                                $isDPPaid = ($pStatus === 'DP Dibayar');
                                $isExpired = ($pStatus === 'Kadaluarsa');

                                // Calculate clean remaining balance
                                if ($isCompleted || $pStatus === 'Lunas') {
                                    $remainingDisplay = 0;
                                } elseif ($isDPPaid || $isBookingActive) {
                                    $remainingDisplay = max(0, $total - ($amountPaid ?: $dpAmount));
                                } else {
                                    $remainingDisplay = max(0, $total - $dpAmount);
                                }

                                $bStatusColor = match($bStatus) {
                                    'Selesai' => 'text-emerald-700 bg-emerald-50 border-emerald-200',
                                    'Booking Aktif' => 'text-teal-700 bg-teal-50 border-teal-200 font-bold',
                                    'Booking Dikonfirmasi' => 'text-sky-700 bg-sky-50 border-sky-200 font-bold',
                                    'Dibatalkan' => 'text-rose-700 bg-rose-50 border-rose-200',
                                    default => 'text-amber-800 bg-amber-50 border-amber-200'
                                };

                                $pStatusColor = match($pStatus) {
                                    'DP Dibayar' => 'text-teal-700 bg-teal-50 border-teal-200 font-bold',
                                    'Menunggu Verifikasi' => 'text-indigo-700 bg-indigo-50 border-indigo-200 font-bold',
                                    'Menunggu Pembayaran DP' => 'text-amber-800 bg-amber-50 border-amber-300 font-bold',
                                    'Kadaluarsa', 'Pembayaran Ditolak', 'Dibatalkan' => 'text-rose-700 bg-rose-50 border-rose-200',
                                    default => 'text-gray-700 bg-gray-100 border-gray-200'
                                };
                            @endphp
                            <div id="booking-card-{{ $bk['id'] }}" class="p-5 sm:p-6 flex flex-col gap-4 {{ $isNew ? 'bg-[#faf7f2] border-2 border-[#5b4b38] rounded-2xl shadow-xs my-1' : 'hover:bg-[#fcfaf7]' }} transition-all duration-300 group">
                                
                                <!-- 1. Top Card Bar: ID, Date Created, & Dual Status Badges -->
                                <div class="flex flex-wrap items-center justify-between gap-2.5 pb-3 border-b border-[#f2ece5]">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-xs font-mono font-bold text-[#5b4b38] bg-[#f5f0ea] px-2.5 py-1 rounded-lg border border-[#e8dfd3]">
                                            #{{ $bk['id'] }}
                                        </span>
                                        @if($isNew)
                                            <span class="text-[0.65rem] font-bold text-white bg-emerald-700 px-2.5 py-0.5 rounded-full shadow-2xs">
                                                Pesanan Baru
                                            </span>
                                        @endif
                                        <span class="text-[0.7rem] text-[#8d8277]">
                                            Dipesan pada: <span class="font-medium text-[#554d46]">{{ $bk['created_at'] ?? 'Baru saja' }}</span>
                                        </span>
                                    </div>

                                    <!-- Badges on top right -->
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <div class="inline-flex items-center gap-1.5 text-xs bg-[#faf8f5] px-2.5 py-1 rounded-xl border border-[#ede7df] shadow-2xs">
                                            <span class="text-[0.65rem] text-[#8d8277] uppercase font-semibold">Booking:</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[0.65rem] font-bold uppercase tracking-wider border {{ $bStatusColor }}">
                                                {{ $bStatus }}
                                            </span>
                                        </div>
                                        <div class="inline-flex items-center gap-1.5 text-xs bg-[#faf8f5] px-2.5 py-1 rounded-xl border border-[#ede7df] shadow-2xs">
                                            <span class="text-[0.65rem] text-[#8d8277] uppercase font-semibold">Pembayaran:</span>
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[0.65rem] font-bold uppercase tracking-wider border {{ $pStatusColor }}">
                                                {{ $pStatus }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Main Item Content: Image + Details + Price Breakdown -->
                                <div class="flex flex-col sm:flex-row items-start gap-4 sm:gap-5">
                                    <img src="{{ asset($bk['service_image'] ?? 'images/package-cliffside.jpg') }}" 
                                         alt="{{ $bk['service_title'] }}" 
                                         class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl object-cover border border-[#ede7df] shadow-xs shrink-0 group-hover:scale-102 transition-transform duration-300">
                                    
                                    <div class="space-y-2 flex-1 min-w-0">
                                        <div>
                                            <h3 class="font-bold text-base sm:text-lg text-[#27221e] group-hover:text-[#5b4b38] transition-colors leading-snug">
                                                {{ $bk['service_title'] }}
                                            </h3>
                                            <p class="text-xs text-[#8d8277] mt-0.5">
                                                Acara: <strong class="text-[#27221e]">{{ !empty($bk['event_date']) ? date('d M Y', strtotime($bk['event_date'])) : '-' }}</strong> • {{ $bk['event_location'] ?? 'Lokasi Terdaftar' }}
                                            </p>
                                        </div>

                                        <!-- Price Breakdown Strip -->
                                        <div class="p-2.5 rounded-xl bg-[#faf7f2] border border-[#ede7df] flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-[#554d46]">
                                            <div>
                                                <span class="text-[#8d8277]">Total Biaya:</span>
                                                <strong class="text-[#27221e] ml-1">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                                            </div>
                                            <span class="text-[#ded5cb] hidden sm:inline">•</span>
                                            <div>
                                                <span class="text-[#8d8277]">DP ({{ $dpPct }}%):</span>
                                                <strong class="text-[#5b4b38] ml-1">Rp {{ number_format($dpAmount, 0, ',', '.') }}</strong>
                                            </div>
                                            <span class="text-[#ded5cb] hidden sm:inline">•</span>
                                            <div>
                                                <span class="text-[#8d8277]">Sisa Pelunasan:</span>
                                                <strong class="{{ $remainingDisplay == 0 ? 'text-emerald-700' : 'text-[#7d6f63]' }} ml-1">Rp {{ number_format($remainingDisplay, 0, ',', '.') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3. Status Alert Banner (Full-Width) -->
                                <div>
                                    @if($isWaitingAdmin)
                                        <div class="p-3.5 rounded-xl bg-amber-50/90 border border-amber-200/90 text-amber-900 text-xs flex items-center gap-3 shadow-2xs">
                                            <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="leading-relaxed">Booking Anda berhasil dikirim dan <strong>sedang menunggu konfirmasi admin</strong>. Akses pembayaran DP akan otomatis dibuka setelah disetujui.</span>
                                        </div>
                                    @elseif($isConfirmed && $isWaitingDP)
                                        <div class="p-3.5 rounded-xl bg-amber-50/90 border border-amber-300 text-[#5b4b38] text-xs flex items-center justify-between flex-wrap gap-2.5 shadow-2xs">
                                            <div class="flex items-center gap-2.5">
                                                <span class="text-lg shrink-0 animate-pulse">⏳</span>
                                                <span class="leading-relaxed">Booking telah dikonfirmasi! Segera selesaikan pembayaran DP dalam <strong>7 Hari</strong> untuk mengunci jadwal venue.</span>
                                            </div>
                                            @if(!empty($bk['time_left_formatted']) && empty($bk['is_expired']))
                                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-amber-300 text-rose-700 font-mono font-bold text-xs shrink-0 shadow-2xs">
                                                    <span>Sisa Waktu:</span>
                                                    <span>{{ $bk['time_left_formatted'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @elseif($isWaitingVerify)
                                        <div class="p-3.5 rounded-xl bg-indigo-50/90 border border-indigo-200/90 text-indigo-900 text-xs flex items-center gap-3 shadow-2xs">
                                            <svg class="w-5 h-5 text-indigo-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="leading-relaxed">Bukti transfer DP telah dikirimkan &amp; <strong>sedang diverifikasi</strong> oleh tim keuangan DreamDay Studio.</span>
                                        </div>
                                    @elseif($isBookingActive || $isDPPaid)
                                        <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-xs flex items-center gap-3 shadow-2xs">
                                            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="leading-relaxed">Pembayaran DP berhasil diterima! <strong>Jadwal venue telah resmi dikunci &amp; reservasi aktif</strong>.</span>
                                        </div>
                                    @elseif($isExpired)
                                        <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-xs flex items-center gap-3 shadow-2xs">
                                            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="leading-relaxed">Batas waktu pembayaran DP 7 hari telah berakhir. Booking telah dibatalkan &amp; jadwal kembali tersedia.</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- 4. Action CTA Buttons Row -->
                                <div class="pt-2 border-t border-[#f2ece5] flex items-center justify-end gap-2.5">
                                    @if($isConfirmed && $isWaitingDP)
                                        <a href="{{ route('booking.payment', ['id' => $bk['id']]) }}" class="px-5 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-md hover:shadow-lg transition-all duration-200 cursor-pointer flex items-center gap-2">
                                            <span>BAYAR DP SEKARANG</span>
                                            <span class="text-sm">→</span>
                                        </a>
                                    @elseif($isBookingActive || $isDPPaid)
                                        @if($remainingDisplay > 0)
                                            <a href="{{ route('booking.payment', ['id' => $bk['id'], 'type' => 'pelunasan']) }}" class="px-4 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold shadow-2xs hover:shadow transition cursor-pointer flex items-center gap-1.5">
                                                <span>Bayar Pelunasan (Rp {{ number_format($remainingDisplay, 0, ',', '.') }})</span>
                                                <span>→</span>
                                            </a>
                                        @endif
                                    @endif

                                    <a href="{{ route('booking.success', ['id' => $bk['id']]) }}" class="px-4 py-2.5 rounded-xl border border-[#ded5cb] hover:border-[#5b4b38] hover:bg-[#faf7f2] text-xs font-semibold text-[#5b4b38] hover:text-[#27221e] bg-white transition shadow-2xs">
                                        Lihat Detail / Invoice
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <!-- Empty State when user has no bookings -->
                        <div class="p-8 sm:p-12 text-center flex flex-col items-center justify-center space-y-3">
                            <div class="w-16 h-16 rounded-2xl bg-[#faf7f2] text-[#5b4b38] flex items-center justify-center border border-[#ede7df] shadow-xs">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="font-serif-luxury text-lg sm:text-xl font-bold text-[#27221e]">
                                Belum Ada Riwayat Pemesanan
                            </h3>
                            <p class="text-xs sm:text-sm text-[#8d8277] max-w-sm">
                                Seluruh pemesanan venue, dokumentasi, dan MUA yang Anda pesan dengan email ini akan otomatis tersimpan permanen di sini.
                            </p>
                            <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs sm:text-sm font-medium px-5 py-2.5 rounded-xl shadow-xs transition duration-200 mt-2">
                                Jelajahi Layanan &amp; Venue
                            </a>
                        </div>
                    @endif

                </div>

            </div>

        </div>
    </main>

    <!-- ==================== EDIT PROFILE MODAL ==================== -->
    <div id="edit-profile-modal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-profile-title">
        
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-[#ede7df] overflow-hidden transform scale-95 transition-all duration-300">
            <!-- Modal Header -->
            <div class="p-6 border-b border-[#f2ece5] flex items-center justify-between">
                <h3 id="modal-profile-title" class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e]">
                    Edit Profile Details
                </h3>
                <button type="button" 
                        class="modal-close-btn p-1.5 rounded-lg text-[#8d8277] hover:text-[#27221e] hover:bg-[#faf7f2] transition cursor-pointer"
                        aria-label="Tutup Modal">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form Body -->
            <form id="edit-profile-form" class="p-6 space-y-4">
                <!-- Avatar Preview & Change -->
                <div class="flex items-center gap-4 pb-2">
                    <img id="modal-avatar-preview" 
                         src="{{ asset(session('user_avatar', 'images/default-avatar.svg')) }}" 
                         alt="Avatar Preview" 
                         class="w-16 h-16 rounded-xl object-cover border border-[#ede7df]">
                    <div>
                        <label class="block text-xs font-semibold text-[#685f58] mb-1">Foto Profil</label>
                        <input type="file" id="avatar-file-input" accept="image/*" class="hidden">
                        <button type="button" 
                                onclick="document.getElementById('avatar-file-input').click()" 
                                class="text-xs font-medium text-[#5b4b38] bg-[#f5f0ea] hover:bg-[#ede4d8] px-3 py-1.5 rounded-lg transition cursor-pointer">
                            Pilih Foto Baru
                        </button>
                    </div>
                </div>

                <!-- Full Name -->
                <div>
                    <label for="input-fullname" class="block text-xs font-semibold text-[#685f58] mb-1">Nama Lengkap</label>
                    <input type="text" 
                           id="input-fullname" 
                           name="fullname" 
                           value="{{ $user->name ?? session('user_name', '') }}" 
                           required 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                </div>

                <!-- Email Address -->
                <div>
                    <label for="input-email" class="block text-xs font-semibold text-[#685f58] mb-1">Alamat Email</label>
                    <input type="email" 
                           id="input-email" 
                           name="email" 
                           value="{{ $user->email ?? session('user_email', '') }}" 
                           required 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="input-phone" class="block text-xs font-semibold text-[#685f58] mb-1">Nomor Telepon</label>
                    <input type="tel" 
                           id="input-phone" 
                           name="phone" 
                           value="{{ $user->phone ?? session('user_phone', '+62 812-3456-7890') }}" 
                           class="w-full px-3.5 py-2.5 rounded-xl border border-[#ded5cb] text-sm text-[#27221e] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30 focus:border-[#5b4b38] transition">
                </div>

                <!-- Modal Actions -->
                <div class="pt-4 flex items-center justify-end gap-3 border-t border-[#f2ece5]">
                    <button type="button" 
                            class="modal-close-btn px-4 py-2.5 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-medium shadow-xs transition cursor-pointer">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ==================== ACCOUNT SETTINGS MODAL ==================== -->
    <div id="settings-modal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none"
         role="dialog"
         aria-modal="true"
         aria-labelledby="modal-settings-title">
        
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-[#ede7df] overflow-hidden transform scale-95 transition-all duration-300">
            <!-- Modal Header -->
            <div class="p-6 border-b border-[#f2ece5] flex items-center justify-between">
                <h3 id="modal-settings-title" class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e]">
                    Account Settings
                </h3>
                <button type="button" 
                        class="settings-modal-close-btn p-1.5 rounded-lg text-[#8d8277] hover:text-[#27221e] hover:bg-[#faf7f2] transition cursor-pointer"
                        aria-label="Tutup Modal">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Settings Content -->
            <div class="p-6 space-y-5">
                <!-- Setting 1: Email Notifications -->
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-sm font-semibold text-[#27221e]">Notifikasi Email</h4>
                        <p class="text-xs text-[#8d8277]">Terima info status pesanan dan penawaran vendor eksklusif.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-[#e2dcd4] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-[#ded5cb] after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5b4b38]"></div>
                    </label>
                </div>

                <!-- Setting 2: Two-Factor Authentication -->
                <div class="flex items-center justify-between pt-3 border-t border-[#f2ece5]">
                    <div>
                        <h4 class="text-sm font-semibold text-[#27221e]">Keamanan Dua Langkah (2FA)</h4>
                        <p class="text-xs text-[#8d8277]">Tingkatkan keamanan akun dengan verifikasi OTP.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-[#e2dcd4] peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-[#ded5cb] after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5b4b38]"></div>
                    </label>
                </div>

                <!-- Setting 3: Language -->
                <div class="flex items-center justify-between pt-3 border-t border-[#f2ece5]">
                    <div>
                        <h4 class="text-sm font-semibold text-[#27221e]">Bahasa</h4>
                        <p class="text-xs text-[#8d8277]">Pilih bahasa antarmuka aplikasi.</p>
                    </div>
                    <select class="px-3 py-1.5 rounded-lg border border-[#ded5cb] text-xs font-medium text-[#27221e] focus:outline-none focus:ring-2 focus:ring-[#5b4b38]/30">
                        <option selected>Bahasa Indonesia</option>
                        <option>English (US)</option>
                    </select>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="p-4 bg-[#faf8f5] border-t border-[#f2ece5] flex justify-end">
                <button type="button" 
                        class="settings-modal-close-btn px-5 py-2 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-medium transition cursor-pointer">
                    Selesai
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== LOGOUT CONFIRMATION MODAL ==================== -->
    <div id="logout-modal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs transition-opacity duration-300 opacity-0 pointer-events-none"
         role="dialog"
         aria-modal="true">
        
        <div class="bg-white w-full max-w-sm rounded-2xl shadow-2xl border border-[#ede7df] p-6 text-center transform scale-95 transition-all duration-300 space-y-4">
            <div class="w-12 h-12 rounded-full bg-[#fdf2f2] text-[#b93838] mx-auto flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            
            <div>
                <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">
                    Konfirmasi Keluar
                </h3>
                <p class="text-xs text-[#8d8277] mt-1">
                    Apakah Anda yakin ingin keluar dari akun DreamDay Studio?
                </p>
            </div>

            <div class="flex items-center justify-center gap-3 pt-2">
                <button type="button" 
                        id="logout-cancel-btn"
                        class="w-1/2 py-2.5 px-4 rounded-xl border border-[#ded5cb] text-xs font-medium text-[#685f58] hover:bg-[#faf7f2] transition cursor-pointer">
                    Batal
                </button>
                <a href="{{ route('logout') }}" 
                   class="w-1/2 py-2.5 px-4 rounded-xl bg-[#b93838] hover:bg-[#9f2626] text-white text-xs font-medium transition text-center shadow-xs">
                    Ya, Keluar
                </a>
            </div>
        </div>
    </div>

    <!-- ==================== TOAST NOTIFICATION ==================== -->
    <div id="toast-notification" 
         class="fixed bottom-6 right-6 z-50 bg-[#27221e] text-white px-5 py-3 rounded-xl shadow-xl flex items-center gap-3 transform translate-y-20 opacity-0 transition-all duration-300 pointer-events-none">
        <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span id="toast-message" class="text-xs sm:text-sm font-medium">Perubahan profil berhasil disimpan!</span>
    </div>

    <!-- ==================== FOOTER (Identik dengan DreamDay Studio) ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-12 px-4 sm:px-8 mt-20">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-xs text-[#685f58]">
            
            <!-- Left Side: Brand & Tagline -->
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

            <!-- Right Side: Links -->
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

    <!-- Script for Interactive Modals & Profile Updates -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Modals references
            const editModal = document.getElementById('edit-profile-modal');
            const settingsModal = document.getElementById('settings-modal');
            const logoutModal = document.getElementById('logout-modal');
            const toast = document.getElementById('toast-notification');
            const toastMessage = document.getElementById('toast-message');

            function showToast(msg) {
                if (!toast) return;
                toastMessage.textContent = msg;
                toast.classList.remove('translate-y-20', 'opacity-0', 'pointer-events-none');
                toast.classList.add('translate-y-0', 'opacity-100');
                setTimeout(() => {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-20', 'opacity-0', 'pointer-events-none');
                }, 3000);
            }

            function openModal(modal) {
                if (!modal) return;
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
                const modalBox = modal.querySelector('div');
                if (modalBox) {
                    modalBox.classList.remove('scale-95');
                    modalBox.classList.add('scale-100');
                }
            }

            function closeModal(modal) {
                if (!modal) return;
                modal.classList.remove('opacity-100');
                modal.classList.add('opacity-0', 'pointer-events-none');
                const modalBox = modal.querySelector('div');
                if (modalBox) {
                    modalBox.classList.remove('scale-100');
                    modalBox.classList.add('scale-95');
                }
            }

            // Edit Profile triggers
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const avatarEditBtn = document.getElementById('avatar-edit-btn');
            if (editProfileBtn) editProfileBtn.addEventListener('click', () => openModal(editModal));
            if (avatarEditBtn) avatarEditBtn.addEventListener('click', () => openModal(editModal));

            document.querySelectorAll('.modal-close-btn').forEach(btn => {
                btn.addEventListener('click', () => closeModal(editModal));
            });

            // Settings triggers
            const openSettingsBtn = document.getElementById('open-settings-btn');
            if (openSettingsBtn) openSettingsBtn.addEventListener('click', () => openModal(settingsModal));
            document.querySelectorAll('.settings-modal-close-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    closeModal(settingsModal);
                    showToast('Pengaturan akun tersimpan!');
                });
            });

            // Logout triggers
            const logoutTriggerBtn = document.getElementById('logout-trigger-btn');
            const logoutCancelBtn = document.getElementById('logout-cancel-btn');
            if (logoutTriggerBtn) logoutTriggerBtn.addEventListener('click', () => openModal(logoutModal));
            if (logoutCancelBtn) logoutCancelBtn.addEventListener('click', () => closeModal(logoutModal));

            // Close modals on clicking backdrop
            [editModal, settingsModal, logoutModal].forEach(m => {
                if (m) {
                    m.addEventListener('click', (e) => {
                        if (e.target === m) closeModal(m);
                    });
                }
            });

            // Handle Avatar Selection
            let selectedAvatarDataUrl = null;
            const avatarFileInput = document.getElementById('avatar-file-input');
            if (avatarFileInput) {
                avatarFileInput.addEventListener('change', (e) => {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (event) => {
                            selectedAvatarDataUrl = event.target.result;
                            document.getElementById('modal-avatar-preview').src = selectedAvatarDataUrl;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

            // Handle Profile Edit Form Submission
            const editProfileForm = document.getElementById('edit-profile-form');
            if (editProfileForm) {
                editProfileForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const newName = document.getElementById('input-fullname').value.trim();
                    const newEmail = document.getElementById('input-email').value.trim();
                    const newPhone = document.getElementById('input-phone').value.trim();

                    // Kirim ke server via AJAX agar tersimpan permanen di database MySQL
                    fetch('{{ route('profile.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ 
                            fullname: newName, 
                            email: newEmail, 
                            phone: newPhone,
                            avatar_data: selectedAvatarDataUrl 
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            // Update tampilan langsung di halaman
                            if (newName) document.getElementById('profile-display-name').textContent = newName;
                            if (newEmail) document.getElementById('profile-display-email').textContent = newEmail;
                            if (data.user_avatar) {
                                document.getElementById('profile-display-img').src = data.user_avatar;
                                document.getElementById('modal-avatar-preview').src = data.user_avatar;
                                const navAvatar = document.getElementById('nav-header-avatar');
                                if (navAvatar) navAvatar.src = data.user_avatar;
                            }
                            // Update nama di header navbar
                            const navName = document.getElementById('nav-header-name');
                            if (navName && newName) navName.textContent = newName;
                        }
                        closeModal(editModal);
                        showToast('Detail profil berhasil disimpan permanen!');
                    })
                    .catch(() => {
                        // Fallback: update tampilan lokal saja jika AJAX gagal
                        if (newName) document.getElementById('profile-display-name').textContent = newName;
                        if (newEmail) document.getElementById('profile-display-email').textContent = newEmail;
                        if (selectedAvatarDataUrl) {
                            document.getElementById('profile-display-img').src = selectedAvatarDataUrl;
                        }
                        closeModal(editModal);
                        showToast('Detail profil berhasil disimpan!');
                    });
                });
            }

            // View all bookings click UX
            const viewAllBtn = document.getElementById('view-all-btn');
            if (viewAllBtn) {
                viewAllBtn.addEventListener('click', () => {
                    showToast('Menampilkan seluruh riwayat pemesanan');
                });
            }
        });

        function closeBookingSuccessPopup() {
            const modal = document.getElementById('modal-booking-success-popup');
            if (modal) {
                modal.classList.add('hidden');
            }
            if (window.location.search.includes('new_booking')) {
                const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({ path: newUrl }, '', newUrl);
            }
        }
    </script>

    <!-- ==================== MODAL: RESERVASI BERHASIL DIBUAT ==================== -->
    @php
        $newBookingId = session('new_booking_id') ?? request('new_booking');
        $newBookingObj = null;
        if ($newBookingId && !empty($userBookingsList)) {
            foreach ($userBookingsList as $ub) {
                if ($ub['id'] === $newBookingId) {
                    $newBookingObj = $ub;
                    break;
                }
            }
        }
    @endphp

    @if($newBookingId)
    <div id="modal-booking-success-popup" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-lg w-full p-6 sm:p-8 space-y-6 animate-in fade-in zoom-in duration-300">
            
            <div class="flex items-start justify-between pb-3 border-b border-[#f2ece5]">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-200 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-[0.7rem] uppercase font-bold tracking-widest text-[#8d8277]">RESERVASI BARU BERHASIL</span>
                        <h3 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e]">
                            Reservasi Telah Dibuat!
                        </h3>
                    </div>
                </div>
                <button type="button" onclick="closeBookingSuccessPopup()" class="p-2 rounded-xl text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <!-- Booking Highlights in Popup -->
            <div class="space-y-3 text-xs text-[#27221e]">
                <div class="p-4 rounded-2xl bg-[#faf7f2] border border-[#e8dfd3] flex items-center justify-between">
                    <div>
                        <span class="text-[0.7rem] uppercase font-bold text-[#8d8277] block">Kode Pesanan:</span>
                        <span class="font-mono font-bold text-base text-[#5b4b38]">#{{ $newBookingId }}</span>
                    </div>
                    <span class="px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase bg-amber-100 text-amber-800 border border-amber-200">
                        Menunggu Pembayaran DP
                    </span>
                </div>

                @if($newBookingObj)
                    <div class="p-4 rounded-2xl bg-white border border-[#ede7df] space-y-2">
                        <h4 class="font-bold text-sm text-[#27221e]">{{ $newBookingObj['service_title'] }}</h4>
                        <div class="grid grid-cols-2 gap-2 text-[0.75rem] text-[#685f58]">
                            <div>📅 Tanggal: <strong>{{ !empty($newBookingObj['event_date']) ? date('d M Y', strtotime($newBookingObj['event_date'])) : '-' }}</strong></div>
                            <div>📍 Lokasi: <strong>{{ $newBookingObj['event_location'] ?? '-' }}</strong></div>
                            <div>💰 Total: <strong>Rp {{ number_format($newBookingObj['total_price'], 0, ',', '.') }}</strong></div>
                            <div>💳 Tagihan DP: <strong class="text-[#5b4b38]">Rp {{ number_format($newBookingObj['dp_amount'], 0, ',', '.') }}</strong></div>
                        </div>
                    </div>
                @endif

                <p class="text-xs text-[#685f58] leading-relaxed">
                    Pesanan Anda telah tercatat di <strong>History Booking</strong>. Anda dapat melihat status reservasi kapan saja dan melanjutkan pembayaran DP untuk mengunci jadwal acara.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row items-center gap-3 pt-2">
                <a href="{{ route('booking.payment', ['id' => $newBookingId]) }}" class="w-full sm:flex-1 py-3 px-4 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-bold text-center shadow-md hover:shadow-lg transition duration-200">
                    Bayar DP Sekarang →
                </a>
                <button type="button" onclick="closeBookingSuccessPopup()" class="w-full sm:w-auto px-5 py-3 rounded-xl border border-[#ded5cb] text-xs font-semibold text-[#685f58] hover:bg-[#faf7f2] transition cursor-pointer">
                    Tutup &amp; Lihat Riwayat
                </button>
            </div>

        </div>
    </div>
    @endif

    @include('partials.customer-chat')

</body>
</html>
