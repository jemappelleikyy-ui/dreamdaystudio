@if(session('success_message'))
    <div id="login-success-toast" class="fixed top-5 right-5 z-[100] w-[min(22rem,calc(100vw-2rem))] rounded-2xl border border-emerald-200 bg-white p-4 shadow-2xl transition-all duration-300" role="status" aria-live="polite">
        <div class="flex items-start gap-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-700">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-bold text-[#27221e]">Berhasil login</p>
                <p class="mt-1 text-xs leading-relaxed text-[#685f58]">{{ session('success_message') }}</p>
            </div>
            <button type="button" onclick="document.getElementById('login-success-toast')?.remove()" class="text-lg leading-none text-[#8d8277] hover:text-[#27221e]" aria-label="Tutup notifikasi">&times;</button>
        </div>
    </div>
    <script>
        window.setTimeout(function () {
            const toast = document.getElementById('login-success-toast');
            if (toast) {
                toast.classList.add('translate-x-8', 'opacity-0');
                window.setTimeout(() => toast.remove(), 300);
            }
        }, 4500);
    </script>
@endif
