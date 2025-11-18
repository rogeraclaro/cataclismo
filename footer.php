<!-- Footer -->
<footer class="site-footer">
    <div class="footer-content">
        <!-- Footer Brand Section -->
        <?php if (is_active_sidebar('footer-brand')) : ?>
            <?php dynamic_sidebar('footer-brand'); ?>
        <?php else : ?>
            <div class="footer-brand">
                <h2>CATACLISMO</h2>
                <p>Producciones culturals alternatives des de Barcelona. Gestionem artistes independents i creem ponts culturals entre continents.</p>
            </div>
        <?php endif; ?>

        <!-- Footer Contacte Section -->
        <?php if (is_active_sidebar('footer-contacte')) : ?>
            <?php dynamic_sidebar('footer-contacte'); ?>
        <?php else : ?>
            <div class="footer-section">
                <h3>Contacte</h3>
                <p>Barcelona, Catalunya</p>
                <a href="mailto:info@cataclismoproducciones.com">info@cataclismoproducciones.com</a>
            </div>
        <?php endif; ?>

        <!-- Footer Socials Section -->
        <?php if (is_active_sidebar('footer-socials')) : ?>
            <?php dynamic_sidebar('footer-socials'); ?>
        <?php else : ?>
            <div class="footer-section">
                <h3>Segueix-nos</h3>
                <a href="#" target="_blank">Instagram</a>
                <a href="#" target="_blank">Facebook</a>
                <a href="#" target="_blank">SoundCloud</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> Cataclismo Producciones. By <a href="mailto:roger@masellas.info">Roger</a> amb ❤ des de <a href="https://www.instagram.com/incivic_zone/" target="_blank">SFDC</a></p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
