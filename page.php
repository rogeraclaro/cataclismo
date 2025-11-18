<?php get_header(); ?>

<!-- Page Container -->
<div class="page-container">
    <div class="page-content">
        <?php
        while (have_posts()) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="page-title"><?php the_title(); ?></h1>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php
        endwhile;
        ?>
    </div>
</div>

<?php get_footer(); ?>
