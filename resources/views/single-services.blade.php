<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Curate Your Experience — DreamDay Studio</title>
    <meta name="description" content="Select a focal point for your celebration to begin designing your bespoke journey.">

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
<body class="bg-[#ffffff] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">

    <!-- ==================== HEADER BAR (Identik dengan Full Event Packages) ==================== -->
    <header class="w-full bg-white border-b border-[#f0ebe4]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Left Side: Back Button & Brand Logo -->
            <div class="flex items-center gap-4">
                <a href="{{ route('list-service') }}" class="p-2 rounded-lg text-[#685f58] hover:text-[#27221e] hover:bg-[#f5f0ea] transition flex items-center gap-2 text-sm font-medium group cursor-pointer" title="Kembali ke List Your Service">
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
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 w-full space-y-12 sm:space-y-16">
        
        <!-- Page Title & Subtitle -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <h1 class="font-serif-luxury text-3xl sm:text-4xl md:text-5xl font-bold text-[#6b513a] tracking-tight leading-tight">
                Curate Your Experience
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#685f58] leading-relaxed">
                Select a focal point for your celebration to begin designing your bespoke journey.
            </p>
        </div>

        <!-- 3 Prominent Category Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 lg:gap-10">
            
            <!-- Card 1: Venues -->
            <a href="{{ route('service.detail', ['slug' => 'the-glasshouse-ballroom']) }}" 
               class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 aspect-[3/4] flex flex-col justify-end p-6 sm:p-8 border border-[#e8e2d9]/60 cursor-pointer block">
                <!-- Background Image -->
                <img src="{{ asset('images/service-venue.jpg') }}" 
                     alt="Venues" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                     loading="lazy">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent transition-opacity duration-300 group-hover:opacity-90"></div>

                <!-- Text Overlay Content -->
                <div class="relative z-10 space-y-1.5 transform transition-transform duration-300 group-hover:-translate-y-1">
                    <span class="text-[0.7rem] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#d4af7a] block">
                        LOCATION
                    </span>
                    <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-white tracking-wide leading-tight">
                        Venues
                    </h2>
                    <p class="text-xs text-[#d8d0c5] opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-20 transition-all duration-300 overflow-hidden pt-1">
                        Grand ballrooms, beachfront estates & cliffside private villas.
                    </p>
                </div>
            </a>

            <!-- Card 2: Documentation -->
            <a href="{{ route('documentation.index') }}" 
               class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 aspect-[3/4] flex flex-col justify-end p-6 sm:p-8 border border-[#e8e2d9]/60 cursor-pointer block">
                <!-- Background Image -->
                <img src="{{ asset('images/service-documentation.jpg') }}" 
                     alt="Documentation" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                     loading="lazy">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent transition-opacity duration-300 group-hover:opacity-90"></div>

                <!-- Text Overlay Content -->
                <div class="relative z-10 space-y-1.5 transform transition-transform duration-300 group-hover:-translate-y-1">
                    <span class="text-[0.7rem] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#d4af7a] block">
                        MEMORY
                    </span>
                    <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-white tracking-wide leading-tight">
                        Documentation
                    </h2>
                    <p class="text-xs text-[#d8d0c5] opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-20 transition-all duration-300 overflow-hidden pt-1">
                        Cinematic wedding films, fine art photography & editorial keepsakes.
                    </p>
                </div>
            </a>

            <!-- Card 3: MUA -->
            <a href="{{ route('mua.index') }}" 
               class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 aspect-[3/4] flex flex-col justify-end p-6 sm:p-8 border border-[#e8e2d9]/60 cursor-pointer block">
                <!-- Background Image -->
                <img src="{{ asset('images/service-makeup.jpg') }}" 
                     alt="MUA" 
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                     loading="lazy">
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent transition-opacity duration-300 group-hover:opacity-90"></div>

                <!-- Text Overlay Content -->
                <div class="relative z-10 space-y-1.5 transform transition-transform duration-300 group-hover:-translate-y-1">
                    <span class="text-[0.7rem] sm:text-xs font-bold uppercase tracking-[0.25em] text-[#d4af7a] block">
                        ARTISTRY
                    </span>
                    <h2 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-white tracking-wide leading-tight">
                        MUA
                    </h2>
                    <p class="text-xs text-[#d8d0c5] opacity-0 max-h-0 group-hover:opacity-100 group-hover:max-h-20 transition-all duration-300 overflow-hidden pt-1">
                        Ethereal luxury bridal makeup, hair styling & international master artists.
                    </p>
                </div>
            </a>

        </div>

        <!-- Additional Secondary Services Row (Dynamic Categories / Specializations from Admin) -->
        <div class="pt-6 sm:pt-10 border-t border-[#f0ebe4]">
            <div class="text-center mb-8">
                <span class="text-[0.7rem] font-bold uppercase tracking-widest text-[#8d8277] bg-[#faf8f5] px-4 py-1.5 rounded-full border border-[#ede7df]">
                    EXPLORE MORE SPECIALIZATIONS
                </span>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($categories) && count($categories) > 0)
                    @foreach($categories as $cat)
                        @php
                            $catSlug = strtolower($cat->slug ?? Str::slug($cat->name));
                            $catImage = '/' . ltrim($cat->image ?: 'images/service-venue.jpg', '/');
                            
                            $catLink = route('home') . '?category=' . urlencode($cat->name);
                            if ($catSlug === 'venues') {
                                $catLink = route('venues.index');
                            } elseif ($catSlug === 'documentation') {
                                $catLink = route('documentation.index');
                            } elseif ($catSlug === 'mua') {
                                $catLink = route('mua.index');
                            }
                        @endphp
                        <a href="{{ $catLink }}" class="flex items-center gap-5 p-5 rounded-2xl bg-[#faf8f5] hover:bg-[#f3eee7] border border-[#ede7df] hover:border-[#cfc4b6] transition-all duration-300 group shadow-2xs hover:shadow-md">
                            <img src="{{ asset($catImage) }}" 
                                 onerror="this.src='{{ asset('images/service-venue.jpg') }}'"
                                 alt="{{ $cat->name }}" 
                                 class="w-20 h-20 rounded-xl object-cover shadow-xs group-hover:scale-105 transition-transform shrink-0">
                            <div class="space-y-1 min-w-0 flex-1">

                                <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#6b513a] block">
                                    {{ $cat->name }}
                                </span>
                                <h3 class="font-serif-luxury text-lg font-bold text-[#27221e] group-hover:text-[#6b513a] transition-colors truncate">
                                    {{ $cat->name }}
                                </h3>
                                <p class="text-xs text-[#8d8277] line-clamp-2 leading-relaxed">
                                    {{ $cat->description ?: 'Layanan spesialisasi ' . $cat->name . ' terbaik untuk pernikahan impian Anda.' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <!-- Fallback default static items if no categories in DB -->
                    <a href="{{ route('service.detail', ['slug' => 'artisan-confections']) }}" class="flex items-center gap-5 p-5 rounded-2xl bg-[#faf8f5] hover:bg-[#f3eee7] border border-[#ede7df] transition-all duration-300 group">
                        <img src="{{ asset('images/booking-cake.jpg') }}" alt="Artisan Cake" class="w-20 h-20 rounded-xl object-cover shadow-xs group-hover:scale-105 transition-transform">
                        <div class="space-y-1 min-w-0">
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#6b513a]">CATERING &amp; CAKE</span>
                            <h3 class="font-serif-luxury text-lg font-bold text-[#27221e] group-hover:text-[#6b513a] transition-colors truncate">Artisan Confections Custom Cake</h3>
                            <p class="text-xs text-[#8d8277] line-clamp-1">3-Tier luxury handcrafted edible master cake with sugar flowers.</p>
                        </div>
                    </a>

                    <a href="{{ route('service.detail', ['slug' => 'bloom-floral']) }}" class="flex items-center gap-5 p-5 rounded-2xl bg-[#faf8f5] hover:bg-[#f3eee7] border border-[#ede7df] transition-all duration-300 group">
                        <img src="{{ asset('images/booking-floral.jpg') }}" alt="Bloom & Floral" class="w-20 h-20 rounded-xl object-cover shadow-xs group-hover:scale-105 transition-transform">
                        <div class="space-y-1 min-w-0">
                            <span class="text-[0.65rem] font-bold uppercase tracking-wider text-[#6b513a]">DECORATION &amp; FLORAL</span>
                            <h3 class="font-serif-luxury text-lg font-bold text-[#27221e] group-hover:text-[#6b513a] transition-colors truncate">Bloom &amp; Ethereal Floral</h3>
                            <p class="text-xs text-[#8d8277] line-clamp-1">Fresh imported floral bouquets, grand backdrops and VIP centerpieces.</p>
                        </div>
                    </a>
                @endif
            </div>
        </div>


    </main>

    <!-- ==================== FOOTER (Identik dengan Full Event Packages) ==================== -->
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

</body>
</html>
