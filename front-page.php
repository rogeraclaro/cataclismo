<?php get_header(); ?>

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

    <!-- Scroll Arrow -->
    <div class="scroll-arrow" id="scroll-arrow">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 5V19M12 19L5 12M12 19L19 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
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

<?php get_footer(); ?>
