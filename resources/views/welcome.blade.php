<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DreamDay Studio — Timeless Elegance For Your Precious Moments</title>
    <meta name="description" content="Temukan vendor terbaik untuk pernikahan dan acara spesial Anda dalam satu platform yang elegan dan terpercaya bersama DreamDay Studio.">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

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
<body class="bg-white text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white">

    @include('partials.login-success-toast')

    @include('partials.preloader')

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
                <a href="/" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="DreamDay Studio Logo" 
                         class="h-8 sm:h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#27221e] group-hover:text-[#5b4b38] transition-colors">
                        DreamDay Studio
                    </span>
                </a>
            </div>

            <!-- Right Side: Log In or Profile Avatar & List Your Service Button -->
            <div class="flex items-center gap-3 sm:gap-5">
                @if(session('is_logged_in'))
                    <!-- Profile Avatar (Visible when logged in) -->
                    <a href="{{ route('profile') }}" 
                       class="flex items-center gap-2.5 p-1 rounded-full hover:ring-2 hover:ring-[#5b4b38]/30 transition group cursor-pointer"
                       title="Profil {{ session('user_name', '') }}">
                        <img src="{{ asset(session('user_avatar', 'images/profile-avatar.jpg')) }}" 
                             alt="Foto Profil {{ session('user_name', '') }}" 
                             class="w-9 h-9 sm:w-10 sm:h-10 rounded-full object-cover border-2 border-[#d6ccc2] group-hover:border-[#5b4b38] shadow-xs group-hover:scale-105 transition-all duration-200">
                        <span class="hidden sm:inline font-semibold text-xs sm:text-sm text-[#27221e] group-hover:text-[#5b4b38] pr-1">
                            {{ session('user_name', '') }}
                        </span>
                    </a>
                @else
                    <!-- Log In Button (Visible when NOT logged in) -->
                    <a href="{{ route('login') }}" class="text-sm sm:text-base font-medium text-[#27221e] hover:text-[#5b4b38] transition-colors px-2 py-1">
                        Log In
                    </a>
                @endif

                <a href="{{ route('list-service') }}" class="inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs sm:text-sm font-medium px-4 sm:px-5 py-2.5 rounded-xl shadow-sm hover:shadow-md transition duration-200">
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
            <a href="/" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                <span class="font-serif-luxury text-xl font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors">
                    DreamDay Studio
                </span>
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
            <!-- Profile -->
            <a href="{{ route('profile') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
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
            <a href="{{ route('list-service') }}" class="w-full inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium py-3 px-4 rounded-xl shadow-sm transition">
                List Your Service
            </a>
            <p class="mt-4 text-xs text-center text-[#9a8e85]">
                © 2026 DreamDay Studio
            </p>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT ==================== -->
    <main>
        <!-- ==================== HERO SECTION ==================== -->
        <section class="relative min-h-[580px] lg:min-h-[640px] flex items-center justify-center text-center px-4 sm:px-6 lg:px-8 py-20 overflow-hidden">
            <!-- Background Image with Overlay -->
            <div class="absolute inset-0 -z-10 bg-cover bg-center" style="background-image: url('{{ asset('images/hero-ballroom.jpg') }}');">
                <!-- Multi-layer gradient overlay for crystal clear contrast -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/45 to-black/55"></div>
            </div>
@php
    $servicesData = [];
    $allCatalog = $catalog ?? get_services_catalog();
    foreach ($allCatalog as $slug => $item) {
        $cat = strtolower($item['category'] ?? '');
        $catGroup = 'venues';
        $catLabel = 'Venues';
        if (str_contains($cat, 'doc') || str_contains($cat, 'foto') || str_contains($cat, 'photo')) {
            $catGroup = 'documentation';
            $catLabel = 'Documentation';
        } elseif (str_contains($cat, 'make') || str_contains($cat, 'mua') || str_contains($cat, 'beauty') || str_contains($cat, 'rias')) {
            $catGroup = 'mua';
            $catLabel = 'MUA';
        } elseif (str_contains($cat, 'venue') || str_contains($cat, 'acara') || str_contains($cat, 'gedung')) {
            $catGroup = 'venues';
            $catLabel = 'Venues';
        }
        
        $servicesData[] = [
            'slug' => $slug,
            'title' => $item['title'] ?? '',
            'category' => $item['category'] ?? $catLabel,
            'category_group' => $catGroup,
            'category_label' => $catLabel,
            'price_formatted' => $item['price_formatted'] ?? ('Rp ' . number_format($item['price'] ?? 0, 0, ',', '.')),
            'price' => $item['price'] ?? 0,
            'image' => asset($item['image'] ?? 'images/service-venue.jpg'),
            'location' => $item['location'] ?? 'Indonesia',
            'rating' => $item['rating'] ?? '4.9 (100+ Ulasan)',
            'description' => $item['description'] ?? '',
            'url' => route('service.detail', $slug),
            'category_url' => $catGroup === 'venues' ? route('venues.index') : ($catGroup === 'documentation' ? route('documentation.index') : route('mua.index'))
        ];
    }
@endphp

            <div class="max-w-4xl mx-auto space-y-6 pt-6 sm:pt-10">
                <!-- Hero Headline -->
                <h1 class="font-serif-luxury text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-bold tracking-tight leading-[1.15] drop-shadow-md">
                    Wujudkan Momen Impian Anda Bersama DreamDay Studio
                </h1>

                <!-- Hero Subtitle -->
                <p class="text-sm sm:text-base md:text-lg text-white/90 max-w-2xl mx-auto font-normal leading-relaxed drop-shadow-sm">
                    Temukan vendor terbaik untuk pernikahan dan acara spesial Anda dalam satu platform yang elegan dan terpercaya.
                </p>

                <!-- Floating Search Bar -->
                <div class="pt-4 max-w-3xl mx-auto relative z-30">
                    <form id="hero-search-form" class="bg-white/95 backdrop-blur-md rounded-2xl md:rounded-full p-2 sm:p-2.5 shadow-2xl border border-white/90 flex flex-col md:flex-row items-center gap-2 sm:gap-3 text-left">
                        
                        <!-- Filter Dropdown: Category (All Category, Venues, Documentation, MUA) -->
                        <div class="flex items-center gap-2 w-full md:w-auto px-3.5 py-1.5 border-b md:border-b-0 md:border-r border-[#e8e2d9] shrink-0">
                            <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <select id="search-category-filter" 
                                    class="bg-transparent text-xs sm:text-sm font-semibold text-[#5b4b38] focus:outline-none cursor-pointer py-1 pr-2">
                                <option value="all">All Category</option>
                                <option value="venues">Venues</option>
                                <option value="documentation">Documentation</option>
                                <option value="mua">MUA</option>
                            </select>
                        </div>

                        <!-- Unified Search Input: "search category or location" -->
                        <div class="flex items-center gap-2.5 w-full px-3 py-1.5 relative">
                            <svg class="w-5 h-5 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input id="search-keyword" 
                                   type="text" 
                                   autocomplete="off"
                                   placeholder="search category or location" 
                                   class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#8d8277] focus:outline-none font-medium">
                            <button type="button" id="clear-hero-search-btn" class="hidden text-xs text-[#8d8277] hover:text-[#27221e] p-1 rounded-full hover:bg-[#f0ebe4] transition cursor-pointer" title="Hapus pencarian">
                                ✕
                            </button>
                        </div>

                        <!-- Search CTA Button -->
                        <button type="submit" id="search-cta-btn" class="w-full md:w-auto bg-[#5b4b38] hover:bg-[#483b2c] text-white px-7 py-3 rounded-xl md:rounded-full text-sm font-medium transition duration-200 whitespace-nowrap shadow-sm hover:shadow cursor-pointer flex items-center justify-center gap-2">
                            <span>Cari Sekarang</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </form>

                    <!-- Quick Suggestions Tags -->
                    <div class="flex flex-wrap items-center justify-center gap-2 pt-3 text-xs text-white/90">
                        <span class="font-medium text-white/80">Pencarian Populer:</span>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="Jakarta" data-category="all">Jakarta</button>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="Bali" data-category="all">Bali</button>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="Bandung" data-category="all">Bandung</button>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="Venues" data-category="venues">Venues</button>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="Documentation" data-category="documentation">Documentation</button>
                        <button type="button" class="quick-search-pill px-3 py-1 rounded-full bg-white/20 hover:bg-white/35 backdrop-blur-xs text-white font-medium transition cursor-pointer" data-query="MUA" data-category="mua">MUA</button>
                    </div>

                    <!-- Realtime Suggestion Dropdown Panel -->
                    <div id="live-suggestions-popup" class="hidden absolute top-full left-0 right-0 mt-2 bg-white/98 backdrop-blur-md rounded-2xl shadow-2xl border border-[#e8e2d9] overflow-hidden text-left z-50 max-h-96 overflow-y-auto">
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== DYNAMIC SEARCH RESULTS SECTION ==================== -->
        <section id="search-results-section" class="hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 scroll-mt-24">
            <!-- Search Results Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 pb-8 border-b border-[#ece5dc]">
                <div>
                    <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-[#8d8277] mb-1.5">
                        <span class="inline-block w-2 h-2 rounded-full bg-[#5b4b38]"></span>
                        <span>Hasil Pencarian &amp; Kurasi Vendor</span>
                    </div>
                    <h2 id="results-headline" class="font-serif-luxury text-2xl sm:text-3xl md:text-4xl font-bold text-[#27221e] tracking-tight">
                        Menampilkan Layanan
                    </h2>
                    <p id="results-subheadline" class="mt-2 text-xs sm:text-sm text-[#786e66]">
                        Menampilkan kurasi vendor yang sesuai dengan pencarian Anda.
                    </p>
                </div>

                <!-- Active Category Filter Pills & Reset Button -->
                <div class="flex flex-wrap items-center gap-2">
                    <button type="button" class="results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#5b4b38] text-white shadow-xs" data-filter="all">
                        All Category (<span id="count-all">0</span>)
                    </button>
                    <button type="button" class="results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#f5f0ea] hover:bg-[#ebe2d6] text-[#5b4b38]" data-filter="venues">
                        Venues (<span id="count-venues">0</span>)
                    </button>
                    <button type="button" class="results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#f5f0ea] hover:bg-[#ebe2d6] text-[#5b4b38]" data-filter="documentation">
                        Documentation (<span id="count-doc">0</span>)
                    </button>
                    <button type="button" class="results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#f5f0ea] hover:bg-[#ebe2d6] text-[#5b4b38]" data-filter="mua">
                        MUA (<span id="count-mua">0</span>)
                    </button>
                    <button type="button" id="reset-search-btn" class="px-3.5 py-2 rounded-xl text-xs font-semibold text-[#8d8277] hover:text-[#27221e] hover:bg-[#f0ebe4] transition cursor-pointer">
                        ✕ Reset
                    </button>
                </div>
            </div>

            <!-- Matched Vendor Services Grid -->
            <div class="mt-12">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-[#8d8277]">Daftar Layanan &amp; Vendor</h3>
                    <span id="results-count-badge" class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#f0ebe4] text-[#5b4b38]">0 Vendor Ditemukan</span>
                </div>
                
                <div id="search-services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                    <!-- Dynamic Service Cards Inserted Here -->
                </div>

                <!-- Empty State Message -->
                <div id="no-search-results" class="hidden text-center py-16 px-4 bg-[#faf8f5] rounded-3xl border border-[#ede7df] max-w-2xl mx-auto my-8">
                    <div class="w-16 h-16 rounded-2xl bg-[#f0e9df] text-[#5b4b38] flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="font-serif-luxury text-2xl font-bold text-[#27221e]">Tidak Menemukan Hasil</h3>
                    <p class="mt-2 text-sm text-[#786e66] leading-relaxed">
                        Kami tidak menemukan layanan yang cocok dengan pencarian Anda. Coba gunakan kata kunci lokasi seperti <span class="font-medium text-[#5b4b38]">"Jakarta"</span>, <span class="font-medium text-[#5b4b38]">"Bali"</span>, atau kategori seperti <span class="font-medium text-[#5b4b38]">"Venues"</span>, <span class="font-medium text-[#5b4b38]">"Documentation"</span>, dan <span class="font-medium text-[#5b4b38]">"MUA"</span>.
                    </p>
                    <div class="mt-6 flex flex-wrap justify-center gap-2">
                        <button type="button" class="quick-search-pill px-3 py-1.5 rounded-full bg-[#e8e1d7] hover:bg-[#d6ccc2] text-xs font-semibold text-[#27221e] transition cursor-pointer" data-query="Jakarta" data-category="all">Cari di Jakarta</button>
                        <button type="button" class="quick-search-pill px-3 py-1.5 rounded-full bg-[#e8e1d7] hover:bg-[#d6ccc2] text-xs font-semibold text-[#27221e] transition cursor-pointer" data-query="Bali" data-category="all">Cari di Bali</button>
                        <button type="button" class="quick-search-pill px-3 py-1.5 rounded-full bg-[#e8e1d7] hover:bg-[#d6ccc2] text-xs font-semibold text-[#27221e] transition cursor-pointer" data-query="Venues" data-category="venues">Lihat Venues</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- ==================== SECTION: LAYANAN UNGGULAN KAMI (DEFAULT) ==================== -->
        <section id="layanan-unggulan" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-24">
            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                    Layanan Unggulan Kami
                </h2>
                <p class="mt-3 text-sm sm:text-base text-[#786e66] leading-relaxed">
                    Kurasi vendor premium untuk menyempurnakan setiap detail acara Anda.
                </p>
            </div>

            <!-- 3 Service Image Cards Grid -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                <!-- Card 1: Venue -->
                <a href="{{ route('venues.index') }}" class="service-card group block relative aspect-[3/4] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/service-venue.jpg') }}" 
                         alt="Wedding Venue DreamDay Studio" 
                         class="w-full h-full object-cover" 
                         loading="lazy">
                    <!-- Subtle Dark Overlay for Typography -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <!-- Label Overlay -->
                    <div class="absolute inset-x-0 bottom-6 text-center">
                        <span class="font-serif-luxury text-2xl md:text-3xl text-white font-semibold tracking-wide drop-shadow-md">
                            Venue
                        </span>
                        <p class="text-xs text-white/80 mt-1 font-medium group-hover:text-white transition">Lihat Pilihan Venue &amp; Reservasi →</p>
                    </div>
                </a>

                <!-- Card 2: Dokumentasi -->
                <a href="{{ route('documentation.index') }}" class="service-card group block relative aspect-[3/4] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/service-documentation.jpg') }}" 
                         alt="Dokumentasi Wedding Photography & Videography" 
                         class="w-full h-full object-cover" 
                         loading="lazy">
                    <!-- Subtle Dark Overlay for Typography -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <!-- Label Overlay -->
                    <div class="absolute inset-x-0 bottom-6 text-center">
                        <span class="font-serif-luxury text-2xl md:text-3xl text-white font-semibold tracking-wide drop-shadow-md">
                            Dokumentasi
                        </span>
                        <p class="text-xs text-white/80 mt-1 font-medium group-hover:text-white transition">Lihat Pilihan Studio &amp; Reservasi →</p>
                    </div>
                </a>

                <!-- Card 3: Make-up -->
                <a href="{{ route('mua.index') }}" class="service-card group block relative aspect-[3/4] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                    <img src="{{ asset('images/service-makeup.jpg') }}" 
                         alt="Make-up Artist & Bridal Beauty" 
                         class="w-full h-full object-cover" 
                         loading="lazy">
                    <!-- Subtle Dark Overlay for Typography -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                    <!-- Label Overlay -->
                    <div class="absolute inset-x-0 bottom-6 text-center">
                        <span class="font-serif-luxury text-2xl md:text-3xl text-white font-semibold tracking-wide drop-shadow-md">
                            Make-up
                        </span>
                        <p class="text-xs text-white/80 mt-1 font-medium group-hover:text-white transition">Lihat Pilihan MUA &amp; Reservasi →</p>
                    </div>
                </a>
            </div>
        </section>

        <!-- ==================== SECTION: MENGAPA MEMILIH DREAMDAY STUDIO? ==================== -->
        <section class="bg-[#faf8f5] border-y border-[#ede7df] py-20 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-4 mb-14">
                    <h2 class="font-serif-luxury text-3xl sm:text-4xl md:text-[2.6rem] font-bold text-[#27221e] tracking-tight leading-snug">
                        Mengapa Memilih DreamDay Studio?
                    </h2>
                    <p class="text-sm sm:text-base text-[#685f58] leading-relaxed">
                        Kami mendedikasikan diri untuk merangkai setiap detail acara Anda menjadi mahakarya yang tak terlupakan, dengan standar kualitas editorial.
                    </p>
                </div>

                <!-- 3 Feature Columns Grid (Clean Layout Without Big Image) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    <!-- Feature 1: Praktis & Mudah -->
                    <div class="bg-white border border-[#e8e1d7] rounded-2xl p-7 flex flex-col items-start gap-4 shadow-xs hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-2xl bg-[#f0e9df] flex items-center justify-center shrink-0 text-[#5b4b38]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#27221e]">Praktis &amp; Mudah</h3>
                            <p class="mt-2 text-xs sm:text-sm text-[#685f58] leading-relaxed">
                                Platform intuitif yang memudahkan Anda menemukan dan merencanakan seluruh kebutuhan dalam satu tempat.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 2: Aman & Terpercaya -->
                    <div class="bg-white border border-[#e8e1d7] rounded-2xl p-7 flex flex-col items-start gap-4 shadow-xs hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-2xl bg-[#f0e9df] flex items-center justify-center shrink-0 text-[#5b4b38]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#27221e]">Aman &amp; Terpercaya</h3>
                            <p class="mt-2 text-xs sm:text-sm text-[#685f58] leading-relaxed">
                                Setiap vendor melewati proses verifikasi ketat, menjamin transaksi yang aman dan layanan yang profesional.
                            </p>
                        </div>
                    </div>

                    <!-- Feature 3: Penyedia Jasa Terbaik -->
                    <div class="bg-white border border-[#e8e1d7] rounded-2xl p-7 flex flex-col items-start gap-4 shadow-xs hover:shadow-md transition-all duration-200">
                        <div class="w-12 h-12 rounded-2xl bg-[#f0e9df] flex items-center justify-center shrink-0 text-[#5b4b38]">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-[#27221e]">Penyedia Jasa Terbaik</h3>
                            <p class="mt-2 text-xs sm:text-sm text-[#685f58] leading-relaxed">
                                Koleksi kurasi vendor kelas atas yang diakui keahliannya, memastikan estetika premium untuk hari istimewa Anda.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-white border-t border-[#ede7df] pt-16 pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- 4 Footer Columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 lg:gap-8 pb-12">
                <!-- Column 1 & 2: Brand Description -->
                <div class="lg:col-span-2 space-y-4">
                    <a href="/" class="flex items-center gap-3 group">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto object-contain">
                        <span class="font-serif-luxury text-2xl font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors">
                            DreamDay Studio
                        </span>
                    </a>
                    <p class="text-sm text-[#786e66] leading-relaxed max-w-sm">
                        Timeless elegance for your most precious moments.
                    </p>
                </div>

                <!-- Column 3: EXPLORE -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#8d8277] mb-4">
                        EXPLORE
                    </h4>
                    <ul class="space-y-2.5 text-sm text-[#554d46]">
                        <li><a href="#layanan-unggulan" class="hover:text-[#5b4b38] transition-colors">Venues</a></li>
                        <li><a href="#layanan-unggulan" class="hover:text-[#5b4b38] transition-colors">Documentation</a></li>
                        <li><a href="#layanan-unggulan" class="hover:text-[#5b4b38] transition-colors">Make-up</a></li>
                        <li><a href="#layanan-unggulan" class="hover:text-[#5b4b38] transition-colors">Photography</a></li>
                    </ul>
                </div>

                <!-- Column 4: COMPANY -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#8d8277] mb-4">
                        COMPANY
                    </h4>
                    <ul class="space-y-2.5 text-sm text-[#554d46]">
                        <li><a href="https://wa.me/628138897031" target="_blank" rel="noopener noreferrer" class="hover:text-[#5b4b38] transition-colors">Contact Us</a></li>
                        <li><a href="#about" class="hover:text-[#5b4b38] transition-colors">About Us</a></li>
                        <li><a href="#careers" class="hover:text-[#5b4b38] transition-colors">Careers</a></li>
                        <li><a href="https://www.instagram.com/dream_daystudioid?stkn=MXE0azVxMTRvcG96ZA==" target="_blank" rel="noopener noreferrer" class="hover:text-[#5b4b38] transition-colors">Media Social</a></li>
                    </ul>
                </div>

                <!-- Column 5: LEGAL -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-widest text-[#8d8277] mb-4">
                        LEGAL
                    </h4>
                    <ul class="space-y-2.5 text-sm text-[#554d46]">
                        <li><a href="#privacy" class="hover:text-[#5b4b38] transition-colors">Privacy Policy</a></li>
                        <li><a href="#terms" class="hover:text-[#5b4b38] transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Divider & Copyright -->
            <div class="pt-8 border-t border-[#f0ebe4] text-xs text-[#8d8277]">
                <p>© 2026 DreamDay Studio. Timeless elegance for your most precious moments.</p>
            </div>
        </div>
    </footer>

    @include('partials.customer-chat')

    <!-- ==================== DYNAMIC SEARCH & FILTER LOGIC SCRIPT ==================== -->
    <script>
    (function () {
        // Master services data from PHP catalog
        const allServices = @json($servicesData);
        
        // Category metadata dictionary
        const categoriesMeta = {
            venues: {
                id: 'venues',
                name: 'Venues',
                title: 'Wedding & Event Venues',
                desc: 'Ballroom megah, outdoor garden, dan luxury villa untuk momen bahagia Anda.',
                image: "{{ asset('images/service-venue.jpg') }}",
                url: "{{ route('venues.index') }}",
                badge: 'Eksklusif & Mewah',
                keywords: ['venue', 'venues', 'gedung', 'ballroom', 'hotel', 'villa', 'hall', 'tempat', 'garden', 'resort', 'estate', 'outdoor', 'indoor', 'paket acara', 'wedding venue']
            },
            documentation: {
                id: 'documentation',
                name: 'Documentation',
                title: 'Photography & Cinematic Video',
                desc: 'Abadikan kenangan tak terlupakan dengan sinematografi 4K dan foto editorial.',
                image: "{{ asset('images/service-documentation.jpg') }}",
                url: "{{ route('documentation.index') }}",
                badge: 'Sinematik 4K',
                keywords: ['doc', 'documentation', 'dokumentasi', 'foto', 'photo', 'photography', 'fotografi', 'video', 'videography', 'videografi', 'cinematic', 'cinema', 'kamera', 'drone', 'streaming', 'broadcast']
            },
            mua: {
                id: 'mua',
                name: 'MUA (Make-up)',
                title: 'Make-up Artist & Bridal Beauty',
                desc: 'Riasan pengantin flawless, glamor, dan tahan lama dari Master MUA ternama.',
                image: "{{ asset('images/service-makeup.jpg') }}",
                url: "{{ route('mua.index') }}",
                badge: 'Master MUA',
                keywords: ['mua', 'makeup', 'make-up', 'make up', 'rias', 'riasan', 'beauty', 'bridal', 'cantik', 'hairdo', 'salon', 'glam', 'pengantin', 'kecantikan']
            }
        };

        // Known location list for auto-detection
        const knownLocations = [
            'jakarta', 'bali', 'bandung', 'surabaya', 'tangerang', 'medan', 
            'lombok', 'labuan bajo', 'uluwatu', 'senayan', 'dharmawangsa', 
            'cilandak', 'gatot subroto', 'mega kuningan', 'jabodetabek', 'surabaya'
        ];

        // DOM Element references
        const heroSearchForm = document.getElementById('hero-search-form');
        const searchCatFilter = document.getElementById('search-category-filter');
        const searchInput = document.getElementById('search-keyword');
        const clearSearchBtn = document.getElementById('clear-hero-search-btn');
        const liveSuggestionsPopup = document.getElementById('live-suggestions-popup');
        
        const searchResultsSection = document.getElementById('search-results-section');
        const resultsHeadline = document.getElementById('results-headline');
        const resultsSubheadline = document.getElementById('results-subheadline');
        const resultsCountBadge = document.getElementById('results-count-badge');
        const matchedCatContainer = document.getElementById('matched-categories-container');
        const matchedCatTitle = document.getElementById('matched-categories-title');
        const matchedCatBadge = document.getElementById('matched-categories-badge');
        const matchedCatGrid = document.getElementById('matched-categories-grid');
        const searchServicesGrid = document.getElementById('search-services-grid');
        const noSearchResults = document.getElementById('no-search-results');
        const resetSearchBtn = document.getElementById('reset-search-btn');
        const layananUnggulanSection = document.getElementById('layanan-unggulan');

        const countAll = document.getElementById('count-all');
        const countVenues = document.getElementById('count-venues');
        const countDoc = document.getElementById('count-doc');
        const countMua = document.getElementById('count-mua');

        // Current active state
        let currentQuery = '';
        let currentSearchDropdownCat = 'all';
        let currentActiveResultFilter = 'all';
        let currentMatchedServices = [];

        // Helper: Check if query matches location
        function isLocationQuery(q) {
            if (!q) return false;
            const lowerQ = q.toLowerCase();
            return knownLocations.some(loc => loc.includes(lowerQ) || lowerQ.includes(loc)) ||
                   allServices.some(s => s.location.toLowerCase().includes(lowerQ));
        }

        // Helper: Check if query matches category
        function getMatchedCategoryFromQuery(q) {
            if (!q) return null;
            const lowerQ = q.toLowerCase();
            for (const [key, meta] of Object.entries(categoriesMeta)) {
                if (meta.name.toLowerCase() === lowerQ || meta.title.toLowerCase().includes(lowerQ)) {
                    return key;
                }
                if (meta.keywords.some(kw => kw === lowerQ || lowerQ.includes(kw) || kw.includes(lowerQ))) {
                    return key;
                }
            }
            return null;
        }

        // Core Search Function
        function performSearch(query, categoryFilter = 'all', activeTabFilter = 'all', shouldScroll = true) {
            const rawQuery = (query || '').trim();
            const lowerQ = rawQuery.toLowerCase();
            
            currentQuery = rawQuery;
            currentSearchDropdownCat = categoryFilter;
            currentActiveResultFilter = activeTabFilter;

            // Sync input & dropdown
            if (searchInput) searchInput.value = rawQuery;
            if (searchCatFilter) searchCatFilter.value = categoryFilter;
            if (clearSearchBtn) {
                if (rawQuery.length > 0) {
                    clearSearchBtn.classList.remove('hidden');
                } else {
                    clearSearchBtn.classList.add('hidden');
                }
            }

            // If empty query and category is 'all'
            if (!rawQuery && categoryFilter === 'all') {
                if (searchResultsSection) searchResultsSection.classList.add('hidden');
                if (layananUnggulanSection) layananUnggulanSection.classList.remove('hidden');
                return;
            }

            // Identify type of query
            const matchedCatKey = getMatchedCategoryFromQuery(lowerQ);
            const isLoc = isLocationQuery(lowerQ);

            // Filter services matching query and dropdown filter
            let matched = allServices.filter(service => {
                // Dropdown category constraint
                if (categoryFilter !== 'all' && service.category_group !== categoryFilter) {
                    return false;
                }

                if (!rawQuery) {
                    return true;
                }

                const titleMatch = service.title.toLowerCase().includes(lowerQ);
                
                // If query is specifically a category keyword
                if (matchedCatKey) {
                    if (service.category_group === matchedCatKey) return true;
                }

                // Only service names are searchable by free-text keywords.
                if (titleMatch) return true;

                return false;
            });

            currentMatchedServices = matched;

            // Update Counts for Filter Pills
            const venuesCount = matched.filter(s => s.category_group === 'venues').length;
            const docCount = matched.filter(s => s.category_group === 'documentation').length;
            const muaCount = matched.filter(s => s.category_group === 'mua').length;
            const totalCount = matched.length;

            if (countAll) countAll.textContent = totalCount;
            if (countVenues) countVenues.textContent = venuesCount;
            if (countDoc) countDoc.textContent = docCount;
            if (countMua) countMua.textContent = muaCount;

            // Determine which categories are present in these results
            const presentCategoryGroups = new Set();
            matched.forEach(s => {
                if (s.category_group) presentCategoryGroups.add(s.category_group);
            });

            // If matchedCatKey was searched directly and no other, ensure it is in presentCategoryGroups
            if (matchedCatKey && presentCategoryGroups.size === 0) {
                presentCategoryGroups.add(matchedCatKey);
            }

            // Update Headline & Subheadline
            if (isLoc && rawQuery) {
                const locCapitalized = rawQuery.charAt(0).toUpperCase() + rawQuery.slice(1);
                resultsHeadline.textContent = `Menampilkan Kategori & Layanan di "${locCapitalized}"`;
                resultsSubheadline.textContent = `Ditemukan ${totalCount} vendor terbaik di ${locCapitalized} yang siap menyempurnakan acara Anda.`;
                if (matchedCatTitle) matchedCatTitle.textContent = `Kategori Layanan di ${locCapitalized}`;
                if (matchedCatBadge) matchedCatBadge.textContent = `${presentCategoryGroups.size} Kategori Tersedia di ${locCapitalized}`;
            } else if (matchedCatKey) {
                const catInfo = categoriesMeta[matchedCatKey];
                resultsHeadline.textContent = `Kategori: ${catInfo.title}`;
                resultsSubheadline.textContent = `${catInfo.desc} — Ditemukan ${totalCount} vendor pilihan.`;
                if (matchedCatTitle) matchedCatTitle.textContent = `Kategori Terpilih`;
                if (matchedCatBadge) matchedCatBadge.textContent = `${totalCount} Vendor Tersedia`;
            } else if (rawQuery) {
                resultsHeadline.textContent = `Hasil Pencarian: "${rawQuery}"`;
                resultsSubheadline.textContent = `Menampilkan ${totalCount} kurasi vendor yang cocok dengan kata kunci "${rawQuery}".`;
                if (matchedCatTitle) matchedCatTitle.textContent = `Kategori Terkait`;
                if (matchedCatBadge) matchedCatBadge.textContent = `${presentCategoryGroups.size} Kategori Ditemukan`;
            } else if (categoryFilter !== 'all') {
                const catInfo = categoriesMeta[categoryFilter];
                resultsHeadline.textContent = `Kategori: ${catInfo.name}`;
                resultsSubheadline.textContent = `${catInfo.desc} — Ditemukan ${totalCount} vendor pilihan.`;
                if (matchedCatTitle) matchedCatTitle.textContent = `Kategori Terpilih`;
                if (matchedCatBadge) matchedCatBadge.textContent = `${totalCount} Vendor Tersedia`;
            }

            // Render Category Cards (Showcase)
            renderCategoryCards(presentCategoryGroups, isLoc ? rawQuery : null, matched);

            // Filter by active pill (all, venues, documentation, mua)
            let displayedServices = matched;
            if (activeTabFilter !== 'all') {
                displayedServices = matched.filter(s => s.category_group === activeTabFilter);
            }

            // Render Service Cards
            renderServicesGrid(displayedServices);

            // Update Tab Button Styles
            updateFilterTabsUI(activeTabFilter);

            // Update results badge
            if (resultsCountBadge) {
                resultsCountBadge.textContent = `${displayedServices.length} Vendor Ditampilkan`;
            }

            // Reveal Results Section
            if (searchResultsSection) searchResultsSection.classList.remove('hidden');
            if (layananUnggulanSection) layananUnggulanSection.classList.add('hidden');

            // Smooth scroll into results
            if (shouldScroll && searchResultsSection) {
                searchResultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Render Matched Category Cards
        function renderCategoryCards(categoryGroupSet, locationQuery, matchedServices) {
            if (!matchedCatGrid || !matchedCatContainer) return;

            let groupsToRender = Array.from(categoryGroupSet);
            // If empty, fallback to all 3 categories or hide
            if (groupsToRender.length === 0) {
                groupsToRender = Object.keys(categoriesMeta);
            }

            matchedCatGrid.innerHTML = '';
            
            groupsToRender.forEach(catGroup => {
                const meta = categoriesMeta[catGroup];
                if (!meta) return;

                // Count vendor for this specific category in current matched services
                const catVendorCount = matchedServices.filter(s => s.category_group === catGroup).length;
                
                const locBadge = locationQuery ? `📍 ${locationQuery.charAt(0).toUpperCase() + locationQuery.slice(1)}` : meta.badge;
                const displayTitle = locationQuery 
                    ? `${meta.name} di ${locationQuery.charAt(0).toUpperCase() + locationQuery.slice(1)}` 
                    : meta.title;

                const cardHtml = `
                    <div class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-[#e8e1d7] bg-white flex flex-col justify-between">
                        <div class="relative h-44 sm:h-48 w-full overflow-hidden">
                            <img src="${meta.image}" alt="${meta.name}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent"></div>
                            
                            <div class="absolute top-3 right-3">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-white/95 text-[#5b4b38] backdrop-blur-xs shadow-xs">
                                    ${locBadge}
                                </span>
                            </div>
                            
                            <div class="absolute bottom-3 left-4 right-4 text-left">
                                <h4 class="font-serif-luxury text-xl font-bold text-white tracking-wide drop-shadow-sm">
                                    ${displayTitle}
                                </h4>
                                <p class="text-xs text-white/85 line-clamp-1 mt-0.5">${meta.desc}</p>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-[#faf8f5] flex items-center justify-between border-t border-[#ede7df]">
                            <div class="text-xs text-[#786e66]">
                                <span class="font-bold text-[#5b4b38] text-sm">${catVendorCount}</span> vendor tersedia
                            </div>
                            <div class="flex items-center gap-2">
                                <button type="button" 
                                        onclick="window.filterByResultCategory('${catGroup}')" 
                                        class="px-3 py-1.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-semibold transition cursor-pointer shadow-2xs">
                                    Lihat Layanan
                                </button>
                                <a href="${meta.url}" 
                                   class="px-2.5 py-1.5 rounded-xl bg-white hover:bg-[#f0ebe4] text-[#5b4b38] border border-[#d6ccc2] text-xs font-medium transition cursor-pointer"
                                   title="Buka Halaman ${meta.name}">
                                    Kategori →
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                matchedCatGrid.insertAdjacentHTML('beforeend', cardHtml);
            });
        }

        // Render Service Cards Grid
        function renderServicesGrid(services) {
            if (!searchServicesGrid) return;
            searchServicesGrid.innerHTML = '';

            if (services.length === 0) {
                if (noSearchResults) noSearchResults.classList.remove('hidden');
                return;
            }

            if (noSearchResults) noSearchResults.classList.add('hidden');

            services.forEach(service => {
                const ratingNumber = (service.rating || '4.9').split(' ')[0];
                const cardHtml = `
                    <div class="bg-white rounded-2xl border border-[#ece5dc] overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="relative h-60 sm:h-64 overflow-hidden bg-[#f5f0ea]">
                                <img src="${service.image}" alt="${service.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                                
                                <div class="absolute top-3 left-3 flex flex-wrap gap-1.5">
                                    <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-white/95 text-[#5b4b38] shadow-xs backdrop-blur-xs">
                                        ${service.category_label}
                                    </span>
                                </div>
                                
                                <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between text-xs text-white drop-shadow-md">
                                    <span class="flex items-center gap-1 font-medium bg-black/45 backdrop-blur-xs px-2.5 py-1 rounded-lg">
                                        📍 ${service.location}
                                    </span>
                                    <span class="font-semibold bg-black/45 backdrop-blur-xs px-2.5 py-1 rounded-lg flex items-center gap-1 text-amber-300">
                                        ★ ${ratingNumber}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-5 text-left">
                                <h4 class="font-serif-luxury text-lg font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors leading-snug line-clamp-1">
                                    ${service.title}
                                </h4>
                                <p class="mt-2 text-xs sm:text-sm text-[#786e66] line-clamp-2 leading-relaxed">
                                    ${service.description}
                                </p>
                            </div>
                        </div>

                        <div class="p-5 pt-0">
                            <div class="pt-3.5 border-t border-[#f0ebe4] flex items-center justify-between">
                                <div class="text-left">
                                    <span class="text-[10px] uppercase font-bold text-[#8d8277] tracking-wider block">Mulai Dari</span>
                                    <span class="font-serif-luxury text-base sm:text-lg font-bold text-[#5b4b38]">
                                        ${service.price_formatted}
                                    </span>
                                </div>
                                <a href="${service.url}" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs font-semibold shadow-xs transition duration-200 cursor-pointer">
                                    <span>Lihat Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                searchServicesGrid.insertAdjacentHTML('beforeend', cardHtml);
            });
        }

        // Update Filter Tab Buttons Active State
        function updateFilterTabsUI(activeFilter) {
            const buttons = document.querySelectorAll('.results-filter-btn');
            buttons.forEach(btn => {
                const filter = btn.getAttribute('data-filter');
                if (filter === activeFilter) {
                    btn.className = 'results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#5b4b38] text-white shadow-xs';
                } else {
                    btn.className = 'results-filter-btn px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold transition cursor-pointer bg-[#f5f0ea] hover:bg-[#ebe2d6] text-[#5b4b38]';
                }
            });
        }

        // Live Suggestions Autocomplete Popup
        function updateLiveSuggestions(query) {
            if (!liveSuggestionsPopup) return;
            const q = (query || '').trim().toLowerCase();

            if (q.length === 0) {
                liveSuggestionsPopup.classList.add('hidden');
                liveSuggestionsPopup.innerHTML = '';
                return;
            }

            // Find matching categories
            const matchedCats = [];
            for (const [key, meta] of Object.entries(categoriesMeta)) {
                if (meta.name.toLowerCase().includes(q) || meta.keywords.some(kw => kw.includes(q))) {
                    const count = allServices.filter(s => s.category_group === key).length;
                    matchedCats.push({ key, name: meta.name, count });
                }
            }

            // Find matching unique locations
            const matchedLocs = [];
            const locCounts = {};
            allServices.forEach(s => {
                const loc = s.location;
                if (loc.toLowerCase().includes(q)) {
                    // Extract main city/region (e.g. Jakarta, Bali, Bandung)
                    const parts = loc.split(',').map(p => p.trim());
                    const mainPart = parts[parts.length - 1] || loc;
                    locCounts[mainPart] = (locCounts[mainPart] || 0) + 1;
                }
            });
            Object.keys(locCounts).forEach(loc => {
                matchedLocs.push({ name: loc, count: locCounts[loc] });
            });

            // Find matching services (top 4)
            const matchedServs = allServices.filter(s => 
                s.title.toLowerCase().includes(q) || s.description.toLowerCase().includes(q)
            ).slice(0, 4);

            if (matchedCats.length === 0 && matchedLocs.length === 0 && matchedServs.length === 0) {
                liveSuggestionsPopup.innerHTML = `
                    <div class="p-4 text-xs text-[#786e66] text-center">
                        Tekan <span class="font-bold text-[#5b4b38]">Enter</span> untuk mencari "${query}"
                    </div>
                `;
                liveSuggestionsPopup.classList.remove('hidden');
                return;
            }

            let html = '<div class="p-2 divide-y divide-[#f0ebe4]">';

            // Categories block
            if (matchedCats.length > 0) {
                html += '<div class="py-1.5"><div class="px-3 py-1 text-[11px] font-bold text-[#8d8277] uppercase tracking-wider">🏷️ Kategori</div>';
                matchedCats.forEach(c => {
                    html += `
                        <button type="button" class="w-full text-left px-3 py-2 rounded-lg hover:bg-[#faf7f2] flex items-center justify-between transition cursor-pointer text-xs" onclick="window.selectSuggestion('${c.name}', '${c.key}')">
                            <span class="font-bold text-[#27221e]">${c.name}</span>
                            <span class="text-[#8d8277] text-[11px] bg-[#f5f0ea] px-2 py-0.5 rounded-full">${c.count} Vendor</span>
                        </button>
                    `;
                });
                html += '</div>';
            }

            // Locations block
            if (matchedLocs.length > 0) {
                html += '<div class="py-1.5"><div class="px-3 py-1 text-[11px] font-bold text-[#8d8277] uppercase tracking-wider">📍 Lokasi</div>';
                matchedLocs.forEach(l => {
                    html += `
                        <button type="button" class="w-full text-left px-3 py-2 rounded-lg hover:bg-[#faf7f2] flex items-center justify-between transition cursor-pointer text-xs" onclick="window.selectSuggestion('${l.name}', 'all')">
                            <span class="font-medium text-[#27221e]">Cari di <strong>${l.name}</strong></span>
                            <span class="text-[#5b4b38] text-[11px] font-semibold bg-[#f5f0ea] px-2 py-0.5 rounded-full">${l.count} Vendor</span>
                        </button>
                    `;
                });
                html += '</div>';
            }

            // Specific vendor items block
            if (matchedServs.length > 0) {
                html += '<div class="py-1.5"><div class="px-3 py-1 text-[11px] font-bold text-[#8d8277] uppercase tracking-wider">✨ Vendor Terkait</div>';
                matchedServs.forEach(s => {
                    html += `
                        <a href="${s.url}" class="block px-3 py-2 rounded-lg hover:bg-[#faf7f2] transition text-xs">
                            <div class="font-semibold text-[#27221e] line-clamp-1">${s.title}</div>
                            <div class="text-[11px] text-[#8d8277] flex items-center gap-2 mt-0.5">
                                <span>${s.category_label}</span>
                                <span>•</span>
                                <span>${s.location}</span>
                            </div>
                        </a>
                    `;
                });
                html += '</div>';
            }

            html += '</div>';
            liveSuggestionsPopup.innerHTML = html;
            liveSuggestionsPopup.classList.remove('hidden');
        }

        // Global functions accessible from inline handlers
        window.executeHeroSearch = function () {
            if (liveSuggestionsPopup) liveSuggestionsPopup.classList.add('hidden');
            const q = searchInput ? searchInput.value : '';
            const cat = searchCatFilter ? searchCatFilter.value : 'all';
            performSearch(q, cat, 'all', true);
        };

        window.selectSuggestion = function (query, catFilter = 'all') {
            if (searchInput) searchInput.value = query;
            if (searchCatFilter) searchCatFilter.value = catFilter;
            if (liveSuggestionsPopup) liveSuggestionsPopup.classList.add('hidden');
            performSearch(query, catFilter, 'all', true);
        };

        window.filterByResultCategory = function (categoryGroup) {
            currentActiveResultFilter = categoryGroup;
            updateFilterTabsUI(categoryGroup);
            let filtered = currentMatchedServices;
            if (categoryGroup !== 'all') {
                filtered = currentMatchedServices.filter(s => s.category_group === categoryGroup);
            }
            renderServicesGrid(filtered);
            if (resultsCountBadge) {
                resultsCountBadge.textContent = `${filtered.length} Vendor Ditampilkan`;
            }
            if (searchServicesGrid) {
                searchServicesGrid.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        };

        // Event Listeners
        if (heroSearchForm) {
            heroSearchForm.addEventListener('submit', function (e) {
                e.preventDefault();
                window.executeHeroSearch();
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const q = this.value;
                if (clearSearchBtn) {
                    if (q.length > 0) clearSearchBtn.classList.remove('hidden');
                    else clearSearchBtn.classList.add('hidden');
                }
                updateLiveSuggestions(q);
            });

            searchInput.addEventListener('focus', function () {
                if (this.value.trim().length > 0) {
                    updateLiveSuggestions(this.value);
                }
            });
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', function () {
                if (searchInput) {
                    searchInput.value = '';
                    searchInput.focus();
                }
                clearSearchBtn.classList.add('hidden');
                if (liveSuggestionsPopup) liveSuggestionsPopup.classList.add('hidden');
            });
        }

        if (searchCatFilter) {
            searchCatFilter.addEventListener('change', function () {
                if (searchInput && searchInput.value.trim().length > 0) {
                    window.executeHeroSearch();
                }
            });
        }

        // Quick search pills listener
        document.querySelectorAll('.quick-search-pill').forEach(pill => {
            pill.addEventListener('click', function () {
                const q = this.getAttribute('data-query') || '';
                const cat = this.getAttribute('data-category') || 'all';
                if (searchInput) searchInput.value = q;
                if (searchCatFilter) searchCatFilter.value = cat;
                performSearch(q, cat, 'all', true);
            });
        });

        // Results Filter Buttons listener
        document.querySelectorAll('.results-filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                const filter = this.getAttribute('data-filter') || 'all';
                window.filterByResultCategory(filter);
            });
        });

        // Reset Button listener
        if (resetSearchBtn) {
            resetSearchBtn.addEventListener('click', function () {
                if (searchInput) searchInput.value = '';
                if (searchCatFilter) searchCatFilter.value = 'all';
                if (clearSearchBtn) clearSearchBtn.classList.add('hidden');
                if (searchResultsSection) searchResultsSection.classList.add('hidden');
                if (layananUnggulanSection) {
                    layananUnggulanSection.classList.remove('hidden');
                    layananUnggulanSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        }

        // Close live suggestions on outside click
        document.addEventListener('click', function (e) {
            if (liveSuggestionsPopup && !liveSuggestionsPopup.contains(e.target) && !heroSearchForm.contains(e.target)) {
                liveSuggestionsPopup.classList.add('hidden');
            }
        });

        // Keyboard escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && liveSuggestionsPopup) {
                liveSuggestionsPopup.classList.add('hidden');
            }
        });

    })();
    </script>

    <!-- ==================== MODAL: REGISTRATION SUCCESS POPUP ==================== -->
    <div id="modal-registration-success" 
         class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 {{ session('registered_success') || request('registered') ? '' : 'hidden' }}">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-md w-full p-6 sm:p-8 text-center space-y-5 transform transition-all duration-300">
            
            <!-- Luxury Success Icon Badge -->
            <div class="w-16 h-16 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center mx-auto border border-emerald-200 shadow-xs">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Content Details -->
            <div class="space-y-2">
                <span class="text-[0.7rem] uppercase font-bold tracking-widest text-[#8d8277]">DREAMDAY STUDIO</span>
                <h3 class="font-serif-luxury text-2xl font-bold text-[#27221e]">
                    Akun Telah Berhasil Teregistrasi!
                </h3>
                <p class="text-xs sm:text-sm text-[#685f58] leading-relaxed">
                    Selamat datang, <strong class="text-[#5b4b38]">{{ session('user_name', 'Pelanggan Terhormat') }}</strong>! Akun Anda telah aktif dan siap digunakan untuk memilih vendor serta memesan paket pernikahan impian Anda.
                </p>
            </div>

            <!-- Action Button to Land on Homepage -->
            <div class="pt-2">
                <button type="button" 
                        onclick="closeRegistrationSuccessModal()" 
                        class="w-full py-3.5 px-6 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-xs sm:text-sm shadow-md hover:shadow-lg transition duration-200 cursor-pointer">
                    Mulai Jelajahi Layanan &amp; Vendor
                </button>
            </div>

        </div>
    </div>

    <script>
        function closeRegistrationSuccessModal() {
            const modal = document.getElementById('modal-registration-success');
            if (modal) {
                modal.classList.add('hidden');
            }
            // Clean url if registered param exists
            if (window.location.search.includes('registered')) {
                const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.replaceState({ path: newUrl }, '', newUrl);
            }
        }
    </script>
</body>
</html>
