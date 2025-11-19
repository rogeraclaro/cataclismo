/**
 * Navigation scripts
 */

(function() {
    'use strict';

    // Burger Menu Functionality
    const burgerMenu = document.getElementById('burger-menu');
    const mainNavigation = document.getElementById('main-navigation');
    const menuOverlay = document.getElementById('menu-overlay');
    
    if (burgerMenu && mainNavigation && menuOverlay) {
        // Toggle menu
        burgerMenu.addEventListener('click', function() {
            burgerMenu.classList.toggle('active');
            mainNavigation.classList.toggle('active');
            menuOverlay.classList.toggle('active');
            document.body.style.overflow = mainNavigation.classList.contains('active') ? 'hidden' : '';
        });
        
        // Close menu when clicking overlay
        menuOverlay.addEventListener('click', function() {
            burgerMenu.classList.remove('active');
            mainNavigation.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close menu when clicking a link
        const menuLinks = mainNavigation.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mainNavigation.classList.contains('active')) {
                burgerMenu.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Afegir classe current als enllaços del menú actiu
    const currentLocation = window.location.href;
    const menuItems = document.querySelectorAll('nav a');
    
    menuItems.forEach(item => {
        if (item.href === currentLocation) {
            item.classList.add('current');
        }
    });

    // Smooth scroll per enllaços ancoratge
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Lazy loading per imatges
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img[loading="lazy"]');
        images.forEach(img => {
            if (img.dataset.src) {
                img.src = img.dataset.src;
            }
        });
    }

    // Hide/Show logo and burger menu on scroll
    const siteLogo = document.querySelector('.site-logo');
    const siteHeader = document.querySelector('.site-header-global');
    let lastScrollTop = 0;
    const scrollThreshold = 100; // Píxels abans de començar a amagar

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        // Si estem al top de la pàgina, sempre mostrar
        if (currentScroll < scrollThreshold) {
            if (siteLogo) siteLogo.classList.remove('hide-on-scroll');
            if (siteHeader) siteHeader.classList.remove('hide-on-scroll');
        }
        // Si fem scroll cap avall, amagar
        else if (currentScroll > lastScrollTop) {
            if (siteLogo) siteLogo.classList.add('hide-on-scroll');
            if (siteHeader) siteHeader.classList.add('hide-on-scroll');
        }
        // Si fem scroll cap amunt, mostrar
        else {
            if (siteLogo) siteLogo.classList.remove('hide-on-scroll');
            if (siteHeader) siteHeader.classList.remove('hide-on-scroll');
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    }, { passive: true });

})();
