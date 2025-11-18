/**
 * Main JavaScript for Cataclismo Producciones Theme
 * ====================================
 * Includes: Three.js smoke effect, menu functionality, and anime.js animations
 */

// ====================================
// THREE.JS SMOKE EFFECT
// ====================================
var camera, scene, renderer;
var clock, delta;
var smokeParticles = [];

function initThreeJS() {
    var canvasContainer = document.getElementById('canvas-container');
    if (!canvasContainer) {
        console.error('canvas-container not found!');
        return;
    }

    clock = new THREE.Clock();

    renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);

    scene = new THREE.Scene();

    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);

    // Ajustar posició de càmera segons mida de pantalla
    if (window.innerWidth <= 768) {
        camera.position.z = 1450; // Mòbil - més lluny
    } else {
        camera.position.z = 850;  // Desktop
    }

    scene.add(camera);

    // Lighting
    var light = new THREE.DirectionalLight(0xffffff, 0.5);
    light.position.set(-1, 0, 1);
    scene.add(light);

    // Smoke particles - DARK & DRAMATIC
    var smokeTexture = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png');
    var smokeMaterial = new THREE.MeshLambertMaterial({
        color: 0x1a1a1a, // Fum fosc (gris molt fosc, quasi negre)
        map: smokeTexture,
        transparent: true,
        opacity: 0.4 // Opacitat moderada per contrast
    });
    var smokeGeo = new THREE.PlaneGeometry(500, 500);

    for (var p = 0; p < 85; p++) {
        var particle = new THREE.Mesh(smokeGeo, smokeMaterial);
        particle.position.set(
            Math.random() * 500 - 250,
            Math.random() * 500 - 250,
            Math.random() * 1000 - 100
        );
        particle.rotation.z = Math.random() * 360;
        scene.add(particle);
        smokeParticles.push(particle);
    }

    canvasContainer.appendChild(renderer.domElement);
}

function animate() {
    delta = clock.getDelta();
    requestAnimationFrame(animate);
    evolveSmoke();
    render();
}

function evolveSmoke() {
    var sp = smokeParticles.length;
    while (sp--) {
        smokeParticles[sp].rotation.z += (delta * 0.15);
    }
}

function render() {
    renderer.render(scene, camera);
}

// Resize handler
window.addEventListener('resize', function () {
    if (camera && renderer) {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);

        // Ajustar posició de càmera segons nova mida
        if (window.innerWidth <= 768) {
            camera.position.z = 1450; // Mòbil - més lluny
        } else {
            camera.position.z = 850;  // Desktop
        }
    }
});

// ====================================
// BURGER MENU FUNCTIONALITY
// ====================================
function initBurgerMenu() {
    const burgerMenu = document.getElementById('burger-menu');
    const mainNavigation = document.getElementById('main-navigation');
    const menuOverlay = document.getElementById('menu-overlay');

    if (!burgerMenu || !mainNavigation || !menuOverlay) {
        console.error('Menu elements not found');
        return;
    }

    let menuOpen = false;

    // Toggle menu
    burgerMenu.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        menuOpen = !menuOpen;

        if (menuOpen) {
            burgerMenu.classList.add('active');
            mainNavigation.classList.add('active');
            menuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            burgerMenu.classList.remove('active');
            mainNavigation.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Close menu when clicking overlay
    menuOverlay.addEventListener('click', function () {
        burgerMenu.classList.remove('active');
        mainNavigation.classList.remove('active');
        menuOverlay.classList.remove('active');
        document.body.style.overflow = '';
        menuOpen = false;
    });

    // Submenu toggle
    const menuItemsWithChildren = mainNavigation.querySelectorAll('.menu-item-has-children');
    menuItemsWithChildren.forEach(item => {
        const link = item.querySelector('a');
        if (link) {
            link.addEventListener('click', function (e) {
                // SEMPRE prevenir navegació i propagació per items amb fills
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation(); // Evita altres listeners

                const submenu = item.querySelector('.sub-menu');
                if (submenu) {
                    // Només toggle si realment hi ha submenu
                    item.classList.toggle('submenu-open');
                }

                // NO tancar el menú principal
                return false;
            }, true); // Usar capture per executar abans que altres listeners
        }
    });

    // Close menu for submenu links (links DINS del submenu)
    const submenuLinks = mainNavigation.querySelectorAll('.sub-menu a');
    submenuLinks.forEach(link => {
        link.addEventListener('click', function () {
            burgerMenu.classList.remove('active');
            mainNavigation.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
            menuOpen = false;
        });
    });

    // Close menu for direct links (NO items amb fills)
    const allTopLevelItems = mainNavigation.querySelectorAll('#primary-menu > li');
    allTopLevelItems.forEach(item => {
        // NOMÉS afegir event si NO té fills
        if (!item.classList.contains('menu-item-has-children')) {
            const link = item.querySelector('a');
            if (link) {
                link.addEventListener('click', function () {
                    burgerMenu.classList.remove('active');
                    mainNavigation.classList.remove('active');
                    menuOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                    menuOpen = false;
                });
            }
        }
    });

    // Close menu on ESC key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && menuOpen) {
            burgerMenu.classList.remove('active');
            mainNavigation.classList.remove('active');
            menuOverlay.classList.remove('active');
            document.body.style.overflow = '';
            menuOpen = false;
        }
    });
}

// ====================================
// ANIME.JS ANIMATIONS
// ====================================
function initAnimeAnimations() {
    // Esperar que anime estigui disponible
    if (typeof anime === 'undefined') {
        console.error('Anime.js no està carregat');
        return;
    }

    const scrollArrow = document.getElementById('scroll-arrow');
    const sectionsGrid = document.querySelector('.sections-grid');

    if (!scrollArrow) {
        console.error('Scroll arrow no trobat');
        return;
    }

    // 1. ANIMACIÓ DE LA FLETXA: Fade in + bounce continu
    anime({
        targets: scrollArrow,
        opacity: [0, 1],
        translateY: [30, 0],
        duration: 1000,
        easing: 'easeOutQuad',
        delay: 1000,
        complete: function () {
            // Després del fade in, començar el bounce infinit
            anime({
                targets: scrollArrow,
                translateY: [0, 15],
                duration: 800,
                easing: 'easeInOutQuad',
                direction: 'alternate',
                loop: true
            });
        }
    });

    // 2. SMOOTH SCROLL AMB CLICK
    if (sectionsGrid) {
        scrollArrow.addEventListener('click', function () {
            const targetPosition = sectionsGrid.offsetTop;

            anime({
                targets: 'html, body',
                scrollTop: targetPosition,
                duration: 600,
                easing: 'easeInOutQuad'
            });
        });
    }
}

// ====================================
// SECTION CARDS SCROLL ANIMATIONS
// ====================================
function initScrollAnimations() {
    // Esperar que anime estigui disponible
    if (typeof anime === 'undefined') {
        console.error('Anime.js no està carregat per les animacions de scroll');
        return;
    }

    const sectionCards = document.querySelectorAll('.section-card');

    if (!sectionCards.length) return;

    const cardsArray = Array.from(sectionCards);

    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.15 // Trigger when 15% of element is visible
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Get the actual index of this card in the original array
                const cardIndex = cardsArray.indexOf(entry.target);

                // Animar amb anime.js amb delay escalonat
                anime({
                    targets: entry.target,
                    opacity: [0, 1],
                    translateY: [550, 0],
                    duration: 300,
                    easing: 'easeOutQuad',
                    delay: cardIndex * 150
                });

                // Once animated, stop observing
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    sectionCards.forEach(card => {
        observer.observe(card);
    });
}

// ====================================
// RANDOM GLITCH FREEZES
// ====================================
function initRandomGlitchFreezes() {
    const title = document.querySelector('.hero-title');
    if (!title) return;

    // Crear estil dinàmic per als freezes
    const styleEl = document.createElement('style');
    styleEl.id = 'glitch-freeze-style';
    document.head.appendChild(styleEl);

    function createRandomFreeze() {
        // Paràmetres aleatoris
        const startPos = Math.floor(Math.random() * 85); // 0-85%
        const thickness = Math.floor(Math.random() * 24) + 3; // 3-26%
        const endPos = startPos + thickness;
        const duration = Math.random() * 2000 + 300; // 300-2300ms

        // Aplicar freeze al ::before i ::after
        const freezeCSS = `
            .hero-title::before {
                animation-play-state: paused !important;
                clip-path: polygon(0 ${startPos}%, 100% ${startPos}%, 100% ${endPos}%, 0 ${endPos}%) !important;
            }
            .hero-title::after {
                animation-play-state: paused !important;
                clip-path: polygon(0 ${startPos + 5}%, 100% ${startPos + 5}%, 100% ${endPos + 5}%, 0 ${endPos + 5}%) !important;
            }
        `;

        styleEl.textContent = freezeCSS;

        // Després del freeze, tornar a l'animació normal
        setTimeout(() => {
            styleEl.textContent = `
                .hero-title::before {
                    animation-play-state: running !important;
                }
                .hero-title::after {
                    animation-play-state: running !important;
                }
            `;
        }, duration);
    }

    // Freeze aleatori cada 3-20 segons
    function scheduleNextFreeze() {
        const nextFreezeDelay = Math.random() * 17000 + 3000; // 3-20 segons
        setTimeout(() => {
            createRandomFreeze();
            scheduleNextFreeze();
        }, nextFreezeDelay);
    }

    scheduleNextFreeze();
}

// ====================================
// INITIALIZE ALL ON DOM READY
// ====================================
function initAll() {
    const isHomePage = document.body.classList.contains('home') || document.body.classList.contains('page-template-front-page');

    // GLOBAL: Initialize Three.js smoke effect on all pages
    if (typeof THREE !== 'undefined') {
        initThreeJS();
        animate();
    }

    // GLOBAL: Initialize burger menu on all pages
    initBurgerMenu();

    // Home page specific initializations
    if (isHomePage) {
        // Initialize anime.js animations
        if (typeof anime !== 'undefined') {
            initAnimeAnimations();
            initScrollAnimations();
        }

        initRandomGlitchFreezes();
    }
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
} else {
    initAll();
}
