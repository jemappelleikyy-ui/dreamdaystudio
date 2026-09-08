<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Capture Your Most Precious Moments — DreamDay Studio</title>
    <meta name="description" content="Discover premium documentation studios specialized in timeless, cinematic, and editorial wedding storytelling.">

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
<body class="bg-white text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER BAR ==================== -->
    <header class="sticky top-0 z-40 w-full bg-white/95 backdrop-blur-md border-b border-[#f0ebe4] transition-all duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Drawer Toggle & Brand Logo -->
            <div class="flex items-center gap-4 sm:gap-6">
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

                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="h-8 sm:h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <span class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#6b513a] group-hover:text-[#523d2b] transition-colors">
                        DreamDay Studio
                    </span>
                </a>
            </div>

            <!-- Right Side: Profile / Login & List Service -->
            <div class="flex items-center gap-3 sm:gap-5">
                @if(session('is_logged_in'))
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
                    <a href="{{ route('login') }}" class="text-sm sm:text-base font-medium text-[#27221e] hover:text-[#5b4b38] transition-colors px-2 py-1">
                        Log In
                    </a>
                @endif

                <a href="{{ route('list-service') }}" class="inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white text-xs sm:text-sm font-medium px-4 sm:px-5 py-2.5 rounded-xl shadow-xs hover:shadow-md transition duration-200">
                    List Your Service
                </a>
            </div>
        </div>
    </header>

    <!-- ==================== DRAWER SIDEBAR ==================== -->
    <div id="drawer-backdrop" class="fixed inset-0 z-50 bg-black/40 backdrop-blur-xs is-hidden" aria-hidden="true"></div>
    <aside id="drawer-menu" class="fixed top-0 left-0 bottom-0 z-50 w-72 sm:w-80 bg-white shadow-2xl flex flex-col justify-between is-closed border-r border-[#ece5dc]" role="dialog" aria-modal="true">
        <div class="p-6 border-b border-[#f2ece5] flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                <span class="font-serif-luxury text-xl font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors">DreamDay Studio</span>
            </a>
            <button id="drawer-close-btn" type="button" class="p-2 rounded-lg text-[#786e66] hover:text-[#27221e] hover:bg-[#f5f0ea] transition cursor-pointer" aria-label="Tutup Menu">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-1.5">
            <a href="{{ route('profile') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <span>Profile</span>
            </a>
            <a href="{{ route('venues.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#27221e] hover:text-[#5b4b38] hover:bg-[#faf7f2] font-medium text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#f5f0ea] group-hover:bg-[#ebe2d6] text-[#5b4b38] transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </span>
                <span>Venues</span>
            </a>
            <!-- Documentation (Active) -->
            <a href="{{ route('documentation.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#5b4b38] bg-[#faf7f2] font-semibold text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#ebe2d6] text-[#5b4b38] transition-colors">
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
        <div class="p-6 border-t border-[#f2ece5] bg-[#faf8f5]">
            <a href="{{ route('list-service') }}" class="w-full inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium py-3 px-4 rounded-xl shadow-xs transition">
                List Your Service
            </a>
        </div>
    </aside>

    <!-- ==================== MAIN CONTENT SECTION ==================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 w-full flex-1 space-y-12">
        
        <!-- Page Title & Subtitle -->
        <div class="text-center max-w-3xl mx-auto space-y-3">
            <h1 class="font-serif-luxury text-3xl sm:text-4xl md:text-5xl font-bold text-[#27221e] tracking-tight">
                Capture Your Most Precious Moments
            </h1>
            <p class="text-xs sm:text-sm text-[#786e66] leading-relaxed max-w-2xl mx-auto">
                Discover premium documentation studios specialized in timeless, cinematic, and editorial wedding storytelling.
            </p>
        </div>

        <!-- Search Input Bar -->
        <div class="max-w-xl mx-auto">
            <div class="relative flex items-center bg-white border border-[#ded5cb] rounded-full px-5 py-3 shadow-xs hover:border-[#b0a597] focus-within:border-[#5b4b38] focus-within:ring-2 focus-within:ring-[#5b4b38]/20 transition duration-200">
                <svg class="w-4 h-4 text-[#8d8277] mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" 
                       id="studio-search-input"
                       placeholder="search for studios..." 
                       class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none font-medium">
                <button type="button" id="clear-search-btn" class="hidden text-xs text-[#8d8277] hover:text-[#27221e] ml-2">
                    ✕
                </button>
            </div>
        </div>

        <!-- Studios Grid (All photo sizes identical & uniform) -->
        <div id="studios-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 lg:gap-10 items-stretch">
            
            @php
                $studiosList = [
                    [
                        'slug' => 'emboss-photography',
                        'title' => 'Emboss Photography',
                        'description' => 'Fine-art wedding photography with a focus on editorial portraits and natural...',
                        'image' => 'images/doc-emboss.jpg',
                        'badge' => null,
                        'price' => 'Rp 18.000.000',
                    ],
                    [
                        'slug' => 'pastwork-id',
                        'title' => 'Pastwork.id',
                        'description' => 'Dynamic cinematic trailers and comprehensive event videography...',
                        'image' => 'images/doc-pastwork.jpg',
                        'badge' => null,
                        'price' => 'Rp 22.000.000',
                    ],
                    [
                        'slug' => 'soundjakarta',
                        'title' => 'Soundjakarta',
                        'description' => 'Live event streaming, audio recording, and professional broadcasting...',
                        'image' => 'images/doc-soundjakarta.jpg',
                        'badge' => null,
                        'price' => 'Rp 15.000.000',
                    ],
                    [
                        'slug' => 'kamera-pohon',
                        'title' => 'Kamera Pohon',
                        'description' => 'Organic, documentary-style photography capturing candid...',
                        'image' => 'images/doc-kamerapohon.jpg',
                        'badge' => null,
                        'price' => 'Rp 16.500.000',
                    ],
                    [
                        'slug' => 'bab-production',
                        'title' => 'BAB Production',
                        'description' => 'Full-scale cinematic production house offering drone coverage, same-day edits, and immersive big-screen storytelling for luxury events.',
                        'image' => 'images/doc-babproduction.jpg',
                        'badge' => 'FEATURED STUDIO',
                        'price' => 'Rp 28.000.000',
                    ],
                    [
                        'slug' => 'dstudio-jakarta',
                        'title' => 'DSTUDIO Jakarta',
                        'description' => 'Pre-wedding studio sessions and conceptual indoor photo shoots.',
                        'image' => 'images/doc-dstudio.jpg',
                        'badge' => null,
                        'price' => 'Rp 14.000.000',
                    ],
                    [
                        'slug' => 'dsfphoto',
                        'title' => 'DSFPHOTO',
                        'description' => 'Classic, timeless wedding photography focusing on elegant emotional...',
                        'image' => 'images/doc-dsfphoto.jpg',
                        'badge' => null,
                        'price' => 'Rp 19.500.000',
                    ],
                    [
                        'slug' => 'arista-graphy',
                        'title' => 'Arista Graphy',
                        'description' => 'Destination wedding specialists offering sweeping panoramic and romantic...',
                        'image' => 'images/doc-aristagraphy.jpg',
                        'badge' => null,
                        'price' => 'Rp 24.000.000',
                    ],
                ];
            @endphp

            @foreach($studiosList as $studio)
                <div class="studio-card group bg-white rounded-2xl overflow-hidden border border-[#eae3d9] shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between"
                     data-title="{{ strtolower($studio['title']) }}"
                     data-description="{{ strtolower($studio['description']) }}">
                    
                    <div>
                        <!-- Uniform Aspect Ratio Photo Container (All photo sizes identical) -->
                        <div class="relative aspect-[16/10] w-full overflow-hidden bg-[#faf8f5]">
                            <img src="{{ asset($studio['image']) }}" 
                                 alt="{{ $studio['title'] }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 loading="lazy">
                            
                            @if(!empty($studio['badge']))
                                <span class="absolute top-3 left-3 bg-[#5b4b38]/90 backdrop-blur-xs text-white text-[9px] font-bold uppercase tracking-widest px-2.5 py-1 rounded shadow-xs">
                                    {{ $studio['badge'] }}
                                </span>
                            @endif
                        </div>

                        <!-- Card Information Body -->
                        <div class="p-5 sm:p-6 space-y-2.5 pb-4">
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e] group-hover:text-[#5b4b38] transition-colors leading-snug">
                                <a href="{{ route('service.detail', ['slug' => $studio['slug']]) }}">
                                    {{ $studio['title'] }}
                                </a>
                            </h2>

                            <p class="text-xs text-[#786e66] leading-relaxed line-clamp-3">
                                {{ $studio['description'] }}
                            </p>
                        </div>
                        
                    </div>

                    <!-- Action Buttons (View Details & Book Now) -->
                    <div class="p-5 sm:p-6 pt-0 mt-auto">
                        <div class="grid grid-cols-2 gap-2.5 pt-2 border-t border-[#f2ece5]">
                            <a href="{{ route('service.detail', ['slug' => $studio['slug']]) }}" 
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold rounded-lg border border-[#ded5cb] text-[#554d46] hover:bg-[#faf7f2] hover:text-[#27221e] hover:border-[#b0a597] transition duration-150 text-center">
                                View Details
                            </a>
                            <a href="{{ route('booking', ['service' => $studio['slug']]) }}" 
                               class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold rounded-lg bg-[#5b4b38] text-white hover:bg-[#483b2c] shadow-xs hover:shadow transition duration-150 text-center">
                                Book Now
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

        <!-- No Results Found Message State -->
        <div id="no-results" class="hidden text-center py-16 space-y-4">
            <div class="w-16 h-16 rounded-full bg-[#f5f0ea] flex items-center justify-center mx-auto text-[#8d8277]">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Tidak ada studio ditemukan</h3>
            <p class="text-xs text-[#786e66] max-w-sm mx-auto">
                Coba gunakan kata kunci pencarian yang lain untuk menemukan studio dokumentasi impian Anda.
            </p>
        </div>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-white border-t border-[#ede7df] py-10 px-4 sm:px-8 mt-16">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-xs text-[#685f58]">
            <!-- Left Side: Brand & Tagline -->
            <div class="space-y-1 text-center md:text-left">
                <a href="{{ route('home') }}" class="font-serif-luxury text-2xl font-bold tracking-tight text-[#6b513a] hover:text-[#523d2b] transition-colors">
                    DreamDay Studio
                </a>
            </div>

            <!-- Middle Side: Policy Links -->
            <div class="flex items-center gap-6 text-xs text-[#554d46] font-medium">
                <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
            </div>

            <!-- Right Side: Copyright -->
            <p class="text-xs text-[#8d8277]">
                © 2026 DreamDay Studio. All rights reserved.
            </p>
        </div>
    </footer>

    @include('partials.customer-chat')

    <!-- ==================== SEARCH & DRAWER JAVASCRIPT ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Realtime Search Filter
            const searchInput = document.getElementById('studio-search-input');
            const clearBtn = document.getElementById('clear-search-btn');
            const cards = document.querySelectorAll('.studio-card');
            const noResults = document.getElementById('no-results');

            if (searchInput) {
                searchInput.addEventListener('input', () => {
                    const query = searchInput.value.toLowerCase().trim();
                    let visibleCount = 0;

                    if (query.length > 0) {
                        clearBtn.classList.remove('hidden');
                    } else {
                        clearBtn.classList.add('hidden');
                    }

                    cards.forEach(card => {
                        const title = card.getAttribute('data-title') || '';
                        const desc = card.getAttribute('data-description') || '';
                        if (title.includes(query) || desc.includes(query)) {
                            card.classList.remove('hidden');
                            visibleCount++;
                        } else {
                            card.classList.add('hidden');
                        }
                    });

                    if (visibleCount === 0) {
                        noResults.classList.remove('hidden');
                    } else {
                        noResults.classList.add('hidden');
                    }
                });

                if (clearBtn) {
                    clearBtn.addEventListener('click', () => {
                        searchInput.value = '';
                        searchInput.dispatchEvent(new Event('input'));
                        searchInput.focus();
                    });
                }
            }

            // Drawer Sidebar Toggle
            const toggleBtn = document.getElementById('drawer-toggle-btn');
            const closeBtn = document.getElementById('drawer-close-btn');
            const backdrop = document.getElementById('drawer-backdrop');
            const drawer = document.getElementById('drawer-menu');

            function openDrawer() {
                if (!drawer || !backdrop) return;
                backdrop.classList.remove('is-hidden');
                drawer.classList.remove('is-closed');
                document.body.classList.add('overflow-hidden');
            }

            function closeDrawer() {
                if (!drawer || !backdrop) return;
                backdrop.classList.add('is-hidden');
                drawer.classList.add('is-closed');
                document.body.classList.remove('overflow-hidden');
            }

            if (toggleBtn) toggleBtn.addEventListener('click', openDrawer);
            if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
            if (backdrop) backdrop.addEventListener('click', closeDrawer);
        });
    </script>
</body>
</html>
