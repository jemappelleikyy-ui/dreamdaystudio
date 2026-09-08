import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const drawerToggleBtn = document.getElementById('drawer-toggle-btn');
    const drawerCloseBtn = document.getElementById('drawer-close-btn');
    const drawerBackdrop = document.getElementById('drawer-backdrop');
    const drawerMenu = document.getElementById('drawer-menu');

    function openDrawer() {
        if (!drawerMenu || !drawerBackdrop) return;
        drawerMenu.classList.remove('is-closed');
        drawerMenu.classList.add('is-open');
        drawerMenu.setAttribute('aria-hidden', 'false');
        
        drawerBackdrop.classList.remove('is-hidden');
        drawerBackdrop.classList.add('is-open');
        
        if (drawerToggleBtn) {
            drawerToggleBtn.setAttribute('aria-expanded', 'true');
        }
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawerMenu || !drawerBackdrop) return;
        drawerMenu.classList.remove('is-open');
        drawerMenu.classList.add('is-closed');
        drawerMenu.setAttribute('aria-hidden', 'true');
        
        drawerBackdrop.classList.remove('is-open');
        drawerBackdrop.classList.add('is-hidden');
        
        if (drawerToggleBtn) {
            drawerToggleBtn.setAttribute('aria-expanded', 'false');
        }
        document.body.style.overflow = '';
    }

    function toggleDrawer() {
        if (drawerMenu && drawerMenu.classList.contains('is-open')) {
            closeDrawer();
        } else {
            openDrawer();
        }
    }

    if (drawerToggleBtn) {
        drawerToggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            toggleDrawer();
        });
    }

    if (drawerCloseBtn) {
        drawerCloseBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            closeDrawer();
        });
    }

    if (drawerBackdrop) {
        drawerBackdrop.addEventListener('click', () => {
            closeDrawer();
        });
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && drawerMenu && drawerMenu.classList.contains('is-open')) {
            closeDrawer();
        }
    });

    // Close drawer when clicking any nav link inside the drawer
    const drawerLinks = drawerMenu ? drawerMenu.querySelectorAll('a') : [];
    drawerLinks.forEach(link => {
        link.addEventListener('click', () => {
            closeDrawer();
        });
    });

    // Search bar submit UX feedback
    const searchForm = document.getElementById('hero-search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (typeof window.executeHeroSearch === 'function') {
                window.executeHeroSearch();
            } else {
                const targetSection = document.getElementById('search-results-section') || document.getElementById('layanan-unggulan');
                if (targetSection) {
                    targetSection.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    }
});
