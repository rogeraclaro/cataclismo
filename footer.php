<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <!-- Footer Contacte Section -->
        <div class="footer-section baixa">
            <h3><?php echo get_field('footer_contact_title', 'option') ?: 'Contacte'; ?></h3>
            <?php echo get_field('footer_contact_location', 'option') ?: 'Barcelona, Catalunya'; ?>
            <a href="mailto:<?php echo get_field('footer_contact_email', 'option') ?: 'info@cataclismoproducciones.com'; ?>">
                <?php echo get_field('footer_contact_email', 'option') ?: 'info@cataclismoproducciones.com'; ?>
            </a>
        </div>

        <!-- Footer Brand Section -->
        <div class="footer-brand">
            <?php $footer_title = get_field('footer_brand_title', 'option') ?: 'CATACLISMO'; ?>
            <h2 class="hero-title" data-text="<?php echo esc_attr($footer_title); ?>"><?php echo $footer_title; ?></h2>
            <p class="puja"><?php echo get_field('footer_brand_description', 'option') ?: 'Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.'; ?></p>
        </div>

        <!-- Footer Socials Section -->
        <div class="footer-section baixa">
            <h3><?php echo get_field('footer_socials_title', 'option') ?: 'Segueix-nos'; ?></h3>
            <?php if (have_rows('footer_social_links', 'option')) : ?>
                <?php while (have_rows('footer_social_links', 'option')) : the_row(); ?>
                    <a href="<?php echo esc_url(get_sub_field('social_url')); ?>" target="_blank">
                        <?php echo esc_html(get_sub_field('social_name')); ?>
                    </a>
                <?php endwhile; ?>
            <?php else : ?>
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">Facebook</a>
                <a href="#" target="_blank">SoundCloud</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Cataclismo Producciones. By <a href="mailto:roger@masellas.info">Roger</a> amb ❤ des de <a href="https://www.instagram.com/incivic_zone/" target="_blank">SFDC</a></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
