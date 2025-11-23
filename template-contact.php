<?php
/**
 * Template Name: Contact Template
 * Description: Plantilla de contacte amb disseny brutalist-editorial
 */

get_header(); ?>

<!-- Contact Hero Section -->
<section class="contact-hero">
    <div class="contact-hero-content">
        <div class="contact-hero-label">
            <span class="contact-label-text"><?php echo function_exists('pll__') ? pll__('Contacta\'ns') : 'Contacta\'ns'; ?></span>
            <div class="contact-label-line"></div>
        </div>
        <h1 class="contact-hero-title" data-text="<?php echo get_field('contact_title') ?: 'PARLEM'; ?>">
            <?php echo get_field('contact_title') ?: 'PARLEM'; ?>
        </h1>
        <div class="contact-hero-subtitle">
            <?php
            $subtitle = get_field('contact_subtitle');
            echo $subtitle ? '<p>' . esc_html($subtitle) . '</p>' : '<p>Tens un projecte? Una idea? Volem escoltar-te.</p>';
            ?>
        </div>
    </div>

    <!-- Decorative element -->
    <div class="contact-hero-decoration">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
            <path d="M 0,100 Q 50,0 100,100 T 200,100" stroke="currentColor" fill="none" stroke-width="2"/>
        </svg>
    </div>
</section>

<!-- Contact Grid -->
<section class="contact-grid">
    <div class="contact-container">

        <!-- Contact Info -->
        <div class="contact-info">
            <div class="contact-info-block">
                <span class="contact-info-number">01</span>
                <h3 class="contact-info-title"><?php echo function_exists('pll__') ? pll__('On som') : 'On som'; ?></h3>
                <div class="contact-info-content">
                    <?php
                    $location = get_field('contact_location');
                    echo $location ? wp_kses_post($location) : '<p>Barcelona, Catalunya<br>Raval Cultural District</p>';
                    ?>
                </div>
            </div>

            <div class="contact-info-block">
                <span class="contact-info-number">02</span>
                <h3 class="contact-info-title"><?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?></h3>
                <div class="contact-info-content">
                    <?php
                    $email = get_field('contact_email') ?: 'info@cataclismoproducciones.com';
                    echo '<a href="mailto:' . esc_attr($email) . '" class="contact-email-link">' . esc_html($email) . '</a>';
                    ?>
                </div>
            </div>

            <div class="contact-info-block">
                <span class="contact-info-number">03</span>
                <h3 class="contact-info-title"><?php echo function_exists('pll__') ? pll__('Xarxes') : 'Xarxes'; ?></h3>
                <div class="contact-info-content contact-socials">
                    <?php
                    if (have_rows('contact_social_links')) :
                        while (have_rows('contact_social_links')) : the_row();
                            $social_name = get_sub_field('social_name');
                            $social_url = get_sub_field('social_url');
                            if ($social_name && $social_url) :
                    ?>
                        <a href="<?php echo esc_url($social_url); ?>" target="_blank" class="contact-social-link">
                            <?php echo esc_html($social_name); ?>
                        </a>
                    <?php
                            endif;
                        endwhile;
                    else :
                    ?>
                        <a href="#" class="contact-social-link">Instagram</a>
                        <a href="#" class="contact-social-link">Facebook</a>
                        <a href="#" class="contact-social-link">SoundCloud</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Decorative Text Block -->
            <div class="contact-statement">
                <?php
                $statement = get_field('contact_statement');
                echo $statement ? '<p>' . esc_html($statement) . '</p>' : '<p>Construïm cultura alternativa.<br>Projecte a projecte.<br>Artista a artista.</p>';
                ?>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-wrapper">
            <div class="contact-form-header">
                <h2 class="contact-form-title"><?php echo function_exists('pll__') ? pll__('Envia\'ns un missatge') : 'Envia\'ns un missatge'; ?></h2>
                <div class="contact-form-line"></div>
            </div>

            <form class="contact-form" id="cataclismo-contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="cataclismo_contact_form">
                <?php wp_nonce_field('cataclismo_contact_form', 'contact_nonce'); ?>

                <div class="form-group">
                    <label for="contact-name" class="form-label">
                        <?php echo function_exists('pll__') ? pll__('El teu nom') : 'El teu nom'; ?>
                        <span class="form-required">*</span>
                    </label>
                    <input
                        type="text"
                        id="contact-name"
                        name="contact_name"
                        class="form-input"
                        required
                        autocomplete="name"
                    >
                    <div class="form-input-line"></div>
                </div>

                <div class="form-group">
                    <label for="contact-email" class="form-label">
                        <?php echo function_exists('pll__') ? pll__('Email') : 'Email'; ?>
                        <span class="form-required">*</span>
                    </label>
                    <input
                        type="email"
                        id="contact-email"
                        name="contact_email"
                        class="form-input"
                        required
                        autocomplete="email"
                    >
                    <div class="form-input-line"></div>
                </div>

                <div class="form-group">
                    <label for="contact-subject" class="form-label">
                        <?php echo function_exists('pll__') ? pll__('Assumpte') : 'Assumpte'; ?>
                    </label>
                    <input
                        type="text"
                        id="contact-subject"
                        name="contact_subject"
                        class="form-input"
                    >
                    <div class="form-input-line"></div>
                </div>

                <div class="form-group">
                    <label for="contact-message" class="form-label">
                        <?php echo function_exists('pll__') ? pll__('Missatge') : 'Missatge'; ?>
                        <span class="form-required">*</span>
                    </label>
                    <textarea
                        id="contact-message"
                        name="contact_message"
                        class="form-textarea"
                        rows="6"
                        required
                    ></textarea>
                    <div class="form-input-line"></div>
                </div>

                <div class="form-submit-wrapper">
                    <button type="submit" class="form-submit-btn">
                        <span class="btn-text"><?php echo function_exists('pll__') ? pll__('ENVIAR') : 'ENVIAR'; ?></span>
                        <span class="btn-arrow">→</span>
                    </button>
                    <div class="form-submit-note">
                        <?php echo function_exists('pll__') ? pll__('Resposta en 24-48h') : 'Resposta en 24-48h'; ?>
                    </div>
                </div>

                <div class="form-message" id="form-message"></div>
            </form>
        </div>

    </div>
</section>

<!-- Map or Additional Section (optional) -->
<?php if (get_field('show_map')) : ?>
<section class="contact-map">
    <div class="contact-map-overlay">
        <div class="contact-map-label">BARCELONA</div>
    </div>
    <?php
    $map_embed = get_field('map_embed');
    if ($map_embed) {
        echo $map_embed;
    }
    ?>
</section>
<?php endif; ?>

<?php get_footer(); ?>
