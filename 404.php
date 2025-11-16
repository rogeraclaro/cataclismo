<?php get_header(); ?>

<main>
    <div class="container">
        <article class="error-404 not-found">
            <header class="entry-header">
                <h1 class="entry-title">404 - Pàgina no trobada</h1>
            </header>

            <div class="entry-content">
                <p>Ho sentim, però la pàgina que cerques no existeix.</p>
                <p>Potser vols provar una cerca?</p>
                
                <?php get_search_form(); ?>
                
                <h2>Categories</h2>
                <ul>
                    <?php
                    wp_list_categories(array(
                        'orderby'    => 'count',
                        'order'      => 'DESC',
                        'show_count' => 1,
                        'title_li'   => '',
                        'number'     => 10,
                    ));
                    ?>
                </ul>

                <h2>Arxiu</h2>
                <ul>
                    <?php
                    wp_get_archives(array(
                        'type'  => 'monthly',
                        'limit' => 12,
                    ));
                    ?>
                </ul>
            </div>
        </article>
    </div>
</main>

<?php get_footer(); ?>
