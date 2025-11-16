<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: 0;
        }
        
        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        /* Header amb burger menu */
        .home-header {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            background: rgba(255, 0, 0, 0.5); /* DEBUG */
            padding: 15px;
        }
        
        /* Burger Menu Button - 3 BARRES BLANQUES HORITZONTALS */
        .burger-menu {
            display: flex !important;
            flex-direction: column !important;
            justify-content: space-between !important;
            width: 35px !important;
            height: 30px !important;
            background: rgba(0, 255, 0, 0.5) !important; /* DEBUG: verd */
            border: 2px solid yellow !important;
            cursor: pointer !important;
            padding: 3px !important;
            z-index: 10000 !important;
            position: relative !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .burger-menu span {
            display: block !important;
            width: 100% !important;
            height: 4px !important;
            background: #ffffff !important;
            border-radius: 2px !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.8) !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .burger-menu.active span:nth-child(1) {
            transform: rotate(45deg);
            position: absolute;
            top: 10px;
        }

        .burger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .burger-menu.active span:nth-child(3) {
            transform: rotate(-45deg);
            position: absolute;
            top: 10px;
        }

        /* Overlay */
        .menu-overlay {
            display: none !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0,0,0,0.8) !important;
            z-index: 9998 !important;
            opacity: 0 !important;
            transition: opacity 0.3s ease !important;
        }

        .menu-overlay.active {
            display: block !important;
            opacity: 1 !important;
        }

        /* Navigation Menu */
        .main-navigation {
            position: fixed !important;
            top: 0 !important;
            right: -100% !important;
            width: 300px !important;
            height: 100vh !important;
            background: rgba(0, 0, 0, 0.95) !important;
            backdrop-filter: blur(10px) !important;
            box-shadow: -2px 0 20px rgba(0, 255, 255, 0.3) !important;
            padding: 80px 30px 30px !important;
            z-index: 10001 !important;
            transition: right 0.4s ease !important;
            overflow-y: auto !important;
        }
        
        .main-navigation.active {
            right: 0 !important;
        }
        
        .main-navigation ul {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
            display: flex !important;
            flex-direction: column !important;
        }
        
        .main-navigation ul li {
            padding: 18px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }
        
        .main-navigation ul li:last-child {
            border-bottom: none;
        }
        
        /* Ocultar submenus per defecte */
        .main-navigation ul ul.sub-menu {
            display: none !important;
            padding-left: 20px !important;
            margin-top: 10px !important;
            list-style: none !important;
        }
        
        /* Mostrar submenus quan tenen la classe 'open' */
        .main-navigation ul li.submenu-open > ul.sub-menu {
            display: block !important;
        }
        
        /* Estils per items de submenú */
        .main-navigation ul ul.sub-menu li {
            padding: 12px 0 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
        }
        
        .main-navigation ul ul.sub-menu li:last-child {
            border-bottom: none !important;
        }
        
        .main-navigation ul ul.sub-menu li a {
            font-size: 16px !important;
            color: #cccccc !important;
        }
        
        /* Indicador de submenú */
        .main-navigation ul li.menu-item-has-children > a:after {
            content: ' \25BC' !important;
            font-size: 10px !important;
            margin-left: 8px !important;
            transition: transform 0.3s ease !important;
            display: inline-block !important;
        }
        
        .main-navigation ul li.menu-item-has-children.submenu-open > a:after {
            transform: rotate(180deg) !important;
        }
        
        .main-navigation ul li a {
            display: block;
            font-size: 18px;
            color: #ffffff;
            text-decoration: none;
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .main-navigation ul li a:hover {
            color: #00ffff;
            padding-left: 10px;
        }
        
        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }
        
        #content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
            pointer-events: none;
        }
        
        #content h1 {
            font-family: Arial, sans-serif;
            font-size: 4em;
            color: #00ffff;
            text-shadow: 0 0 20px #00ffff, 0 0 40px #00ffff;
            margin-bottom: 20px;
            letter-spacing: 3px;
        }
        
        #content p {
            font-family: Arial, sans-serif;
            font-size: 1.5em;
            color: #00dddd;
            text-shadow: 0 0 10px #00dddd;
        }
        
        @media (max-width: 768px) {
            #content h1 {
                font-size: 2.5em;
            }
            
            #content p {
                font-size: 1.2em;
            }
            
            .main-navigation {
                width: 280px;
            }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Overlay per tancar el menú -->
<div class="menu-overlay" id="menu-overlay"></div>

<!-- Header amb Burger Menu -->
<header class="home-header">
    <button class="burger-menu" id="burger-menu" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</header>

<!-- Navigation Menu -->
<nav class="main-navigation" id="main-navigation">
    <?php
    // DEBUG: Verificar si hi ha menú assignat
    $menu_name = 'primary';
    $locations = get_nav_menu_locations();
    $menu = isset($locations[$menu_name]) ? wp_get_nav_menu_object($locations[$menu_name]) : null;
    
    if ($menu) {
        echo '<!-- Menú trobat: ' . $menu->name . ' -->';
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id' => 'primary-menu',
            'container' => false,
            'fallback_cb' => false,
        ));
    } else {
        echo '<!-- NO s\'ha trobat cap menú assignat a primary -->';
        echo '<ul id="primary-menu">';
        echo '<li><a href="' . home_url() . '">Inici</a></li>';
        echo '<li><a href="' . home_url('/sobre-nosaltres') . '">Sobre Nosaltres</a></li>';
        echo '<li><a href="' . home_url('/serveis') . '">Serveis</a></li>';
        echo '<li><a href="' . home_url('/contacte') . '">Contacte</a></li>';
        echo '</ul>';
    }
    ?>
</nav>

<div id="canvas-container"></div>

<div id="content">
    <h1><?php bloginfo('name'); ?></h1>
    <p><?php bloginfo('description'); ?></p>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
<script>
    var camera, scene, renderer;
    var clock, delta;
    var smokeParticles = [];

    init();
    animate();

    function init() {
        clock = new THREE.Clock();
        
        renderer = new THREE.WebGLRenderer();
        renderer.setSize(window.innerWidth, window.innerHeight);
        
        scene = new THREE.Scene();
        
        camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
        camera.position.z = 1000;
        scene.add(camera);

        light = new THREE.DirectionalLight(0xffffff, 0.5);
        light.position.set(-1, 0, 1);
        scene.add(light);

        var smokeTexture = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png');
        var smokeMaterial = new THREE.MeshLambertMaterial({
            color: 0x00dddd, 
            map: smokeTexture, 
            transparent: true
        });
        var smokeGeo = new THREE.PlaneGeometry(300, 300);
        
        for (var p = 0; p < 150; p++) {
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
            smokeParticles[sp].rotation.z += (delta * 0.2);
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
    
    // Burger Menu Functionality
    console.log('=== INICI SCRIPT BURGER MENU ===');
    
    function initBurgerMenu() {
        const burgerMenu = document.getElementById('burger-menu');
        const mainNavigation = document.getElementById('main-navigation');
        const menuOverlay = document.getElementById('menu-overlay');
        
        console.log('Burger element:', burgerMenu);
        console.log('Nav element:', mainNavigation);
        console.log('Overlay element:', menuOverlay);
        
        if (!burgerMenu) {
            console.error('ERROR: No s\'ha trobat el burger-menu!');
            return;
        }
        if (!mainNavigation) {
            console.error('ERROR: No s\'ha trobat el main-navigation!');
            return;
        }
        if (!menuOverlay) {
            console.error('ERROR: No s\'ha trobat el menu-overlay!');
            return;
        }
        
        console.log('Tots els elements trobats! Afegint event listeners...');
        
        // Toggle menu
        let menuOpen = false;
        
        burgerMenu.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('===== BURGER CLICKED! =====');
            console.log('Menu open?', menuOpen);
            
            if (menuOpen) {
                // Tancar
                mainNavigation.style.right = '-100%';
                menuOverlay.style.display = 'none';
                menuOverlay.style.opacity = '0';
                burgerMenu.querySelector('span:nth-child(1)').style.transform = 'none';
                burgerMenu.querySelector('span:nth-child(2)').style.opacity = '1';
                burgerMenu.querySelector('span:nth-child(3)').style.transform = 'none';
                menuOpen = false;
                console.log('Menú tancat');
            } else {
                // Obrir
                mainNavigation.style.right = '0';
                menuOverlay.style.display = 'block';
                setTimeout(function() {
                    menuOverlay.style.opacity = '1';
                }, 10);
                burgerMenu.querySelector('span:nth-child(1)').style.transform = 'rotate(45deg) translateY(10px)';
                burgerMenu.querySelector('span:nth-child(2)').style.opacity = '0';
                burgerMenu.querySelector('span:nth-child(3)').style.transform = 'rotate(-45deg) translateY(-10px)';
                menuOpen = true;
                console.log('Menú obert');
            }
            
            // Verificar després
            setTimeout(function() {
                const navStyles = window.getComputedStyle(mainNavigation);
                console.log('Nav right position:', navStyles.right);
            }, 500);
        });
        
        // Close menu when clicking overlay
        menuOverlay.addEventListener('click', function() {
            console.log('Overlay clicked - tancant menú');
            mainNavigation.style.right = '-100%';
            menuOverlay.style.display = 'none';
            menuOverlay.style.opacity = '0';
            burgerMenu.querySelector('span:nth-child(1)').style.transform = 'none';
            burgerMenu.querySelector('span:nth-child(2)').style.opacity = '1';
            burgerMenu.querySelector('span:nth-child(3)').style.transform = 'none';
            menuOpen = false;
        });
        
        // Close menu when clicking a link
        const menuLinks = mainNavigation.querySelectorAll('a');
        console.log('Enllaços de menú trobats:', menuLinks.length);
        
        // Gestionar submenus
        const menuItemsWithChildren = mainNavigation.querySelectorAll('.menu-item-has-children');
        console.log('Items amb submenú:', menuItemsWithChildren.length);
        
        menuItemsWithChildren.forEach(item => {
            const link = item.querySelector('a');
            if (link) {
                link.addEventListener('click', function(e) {
                    // Si té submenú, no navegar, sinó toggle
                    const submenu = item.querySelector('.sub-menu');
                    if (submenu) {
                        e.preventDefault();
                        e.stopPropagation(); // Evitar que es propagui
                        item.classList.toggle('submenu-open');
                        console.log('Submenu toggled:', item.classList.contains('submenu-open'));
                    }
                });
            }
        });
        
        // Tancar menú només per enllaços de submenú (no parents)
        const submenuLinks = mainNavigation.querySelectorAll('.sub-menu a');
        console.log('Enllaços de submenú trobats:', submenuLinks.length);
        submenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                console.log('Submenu link clicked - tancant menú');
                mainNavigation.style.right = '-100%';
                menuOverlay.style.display = 'none';
                menuOverlay.style.opacity = '0';
                burgerMenu.querySelector('span:nth-child(1)').style.transform = 'none';
                burgerMenu.querySelector('span:nth-child(2)').style.opacity = '1';
                burgerMenu.querySelector('span:nth-child(3)').style.transform = 'none';
                menuOpen = false;
            });
        });
        
        // Tancar menú per enllaços que NO tenen submenú
        const directLinks = mainNavigation.querySelectorAll('li:not(.menu-item-has-children) > a');
        console.log('Enllaços directes trobats:', directLinks.length);
        directLinks.forEach(link => {
            link.addEventListener('click', function() {
                console.log('Direct link clicked - tancant menú');
                mainNavigation.style.right = '-100%';
                menuOverlay.style.display = 'none';
                menuOverlay.style.opacity = '0';
                burgerMenu.querySelector('span:nth-child(1)').style.transform = 'none';
                burgerMenu.querySelector('span:nth-child(2)').style.opacity = '1';
                burgerMenu.querySelector('span:nth-child(3)').style.transform = 'none';
                menuOpen = false;
            });
        });
        
        // Close menu on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menuOpen) {
                console.log('ESC pressed - tancant menú');
                mainNavigation.style.right = '-100%';
                menuOverlay.style.display = 'none';
                menuOverlay.style.opacity = '0';
                burgerMenu.querySelector('span:nth-child(1)').style.transform = 'none';
                burgerMenu.querySelector('span:nth-child(2)').style.opacity = '1';
                burgerMenu.querySelector('span:nth-child(3)').style.transform = 'none';
                menuOpen = false;
            }
        });
        
        console.log('Event listeners afegits correctament!');
    }
    
    // Intentar inicialitzar immediatament
    if (document.readyState === 'loading') {
        console.log('Document encara carregant, esperant DOMContentLoaded...');
        document.addEventListener('DOMContentLoaded', initBurgerMenu);
    } else {
        console.log('Document ja carregat, inicialitzant ara...');
        initBurgerMenu();
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
