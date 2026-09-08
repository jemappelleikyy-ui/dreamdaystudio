<!-- ==================== LUXURY PRELOADER WITH DREAMDAY LOGO ==================== -->
<div id="dreamday-preloader" 
     class="fixed inset-0 z-50 bg-[#f9f8f6] flex flex-col items-center justify-center transition-all duration-700 ease-out">
    
    <div class="relative flex flex-col items-center gap-6">
        
        <!-- Glowing Pulse Rings Behind Logo -->
        <div class="relative flex items-center justify-center">
            <!-- Outer Ripple Glow -->
            <div class="absolute w-28 h-28 sm:w-32 sm:h-32 rounded-full bg-[#5b4b38]/10 animate-ping duration-1000"></div>
            <!-- Inner Soft Aura -->
            <div class="absolute w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-[#ede7df]/80 animate-pulse"></div>

            <!-- Emblem Logo with Smooth Breathing Animation -->
            <div class="relative z-10 w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center animate-bounce-subtle">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="DreamDay Studio Emblem" 
                     class="w-full h-full object-contain filter drop-shadow-md select-none transform hover:scale-105 transition-transform">
            </div>
        </div>

        <!-- Typography & Loading Indicator -->
        <div class="text-center space-y-2">
            <h2 class="font-serif-luxury text-2xl sm:text-3xl font-bold tracking-tight text-[#27221e]">
                DreamDay Studio
            </h2>
            <p class="text-xs sm:text-sm font-medium text-[#8d8277] tracking-widest uppercase animate-pulse">
                Curating Timeless Moments
            </p>
        </div>

        <!-- Minimal Luxury Loading Progress Bar -->
        <div class="w-44 h-1 bg-[#ede7df] rounded-full overflow-hidden mt-1">
            <div id="preloader-bar" class="h-full bg-[#5b4b38] rounded-full transition-all duration-700 ease-out w-0"></div>
        </div>

    </div>

</div>

<style>
    @keyframes bounceSubtle {
        0%, 100% {
            transform: translateY(0) scale(1);
        }
        50% {
            transform: translateY(-6px) scale(1.04);
        }
    }
    .animate-bounce-subtle {
        animation: bounceSubtle 1.8s ease-in-out infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const preloader = document.getElementById('dreamday-preloader');
        const progressBar = document.getElementById('preloader-bar');

        if (progressBar) {
            setTimeout(() => {
                progressBar.style.width = '100%';
            }, 100);
        }

        const hidePreloader = () => {
            if (!preloader) return;
            preloader.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 750);
        };

        // If page already loaded or after short luxurious transition
        if (document.readyState === 'complete') {
            setTimeout(hidePreloader, 650);
        } else {
            window.addEventListener('load', () => {
                setTimeout(hidePreloader, 650);
            });
            // Safety timeout
            setTimeout(hidePreloader, 2000);
        }
    });
</script>
