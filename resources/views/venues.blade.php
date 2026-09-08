<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discover Extraordinary Venues — DreamDay Studio</title>
    <meta name="description" content="Curated spaces for timeless celebrations. Explore our collection of the most exquisite venues tailored for your perfect day.">

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
            <button id="drawer-close-btn" type="button" class="p-2 rounded-lg text-[#786e66] hover:text-[#27221e] hover:bg-[#f5f0ea] transition cursor-pointer">
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
            <a href="{{ route('venues.index') }}" class="flex items-center gap-3.5 px-4 py-3 rounded-xl text-[#5b4b38] bg-[#faf7f2] font-semibold text-base transition-colors group">
                <span class="p-1.5 rounded-lg bg-[#ebe2d6] text-[#5b4b38] transition-colors">
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
                Discover Extraordinary Venues
            </h1>
            <p class="text-xs sm:text-sm text-[#786e66] leading-relaxed max-w-2xl mx-auto">
                Curated spaces for timeless celebrations. Explore our collection of the most exquisite venues tailored for your perfect day.
            </p>
        </div>

        <!-- Search Input Bar -->
        <div class="max-w-xl mx-auto">
            <div class="relative flex items-center bg-white border border-[#ded5cb] rounded-full px-5 py-3 shadow-xs hover:border-[#b0a597] focus-within:border-[#5b4b38] focus-within:ring-2 focus-within:ring-[#5b4b38]/20 transition duration-200">
                <svg class="w-4 h-4 text-[#8d8277] mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" 
                       id="venue-search-input"
                       placeholder="Search for venues..." 
                       class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none font-medium">
                <button type="button" id="clear-search-btn" class="hidden text-xs text-[#8d8277] hover:text-[#27221e] ml-2">
                    ✕
                </button>
            </div>
        </div>

        <!-- Venues Grid (2 Rows x 3 Columns) -->
        <div id="venues-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 items-stretch">
            
            @php
                $venuesList = [
                    [
                        'slug' => 'the-tribrata-dharmawangsa',
                        'title' => 'The Tribrata Darmawangsa',
                        'location' => 'SOUTH JAKARTA',
                        'capacity' => '1500 GUESTS',
                        'image' => 'images/venue-tribrata.jpg',
                        'price' => 'Rp 125.000.000',
                    ],
                    [
                        'slug' => 'rumah-sarwono',
                        'title' => 'Rumah Sarwono',
                        'location' => 'PASAR MINGGU',
                        'capacity' => '500 GUESTS',
                        'image' => 'images/venue-sarwono.jpg',
                        'price' => 'Rp 48.000.000',
                    ],
                    [
                        'slug' => 'plataran-dharmawangsa',
                        'title' => 'Plataran Dharmawangsa',
                        'location' => 'SOUTH JAKARTA',
                        'capacity' => '500 GUESTS',
                        'image' => 'images/venue-plataran.jpg',
                        'price' => 'Rp 85.000.000',
                    ],
                    [
                        'slug' => 'taman-kajoe',
                        'title' => 'Taman Kajoe',
                        'location' => 'CILANDAK',
                        'capacity' => '400 GUESTS',
                        'image' => 'images/venue-tamankajoe.jpg',
                        'price' => 'Rp 55.000.000',
                    ],
                    [
                        'slug' => 'balai-kartini',
                        'title' => 'Balai Kartini',
                        'location' => 'GATOT SUBROTO',
                        'capacity' => '2800 GUESTS',
                        'image' => 'images/venue-balaikartini.jpg',
                        'price' => 'Rp 110.000.000',
                    ],
                    [
                        'slug' => 'the-ritz-carlton-mega-kuningan',
                        'title' => 'The Ritz-Carlton Mega Kuningan',
                        'location' => 'MEGA KUNINGAN',
                        'capacity' => '1200 GUESTS',
                        'image' => 'images/venue-ritzcarlton.jpg',
                        'price' => 'Rp 165.000.000',
                    ],
                ];
            @endphp

            @foreach($venuesList as $venue)
                <div class="venue-card bg-white border border-[#ede7df] rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:border-[#cfc4b6] transition-all duration-300 flex flex-col justify-between group"
                     data-name="{{ strtolower($venue['title']) }}"
                     data-location="{{ strtolower($venue['location']) }}">
                    
                    <div>
                        <!-- Venue Media Image -->
                        <div class="relative aspect-[16/10] overflow-hidden bg-[#faf8f5]">
                            <img src="{{ asset($venue['image']) }}" 
                                 alt="{{ $venue['title'] }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 loading="lazy">
                        </div>

                        <!-- Card Info Body -->
                        <div class="p-6 text-center space-y-2 pb-4">
                            <h2 class="font-serif-luxury text-xl sm:text-2xl font-bold text-[#27221e] tracking-tight group-hover:text-[#5b4b38] transition-colors">
                                {{ $venue['title'] }}
                            </h2>
                            <p class="text-[0.7rem] sm:text-xs font-bold uppercase tracking-widest text-[#8d8277]">
                                {{ $venue['location'] }} • {{ $venue['capacity'] }}
                            </p>
                        </div>
                        
                    </div>

                    <!-- 2 Action Buttons: View Details & Book Now -->
                    <div class="p-6 pt-0 grid grid-cols-2 gap-3">
                        <a href="{{ route('service.detail', ['slug' => $venue['slug']]) }}" 
                           class="py-2.5 px-3 rounded-xl border border-[#ded5cb] hover:border-[#b0a597] bg-white hover:bg-[#faf7f2] text-[#27221e] font-semibold text-xs sm:text-sm text-center transition duration-200 shadow-2xs">
                            View Details
                        </a>
                        
                        @if(session('is_logged_in'))
                            <a href="{{ route('booking', ['service' => $venue['slug']]) }}" 
                               class="py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-semibold text-xs sm:text-sm text-center transition duration-200 shadow-xs hover:shadow">
                                Book Now
                            </a>
                        @else
                            <button type="button" 
                                    onclick="requireLoginToBook('{{ route('booking', ['service' => $venue['slug']]) }}')"
                                    class="py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-semibold text-xs sm:text-sm text-center transition duration-200 shadow-xs hover:shadow cursor-pointer">
                                Book Now
                            </button>
                        @endif
                    </div>

                </div>
            @endforeach

        </div>

        <!-- No Results Message -->
        <div id="no-results-msg" class="hidden text-center py-16 space-y-3">
            <p class="font-serif-luxury text-2xl text-[#27221e] font-bold">Venue tidak ditemukan</p>
            <p class="text-xs text-[#8d8277]">Silakan coba kata kunci lain atau hapus filter pencarian.</p>
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

    <!-- ==================== AUTH GUARD MODAL ==================== -->
    <div id="auth-guard-modal"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300 ease-out"
         aria-modal="true" role="dialog" aria-label="Login diperlukan">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeAuthModal()"></div>
        <div class="relative z-10 bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center transform scale-90 transition-transform duration-300 ease-out" id="auth-modal-card">
            <div class="flex justify-center mb-5">
                <div class="relative">
                    <div class="absolute inset-0 rounded-full bg-[#5b4b38]/10 animate-ping"></div>
                    <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="relative w-14 h-14 object-contain">
                </div>
            </div>
            <h3 class="font-serif-luxury text-2xl font-bold text-[#27221e] mb-2 tracking-tight">
                Login Diperlukan
            </h3>
            <p class="text-sm text-[#786e66] leading-relaxed mb-7">
                Silakan login terlebih dahulu untuk melanjutkan pemesanan venue ini.
            </p>
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
        </div>
    </div>

    <!-- Interactive Search and Modal Scripts -->
    <script>
        // Real-time client-side live filter for venues
        const searchInput = document.getElementById('venue-search-input');
        const clearBtn = document.getElementById('clear-search-btn');
        const venueCards = document.querySelectorAll('.venue-card');
        const noResultsMsg = document.getElementById('no-results-msg');

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                let visibleCount = 0;

                if (query.length > 0) {
                    clearBtn.classList.remove('hidden');
                } else {
                    clearBtn.classList.add('hidden');
                }

                venueCards.forEach(card => {
                    const name = card.getAttribute('data-name') || '';
                    const location = card.getAttribute('data-location') || '';
                    if (name.includes(query) || location.includes(query)) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                if (visibleCount === 0) {
                    noResultsMsg.classList.remove('hidden');
                } else {
                    noResultsMsg.classList.add('hidden');
                }
            });

            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    searchInput.value = '';
                    clearBtn.classList.add('hidden');
                    venueCards.forEach(card => card.classList.remove('hidden'));
                    noResultsMsg.classList.add('hidden');
                    searchInput.focus();
                });
            }
        }

        // Drawer Menu Scripts
        const drawerToggle = document.getElementById('drawer-toggle-btn');
        const drawerMenu = document.getElementById('drawer-menu');
        const drawerBackdrop = document.getElementById('drawer-backdrop');
        const drawerClose = document.getElementById('drawer-close-btn');

        function openDrawer() {
            if (drawerMenu && drawerBackdrop) {
                drawerMenu.classList.remove('is-closed');
                drawerBackdrop.classList.remove('is-hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeDrawer() {
            if (drawerMenu && drawerBackdrop) {
                drawerMenu.classList.add('is-closed');
                drawerBackdrop.classList.add('is-hidden');
                document.body.style.overflow = '';
            }
        }

        if (drawerToggle) drawerToggle.addEventListener('click', openDrawer);
        if (drawerClose) drawerClose.addEventListener('click', closeDrawer);
        if (drawerBackdrop) drawerBackdrop.addEventListener('click', closeDrawer);

        // Auth guard modal
        function requireLoginToBook(bookingUrl) {
            const modal = document.getElementById('auth-guard-modal');
            const card = document.getElementById('auth-modal-card');
            const loginBtn = document.getElementById('auth-modal-login-btn');
            if (loginBtn && bookingUrl) {
                loginBtn.href = '{{ route("login") }}?from=' + encodeURIComponent(bookingUrl);
            }
            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100');
            card.classList.remove('scale-90');
            card.classList.add('scale-100');
            document.body.style.overflow = 'hidden';
        }

        function closeAuthModal() {
            const modal = document.getElementById('auth-guard-modal');
            const card = document.getElementById('auth-modal-card');
            modal.classList.add('opacity-0', 'pointer-events-none');
            modal.classList.remove('opacity-100');
            card.classList.add('scale-90');
            card.classList.remove('scale-100');
            document.body.style.overflow = '';
        }
    </script>

    @include('partials.customer-chat')

</body>
</html>
