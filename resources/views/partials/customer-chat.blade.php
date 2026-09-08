<!-- ==================== DEDICATED CHAT BUTTON (NO FLOATING POPUP) ==================== -->
<div id="customer-chat-widget" class="fixed bottom-6 right-6 z-50">
    <!-- Direct link to dedicated Chat Page -->
    <a href="{{ route('chat') }}" 
       id="chat-toggle-btn"
       class="group relative flex items-center gap-2.5 bg-[#5b4b38] hover:bg-[#483b2c] text-white px-4 py-3 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-105 cursor-pointer">
        <span class="relative flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
            </svg>
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-emerald-400 border-2 border-[#5b4b38] rounded-full animate-ping"></span>
        </span>
        <span class="font-semibold text-xs sm:text-sm tracking-wide hidden md:inline">
            Chat Admin
        </span>
    </a>
</div>
