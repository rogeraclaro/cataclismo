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
            --color-primary: #f4624e;
            --color-secondary: #e8c547;
            --color-dark: #0d0f12;
            --color-light: #ffffff;
            --color-gray: #6b7280;
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
            opacity: 0.85;
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

        /* Logo/Title with GLITCH EFFECT - Simplified approach */
        .hero-title {
            font-family: var(--font-display);
            font-size: clamp(60px, 15vw, 180px);
            color: var(--color-light);
            text-transform: uppercase;
            letter-spacing: 8px;
            line-height: 0.9;
            margin-bottom: 30px;
            position: relative;
            display: inline-block;
            animation: glitch-skew 2s infinite;
        }

        .hero-title::before,
        .hero-title::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            letter-spacing: 8px;
        }

        .hero-title::before {
            left: 2px;
            text-shadow: -2px 0 #ff0000;
            clip-path: polygon(0 0, 100% 0, 100% 45%, 0 45%);
            animation: glitch-anim-1 2s infinite linear alternate-reverse;
        }

        .hero-title::after {
            left: -2px;
            text-shadow: 2px 0 #0000ff;
            clip-path: polygon(0 55%, 100% 55%, 100% 100%, 0 100%);
            animation: glitch-anim-2 2s infinite linear alternate-reverse;
        }

        @keyframes glitch-skew {
            0% { transform: skew(0deg); }
            10% { transform: skew(0deg); }
            11% { transform: skew(-2deg); }
            12% { transform: skew(0deg); }
            90% { transform: skew(0deg); }
            91% { transform: skew(1deg); }
            92% { transform: skew(0deg); }
            100% { transform: skew(0deg); }
        }

        @keyframes glitch-anim-1 {
            0% { clip-path: polygon(0 2%, 100% 2%, 100% 5%, 0 5%); }
            5% { clip-path: polygon(0 15%, 100% 15%, 100% 18%, 0 18%); }
            10% { clip-path: polygon(0 52%, 100% 52%, 100% 59%, 0 59%); }
            15% { clip-path: polygon(0 52%, 100% 52%, 100% 59%, 0 59%); }
            20% { clip-path: polygon(0 8%, 100% 8%, 100% 14%, 0 14%); }
            25% { clip-path: polygon(0 33%, 100% 33%, 100% 37%, 0 37%); }
            30% { clip-path: polygon(0 71%, 100% 71%, 100% 78%, 0 78%); }
            35% { clip-path: polygon(0 1%, 100% 1%, 100% 3%, 0 3%); }
            40% { clip-path: polygon(0 44%, 100% 44%, 100% 49%, 0 49%); }
            45% { clip-path: polygon(0 44%, 100% 44%, 100% 49%, 0 49%); }
            50% { clip-path: polygon(0 87%, 100% 87%, 100% 92%, 0 92%); }
            55% { clip-path: polygon(0 22%, 100% 22%, 100% 28%, 0 28%); }
            60% { clip-path: polygon(0 61%, 100% 61%, 100% 65%, 0 65%); }
            65% { clip-path: polygon(0 9%, 100% 9%, 100% 12%, 0 12%); }
            70% { clip-path: polygon(0 38%, 100% 38%, 100% 42%, 0 42%); }
            75% { clip-path: polygon(0 76%, 100% 76%, 100% 81%, 0 81%); }
            80% { clip-path: polygon(0 76%, 100% 76%, 100% 81%, 0 81%); }
            85% { clip-path: polygon(0 3%, 100% 3%, 100% 7%, 0 7%); }
            90% { clip-path: polygon(0 55%, 100% 55%, 100% 60%, 0 60%); }
            95% { clip-path: polygon(0 91%, 100% 91%, 100% 95%, 0 95%); }
            100% { clip-path: polygon(0 29%, 100% 29%, 100% 34%, 0 34%); }
        }

        @keyframes glitch-anim-2 {
            0% { clip-path: polygon(0 84%, 100% 84%, 100% 89%, 0 89%); }
            5% { clip-path: polygon(0 84%, 100% 84%, 100% 89%, 0 89%); }
            10% { clip-path: polygon(0 41%, 100% 41%, 100% 47%, 0 47%); }
            15% { clip-path: polygon(0 6%, 100% 6%, 100% 11%, 0 11%); }
            20% { clip-path: polygon(0 73%, 100% 73%, 100% 79%, 0 79%); }
            25% { clip-path: polygon(0 27%, 100% 27%, 100% 31%, 0 31%); }
            30% { clip-path: polygon(0 27%, 100% 27%, 100% 31%, 0 31%); }
            35% { clip-path: polygon(0 94%, 100% 94%, 100% 98%, 0 98%); }
            40% { clip-path: polygon(0 48%, 100% 48%, 100% 54%, 0 54%); }
            45% { clip-path: polygon(0 13%, 100% 13%, 100% 17%, 0 17%); }
            50% { clip-path: polygon(0 63%, 100% 63%, 100% 68%, 0 68%); }
            55% { clip-path: polygon(0 63%, 100% 63%, 100% 68%, 0 68%); }
            60% { clip-path: polygon(0 19%, 100% 19%, 100% 24%, 0 24%); }
            65% { clip-path: polygon(0 82%, 100% 82%, 100% 88%, 0 88%); }
            70% { clip-path: polygon(0 36%, 100% 36%, 100% 41%, 0 41%); }
            75% { clip-path: polygon(0 4%, 100% 4%, 100% 8%, 0 8%); }
            80% { clip-path: polygon(0 69%, 100% 69%, 100% 75%, 0 75%); }
            85% { clip-path: polygon(0 69%, 100% 69%, 100% 75%, 0 75%); }
            90% { clip-path: polygon(0 24%, 100% 24%, 100% 29%, 0 29%); }
            95% { clip-path: polygon(0 89%, 100% 89%, 100% 93%, 0 93%); }
            100% { clip-path: polygon(0 51%, 100% 51%, 100% 56%, 0 56%); }
        }

        @keyframes glitch-animation-1-OLD {
            0% { clip-path: inset(91px 0 calc(100% - 42px) 0); }
            5% { clip-path: inset(13px 0 calc(100% - 46px) 0); }
            10% { clip-path: inset(52px 0 calc(100% - 59px) 0); }
            15% { clip-path: inset(38px 0 calc(100% - 32px) 0); }
            20% { clip-path: inset(57px 0 calc(100% - 39px) 0); }
            25% { clip-path: inset(124px 0 calc(100% - 65px) 0); }
            30% { clip-path: inset(125px 0 calc(100% - 70px) 0); }
            35% { clip-path: inset(123px 0 calc(100% - 44px) 0); }
            40% { clip-path: inset(54px 0 calc(100% - 141px) 0); }
            45% { clip-path: inset(31px 0 calc(100% - 148px) 0); }
            50% { clip-path: inset(1px 0 calc(100% - 10px) 0); }
            55% { clip-path: inset(125px 0 calc(100% - 16px) 0); }
            60% { clip-path: inset(7px 0 calc(100% - 131px) 0); }
            65% { clip-path: inset(112px 0 calc(100% - 74px) 0); }
            70% { clip-path: inset(54px 0 calc(100% - 3px) 0); }
            75% { clip-path: inset(107px 0 calc(100% - 37px) 0); }
            80% { clip-path: inset(65px 0 calc(100% - 47px) 0); }
            85% { clip-path: inset(66px 0 calc(100% - 149px) 0); }
            90% { clip-path: inset(146px 0 calc(100% - 39px) 0); }
            95% { clip-path: inset(147px 0 calc(100% - 122px) 0); }
            100% { clip-path: inset(148px 0 calc(100% - 129px) 0); }
        }

        @keyframes glitch-animation-2 {
            0% { clip-path: inset(93px 0 calc(100% - 35px) 0); }
            5% { clip-path: inset(46px 0 calc(100% - 76px) 0); }
            10% { clip-path: inset(46px 0 calc(100% - 44px) 0); }
            15% { clip-path: inset(119px 0 calc(100% - 62px) 0); }
            20% { clip-path: inset(61px 0 calc(100% - 111px) 0); }
            25% { clip-path: inset(129px 0 calc(100% - 83px) 0); }
            30% { clip-path: inset(103px 0 calc(100% - 19px) 0); }
            35% { clip-path: inset(68px 0 calc(100% - 54px) 0); }
            40% { clip-path: inset(61px 0 calc(100% - 16px) 0); }
            45% { clip-path: inset(48px 0 calc(100% - 105px) 0); }
            50% { clip-path: inset(87px 0 calc(100% - 64px) 0); }
            55% { clip-path: inset(148px 0 calc(100% - 97px) 0); }
            60% { clip-path: inset(19px 0 calc(100% - 2px) 0); }
            65% { clip-path: inset(57px 0 calc(100% - 136px) 0); }
            70% { clip-path: inset(104px 0 calc(100% - 40px) 0); }
            75% { clip-path: inset(85px 0 calc(100% - 144px) 0); }
            80% { clip-path: inset(92px 0 calc(100% - 59px) 0); }
            85% { clip-path: inset(67px 0 calc(100% - 60px) 0); }
            90% { clip-path: inset(124px 0 calc(100% - 79px) 0); }
            95% { clip-path: inset(103px 0 calc(100% - 49px) 0); }
            100% { clip-path: inset(32px 0 calc(100% - 109px) 0); }
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
            color: var(--color-light);
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
            color: rgba(255, 255, 255, 0.95);
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
            color: var(--color-light);
            font-weight: bold;
            opacity: 0.7;
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
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.8;
        }

        .footer-section h3 {
            font-family: var(--font-title);
            font-size: 20px;
            color: var(--color-light);
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .footer-section p,
        .footer-section a {
            font-family: var(--font-body);
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
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
        <h1 class="hero-title" data-text="CATACLISMO">CATACLISMO</h1>
        <div class="hero-subtitle">
            <?php
            // Get hero subtitle from ACF
            $hero_subtitle = get_field('hero_subtitle');
            if ($hero_subtitle) :
                echo '<p>' . nl2br(esc_html($hero_subtitle)) . '</p>';
            else :
                // Fallback content si no hi ha contingut editat
            ?>
            <p>
                <span class="highlight">Gestió i producció cultural</span> per artistes independents i alternatius.
                Des de Barcelona cap al món, creant ponts entre la música, el teatre, les performances i els visuals.
            </p>
            <?php
            endif;
            ?>
        </div>
    </div>
</section>

<?php
// Services sections from ACF
if (have_rows('services_sections')) :
?>
<!-- Sections Grid -->
<div class="sections-grid">
    <?php
    while (have_rows('services_sections')) : the_row();
        $section_number = get_sub_field('section_number');
        $section_title = get_sub_field('section_title');
        $section_description = get_sub_field('section_description');
    ?>
    <div class="section-card">
        <?php if ($section_number) : ?>
        <div class="section-number"><?php echo esc_html($section_number); ?></div>
        <?php endif; ?>

        <?php if ($section_title) : ?>
        <h2 class="section-title"><?php echo esc_html($section_title); ?></h2>
        <?php endif; ?>

        <?php if ($section_description) : ?>
        <p class="section-description"><?php echo esc_html($section_description); ?></p>
        <?php endif; ?>

        <?php if (have_rows('section_list')) : ?>
        <ul class="section-list">
            <?php
            while (have_rows('section_list')) : the_row();
                $list_item = get_sub_field('list_item');
                if ($list_item) :
            ?>
            <li><?php echo esc_html($list_item); ?></li>
            <?php
                endif;
            endwhile;
            ?>
        </ul>
        <?php endif; ?>
    </div>
    <?php
    endwhile;
    ?>
</div>
<?php
endif;
?>

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

        // Smoke particles - DARK & DRAMATIC (matching PDF cataclysmic aesthetic)
        var smokeTexture = new THREE.TextureLoader().load('https://s3-us-west-2.amazonaws.com/s.cdpn.io/95637/Smoke-Element.png');
        var smokeMaterial = new THREE.MeshLambertMaterial({
            color: 0x2a3240, // Much darker gray-blue, almost black
            map: smokeTexture,
            transparent: true,
            opacity: 0.75
        });
        var smokeGeo = new THREE.PlaneGeometry(350, 350);

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
            // Paràmetres aleatoris segons noves directrius
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

    // Inicialitzar freezes aleatoris
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initRandomGlitchFreezes);
    } else {
        initRandomGlitchFreezes();
    }
</script>

<?php wp_footer(); ?>
</body>
</html>
