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

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Canvas container for smoke effect - Global -->
<div id="canvas-container"></div>

<!-- Logo/Home Link with Glitch Animation -->
<div class="site-logo">
    <a href="<?php echo esc_url(home_url('/')); ?>">
        <div class="hero-title" data-text="CATACLISMO">CATACLISMO</div>
    </a>
</div>

<!-- Floating decorative labels - ONLY ON HOME -->
<?php if (is_front_page()) : ?>
<?php
$floating_label_1 = get_field('floating_label_1');
$floating_label_2 = get_field('floating_label_2');
$floating_label_3 = get_field('floating_label_3');
?>
<?php if (!empty($floating_label_1)) : ?>
<div class="floating-label label-1"><?php echo esc_html($floating_label_1); ?></div>
<?php endif; ?>
<?php if (!empty($floating_label_2)) : ?>
<div class="floating-label label-2"><?php echo esc_html($floating_label_2); ?></div>
<?php endif; ?>
<?php if (!empty($floating_label_3)) : ?>
<div class="floating-label label-3"><?php echo esc_html($floating_label_3); ?></div>
<?php endif; ?>
<?php endif; ?>

<!-- Menu Overlay -->
<div class="menu-overlay" id="menu-overlay"></div>

<!-- Burger Menu Header -->
<header class="site-header-global">
    <button class="burger-menu" id="burger-menu" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <!-- Language Switcher -->
    <!-- <?php if (function_exists('pll_the_languages')) : ?>
    <div class="language-switcher">
        <?php
        pll_the_languages(array(
            'show_flags' => 0,
            'show_names' => 1,
            'display_names_as' => 'slug',
            'dropdown' => 0,
            'hide_if_empty' => 0,
            'hide_current' => 0
        ));
        ?>
    </div>
    <?php endif; ?> -->
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
