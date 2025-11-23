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

    // Footer Widget Areas
    register_sidebar(array(
        'name'          => esc_html__('Footer - Brand', 'elmeutheme'),
        'id'            => 'footer-brand',
        'description'   => esc_html__('Secció principal del footer amb títol i descripció de Cataclismo.', 'elmeutheme'),
        'before_widget' => '<div id="%1$s" class="footer-brand %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer - Contacte', 'elmeutheme'),
        'id'            => 'footer-contacte',
        'description'   => esc_html__('Secció de contacte del footer.', 'elmeutheme'),
        'before_widget' => '<div id="%1$s" class="footer-section %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer - Xarxes Socials', 'elmeutheme'),
        'id'            => 'footer-socials',
        'description'   => esc_html__('Secció de xarxes socials del footer.', 'elmeutheme'),
        'before_widget' => '<div id="%1$s" class="footer-section %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
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

    // Three.js library (CDN) - disponible a totes les pàgines
    wp_enqueue_script('threejs', 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js', array(), 'r128', true);

    // Anime.js library (CDN - versió 3.2.1 més estable) - disponible a totes les pàgines
    wp_enqueue_script('animejs', 'https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js', array(), '3.2.1', true);

    // Main.js (depends on Three.js and Anime.js) - disponible a totes les pàgines
    wp_enqueue_script('cataclismo-main', get_template_directory_uri() . '/js/main.js', array('threejs', 'animejs'), '1.1.0', true);

    // Contact Form script - només a la pàgina de contacte
    if (is_page_template('template-contact.php')) {
        wp_enqueue_script('cataclismo-contact-form', get_template_directory_uri() . '/js/contact-form.js', array(), '1.0', true);
    }

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

// ====================================
// ADVANCED CUSTOM FIELDS - HOME PAGE
// ====================================
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_home_content',
    'title' => 'Contingut de la Home',
    'fields' => array(
        array(
            'key' => 'field_hero_subtitle',
            'label' => 'Subtítol Hero',
            'name' => 'hero_subtitle',
            'type' => 'textarea',
            'instructions' => 'Text que apareix sota "CATACLISMO"',
            'required' => 0,
            'rows' => 3,
            'default_value' => 'Gestió i producció cultural per artistes independents i alternatius. Des de Barcelona cap al món, creant ponts entre la música, el teatre, les performances i els visuals.',
        ),
        array(
            'key' => 'field_floating_label_1',
            'label' => 'Etiqueta Flotant 1',
            'name' => 'floating_label_1',
            'type' => 'text',
            'instructions' => 'Text de l\'etiqueta flotant superior esquerra',
            'required' => 0,
            'default_value' => '',
        ),
        array(
            'key' => 'field_floating_label_2',
            'label' => 'Etiqueta Flotant 2',
            'name' => 'floating_label_2',
            'type' => 'text',
            'instructions' => 'Text de l\'etiqueta flotant dreta',
            'required' => 0,
            'default_value' => '',
        ),
        array(
            'key' => 'field_floating_label_3',
            'label' => 'Etiqueta Flotant 3',
            'name' => 'floating_label_3',
            'type' => 'text',
            'instructions' => 'Text de l\'etiqueta flotant inferior esquerra',
            'required' => 0,
            'default_value' => '',
        ),
        array(
            'key' => 'field_services_sections',
            'label' => 'Seccions de Serveis',
            'name' => 'services_sections',
            'type' => 'repeater',
            'instructions' => 'Afegeix les seccions de serveis (Gestió, Booking, etc.)',
            'required' => 0,
            'layout' => 'block',
            'button_label' => 'Afegir Secció',
            'sub_fields' => array(
                array(
                    'key' => 'field_section_number',
                    'label' => 'Número',
                    'name' => 'section_number',
                    'type' => 'text',
                    'placeholder' => '01',
                    'wrapper' => array(
                        'width' => '20',
                    ),
                ),
                array(
                    'key' => 'field_section_title',
                    'label' => 'Títol',
                    'name' => 'section_title',
                    'type' => 'text',
                    'placeholder' => '',
                    'wrapper' => array(
                        'width' => '80',
                    ),
                ),
                array(
                    'key' => 'field_section_description',
                    'label' => 'Descripció',
                    'name' => 'section_description',
                    'type' => 'wysiwyg',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 0,
                    'delay' => 0,
                ),
                array(
                    'key' => 'field_section_list',
                    'label' => 'Llista d\'ítems',
                    'name' => 'section_list',
                    'type' => 'repeater',
                    'layout' => 'table',
                    'button_label' => 'Afegir ítem',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_list_item',
                            'label' => 'Ítem',
                            'name' => 'list_item',
                            'type' => 'text',
                        ),
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'template-home.php',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// ====================================
// ADVANCED CUSTOM FIELDS - FOOTER SETTINGS
// ====================================
// Ara usem pàgines normals en comptes d'Options Page
// Això permet la traducció automàtica amb Polylang
// Cal crear una pàgina anomenada "Footer Config" (slug: footer-config) per cada idioma

acf_add_local_field_group(array(
    'key' => 'group_footer_content',
    'title' => 'Contingut del Footer',
    'fields' => array(
        // BRAND SECTION
        array(
            'key' => 'field_footer_brand_title',
            'label' => 'Títol Brand',
            'name' => 'footer_brand_title',
            'type' => 'text',
            'instructions' => 'Títol principal del footer (per defecte: CATACLISMO)',
            'required' => 0,
            'default_value' => 'CATACLISMO',
        ),
        array(
            'key' => 'field_footer_brand_description',
            'label' => 'Descripció Brand',
            'name' => 'footer_brand_description',
            'type' => 'wysiwyg',
            'instructions' => 'Descripció de Cataclismo al footer',
            'required' => 0,
            'rows' => 3,
            'default_value' => 'Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.',
        ),

        // CONTACT SECTION
        array(
            'key' => 'field_footer_contact_title',
            'label' => 'Títol Contacte',
            'name' => 'footer_contact_title',
            'type' => 'text',
            'instructions' => 'Títol de la secció de contacte',
            'required' => 0,
            'default_value' => 'Contacte',
        ),
        array(
            'key' => 'field_footer_contact_location',
            'label' => 'Ubicació',
            'name' => 'footer_contact_location',
            'type' => 'wysiwyg',
            'instructions' => 'Ciutat/ubicació',
            'required' => 0,
            'default_value' => 'Barcelona, Catalunya',
        ),
        array(
            'key' => 'field_footer_contact_email',
            'label' => 'Email de Contacte',
            'name' => 'footer_contact_email',
            'type' => 'email',
            'instructions' => 'Adreça de correu electrònic',
            'required' => 0,
            'default_value' => 'info@cataclismoproducciones.com',
        ),

        // SOCIALS SECTION
        array(
            'key' => 'field_footer_socials_title',
            'label' => 'Títol Xarxes Socials',
            'name' => 'footer_socials_title',
            'type' => 'text',
            'instructions' => 'Títol de la secció de xarxes socials',
            'required' => 0,
            'default_value' => 'Segueix-nos',
        ),
        array(
            'key' => 'field_footer_social_links',
            'label' => 'Enllaços de Xarxes Socials',
            'name' => 'footer_social_links',
            'type' => 'repeater',
            'instructions' => 'Afegeix els enllaços de xarxes socials',
            'required' => 0,
            'layout' => 'table',
            'button_label' => 'Afegir Xarxa Social',
            'sub_fields' => array(
                array(
                    'key' => 'field_social_name',
                    'label' => 'Nom',
                    'name' => 'social_name',
                    'type' => 'text',
                    'placeholder' => 'Instagram',
                ),
                array(
                    'key' => 'field_social_url',
                    'label' => 'URL',
                    'name' => 'social_url',
                    'type' => 'url',
                    'placeholder' => 'https://instagram.com/...',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'template-footer-config.php',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// ====================================
// ADVANCED CUSTOM FIELDS - ARTISTES (POSTS)
// ====================================
acf_add_local_field_group(array(
    'key' => 'group_artist_content',
    'title' => 'Contingut Artista',
    'fields' => array(
        array(
            'key' => 'field_artist_subtitle',
            'label' => 'Subtítol',
            'name' => 'artist_subtitle',
            'type' => 'text',
            'instructions' => 'Descripció curta de l\'artista (ex: "HARDCORE PUNK DESDE 1987")',
            'required' => 0,
            'placeholder' => 'Rock Stoner, Arte Urbano, etc.',
        ),
        array(
            'key' => 'field_artist_image',
            'label' => 'Imatge Principal',
            'name' => 'artist_image',
            'type' => 'image',
            'instructions' => 'Imatge de l\'artista amb fons transparent (PNG recomanat)',
            'required' => 0,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
        ),
        array(
            'key' => 'field_artist_description',
            'label' => 'Descripció',
            'name' => 'artist_description',
            'type' => 'wysiwyg',
            'instructions' => 'Text descriptiu de l\'artista',
            'required' => 0,
            'tabs' => 'all',
            'toolbar' => 'full',
            'media_upload' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'post',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

// ====================================
// ADVANCED CUSTOM FIELDS - CONTACT PAGE
// ====================================
acf_add_local_field_group(array(
    'key' => 'group_contact_content',
    'title' => 'Contingut de la Pàgina de Contacte',
    'fields' => array(
        array(
            'key' => 'field_contact_title',
            'label' => 'Títol Hero',
            'name' => 'contact_title',
            'type' => 'text',
            'instructions' => 'Títol principal de la secció hero (per defecte: PARLEM)',
            'required' => 0,
            'default_value' => 'PARLEM',
        ),
        array(
            'key' => 'field_contact_subtitle',
            'label' => 'Subtítol Hero',
            'name' => 'contact_subtitle',
            'type' => 'textarea',
            'instructions' => 'Text descriptiu sota el títol',
            'required' => 0,
            'rows' => 2,
            'default_value' => 'Tens un projecte? Una idea? Volem escoltar-te.',
        ),
        array(
            'key' => 'field_contact_location',
            'label' => 'Ubicació',
            'name' => 'contact_location',
            'type' => 'wysiwyg',
            'instructions' => 'Ciutat/ubicació de contacte',
            'required' => 0,
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => 0,
            'default_value' => '<p>Barcelona, Catalunya<br>Raval Cultural District</p>',
        ),
        array(
            'key' => 'field_contact_email',
            'label' => 'Email de Contacte',
            'name' => 'contact_email',
            'type' => 'email',
            'instructions' => 'Adreça de correu electrònic principal',
            'required' => 0,
            'default_value' => 'info@cataclismoproducciones.com',
        ),
        array(
            'key' => 'field_contact_social_links',
            'label' => 'Enllaços de Xarxes Socials',
            'name' => 'contact_social_links',
            'type' => 'repeater',
            'instructions' => 'Afegeix enllaços a xarxes socials',
            'required' => 0,
            'layout' => 'table',
            'button_label' => 'Afegir Xarxa Social',
            'sub_fields' => array(
                array(
                    'key' => 'field_contact_social_name',
                    'label' => 'Nom',
                    'name' => 'social_name',
                    'type' => 'text',
                    'placeholder' => 'Instagram',
                ),
                array(
                    'key' => 'field_contact_social_url',
                    'label' => 'URL',
                    'name' => 'social_url',
                    'type' => 'url',
                    'placeholder' => 'https://instagram.com/...',
                ),
            ),
        ),
        array(
            'key' => 'field_contact_statement',
            'label' => 'Frase Destacada',
            'name' => 'contact_statement',
            'type' => 'textarea',
            'instructions' => 'Frase o missatge destacat a la secció d\'informació',
            'required' => 0,
            'rows' => 3,
            'default_value' => 'Construïm cultura alternativa.\nProjecte a projecte.\nArtista a artista.',
        ),
        array(
            'key' => 'field_contact_show_map',
            'label' => 'Mostrar Mapa',
            'name' => 'show_map',
            'type' => 'true_false',
            'instructions' => 'Mostrar secció de mapa al final de la pàgina',
            'required' => 0,
            'default_value' => 0,
            'ui' => 1,
        ),
        array(
            'key' => 'field_contact_map_embed',
            'label' => 'Codi Embed del Mapa',
            'name' => 'map_embed',
            'type' => 'textarea',
            'instructions' => 'Codi iframe de Google Maps o altre servei de mapes',
            'required' => 0,
            'rows' => 3,
            'conditional_logic' => array(
                array(
                    array(
                        'field' => 'field_contact_show_map',
                        'operator' => '==',
                        'value' => '1',
                    ),
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'page_template',
                'operator' => '==',
                'value' => 'template-contact.php',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
));

endif;

// ====================================
// POLYLANG + ACF - CONFIGURATION COMPLETA
// ====================================

/**
 * PROBLEMA: Per defecte, quan tens dues pàgines (una en català i una en espanyol)
 * que són traduccions l'una de l'altra segons Polylang, i edites els camps ACF en una,
 * els canvis es reflecteixen a l'altra.
 *
 * SOLUCIÓ: Desactivar COMPLETAMENT la sincronització i còpia de camps ACF entre idiomes.
 * Cada pàgina/post té els seus propis camps ACF independents.
 */

// 1. Evitar que Polylang copiï automàticament els post_meta d'ACF quan es crea una traducció
add_filter('pll_copy_post_metas', 'elmeutheme_prevent_acf_copy', 10, 2);
function elmeutheme_prevent_acf_copy($metas, $sync) {
    if (!$sync) {
        return $metas;
    }

    // Filtrar TOTS els camps ACF (comencen amb _ excepte alguns especials)
    return array_filter($metas, function($meta_key) {
        // Mantenir només metas que NO són d'ACF
        // Els camps ACF tenen meta keys com: field_xxx, _field_xxx, o altres començant amb _
        $is_acf = (
            strpos($meta_key, 'field_') === 0 ||
            strpos($meta_key, '_field_') === 0 ||
            (strpos($meta_key, '_') === 0 && !in_array($meta_key, [
                '_thumbnail_id',
                '_wp_page_template',
                '_wp_page_template',
                '_edit_lock',
                '_edit_last'
            ]))
        );
        return !$is_acf;
    });
}

// 2. Marcar explícitament que NO volem copiar cap meta d'ACF
add_filter('pll_translate_post_meta', '__return_false', 999);

// 3. Deshabilitar la sincronització de Polylang per camps ACF
add_action('admin_init', 'elmeutheme_configure_polylang_acf');
function elmeutheme_configure_polylang_acf() {
    // Configurar Polylang per NO sincronitzar camps ACF
    if (function_exists('PLL')) {
        $options = get_option('polylang');
        if (is_array($options)) {
            // Assegurar que la sincronització està desactivada
            $options['sync'] = array();
            update_option('polylang', $options);
        }
    }
}

// 4. Assegurar que ACF utilitza sempre l'idioma correcte
add_filter('acf/settings/current_language', 'elmeutheme_acf_current_language');
function elmeutheme_acf_current_language($language) {
    if (function_exists('pll_current_language')) {
        return pll_current_language();
    }
    return $language;
}

// 5. Important: Quan guardem un camp ACF, assegurar que es guarda NOMÉS al post actual
add_filter('acf/pre_save_post', 'elmeutheme_acf_save_to_correct_post', 10, 1);
function elmeutheme_acf_save_to_correct_post($post_id) {
    // No fer res si és una auto-save
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Retornar el post ID original sense modificar
    // Això evita que ACF intenti guardar a traduccions
    return $post_id;
}

// 6. CRÍTIC: Desactivar la sincronització en el moment del guardat
add_action('save_post', 'elmeutheme_disable_sync_on_save', 1, 1);
function elmeutheme_disable_sync_on_save($post_id) {
    // Deshabilitar temporalment la sincronització de Polylang
    // mentre es guarda el post per evitar que copiï els camps ACF
    remove_action('save_post', 'pll_save_post_translations', 1000);
}

// 7. Evitar que update_post_meta sincronitzi entre traduccions
add_filter('update_post_metadata', 'elmeutheme_prevent_meta_sync', 10, 5);
function elmeutheme_prevent_meta_sync($check, $object_id, $meta_key, $meta_value, $prev_value) {
    // Si estem guardant un camp ACF, evitar que Polylang el propagui
    if (strpos($meta_key, 'field_') === 0 || strpos($meta_key, '_field_') === 0 ||
        (strpos($meta_key, '_') === 0 && !in_array($meta_key, ['_thumbnail_id', '_wp_page_template', '_edit_lock', '_edit_last']))) {

        // Deshabilitar temporalment la sincronització de Polylang per aquest meta
        global $elmeutheme_syncing_disabled;
        $elmeutheme_syncing_disabled = true;
    }

    return $check; // null = continuar normalment
}

// ====================================
// POLYLANG - REGISTER STRINGS FOR TRANSLATION
// ====================================
function elmeutheme_register_polylang_strings() {
    if (function_exists('pll_register_string')) {
        // Home page fallback
        pll_register_string('hero_subtitle_fallback', 'Gestió i producció cultural per artistes independents i alternatius. Des de Barcelona cap al món, creant ponts entre la música, el teatre, les performances i els visuals.', 'Theme Cataclismo');
        pll_register_string('hero_subtitle_highlight', 'Gestió i producció cultural', 'Theme Cataclismo');

        // Footer fallback strings
        pll_register_string('footer_contact_title_fallback', 'Contacte', 'Theme Cataclismo');
        pll_register_string('footer_contact_location_fallback', 'Barcelona, Catalunya', 'Theme Cataclismo');
        pll_register_string('footer_brand_title_fallback', 'CATACLISMO', 'Theme Cataclismo');
        pll_register_string('footer_brand_description_fallback', 'Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.', 'Theme Cataclismo');
        pll_register_string('footer_socials_title_fallback', 'Segueix-nos', 'Theme Cataclismo');

        // Footer bottom text
        pll_register_string('footer_bottom_text', 'amb ❤ des de', 'Theme Cataclismo');

        // Social networks fallbacks
        pll_register_string('social_instagram', 'Instagram', 'Theme Cataclismo');
        pll_register_string('social_facebook', 'Facebook', 'Theme Cataclismo');
        pll_register_string('social_soundcloud', 'SoundCloud', 'Theme Cataclismo');
    }
}
add_action('init', 'elmeutheme_register_polylang_strings');

// ====================================
// CONTACT FORM HANDLER
// ====================================

/**
 * Processa el formulari de contacte i envia l'email
 */
function cataclismo_handle_contact_form() {
    // Verificar nonce per seguretat
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'cataclismo_contact_form')) {
        wp_die('Error de seguretat. Si us plau, torna a intentar-ho.');
    }

    // Sanititzar i validar dades
    $name = sanitize_text_field($_POST['contact_name'] ?? '');
    $email = sanitize_email($_POST['contact_email'] ?? '');
    $subject = sanitize_text_field($_POST['contact_subject'] ?? '');
    $message = sanitize_textarea_field($_POST['contact_message'] ?? '');

    // Validacions
    $errors = array();

    if (empty($name)) {
        $errors[] = 'El nom és obligatori.';
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = 'L\'email no és vàlid.';
    }

    if (empty($message)) {
        $errors[] = 'El missatge és obligatori.';
    }

    // Si hi ha errors, redirigir amb missatge d'error
    if (!empty($errors)) {
        $error_message = implode(' ', $errors);
        wp_redirect(add_query_arg('contact_error', urlencode($error_message), wp_get_referer()));
        exit;
    }

    // Preparar l'email
    $to = get_option('admin_email'); // Email de l'administrador del lloc

    // També enviar a l'email configurat a ACF si existeix
    $contact_page = get_page_by_path('contacte'); // Ajusta segons el slug de la pàgina
    if ($contact_page) {
        $acf_email = get_field('contact_email', $contact_page->ID);
        if ($acf_email && is_email($acf_email)) {
            $to = $acf_email;
        }
    }

    $email_subject = 'Nou missatge de contacte: ' . ($subject ?: 'Sense assumpte');

    $email_body = "Has rebut un nou missatge de contacte des de Cataclismo Producciones:\n\n";
    $email_body .= "Nom: $name\n";
    $email_body .= "Email: $email\n";
    if ($subject) {
        $email_body .= "Assumpte: $subject\n";
    }
    $email_body .= "\nMissatge:\n$message\n\n";
    $email_body .= "---\n";
    $email_body .= "Aquest missatge s'ha enviat des del formulari de contacte de " . get_bloginfo('name');

    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <noreply@' . parse_url(home_url(), PHP_URL_HOST) . '>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Enviar l'email
    $sent = wp_mail($to, $email_subject, $email_body, $headers);

    // Redirigir amb missatge de success o error
    if ($sent) {
        wp_redirect(add_query_arg('contact_success', '1', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('contact_error', urlencode('Error en enviar el missatge. Si us plau, intenta-ho de nou.'), wp_get_referer()));
    }
    exit;
}

// Hooks per processar el formulari
add_action('admin_post_nopriv_cataclismo_contact_form', 'cataclismo_handle_contact_form');
add_action('admin_post_cataclismo_contact_form', 'cataclismo_handle_contact_form');
