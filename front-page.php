<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>

    <!-- Google Fonts - Tipografia distintiva -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Archivo+Black&family=Work+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #FF0033;
            --color-secondary: #FFFF00;
            --color-dark: #0a0a0a;
            --color-light: #ffffff;
            --color-accent: #00FF88;
            --font-display: 'Bebas Neue', 'Arial Black', sans-serif;
            --font-title: 'Archivo Black', sans-serif;
            --font-body: 'Work Sans', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow-x: hidden;
            background: var(--color-dark);
            color: var(--color-light);
        }

        /* ====================================
           CANVAS SMOKE EFFECT (BACKGROUND)
        ==================================== */
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.6;
        }

        /* ====================================
           BURGER MENU - TOP RIGHT
        ==================================== */
        .home-header {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 9999;
            mix-blend-mode: difference;
        }

        .burger-menu {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 45px;
            height: 35px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            position: relative;
            transition: transform 0.3s ease;
        }

        .burger-menu:hover {
            transform: scale(1.1);
        }

        .burger-menu span {
            display: block;
            width: 100%;
            height: 3px;
            background: var(--color-light);
            transition: all 0.3s ease;
        }

        .burger-menu.active span:nth-child(1) {
            transform: rotate(45deg) translate(10px, 10px);
        }

        .burger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active span:nth-child(3) {
            transform: rotate(-45deg) translate(10px, -10px);
        }

        /* ====================================
           MENU OVERLAY & NAVIGATION
        ==================================== */
        .menu-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.9);
            z-index: 9997;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .menu-overlay.active {
            display: block;
            opacity: 1;
        }

        .main-navigation {
            position: fixed;
            top: 0;
            right: -100%;
            width: 100%;
            max-width: 500px;
            height: 100vh;
            background: var(--color-dark);
            border-left: 3px solid var(--color-primary);
            padding: 100px 50px 50px;
            z-index: 9998;
            transition: right 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            overflow-y: auto;
        }

        .main-navigation.active {
            right: 0;
        }

        .main-navigation ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .main-navigation ul li {
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.3s ease;
        }

        .main-navigation.active ul li {
            opacity: 1;
            transform: translateX(0);
        }

        .main-navigation.active ul li:nth-child(1) { transition-delay: 0.1s; }
        .main-navigation.active ul li:nth-child(2) { transition-delay: 0.2s; }
        .main-navigation.active ul li:nth-child(3) { transition-delay: 0.3s; }
        .main-navigation.active ul li:nth-child(4) { transition-delay: 0.4s; }
        .main-navigation.active ul li:nth-child(5) { transition-delay: 0.5s; }

        .main-navigation ul li a {
            display: block;
            font-family: var(--font-display);
            font-size: 48px;
            color: var(--color-light);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            position: relative;
        }

        .main-navigation ul li a:hover {
            color: var(--color-primary);
            padding-left: 20px;
        }

        .main-navigation ul li a::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            width: 0;
            height: 3px;
            background: var(--color-secondary);
            transition: width 0.3s ease;
        }

        .main-navigation ul li a:hover::before {
            width: 10px;
        }

        /* Submenus */
        .main-navigation ul ul.sub-menu {
            display: none;
            padding-left: 30px;
            margin-top: 15px;
        }

        .main-navigation ul li.submenu-open > ul.sub-menu {
            display: block;
        }

        .main-navigation ul ul.sub-menu li a {
            font-size: 24px;
            font-family: var(--font-body);
            font-weight: 600;
        }

        .main-navigation ul li.menu-item-has-children > a::after {
            content: ' ↓';
            font-size: 30px;
            margin-left: 10px;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .main-navigation ul li.menu-item-has-children.submenu-open > a::after {
            transform: rotate(180deg);
        }

        /* ====================================
           HERO SECTION - MAIN CONTENT
        ==================================== */
        .hero-section {
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 80px 50px;
            z-index: 10;
        }

        .hero-content {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* Logo/Title with glitch effect */
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(60px, 15vw, 180px);
            color: var(--color-light);
            text-transform: uppercase;
            letter-spacing: 8px;
            line-height: 0.9;
            margin-bottom: 30px;
            position: relative;
            animation: glitch 3s infinite;
        }

        @keyframes glitch {
            0%, 100% {
                text-shadow:
                    2px 2px 0 var(--color-primary),
                    -2px -2px 0 var(--color-secondary);
            }
            25% {
                text-shadow:
                    -2px -2px 0 var(--color-primary),
                    2px 2px 0 var(--color-secondary);
            }
            50% {
                text-shadow:
                    2px -2px 0 var(--color-primary),
                    -2px 2px 0 var(--color-secondary);
            }
            75% {
                text-shadow:
                    -2px 2px 0 var(--color-primary),
                    2px -2px 0 var(--color-secondary);
            }
        }

        .hero-subtitle {
            font-family: var(--font-body);
            font-size: clamp(18px, 3vw, 32px);
            font-weight: 300;
            color: var(--color-light);
            max-width: 800px;
            line-height: 1.6;
            margin-bottom: 50px;
            opacity: 0;
            animation: fadeInUp 1s ease forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Highlight text */
        .highlight {
            background: linear-gradient(120deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }

        /* ====================================
           SECTIONS GRID
        ==================================== */
        .sections-grid {
            position: relative;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 3px;
            background: var(--color-primary);
            margin-top: 100px;
            z-index: 10;
        }

        .section-card {
            background: var(--color-dark);
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            cursor: pointer;
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .section-card:hover::before {
            left: 100%;
        }

        .section-card:hover {
            background: rgba(255, 0, 51, 0.1);
            transform: scale(1.02);
        }

        .section-number {
            font-family: var(--font-display);
            font-size: 120px;
            color: var(--color-primary);
            opacity: 0.2;
            position: absolute;
            top: -20px;
            right: 20px;
            line-height: 1;
        }

        .section-title {
            font-family: var(--font-title);
            font-size: 36px;
            color: var(--color-light);
            text-transform: uppercase;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .section-description {
            font-family: var(--font-body);
            font-size: 16px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }

        .section-list {
            list-style: none;
            padding: 0;
            position: relative;
            z-index: 2;
        }

        .section-list li {
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 400;
            color: var(--color-light);
            padding: 10px 0;
            padding-left: 25px;
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-list li::before {
            content: '▸';
            position: absolute;
            left: 0;
            color: var(--color-secondary);
            font-weight: bold;
        }

        /* ====================================
           FLOATING ELEMENTS
        ==================================== */
        .floating-label {
            position: fixed;
            font-family: var(--font-display);
            font-size: 24px;
            color: var(--color-primary);
            opacity: 0.3;
            z-index: 5;
            pointer-events: none;
            animation: float 6s ease-in-out infinite;
        }

        .floating-label.label-1 {
            top: 15%;
            left: 5%;
            animation-delay: 0s;
        }

        .floating-label.label-2 {
            top: 60%;
            right: 8%;
            animation-delay: 2s;
        }

        .floating-label.label-3 {
            bottom: 20%;
            left: 10%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        /* ====================================
           FOOTER
        ==================================== */
        .site-footer {
            position: relative;
            background: var(--color-dark);
            border-top: 3px solid var(--color-primary);
            padding: 80px 50px 40px;
            z-index: 10;
            margin-top: 100px;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 50px;
        }

        .footer-brand h2 {
            font-family: var(--font-display);
            font-size: 48px;
            color: var(--color-light);
            margin-bottom: 20px;
        }

        .footer-brand p {
            font-family: var(--font-body);
            font-size: 16px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
        }

        .footer-section h3 {
            font-family: var(--font-title);
            font-size: 20px;
            color: var(--color-secondary);
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .footer-section p,
        .footer-section a {
            font-family: var(--font-body);
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
            line-height: 2;
            text-decoration: none;
            display: block;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: var(--color-primary);
            padding-left: 5px;
        }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-family: var(--font-body);
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        /* ====================================
           RESPONSIVE
        ==================================== */
        @media (max-width: 768px) {
            .hero-section {
                padding: 60px 30px;
            }

            .hero-title {
                font-size: 60px;
                letter-spacing: 4px;
            }

            .hero-subtitle {
                font-size: 18px;
            }

            .sections-grid {
                grid-template-columns: 1fr;
                margin-top: 60px;
            }

            .section-card {
                padding: 40px 30px;
            }

            .section-number {
                font-size: 80px;
            }

            .section-title {
                font-size: 28px;
            }

            .main-navigation {
                max-width: 100%;
                padding: 80px 30px 30px;
            }

            .main-navigation ul li a {
                font-size: 36px;
            }

            .floating-label {
                display: none;
            }

            .site-footer {
                padding: 60px 30px 30px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 40px;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Canvas container for smoke effect -->
<div id="canvas-container"></div>

<!-- Floating decorative labels -->
<div class="floating-label label-1">PRODUCCIONES</div>
<div class="floating-label label-2">BCN</div>
<div class="floating-label label-3">CULTURA</div>

<!-- Menu Overlay -->
<div class="menu-overlay" id="menu-overlay"></div>

<!-- Burger Menu Header -->
<header class="home-header">
    <button class="burger-menu" id="burger-menu" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>

<!-- Main Navigation -->
<nav class="main-navigation" id="main-navigation">
    <?php
    $menu_name = 'primary';
    $locations = get_nav_menu_locations();
    $menu = isset($locations[$menu_name]) ? wp_get_nav_menu_object($locations[$menu_name]) : null;

    if ($menu) {
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id' => 'primary-menu',
            'container' => false,
            'fallback_cb' => false,
        ));
    } else {
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . home_url() . '">Inici</a></li>';
        echo '<li><a href="' . home_url('/sobre-nosaltres') . '">Qui Som</a></li>';
        echo '<li><a href="' . home_url('/serveis') . '">Serveis</a></li>';
        echo '<li><a href="' . home_url('/artistes') . '">Artistes</a></li>';
        echo '<li><a href="' . home_url('/contacte') . '">Contacte</a></li>';
        echo '</ul>';
    }
    ?>
</nav>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">CATACLISMO</h1>
        <p class="hero-subtitle">
            <span class="highlight">Gestió i producció cultural</span> per artistes independents i alternatius.
            Des de Barcelona cap al món, creant ponts entre la música, el teatre, les performances i els visuals.
        </p>
    </div>
</section>

<!-- Services Grid -->
<div class="sections-grid">
    <!-- Gestió i Producció -->
    <div class="section-card">
        <span class="section-number">01</span>
        <h2 class="section-title">Gestió i Producció</h2>
        <p class="section-description">
            Elaboració de projectes de circulació internacional i gestió cultural d'artistes.
        </p>
        <ul class="section-list">
            <li>Creació i elaboració de perfiles culturals d'artistes</li>
            <li>Elaboració de projectes per al Fons de la Música</li>
            <li>Línea de circulació a l'estranger</li>
            <li>Gestió amb el Ministeri de Cultura, Arts i Patrimoni</li>
            <li>Rendició de projectes i seguiment</li>
        </ul>
    </div>

    <!-- Booking -->
    <div class="section-card">
        <span class="section-number">02</span>
        <h2 class="section-title">Booking</h2>
        <p class="section-description">
            Gestió integral de concerts i esdeveniments per artistes de diferents disciplines.
        </p>
        <ul class="section-list">
            <li>Contacte amb promotors i sales de concerts</li>
            <li>Venda i acords per show</li>
            <li>Cobertura de requeriments tècnics</li>
            <li>Gestió d'allotjament de transport</li>
            <li>Tour management</li>
            <li>Gestió amb agències de promoció i difusió</li>
            <li>Gestió de merchandising</li>
            <li>Gestió de bandes suport</li>
        </ul>
    </div>

    <!-- Experiència -->
    <div class="section-card">
        <span class="section-number">03</span>
        <h2 class="section-title">Experiència</h2>
        <p class="section-description">
            Des del 2012 generant itineràncies artístiques a Xile, Llatinoamèrica i Europa.
        </p>
        <ul class="section-list">
            <li>Gires internacionals per Europa</li>
            <li>Projectes a Xile i Llatinoamèrica</li>
            <li>Gestió de festivals i esdeveniments</li>
            <li>Networking amb circuits culturals alternatius</li>
            <li>Suport a artistes emergents i consolidats</li>
        </ul>
    </div>
</div>

<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h2>CATACLISMO</h2>
            <p>Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.</p>
        </div>

        <div class="footer-section">
            <h3>Contacte</h3>
            <p>Barcelona, Catalunya</p>
            <a href="mailto:info@cataclismoproducciones.com">info@cataclismoproducciones.com</a>
        </div>

        <div class="footer-section">
            <h3>Segueix-nos</h3>
            <a href="#" target="_blank">Instagram</a>
            <a href="#" target="_blank">Facebook</a>
            <a href="#" target="_blank">SoundCloud</a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Cataclismo Producciones. Dissenyat amb ❤ per la cultura alternativa.</p>
    </div>
</footer>

<!-- Three.js Smoke Effect -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    // ====================================
    // THREE.JS SMOKE EFFECT
    // ====================================
    var camera, scene, renderer;
    var clock, delta;
    var smokeParticles = [];

    init();
    animate();

    function init() {
        clock = new THREE.Clock();

        renderer = new THREE.WebGLRenderer({ alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);

        scene = new THREE.Scene();

        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
        camera.position.z = 1000;
        scene.add(camera);

        // Lighting
        var light = new THREE.DirectionalLight(0xffffff, 0.5);
        light.position.set(-1, 0, 1);
        scene.add(light);

        // Smoke particles with red/yellow tint
        var smokeTexture = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png');
        var smokeMaterial = new THREE.MeshLambertMaterial({
            color: 0xff3344, // Red-ish tint
            map: smokeTexture,
            transparent: true,
            opacity: 0.5
        });
        var smokeGeo = new THREE.PlaneGeometry(300, 300);

        for (var p = 0; p < 120; p++) {
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

        document.getElementById('canvas-container').appendChild(renderer.domElement);
    }

    function animate() {
        delta = clock.getDelta();
        requestAnimationFrame(animate);
        evolveSmoke();
        render();
    }

    function evolveSmoke() {
        var sp = smokeParticles.length;
        while(sp--) {
            smokeParticles[sp].rotation.z += (delta * 0.15);
        }
    }

    function render() {
        renderer.render(scene, camera);
    }

    window.addEventListener('resize', function() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
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
        burgerMenu.addEventListener('click', function(e) {
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
        menuOverlay.addEventListener('click', function() {
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
                link.addEventListener('click', function(e) {
                    const submenu = item.querySelector('.sub-menu');
                    if (submenu) {
                        e.preventDefault();
                        e.stopPropagation();
                        item.classList.toggle('submenu-open');
                    }
                });
            }
        });

        // Close menu for submenu links
        const submenuLinks = mainNavigation.querySelectorAll('.sub-menu a');
        submenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
                menuOpen = false;
            });
        });

        // Close menu for direct links
        const directLinks = mainNavigation.querySelectorAll('li:not(.menu-item-has-children) > a');
        directLinks.forEach(link => {
            link.addEventListener('click', function() {
                burgerMenu.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
                menuOpen = false;
            });
        });

        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menuOpen) {
                burgerMenu.classList.remove('active');
                mainNavigation.classList.remove('active');
                menuOverlay.classList.remove('active');
                document.body.style.overflow = '';
                menuOpen = false;
            }
        });
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initBurgerMenu);
    } else {
        initBurgerMenu();
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
