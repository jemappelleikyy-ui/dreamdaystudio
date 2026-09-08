<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up — DreamDay Studio</title>
    <meta name="description" content="Create your DreamDay Studio account to curate your extraordinary event.">

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

    <!-- ==================== TOP BRAND HEADER ==================== -->
    <header class="w-full py-6 sm:py-8 flex items-center justify-center">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 group transition-transform hover:scale-[1.02]">
            <!-- Sparkle Icon -->
            <svg class="w-5 h-5 text-[#6b513a]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 0l3.09 8.26L24 12l-8.91 3.74L12 24l-3.09-8.26L0 12l8.91-3.74L12 0z"/>
            </svg>
            <span class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#6b513a] group-hover:text-[#523d2b] transition-colors">
                DreamDay Studio
            </span>
        </a>
    </header>

    <!-- ==================== MAIN CONTENT SECTION ==================== -->
    <main class="flex-1 flex flex-col items-center justify-center px-4 sm:px-6 py-6 sm:py-10 w-full">

        <!-- Sign Up Card Container -->
        <div class="w-full max-w-md bg-white rounded-2xl border border-[#ede7df] shadow-xl p-6 sm:p-10 transition-all">
            
            <!-- Mini Logo Inside Card Top (As in screenshot) -->
            <div class="flex items-center justify-center gap-2 mb-4">
                <svg class="w-4 h-4 text-[#6b513a]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0l3.09 8.26L24 12l-8.91 3.74L12 24l-3.09-8.26L0 12l8.91-3.74L12 0z"/>
                </svg>
                <span class="font-serif-luxury text-xl font-bold text-[#6b513a]">
                    DreamDay Studio
                </span>
            </div>

            <!-- Heading -->
            <h1 class="font-serif-luxury text-2xl sm:text-3xl font-bold text-[#27221e] text-center tracking-tight mb-8">
                Create Your Account
            </h1>

            <!-- Sign Up Form -->
            <form id="signup-form" action="{{ route('signup') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- 1. Full Name -->
                <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                    <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <input type="text" 
                           id="fullname" 
                           name="fullname" 
                           placeholder="Full Name" 
                           required
                           class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                </div>

                <!-- 2. Email Address -->
                <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                    <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ request('email', session('unregistered_email', '')) }}"
                           placeholder="Email Address" 
                           required
                           class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                </div>

                <!-- 3. Password -->
                <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                    <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           placeholder="Password" 
                           required
                           class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                    <button type="button" 
                            onclick="toggleVisibility('password', 'eye-pass-closed', 'eye-pass-open')"
                            class="text-[#8d8277] hover:text-[#27221e] transition-colors p-1 cursor-pointer"
                            aria-label="Lihat password">
                        <svg id="eye-pass-closed" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                        <svg id="eye-pass-open" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <!-- 4. Confirm Password -->
                <div class="flex items-center gap-3 border-b border-[#e2dcd4] focus-within:border-[#6b513a] pb-2 transition-colors">
                    <svg class="w-4 h-4 text-[#8d8277] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Confirm Password" 
                           required
                           class="w-full bg-transparent text-sm text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                    <button type="button" 
                            onclick="toggleVisibility('password_confirmation', 'eye-confirm-closed', 'eye-confirm-open')"
                            class="text-[#8d8277] hover:text-[#27221e] transition-colors p-1 cursor-pointer"
                            aria-label="Lihat konfirmasi password">
                        <svg id="eye-confirm-closed" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                        </svg>
                        <svg id="eye-confirm-open" class="w-4 h-4 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>

                <!-- Sign Up Button -->
                <button type="submit" class="w-full py-3.5 px-4 rounded-xl bg-[#63503a] hover:bg-[#50402e] text-white font-medium text-sm shadow-sm hover:shadow transition duration-200 cursor-pointer mt-4">
                    Sign Up
                </button>

                <!-- Divider: OR CONTINUE WITH -->
                <div class="relative flex py-2 items-center">
                    <div class="flex-grow border-t border-[#ede7df]"></div>
                    <span class="flex-shrink mx-3 text-[0.65rem] font-bold text-[#8d8277] uppercase tracking-wider">OR CONTINUE WITH</span>
                    <div class="flex-grow border-t border-[#ede7df]"></div>
                </div>

                <!-- Social Sign In Options -->
                <div class="grid grid-cols-2 gap-3">
                    <!-- Google Button -->
                    <button type="button" 
                            onclick="openGoogleLoginModal()"
                            class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl border border-[#ede7df] hover:border-[#b0a597] hover:bg-[#faf8f5] transition duration-200 text-xs font-semibold text-[#27221e] cursor-pointer">
                        <svg class="w-4 h-4" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                        </svg>
                        <span>Google</span>
                    </button>

                    <!-- Apple Button -->
                    <button type="button" 
                            onclick="alert('Fitur Apple Sign-In dapat digunakan melalui Google Login')"
                            class="flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl border border-[#ede7df] hover:bg-[#faf8f5] transition duration-200 text-xs font-semibold text-[#27221e] cursor-pointer">
                        <svg class="w-4 h-4 fill-current text-[#27221e]" viewBox="0 0 24 24">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 6.87c.66-.82 1.11-1.96.99-3.1-.96.04-2.12.64-2.8 1.44-.6.69-1.13 1.84-.99 2.96 1.07.08 2.15-.49 2.8-1.3z"/>
                        </svg>
                        <span>Apple</span>
                    </button>
                </div>

                <!-- Already have account Link -->
                <div class="text-center pt-3">
                    <p class="text-xs text-[#685f58]">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="font-semibold text-[#6b513a] hover:underline">Sign In</a>
                    </p>
                </div>
            </form>

        </div>
    </main>

    <!-- ==================== MODAL: GOOGLE ACCOUNT LOGIN SELECTOR ==================== -->
    <div id="modal-google-login" class="fixed inset-0 z-50 bg-black/50 backdrop-blur-xs flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-3xl border border-[#ede7df] shadow-2xl max-w-md w-full p-6 sm:p-8 space-y-5 animate-in fade-in zoom-in duration-200">
            <div class="flex items-center justify-between pb-3 border-b border-[#f2ece5]">
                <div class="flex items-center gap-2.5">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                    </svg>
                    <span class="font-bold text-sm text-[#27221e]">Daftar / Masuk dengan Google</span>
                </div>
                <button type="button" onclick="closeGoogleLoginModal()" class="p-1.5 rounded-lg text-[#8d8277] hover:bg-[#faf8f5] cursor-pointer">✕</button>
            </div>

            <p class="text-xs text-[#685f58]">
                Pilih atau masukkan akun Google Anda. Sistem akan membaca akun dari database atau otomatis mendaftarkannya jika akun baru:
            </p>

            <!-- Quick Google Account List (Reads from DB or custom) -->
            <div class="space-y-2">
                <button type="button" 
                        onclick="submitGoogleLogin('inimahgw5@gmail.com', 'ikkkyyyyyy')"
                        class="w-full flex items-center justify-between p-3 rounded-xl border border-[#ede7df] hover:border-[#5b4b38] hover:bg-[#faf8f5] transition cursor-pointer text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#5b4b38] text-white flex items-center justify-center font-bold text-xs">
                            I
                        </div>
                        <div>
                            <span class="block font-bold text-xs text-[#27221e]">ikkkyyyyyy</span>
                            <span class="block text-[0.7rem] text-[#8d8277]">inimahgw5@gmail.com</span>
                        </div>
                    </div>
                    <span class="text-[0.65rem] font-bold text-[#5b4b38] bg-[#f5f0ea] px-2 py-0.5 rounded">Tersimpan</span>
                </button>

                <button type="button" 
                        onclick="submitGoogleLogin('rizkyalmustamin@gmail.com', 'ikyyy')"
                        class="w-full flex items-center justify-between p-3 rounded-xl border border-[#ede7df] hover:border-[#5b4b38] hover:bg-[#faf8f5] transition cursor-pointer text-left">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-[#8c7457] text-white flex items-center justify-center font-bold text-xs">
                            R
                        </div>
                        <div>
                            <span class="block font-bold text-xs text-[#27221e]">ikyyy</span>
                            <span class="block text-[0.7rem] text-[#8d8277]">rizkyalmustamin@gmail.com</span>
                        </div>
                    </div>
                    <span class="text-[0.65rem] font-bold text-[#5b4b38] bg-[#f5f0ea] px-2 py-0.5 rounded">Tersimpan</span>
                </button>
            </div>

            <!-- Custom / Different Google Account Input -->
            <div class="pt-3 border-t border-[#f2ece5] space-y-3">
                <span class="block text-[0.7rem] font-bold text-[#8d8277] uppercase tracking-wider">Atau Gunakan Akun Google Berbeda:</span>
                <form action="{{ route('auth.google') }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <input type="email" 
                               name="email" 
                               id="google_custom_email_signup" 
                               placeholder="nama.anda@gmail.com" 
                               required
                               class="w-full px-3.5 py-2.5 rounded-xl border border-[#ded5cb] text-xs text-[#27221e] focus:ring-2 focus:ring-[#5b4b38]/20 focus:border-[#5b4b38] outline-none">
                    </div>
                    <button type="submit" class="w-full py-2.5 rounded-xl bg-[#5b4b38] hover:bg-[#483b2c] text-white font-bold text-xs transition duration-200 cursor-pointer shadow-xs">
                        Daftar Otomatis dengan Akun Ini →
                    </button>
                </form>
            </div>

        </div>
    </div>

    <!-- ==================== FOOTER (100% IDENTICAL TO LOGIN PAGE) ==================== -->
    <footer class="w-full bg-[#faf8f5] border-t border-[#ede7df] py-6 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-[#685f58]">
            
            <!-- Left: Brand Logo -->
            <div>
                <a href="{{ route('home') }}" class="font-serif-luxury text-xl font-bold tracking-tight text-[#6b513a] hover:text-[#523d2b] transition-colors">
                    DreamDay Studio
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

    <!-- Interactive Scripts for Password Toggle & Google Auth -->
    <script>
        function toggleVisibility(inputId, closedIconId, openIconId) {
            const input = document.getElementById(inputId);
            const eyeClosed = document.getElementById(closedIconId);
            const eyeOpen = document.getElementById(openIconId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeClosed.classList.add('hidden');
                eyeOpen.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeClosed.classList.remove('hidden');
                eyeOpen.classList.add('hidden');
            }
        }

        function openGoogleLoginModal() {
            const modal = document.getElementById('modal-google-login');
            if (modal) modal.classList.remove('hidden');
        }

        function closeGoogleLoginModal() {
            const modal = document.getElementById('modal-google-login');
            if (modal) modal.classList.add('hidden');
        }

        function submitGoogleLogin(email, name) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('auth.google') }}";

            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = "{{ csrf_token() }}";
            form.appendChild(csrf);

            const emailInput = document.createElement('input');
            emailInput.type = 'hidden';
            emailInput.name = 'email';
            emailInput.value = email;
            form.appendChild(emailInput);

            const nameInput = document.createElement('input');
            nameInput.type = 'hidden';
            nameInput.name = 'name';
            nameInput.value = name;
            form.appendChild(nameInput);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
