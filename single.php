<?php get_header(); ?>

<!-- Artist Page -->
<main class="artist-page">
    <?php
    while (have_posts()) :
        the_post();

        // Get ACF fields
        $subtitle = get_field('artist_subtitle');
        $artist_image = get_field('artist_image');
        $description = get_field('artist_description');
    ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('artist-content'); ?>>

        <!-- Artist Title -->
        <div class="artist-header">
            <h1 class="artist-title"><?php the_title(); ?></h1>
        </div>

        <!-- Artist Image -->
        <?php if ($artist_image) : ?>
        <div class="artist-image-container">
            <img src="<?php echo esc_url($artist_image['url']); ?>"
                 alt="<?php echo esc_attr($artist_image['alt'] ?: get_the_title()); ?>"
                 class="artist-image">
        </div>
        <?php endif; ?>

        <!-- Artist Subtitle -->
        <?php if ($subtitle) : ?>
        <div class="artist-subtitle">
            <h2><?php echo esc_html($subtitle); ?></h2>
        </div>
        <?php endif; ?>

        <!-- Artist Description (if exists) -->
        <?php if ($description) : ?>
        <div class="artist-description">
            <?php echo wp_kses_post($description); ?>
        </div>
        <?php endif; ?>

        <!-- Navigation between artists -->
        <div class="artist-navigation">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>

            <?php if ($prev_post) : ?>
            <a href="<?php echo get_permalink($prev_post); ?>" class="nav-link nav-prev">
                <span class="nav-arrow">←</span>
                <span class="nav-label"><?php echo esc_html($prev_post->post_title); ?></span>
            </a>
            <?php endif; ?>

            <?php if ($next_post) : ?>
            <a href="<?php echo get_permalink($next_post); ?>" class="nav-link nav-next">
                <span class="nav-label"><?php echo esc_html($next_post->post_title); ?></span>
                <span class="nav-arrow">→</span>
            </a>
            <?php endif; ?>
        </div>

    </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
