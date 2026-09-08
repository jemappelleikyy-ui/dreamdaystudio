<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login — DreamDay Studio</title>
    <meta name="description" content="Sign in to DreamDay Studio admin dashboard.">
    <meta name="robots" content="noindex, nofollow">

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

    <!-- ==================== TOP BRAND HEADER ==================== -->
    <header class="w-full py-6 sm:py-8 flex items-center justify-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group transition-transform hover:scale-[1.02]">
            <img src="{{ asset('images/logo.png') }}" alt="DreamDay Studio" class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110">
            <span class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#6b513a] group-hover:text-[#523d2b] transition-colors">
                DreamDay Studio
            </span>
        </a>
    </header>

    <!-- ==================== MAIN CONTENT SECTION ==================== -->
    <main class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 py-6 sm:py-10 w-full">
        
        <!-- Error Notice Banner -->
        @if(session('error_message'))
        <div class="w-full max-w-md mb-6 animate-fadeIn" id="error-notice-banner">
            <div class="flex items-start gap-3 bg-[#fdf2f2] border border-[#f8b4b4] rounded-xl p-4 shadow-xs">
                <svg class="w-5 h-5 text-[#b93838] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                <div class="space-y-1">
                    <p class="text-xs sm:text-sm text-[#9f2626] font-semibold leading-snug">
                        {{ session('error_message') }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        @if(session('auth_notice'))
        <!-- Auth Redirect Notice Banner -->
        <div class="w-full max-w-md mb-6 animate-fadeIn" id="auth-notice-banner">
            <div class="flex items-start gap-3 bg-[#fef9f0] border border-[#e6c97a] rounded-xl px-4 py-3.5 shadow-xs">
                <svg class="w-5 h-5 text-[#b8892a] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs sm:text-sm text-[#7a5a1e] font-medium leading-relaxed">
                    {{ session('auth_notice') }}
                </p>
            </div>
        </div>
        @endif

        @if(session('success_message'))
        <!-- Success Notice Banner -->
        <div class="w-full max-w-md mb-6 animate-fadeIn" id="success-notice-banner">
            <div class="flex items-start gap-3 bg-[#f0f9f0] border border-[#c8e6c9] rounded-xl px-4 py-3.5 shadow-xs">
                <svg class="w-5 h-5 text-[#2e7d32] mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                <p class="text-xs sm:text-sm text-[#2e7d32] font-medium leading-relaxed">
                    {{ session('success_message') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Welcome Heading -->
        <div class="text-center space-y-2 mb-8 sm:mb-10 max-w-md mx-auto">
            <h1 class="font-serif-luxury text-3xl sm:text-4xl font-bold text-[#27221e] tracking-tight">
                Admin Portal Login
            </h1>
            <p class="text-xs sm:text-sm text-[#685f58]">
                Sign in to manage DreamDay Studio services and bookings.
            </p>
        </div>

        <!-- Login Card -->
        <div class="w-full max-w-md bg-white rounded-2xl border border-[#ede7df] shadow-xl p-6 sm:p-10 transition-all">
            
            <!-- Login Form -->
            <form id="admin-login-form" action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Address Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-[0.7rem] font-bold uppercase tracking-wider text-[#685f58]">
                        ADMIN EMAIL ADDRESS
                    </label>
                    <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                        <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', 'admindreamday@gmail.com') }}"
                                placeholder="admindreamday@gmail.com" 
                                required
                                class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-[0.7rem] font-bold uppercase tracking-wider text-[#685f58]">
                            PASSWORD
                        </label>
                        <a href="#forgot-password" class="text-xs text-[#8d8277] hover:text-[#6b513a] transition-colors">
                            Forgot Password?
                        </a>
                    </div>
                    <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                        <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Enter admin password" 
                                required
                                class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                        
                        <!-- Toggle Password Visibility -->
                        <button type="button" 
                                id="toggle-password-btn" 
                                onclick="togglePasswordVisibility()"
                                class="text-[#8d8277] hover:text-[#27221e] transition-colors p-1 cursor-pointer"
                                aria-label="Lihat password">
                            <!-- Eye Closed Icon (Default) -->
                            <svg id="eye-closed-icon" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                            <!-- Eye Open Icon (Hidden initially) -->
                            <svg id="eye-open-icon" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-sm shadow-sm hover:shadow transition duration-200 cursor-pointer">
                    Sign In as Admin
                </button>

                <!-- Back Link -->
                <div class="text-center pt-2">
                    <p class="text-xs text-[#685f58]">
                        Bukan administrator? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#6b513a] hover:underline">Login sebagai Pengguna</a>
                    </p>
                </div>
            </form>

        </div>
    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-6 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-[#685f58]">
            
            <!-- Left: Brand Logo -->
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-7 w-auto object-contain">
                    <span class="font-serif-luxury text-xl font-bold tracking-tight text-[#6b513a] group-hover:text-[#523d2b] transition-colors">DreamDay Studio</span>
                </a>
            </div>

            <!-- Center: Links -->
            <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6 text-xs text-[#554d46]">
                <a href="{{ route('home') }}#privacy" class="hover:text-[#27221e] transition-colors">Privacy Policy</a>
                <span class="text-[#cfc5ba]">•</span>
                <a href="{{ route('home') }}#terms" class="hover:text-[#27221e] transition-colors">Terms of Service</a>
                <span class="text-[#cfc5ba]">•</span>
                <a href="{{ route('home') }}#contact" class="hover:text-[#27221e] transition-colors">Contact Us</a>
                <span class="text-[#cfc5ba]">•</span>
                <a href="{{ route('home') }}#about" class="hover:text-[#27221e] transition-colors">About</a>
            </div>

            <!-- Right: Copyright -->
            <div class="text-[#8d8277]">
                © 2026 DreamDay Studio. All rights reserved.
            </div>

        </div>
    </footer>

    <!-- Interactive Scripts for Password Toggle -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeClosed = document.getElementById('eye-closed-icon');
            const eyeOpen = document.getElementById('eye-open-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeClosed.classList.remove('hidden');
                eyeOpen.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
