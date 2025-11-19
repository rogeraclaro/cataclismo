<!-- Footer -->
<footer class="site-footer">
    <?php
    // Obtenir la pàgina Footer Config de l'idioma actual
    $footer_page = get_page_by_path('footer-config');
    $footer_id = $footer_page ? $footer_page->ID : null;
    ?>
    <div class="footer-content">
        <!-- Footer Contacte Section -->
        <div class="footer-section baixa">
            <h3><?php
                $contact_title = $footer_id ? get_field('footer_contact_title', $footer_id) : null;
                echo $contact_title ?: (function_exists('pll__') ? pll__('Contacte') : 'Contacte');
            ?></h3>
            <?php
                $contact_location = $footer_id ? get_field('footer_contact_location', $footer_id) : null;
                echo $contact_location ?: (function_exists('pll__') ? pll__('Barcelona, Catalunya') : 'Barcelona, Catalunya');
            ?>
            <a href="mailto:<?php
                $contact_email = $footer_id ? get_field('footer_contact_email', $footer_id) : null;
                echo $contact_email ?: 'info@cataclismoproducciones.com';
            ?>">
                <?php echo $contact_email ?: 'info@cataclismoproducciones.com'; ?>
            </a>
        </div>

        <!-- Footer Brand Section -->
        <div class="footer-brand">
            <?php
                $footer_title = $footer_id ? get_field('footer_brand_title', $footer_id) : null;
                if (!$footer_title) {
                    $footer_title = function_exists('pll__') ? pll__('CATACLISMO') : 'CATACLISMO';
                }
            ?>
            <h2 class="hero-title" data-text="<?php echo esc_attr($footer_title); ?>"><?php echo $footer_title; ?></h2>
            <p class="puja"><?php
                $brand_desc = $footer_id ? get_field('footer_brand_description', $footer_id) : null;
                echo $brand_desc ?: (function_exists('pll__') ? pll__('Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.') : 'Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.');
            ?></p>
        </div>

        <!-- Footer Socials Section -->
        <div class="footer-section baixa">
            <h3><?php
                $socials_title = $footer_id ? get_field('footer_socials_title', $footer_id) : null;
                echo $socials_title ?: (function_exists('pll__') ? pll__('Segueix-nos') : 'Segueix-nos');
            ?></h3>
            <?php if ($footer_id && have_rows('footer_social_links', $footer_id)) : ?>
                <?php while (have_rows('footer_social_links', $footer_id)) : the_row(); ?>
                    <a href="<?php echo esc_url(get_sub_field('social_url')); ?>" target="_blank">
                        <?php echo esc_html(get_sub_field('social_name')); ?>
                    </a>
                <?php endwhile; ?>
            <?php else : ?>
                <a href="#" target="_blank"><?php echo function_exists('pll__') ? pll__('Instagram') : 'Instagram'; ?></a>
                <a href="#" target="_blank"><?php echo function_exists('pll__') ? pll__('Facebook') : 'Facebook'; ?></a>
                <a href="#" target="_blank"><?php echo function_exists('pll__') ? pll__('SoundCloud') : 'SoundCloud'; ?></a>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Cataclismo Producciones. By <a href="mailto:roger@masellas.info">Roger</a> <?php echo function_exists('pll__') ? pll__('amb ❤ des de') : 'amb ❤ des de'; ?> <a href="https://www.instagram.com/incivic_zone/" target="_blank">SFDC</a></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
