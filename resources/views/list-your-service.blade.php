<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List Your Service — DreamDay Studio</title>
    <meta name="description" content="Expand your reach with DreamDay Studio. Choose how you want to list your services and connect with clients looking for excellence.">

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
            <!-- Left Side: Back to Home + Brand -->
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="p-2 rounded-lg text-[#685f58] hover:text-[#27221e] hover:bg-[#f5f0ea] transition flex items-center gap-2 text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Beranda</span>
                </a>
                <div class="h-5 w-px bg-[#e8e2d9] hidden sm:block"></div>
                <a href="{{ route('home') }}" class="font-serif-luxury text-2xl font-bold tracking-tight text-[#27221e] hover:text-[#5b4b38] transition-colors">
                    DreamDay Studio
                </a>
            </div>

            <!-- Right Side: Log In or Profile Avatar -->
            <div>
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
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[#27221e] hover:text-[#5b4b38] transition-colors px-3 py-1.5 rounded-lg hover:bg-[#f5f0ea]">
                        Log In
                    </a>
                @endif
            </div>
        </div>
    </header>

    <!-- ==================== MAIN CONTENT SECTION ==================== -->
    <main class="flex-1 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 w-full">
        <!-- Page Title & Subtitle -->
        <div class="text-center max-w-2xl mx-auto space-y-4">
            <h1 class="font-serif-luxury text-3xl sm:text-4xl md:text-5xl font-bold text-[#27221e] tracking-tight leading-tight">
                Expand Your reach with DreamDay Studio
            </h1>
            <p class="text-sm sm:text-base text-[#685f58] leading-relaxed">
                Choose how you want to list your services and connect with clients looking for excellence.
            </p>
        </div>

        <!-- 2 Selection Cards Grid -->
        <div class="mt-14 grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10 items-stretch">
            
            <!-- Card 1: Full Event Package -->
            <div class="bg-white border border-[#e8e2d9] rounded-2xl p-8 sm:p-10 shadow-sm hover:shadow-xl hover:border-[#cfc4b6] transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <!-- Badge Icon (Star in Circle) -->
                    <div class="w-12 h-12 rounded-full border-2 border-[#5b4b38] text-[#5b4b38] flex items-center justify-center bg-[#faf8f5] group-hover:bg-[#5b4b38] group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>

                    <!-- Title & Sub-tag -->
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-6 tracking-tight">
                        Full Event Package
                    </h2>
                    <p class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277] mt-1">
                        (PAKET FULL ACARA)
                    </p>

                    <!-- Description -->
                    <p class="mt-6 text-xs sm:text-sm text-[#685f58] leading-relaxed">
                        Offer a complete event experience. Ideal for event planners, full-service venues, or bundled vendor packages looking to provide an all-inclusive solution for clients.
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="mt-10">
                    <a href="{{ route('full-event-packages') }}" class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-[#eeeae3] hover:bg-[#e2dcd4] text-[#27221e] font-semibold text-sm transition duration-200 group-hover:shadow-sm">
                        <span>Get Started</span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>

            <!-- Card 2: Single Service -->
            <div class="bg-white border border-[#e8e2d9] rounded-2xl p-8 sm:p-10 shadow-sm hover:shadow-xl hover:border-[#cfc4b6] transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <!-- Badge Icon (Service / Document Badge) -->
                    <div class="w-12 h-12 rounded-full border-2 border-[#5b4b38] text-[#5b4b38] flex items-center justify-center bg-[#faf8f5] group-hover:bg-[#5b4b38] group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>

                    <!-- Title & Sub-tag -->
                    <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] mt-6 tracking-tight">
                        Single Service
                    </h2>
                    <p class="text-[0.7rem] font-bold uppercase tracking-wider text-[#8d8277] mt-1">
                        (JASA SATUAN)
                    </p>

                    <!-- Description -->
                    <p class="mt-6 text-xs sm:text-sm text-[#685f58] leading-relaxed">
                        List your individual expertise. Perfect for MUAs, photographers, videographers, decorators, or specific venue spaces looking to showcase specialized skills.
                    </p>
                </div>

                <!-- CTA Button -->
                <div class="mt-10">
                    <a href="{{ route('single-services') }}" class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl bg-[#eeeae3] hover:bg-[#e2dcd4] text-[#27221e] font-semibold text-sm transition duration-200 group-hover:shadow-sm">
                        <span>Get Started</span>
                        <span class="transition-transform duration-200 group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>

        </div>
    </main>



    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <!-- Brand Logo Center -->
            <div>
                <a href="{{ route('home') }}" class="font-serif-luxury text-3xl sm:text-4xl font-bold tracking-tight text-[#6b513a] hover:text-[#523d2b] transition-colors">
                    DreamDay Studio
                </a>
            </div>

            <!-- Horizontal Nav Links -->
            <nav class="flex flex-wrap items-center justify-center gap-6 sm:gap-8 text-xs sm:text-sm text-[#554d46] font-medium pt-2">
                <a href="{{ route('home') }}#about" class="hover:text-[#27221e] transition-colors">About Us</a>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Support</a>
                <a href="{{ route('list-service') }}" class="hover:text-[#27221e] transition-colors font-semibold text-[#5b4b38]">Vendor Portal</a>
            </nav>

            <!-- Copyright -->
            <p class="text-xs text-[#8d8277] pt-4">
                © 2026 DreamDay Studio. Curating Timeless Celebrations.
            </p>
        </div>
    </footer>

</body>
</html>
