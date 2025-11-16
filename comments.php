<?php
/**
 * The template for displaying comments
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('Un comentari', 'elmeutheme')
                );
            } else {
                printf(
                    esc_html(_n('%1$s comentari', '%1$s comentaris', $comment_count, 'elmeutheme')),
                    number_format_i18n($comment_count)
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation();

        if (!comments_open()) :
        ?>
            <p class="no-comments"><?php esc_html_e('Els comentaris estan tancats.', 'elmeutheme'); ?></p>
        <?php
        endif;

    endif;

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x('Comentari', 'noun', 'elmeutheme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" required="required"></textarea></p>',
        'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s read-more" value="%4$s" />',
    ));
    ?>

</div>
