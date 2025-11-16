<?php
/**
 * Functions and definitions
 */

// Setup del theme
function elmeutheme_setup() {
    // Suport per traduccions
    load_theme_textdomain('elmeutheme', get_template_directory() . '/languages');

    // Suport per feed links automàtics
    add_theme_support('automatic-feed-links');

    // Suport per title tag
    add_theme_support('title-tag');

    // Suport per imatges destacades
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 630, true);

    // Suport per HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // Suport per logo personalitzat
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Suport per refresh selectiu al customizer
    add_theme_support('customize-selective-refresh-widgets');

    // Suport per responsive embeds
    add_theme_support('responsive-embeds');

    // Registrar menú de navegació
    register_nav_menus(array(
        'primary' => esc_html__('Menú Principal', 'elmeutheme'),
        'footer'  => esc_html__('Menú Footer', 'elmeutheme'),
    ));
}
add_action('after_setup_theme', 'elmeutheme_setup');

// Definir mides de contingut
function elmeutheme_content_width() {
    $GLOBALS['content_width'] = apply_filters('elmeutheme_content_width', 1200);
}
add_action('after_setup_theme', 'elmeutheme_content_width', 0);

// Registrar àrees de widgets
function elmeutheme_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'elmeutheme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Afegeix widgets aquí.', 'elmeutheme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'elmeutheme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Afegeix widgets al footer.', 'elmeutheme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'elmeutheme_widgets_init');

// Enqueue styles i scripts
function elmeutheme_scripts() {
    // Style principal
    wp_enqueue_style('elmeutheme-style', get_stylesheet_uri(), array(), '1.0');

    // Script de navegació
    wp_enqueue_script('elmeutheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true);

    // Comments reply
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'elmeutheme_scripts');

// Personalitzar l'excerpt
function elmeutheme_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'elmeutheme_excerpt_length');

function elmeutheme_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'elmeutheme_excerpt_more');

// Afegir classe al body per navegadors
function elmeutheme_body_classes($classes) {
    // Afegeix classe si no hi ha sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'elmeutheme_body_classes');

// Customizer
function elmeutheme_customize_register($wp_customize) {
    // Secció de colors
    $wp_customize->add_setting('primary_color', array(
        'default'           => '#0073aa',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label'    => __('Color Principal', 'elmeutheme'),
        'section'  => 'colors',
        'settings' => 'primary_color',
    )));
}
add_action('customize_register', 'elmeutheme_customize_register');

// Outputar custom colors
function elmeutheme_custom_colors() {
    $primary_color = get_theme_mod('primary_color', '#0073aa');
    ?>
    <style type="text/css">
        a:hover,
        .site-title:hover,
        nav ul li a:hover,
        .entry-title a:hover,
        .read-more,
        .pagination a:hover,
        .pagination span.current {
            color: <?php echo esc_attr($primary_color); ?>;
        }
        .read-more,
        .pagination a:hover,
        .pagination span.current {
            background-color: <?php echo esc_attr($primary_color); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'elmeutheme_custom_colors');
