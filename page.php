<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo wp_get_document_title(); ?></title>

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
            min-height: 100%;
            background: var(--color-dark);
            color: var(--color-light);
            overflow-x: hidden;
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
            opacity: 0.3;
        }

        /* ====================================
           BURGER MENU - TOP RIGHT
        ==================================== */
        .page-header {
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
           LOGO LINK - TOP LEFT
        ==================================== */
        .site-logo {
            position: fixed;
            top: 30px;
            left: 50px;
            z-index: 9999;
        }

        .site-logo a {
            font-family: var(--font-display);
            font-size: 36px;
            color: var(--color-light);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 3px;
            transition: all 0.3s ease;
            display: block;
        }

        .site-logo a:hover {
            color: var(--color-primary);
            transform: scale(1.05);
        }

        /* ====================================
           PAGE CONTENT
        ==================================== */
        .page-container {
            position: relative;
            min-height: 100vh;
            padding: 150px 50px 100px;
            z-index: 10;
        }

        .page-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-family: var(--font-display);
            font-size: clamp(48px, 10vw, 120px);
            color: var(--color-light);
            text-transform: uppercase;
            letter-spacing: 6px;
            line-height: 0.9;
            margin-bottom: 50px;
            position: relative;
            padding-bottom: 30px;
        }

        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-secondary) 100%);
        }

        .entry-content {
            font-family: var(--font-body);
            font-size: 18px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.9;
        }

        .entry-content p {
            margin-bottom: 25px;
        }

        .entry-content h2 {
            font-family: var(--font-title);
            font-size: 36px;
            color: var(--color-light);
            text-transform: uppercase;
            margin-top: 60px;
            margin-bottom: 25px;
            position: relative;
            padding-left: 20px;
        }

        .entry-content h2::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 5px;
            height: 100%;
            background: var(--color-primary);
        }

        .entry-content h3 {
            font-family: var(--font-title);
            font-size: 24px;
            color: var(--color-secondary);
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .entry-content ul,
        .entry-content ol {
            margin-bottom: 25px;
            padding-left: 30px;
        }

        .entry-content li {
            margin-bottom: 12px;
            line-height: 1.8;
        }

        .entry-content a {
            color: var(--color-yellow);
            text-decoration: underline;
            transition: color 0.3s ease;
        }

        .entry-content a:hover {
            color: var(--color-primary);
        }

        .entry-content blockquote {
            border-left: 4px solid var(--color-primary);
            padding: 20px 30px;
            margin: 40px 0;
            background: rgba(255, 255, 255, 0.05);
            font-style: italic;
        }

        .entry-content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 30px 0;
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
            .site-logo {
                left: 30px;
                top: 25px;
            }

            .site-logo a {
                font-size: 24px;
            }

            .page-header {
                top: 25px;
                right: 25px;
            }

            .page-container {
                padding: 120px 30px 60px;
            }

            .page-title {
                font-size: 48px;
                letter-spacing: 3px;
            }

            .entry-content {
                font-size: 16px;
            }

            .entry-content h2 {
                font-size: 28px;
                margin-top: 40px;
            }

            .entry-content h3 {
                font-size: 20px;
            }

            .main-navigation {
                max-width: 100%;
                padding: 80px 30px 30px;
            }

            .main-navigation ul li a {
                font-size: 36px;
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

<!-- Logo/Home Link -->
<div class="site-logo">
    <a href="<?php echo esc_url(home_url('/')); ?>">CATACLISMO</a>
</div>

<!-- Menu Overlay -->
<div class="menu-overlay" id="menu-overlay"></div>

<!-- Burger Menu Header -->
<header class="page-header">
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

<!-- Page Container -->
<div class="page-container">
    <div class="page-content">
        <?php
        while (have_posts()) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="page-title"><?php the_title(); ?></h1>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
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

        // Smoke particles with red tint (more subtle for pages)
        var smokeTexture = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png');
        var smokeMaterial = new THREE.MeshLambertMaterial({
            color: 0xff3344,
            map: smokeTexture,
            transparent: true,
            opacity: 0.3
        });
        var smokeGeo = new THREE.PlaneGeometry(300, 300);

        for (var p = 0; p < 80; p++) {
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
            smokeParticles[sp].rotation.z += (delta * 0.1);
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
