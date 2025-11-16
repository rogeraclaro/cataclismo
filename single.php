<?php get_header(); ?>

<main class="single-post">
    <div class="container">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <span class="posted-on">
                            Publicat el <?php echo get_the_date(); ?>
                        </span>
                        <span class="byline">
                            per <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
                        <?php if (has_category()) : ?>
                            <span class="cat-links">
                                en <?php the_category(', '); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pàgines:', 'elmeutheme'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    if (has_tag()) {
                        the_tags('<div class="tags-links">Etiquetes: ', ', ', '</div>');
                    }
                    ?>
                </footer>
            </article>

            <?php
            // Navegació entre posts
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">← Article anterior</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">Article següent →</span> <span class="nav-title">%title</span>',
            ));

            // Comentaris
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
