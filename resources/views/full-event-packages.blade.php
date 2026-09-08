<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Curated Event Packages — DreamDay Studio</title>
    <meta name="description" content="Discover our meticulously crafted packages, designed to transform your vision into an unforgettable reality.">

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

    <!-- ==================== HEADER BAR ==================== -->
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
    <main class="flex-1 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 w-full space-y-20">
        
        <!-- Page Title & Subtitle -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <h1 class="font-serif-luxury text-3xl sm:text-4xl md:text-5xl font-bold text-[#27221e] tracking-tight leading-tight">
                Curated Event Packages
            </h1>
            <p class="text-xs sm:text-sm md:text-base text-[#685f58] leading-relaxed">
                Discover our meticulously crafted packages, designed to transform your vision into an unforgettable reality. From intimate gatherings to grand celebrations, every detail is orchestrated with timeless elegance.
            </p>
        </div>

        <!-- ==================== SECTION 1: FEATURED & POPULAR ==================== -->
        <section class="space-y-8">
            <div class="text-center">
                <span class="text-[0.7rem] font-bold uppercase tracking-widest text-[#8d8277] bg-[#faf8f5] px-4 py-1.5 rounded-full border border-[#ede7df]">
                    FEATURED &amp; POPULAR
                </span>
            </div>

            <!-- 2 Large Feature Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10">
                
                <!-- Card 1: Khayangan Estate -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <!-- Image with Overlay Title -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/package-cliffside.jpg') }}" 
                             alt="Khayangan Estate Wedding Package" 
                             class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500" 
                             loading="lazy">
                        <!-- Top-left Badge -->
                        <span class="absolute top-4 left-4 bg-[#5b4b38]/90 backdrop-blur-xs text-white text-[0.65rem] font-bold uppercase tracking-wider px-3 py-1 rounded-md shadow-xs">
                            FEATURED
                        </span>
                        <!-- Bottom Gradient with Title -->
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-6">
                            <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-white tracking-wide">
                                Khayangan Estate
                            </h2>
                        </div>
                    </div>

                    <!-- Body Content -->
                    <div class="p-6 sm:p-7 space-y-6 flex-1 flex flex-col justify-between">
                        <div class="space-y-4">
                            <p class="italic text-xs sm:text-sm text-[#685f58]">
                                &ldquo;A timeless celebration of grand proportions.&rdquo;
                            </p>
                            
                            <div>
                                <h3 class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8d8277] mb-3">
                                    KEY INCLUSIONS
                                </h3>
                                <div class="grid grid-cols-2 gap-3 text-xs text-[#443d37]">
                                    <div class="flex items-center gap-2">
                                        <span>🏛️</span>
                                        <span>Cliffside Venue</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>🍽️</span>
                                        <span>Premium Catering</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>💐</span>
                                        <span>Grand Decor</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>📸</span>
                                        <span>Full Documentation</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('service.detail', ['slug' => 'khayangan-estate']) }}" class="w-full py-3.5 px-4 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs sm:text-sm text-center block transition duration-200 cursor-pointer shadow-xs">
                            Start Booking
                        </a>
                    </div>
                </div>

                <!-- Card 2: The St. Regis Jakarta -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    <!-- Image with Overlay Title -->
                    <div class="relative aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/hero-ballroom.jpg') }}" 
                             alt="The St. Regis Jakarta Wedding Package" 
                             class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500" 
                             loading="lazy">
                        <!-- Top-left Badge -->
                        <span class="absolute top-4 left-4 bg-[#5b4b38]/90 backdrop-blur-xs text-white text-[0.65rem] font-bold uppercase tracking-wider px-3 py-1 rounded-md shadow-xs">
                            POPULAR
                        </span>
                        <!-- Bottom Gradient with Title -->
                        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-6">
                            <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-white tracking-wide">
                                The St. Regis Jakarta
                            </h2>
                        </div>
                    </div>

                    <!-- Body Content -->
                    <div class="p-6 sm:p-7 space-y-6 flex-1 flex flex-col justify-between">
                        <div class="space-y-4">
                            <p class="italic text-xs sm:text-sm text-[#685f58]">
                                &ldquo;Dramatic, stately and undeniably chic.&rdquo;
                            </p>
                            
                            <div>
                                <h3 class="text-[0.65rem] font-bold uppercase tracking-wider text-[#8d8277] mb-3">
                                    KEY INCLUSIONS
                                </h3>
                                <div class="grid grid-cols-2 gap-3 text-xs text-[#443d37]">
                                    <div class="flex items-center gap-2">
                                        <span>🏛️</span>
                                        <span>Luxury Ballroom</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>🍽️</span>
                                        <span>Fine Dining 5-Star</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>💡</span>
                                        <span>Ambient Lighting</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>🎵</span>
                                        <span>Live Entertainment Setup</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <a href="{{ route('service.detail', ['slug' => 'the-glasshouse-ballroom']) }}" class="w-full py-3.5 px-4 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs sm:text-sm text-center block transition duration-200 cursor-pointer shadow-xs">
                            Start Booking
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ==================== SECTION 2: THE CURATED COLLECTION ==================== -->
        <section class="space-y-12">
            <div class="text-center space-y-2">
                <h2 class="font-serif-luxury text-2xl sm:text-3xl md:text-4xl font-bold text-[#27221e] tracking-tight">
                    The Curated Collection
                </h2>
                <p class="text-xs sm:text-sm text-[#685f58]">
                    Explore more bespoke settings for your perfect day.
                </p>
            </div>

            <!-- 10 Package Cards Grid (3 Columns) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- 1. Ohana Enterprise -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/service-venue.jpg') }}" alt="Ohana Enterprise" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Ohana Enterprise</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                A versatile space blending modern aesthetics with complete amenities.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">VENUE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">CATERING</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">DECOR</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 2. Walkingdrums Venue -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/why-choose-us.jpg') }}" alt="Walkingdrums Venue" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Walkingdrums Venue</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                A rustic haven created for warm, inviting, and joyful atmospheres.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">VENUE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">SOUND SYSTEM</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">PHOTOGRAPHY</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 3. Riviera Avenue Lakeside -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/package-cliffside.jpg') }}" alt="Riviera Avenue Lakeside" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Riviera Avenue Lakeside</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                Tranquil waterside elegance for a romantic, breathless evening.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">OUTDOOR VENUE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">LIGHTING</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">DECOR</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 4. Golden Sense -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/hero-ballroom.jpg') }}" alt="Golden Sense" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Golden Sense</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                A spacious and sophisticated venue designed for memorable and timeless events.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">BALLROOM</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">LIGHTING</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">CATERING</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 5. Vertu Harmoni -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/service-venue.jpg') }}" alt="Vertu Harmoni" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Vertu Harmoni</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                Modern elegance with unparalleled service for a truly seamless experience.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">VENUE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">FULL PACKAGE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">DECOR</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 6. Menara Danareksa -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/why-choose-us.jpg') }}" alt="Menara Danareksa" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Menara Danareksa</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                A grand, expansive setting with breathtaking city views for your special day.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">CITY VIEW</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">LIGHTING</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">LUXURY DINING</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 7. Gran Melia -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/hero-ballroom.jpg') }}" alt="Gran Melia" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Gran Melia</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                Timeless Spanish luxury meets exquisite attention to detail.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">5-STAR HOTEL</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">BALLROOM</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">DECOR</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 8. The Ritz-Carlton -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/package-cliffside.jpg') }}" alt="The Ritz-Carlton" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">The Ritz-Carlton</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                Iconic elegance and flawless execution for a breathtaking wedding.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">5-STAR BALLROOM</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">FULL MUA</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">PHOTOGRAPHY</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 9. Ayana Resort -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/why-choose-us.jpg') }}" alt="Ayana Resort" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Ayana Resort</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                A seaside cliffside setting for an unforgettable destination wedding.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">RESORT VENUE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">CATERING</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">DECOR</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

                <!-- 10. Fairmont Jakarta -->
                <div class="bg-white border border-[#e8e2d9] rounded-2xl overflow-hidden shadow-xs hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                    <div class="aspect-[16/10] overflow-hidden">
                        <img src="{{ asset('images/service-venue.jpg') }}" alt="Fairmont Jakarta" class="w-full h-full object-cover group-hover:scale-104 transition-transform duration-500" loading="lazy">
                    </div>
                    <div class="p-5 space-y-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-serif-luxury text-xl font-bold text-[#27221e]">Fairmont Jakarta</h3>
                            <p class="mt-2 text-xs text-[#685f58] leading-relaxed">
                                Sophisticated luxury blending urban style with classic grace.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-1.5">
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">BALLROOM</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">FULL SERVICE</span>
                                <span class="text-[0.6rem] font-bold uppercase tracking-wider px-2 py-0.5 bg-[#f5f0ea] text-[#6b513a] rounded">ENTERTAINMENT</span>
                            </div>
                        </div>
                        <button type="button" class="w-full py-2.5 px-3 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-xs transition cursor-pointer">
                            Start Booking
                        </button>
                    </div>
                </div>

            </div>
        </section>
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

</body>
</html>
