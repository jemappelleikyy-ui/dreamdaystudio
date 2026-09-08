<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat Admin Specialist — DreamDay Studio</title>
    <meta name="description" content="Konsultasi langsung dengan Admin Specialist DreamDay Studio untuk perencanaan pernikahan impian Anda.">

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
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #faf8f5;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #d6ccc2;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a69c92;
        }
    </style>
</head>
<body class="bg-[#faf8f5] text-[#27221e] font-sans-modern antialiased selection:bg-[#5b4b38] selection:text-white min-h-screen flex flex-col justify-between">



    <!-- ==================== MAIN CHAT CONTENT ==================== -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 flex flex-col">
        


        <!-- Chat Main Grid -->
        <div class="bg-white border border-[#ede7df] rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[580px] sm:min-h-[620px] flex-1">
            
            <!-- LEFT PANEL: Admin Info & Specialist Details (4 cols) -->
            <aside class="lg:col-span-4 bg-[#faf8f5] border-r border-[#ede7df] p-6 flex flex-col justify-between gap-6">
                
                <!-- Specialist Card -->
                <div class="space-y-6">
                    <div class="bg-white border border-[#ede7df] rounded-2xl p-5 shadow-xs text-center relative overflow-hidden">
                        <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-[#8c7457] via-[#5b4b38] to-[#3d3225]"></div>
                        
                        <div class="relative inline-block mt-2 mb-3">
                            <img src="{{ asset('images/logo.png') }}" 
                                 alt="Admin Specialist" 
                                 class="w-20 h-20 rounded-2xl object-cover border-2 border-[#5b4b38] shadow-md mx-auto bg-[#faf8f5] p-2">
                            <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-emerald-500 border-2 border-white" title="Online"></span>
                        </div>

                        <h3 class="font-serif-luxury font-bold text-lg text-[#27221e]">
                            DreamDay Specialist Team
                        </h3>
                        <p class="text-xs text-[#8d8277] mt-0.5 font-medium">
                            Official Concierge & Event Planner
                        </p>

                        <div class="mt-4 pt-4 border-t border-[#f2ece5] grid grid-cols-2 gap-2 text-center text-xs">
                            <div class="bg-[#faf8f5] p-2 rounded-xl border border-[#ede7df]">
                                <span class="block text-[0.65rem] text-[#8d8277] font-semibold uppercase">Respon Rata-rata</span>
                                <span class="font-bold text-[#5b4b38]">&lt; 3 Menit</span>
                            </div>
                            <div class="bg-[#faf8f5] p-2 rounded-xl border border-[#ede7df]">
                                <span class="block text-[0.65rem] text-[#8d8277] font-semibold uppercase">Jam Operasional</span>
                                <span class="font-bold text-[#5b4b38]">24 Jam / 7 Hari</span>
                            </div>
                        </div>
                    </div>

                    <!-- User Logged In Info Card -->
                    <div class="bg-white border border-[#ede7df] rounded-xl p-4 space-y-2">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset(session('user_avatar', 'images/default-avatar.svg')) }}" 
                                 alt="User Avatar" 
                                 class="w-10 h-10 rounded-full object-cover border border-[#ede7df]">
                            <div class="min-w-0">
                                <span class="block font-bold text-xs text-[#27221e] truncate">
                                    {{ session('user_name', 'Pengguna') }}
                                </span>
                                <span class="block text-[0.7rem] text-[#8d8277] truncate">
                                    {{ session('user_email', '') }}
                                </span>
                            </div>
                        </div>
                        <p class="text-[0.7rem] text-[#685f58] pt-2 border-t border-[#f2ece5]">
                            🔒 Riwayat percakapan Anda tersimpan aman dan terikat pada akun Anda.
                        </p>
                    </div>

                    <!-- FAQ & Quick Help Hints -->
                    <div class="space-y-2.5">
                        <h4 class="text-xs font-bold uppercase tracking-wider text-[#685f58]">
                            Bantuan Cepat
                        </h4>
                        <button type="button" 
                                onclick="quickSend('Halo Admin, saya ingin menanyakan ketersediaan tanggal paket pernikahan.')"
                                class="w-full text-left text-xs bg-white hover:bg-[#f5f0ea] border border-[#ede7df] text-[#27221e] p-3 rounded-xl transition cursor-pointer">
                            💬 Tanya Ketersediaan Tanggal Paket
                        </button>
                        <button type="button" 
                                onclick="quickSend('Halo Admin, bagaimana prosedur custom dekorasi dan lokasi venue?')"
                                class="w-full text-left text-xs bg-white hover:bg-[#f5f0ea] border border-[#ede7df] text-[#27221e] p-3 rounded-xl transition cursor-pointer">
                            🏰 Tanya Prosedur Custom Venue
                        </button>
                    </div>
                </div>

                <!-- Direct WhatsApp Alternative Button -->
                <div class="pt-4 border-t border-[#ede7df]">
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20DreamDay%20Studio" 
                       target="_blank"
                       class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20ba59] text-white font-semibold text-xs py-3 px-4 rounded-xl shadow-xs transition duration-200">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/>
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>
                </div>

            </aside>

            <!-- RIGHT PANEL: Full Interactive Chat Area (8 cols) -->
            <section class="lg:col-span-8 flex flex-col justify-between bg-white h-full">
                <!-- Chat Window Header -->
                <div class="px-6 py-4 border-b border-[#ede7df] flex items-center justify-between bg-white z-10">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('home') }}" class="p-2 rounded-xl bg-[#faf8f5] hover:bg-[#f5f0ea] border border-[#ede7df] text-[#5b4b38] transition cursor-pointer flex items-center gap-1.5" title="Kembali ke Beranda">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            <span class="hidden sm:inline text-xs font-bold">Kembali ke Beranda</span>
                        </a>
                        <div class="h-6 w-px bg-[#ede7df] hidden sm:block"></div>
                        <div>
                            <h2 class="font-bold text-sm sm:text-base text-[#27221e]">
                                Percakapan Live Support
                            </h2>
                            <p class="text-xs text-[#8d8277]">
                                Riwayat percakapan tersimpan di akun: <span class="font-semibold text-[#5b4b38]">{{ session('user_email') }}</span>
                            </p>
                        </div>
                    </div>

                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">
                        Terhubung
                    </span>
                </div>

                <!-- Messages Container (Scrollable) -->
                <div id="chat-messages-container" 
                     class="flex-1 p-4 sm:p-5 space-y-2.5 overflow-y-auto max-h-[460px] sm:max-h-[500px] bg-[#fcfaf7] custom-scrollbar">

                    
                    <!-- Welcome Initial Banner -->
                    <div class="text-center my-0.5">
                        <span class="inline-block bg-[#f2ece5] text-[#7a6f64] text-[10px] font-medium px-2.5 py-0.5 rounded-md">
                            🔒 Pesan terenkripsi aman • DreamDay Concierge
                        </span>
                    </div>

                    @php
                        $lastDateLabel = null;
                    @endphp

                    @if(!empty($messages) && count($messages) > 0)
                        @foreach($messages as $msg)
                            @php
                                $msgDate = $msg['date_label'] ?? 'Hari Ini';
                            @endphp

                            <!-- Minimal WhatsApp Date Divider Chip -->
                            @if($msgDate !== $lastDateLabel)
                                <div class="flex items-center justify-center my-1.5">
                                    <span class="bg-[#ede7df] text-[#73685e] text-[9.5px] font-medium tracking-normal px-2.5 py-0.5 rounded-md shadow-2xs">
                                        {{ $msgDate }}
                                    </span>
                                </div>
                                @php
                                    $lastDateLabel = $msgDate;
                                @endphp
                            @endif


                            @if(($msg['sender'] ?? 'customer') === 'customer')
                                <!-- Customer Message Bubble (Right) -->
                                <div class="flex justify-end max-w-[82%] sm:max-w-[68%] ml-auto animate-fadeIn">
                                    <div class="bg-[#5b4b38] text-white text-[12.5px] sm:text-[13px] px-3 py-1.5 rounded-2xl rounded-tr-xs shadow-2xs leading-relaxed max-w-full">
                                        <span class="break-words">{{ $msg['message'] }}</span>
                                        <span class="inline-flex items-center gap-0.5 text-[8.5px] text-white/60 float-right ml-2.5 mt-1 select-none shrink-0">
                                            <span>{{ $msg['time'] ?? date('H:i') }}</span>
                                            @if(!empty($msg['is_read']))
                                                <!-- Double Blue Checkmark (Read) -->
                                                <svg class="w-2.5 h-2.5 text-sky-300 inline" viewBox="0 0 16 15" fill="currentColor" title="Dibaca">
                                                    <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.063-.51z"/>
                                                </svg>
                                            @else
                                                <!-- Double Soft Checkmark (Sent) -->
                                                <svg class="w-2.5 h-2.5 text-white/50 inline" viewBox="0 0 16 15" fill="currentColor" title="Terkirim">
                                                    <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.063-.51z"/>
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @else
                                <!-- Admin Message Bubble (Left) -->
                                <div class="flex justify-start max-w-[82%] sm:max-w-[68%] mr-auto animate-fadeIn">
                                    <div class="bg-white border border-[#ede7df] text-[#27221e] text-[12.5px] sm:text-[13px] px-3 py-1.5 rounded-2xl rounded-tl-xs shadow-2xs leading-relaxed max-w-full">
                                        <div class="flex items-center gap-1 mb-0.5">
                                            <span class="font-bold text-[10.5px] text-[#5b4b38]">
                                                {{ $msg['name'] ?? 'Admin DreamDay' }}
                                            </span>
                                            <span class="bg-[#f2ece5] text-[#5b4b38] text-[8.5px] font-bold px-1 rounded">
                                                OFFICIAL
                                            </span>
                                        </div>
                                        <span class="break-words">{{ $msg['message'] }}</span>
                                        <span class="inline-flex items-center text-[8.5px] text-[#9c938a] float-right ml-2.5 mt-1 select-none shrink-0">
                                            <span>{{ $msg['time'] ?? date('H:i') }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <!-- Initial Default Greeting Message from Admin -->
                        <div class="flex items-center justify-center my-1.5">
                            <span class="bg-[#ede7df] text-[#73685e] text-[9.5px] font-medium tracking-normal px-2.5 py-0.5 rounded-md shadow-2xs">
                                Hari Ini
                            </span>
                        </div>
                        <div class="flex justify-start max-w-[82%] sm:max-w-[68%] mr-auto">
                            <div class="bg-white border border-[#ede7df] text-[#27221e] text-[12.5px] sm:text-[13px] px-3 py-1.5 rounded-2xl rounded-tl-xs shadow-2xs leading-relaxed max-w-full">
                                <div class="flex items-center gap-1 mb-0.5">
                                    <span class="font-bold text-[10.5px] text-[#5b4b38]">Admin DreamDay</span>
                                    <span class="bg-[#f2ece5] text-[#5b4b38] text-[8.5px] font-bold px-1 rounded">OFFICIAL</span>
                                </div>
                                <span class="break-words">Selamat datang di DreamDay Studio Live Concierge! 👋 Silakan ketik pertanyaan atau konsultasi Anda mengenai venue, paket pernikahan, maupun konsultasi vendor. Tim kami siap membantu secara pribadi.</span>
                                <span class="inline-flex items-center text-[8.5px] text-[#9c938a] float-right ml-2.5 mt-1 select-none shrink-0">
                                    <span>{{ date('H:i') }}</span>
                                </span>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Instant Chat Input Form (NO LOADING / INSTANT OPTIMISTIC UI) -->
                <div class="p-3 sm:p-4 border-t border-[#ede7df] bg-white">
                    <form id="chat-send-form" onsubmit="handleSendSubmit(event)" class="flex items-center gap-2.5">
                        @csrf
                        <div class="flex-1 flex items-center bg-[#faf8f5] border border-[#ede7df] focus-within:border-[#5b4b38] focus-within:ring-2 focus-within:ring-[#5b4b38]/10 rounded-2xl px-3.5 py-2 transition">
                            <input type="text" 
                                   id="chat-message-input" 
                                   placeholder="Ketik pesan Anda untuk Admin Specialist..." 
                                   autocomplete="off"
                                   required
                                   class="w-full bg-transparent text-xs sm:text-[13px] text-[#27221e] placeholder-[#a69c92] focus:outline-none">
                        </div>

                        <!-- Instant Send Button -->
                        <button type="submit" 
                                id="btn-send-message"
                                class="inline-flex items-center justify-center bg-[#5b4b38] hover:bg-[#483b2c] text-white font-medium p-2.5 sm:px-4 sm:py-2.5 rounded-xl shadow-xs transition duration-200 cursor-pointer shrink-0">
                            <span class="hidden sm:inline text-xs font-bold mr-1">Kirim</span>
                            <svg class="w-3.5 h-3.5 transform rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </form>
                </div>

            </section>

        </div>

    </main>

    <!-- ==================== FOOTER ==================== -->
    <footer class="bg-white border-t border-[#ede7df] mt-12 py-6 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-xs text-[#685f58]">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 w-auto">
                <span class="font-serif-luxury text-base font-bold text-[#6b513a]">DreamDay Studio</span>
            </div>
            <div class="text-[#8d8277]">
                © 2026 DreamDay Studio. Layanan Konsultasi Admin Specialist Terpercaya.
            </div>
        </div>
    </footer>

    <!-- Interactive Script for Instant Chat Updates -->
    <script>
        const container = document.getElementById('chat-messages-container');
        const input = document.getElementById('chat-message-input');
        let currentMessagesList = @json($messages ?? []);

        // Scroll container to bottom
        function scrollToBottom() {
            if (container) {
                container.scrollTop = container.scrollHeight;
            }
        }

        // Scroll to bottom on initial load
        window.addEventListener('load', scrollToBottom);

        function quickSend(text) {
            if (input) {
                input.value = text;
                document.getElementById('chat-send-form').dispatchEvent(new Event('submit'));
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text || '';
            return div.innerHTML;
        }

        function renderFullThread(messages) {
            if (!container) return;
            let html = `
                <div class="text-center my-0.5">
                    <span class="inline-block bg-[#f2ece5] text-[#7a6f64] text-[10px] font-medium px-2.5 py-0.5 rounded-md">
                        🔒 Pesan terenkripsi aman • DreamDay Concierge
                    </span>
                </div>
            `;
            let lastDate = null;

            messages.forEach(msg => {
                const msgDate = msg.date_label || 'Hari Ini';
                if (msgDate !== lastDate) {
                    html += `
                        <div class="flex items-center justify-center my-1.5">
                            <span class="bg-[#ede7df] text-[#73685e] text-[9.5px] font-medium tracking-normal px-2.5 py-0.5 rounded-md shadow-2xs">
                                ${escapeHtml(msgDate)}
                            </span>
                        </div>
                    `;
                    lastDate = msgDate;
                }

                const isCustomer = (msg.sender === 'customer');
                const timeStr = msg.time || '';
                const checkmarkSvg = msg.is_read ? `
                    <svg class="w-2.5 h-2.5 text-sky-300 inline" viewBox="0 0 16 15" fill="currentColor" title="Dibaca">
                        <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.063-.51z"/>
                    </svg>
                ` : `
                    <svg class="w-2.5 h-2.5 text-white/50 inline" viewBox="0 0 16 15" fill="currentColor" title="Terkirim">
                        <path d="M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.879a.32.32 0 0 1-.484.033l-.358-.325a.319.319 0 0 0-.484.032l-.378.483a.418.418 0 0 0 .036.541l1.32 1.266c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.879a.32.32 0 0 1-.484.033L1.891 7.769a.366.366 0 0 0-.515.006l-.423.433a.364.364 0 0 0 .006.514l3.258 3.185c.143.14.361.125.484-.033l6.272-8.048a.366.366 0 0 0-.063-.51z"/>
                    </svg>
                `;

                if (isCustomer) {
                    html += `
                        <div class="flex justify-end max-w-[82%] sm:max-w-[68%] ml-auto animate-fadeIn">
                            <div class="bg-[#5b4b38] text-white text-[12.5px] sm:text-[13px] px-3 py-1.5 rounded-2xl rounded-tr-xs shadow-2xs leading-relaxed max-w-full">
                                <span class="break-words">${escapeHtml(msg.message)}</span>
                                <span class="inline-flex items-center gap-0.5 text-[8.5px] text-white/60 float-right ml-2.5 mt-1 select-none shrink-0">
                                    <span>${escapeHtml(timeStr)}</span>
                                    ${checkmarkSvg}
                                </span>
                            </div>
                        </div>
                    `;
                } else {
                    html += `
                        <div class="flex justify-start max-w-[82%] sm:max-w-[68%] mr-auto animate-fadeIn">
                            <div class="bg-white border border-[#ede7df] text-[#27221e] text-[12.5px] sm:text-[13px] px-3 py-1.5 rounded-2xl rounded-tl-xs shadow-2xs leading-relaxed max-w-full">
                                <div class="flex items-center gap-1 mb-0.5">
                                    <span class="font-bold text-[10.5px] text-[#5b4b38]">${escapeHtml(msg.name || 'Admin DreamDay')}</span>
                                    <span class="bg-[#f2ece5] text-[#5b4b38] text-[8.5px] font-bold px-1 rounded">OFFICIAL</span>
                                </div>
                                <span class="break-words">${escapeHtml(msg.message)}</span>
                                <span class="inline-flex items-center text-[8.5px] text-[#9c938a] float-right ml-2.5 mt-1 select-none shrink-0">
                                    <span>${escapeHtml(timeStr)}</span>
                                </span>
                            </div>
                        </div>
                    `;
                }
            });

            container.innerHTML = html;
            scrollToBottom();
        }

        // INSTANT OPTIMISTIC SUBMIT FUNCTION (WhatsApp Style Minimal Embedded Time & Checkmark)
        function handleSendSubmit(e) {
            e.preventDefault();
            const messageText = input.value.trim();
            if (!messageText) return;

            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const mins = String(now.getMinutes()).padStart(2, '0');
            const timeStr = `${hours}:${mins}`;

            const newMsgObj = {
                sender: 'customer',
                name: "{{ session('user_name', 'Anda') }}",
                message: messageText,
                time: timeStr,
                date_label: 'Hari Ini',
                is_read: false
            };

            currentMessagesList.push(newMsgObj);
            renderFullThread(currentMessagesList);

            
            // Clear input immediately so user can keep typing freely
            input.value = '';

            // Send message payload to server in background via AJAX
            fetch("{{ route('chat.send') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ message: messageText })
            }).catch(err => {
                console.log('Background chat sync error:', err);
            });
        }


        // Periodic Background Sync to pull new messages from Admin
        setInterval(() => {
            fetch("{{ route('chat.sync') }}")
                .then(res => res.json())
                .then(data => {
                    if (data && data.success && data.messages) {
                        if (data.messages.length !== currentMessagesList.length) {
                            currentMessagesList = data.messages;
                            renderFullThread(currentMessagesList);
                        }
                    }
                })
                .catch(err => {});
        }, 3500);
    </script>
</body>
</html>

