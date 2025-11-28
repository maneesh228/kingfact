<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ( '1' === $comments_number ) {
                printf( _x( 'One comment on &ldquo;%s&rdquo;', 'comments title', 'kingfact' ), get_the_title() );
            } else {
                printf(
                    _nx(
                        '%1$s comment on &ldquo;%2$s&rdquo;',
                        '%1$s comments on &ldquo;%2$s&rdquo;',
                        $comments_number,
                        'comments title',
                        'kingfact'
                    ),
                    number_format_i18n( $comments_number ),
                    get_the_title()
                );
            }
            ?>
        </h3>

        <ul class="comment-list">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => 'kingfact_comment',
            ) );
            ?>
        </ul>

        <?php
        the_comments_pagination( array(
            'prev_text' => '<i class="fas fa-angle-left"></i> Previous',
            'next_text' => 'Next <i class="fas fa-angle-right"></i>',
        ) );
        ?>

    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'kingfact' ); ?></p>
    <?php endif; ?>

    <?php
    comment_form( array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'  => '</h3>',
        'class_submit'       => 'b-btn btn-black',
        'submit_button'      => '<button type="submit" class="b-btn btn-black"><span>%4$s</span></button>',
        'comment_field'      => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'kingfact' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
        'fields'             => array(
            'author' => '<p class="comment-form-author"><label for="author">' . __( 'Name', 'kingfact' ) . ' <span class="required">*</span></label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required /></p>',
            'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'kingfact' ) . ' <span class="required">*</span></label><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" required /></p>',
            'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website', 'kingfact' ) . '</label><input id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
        ),
    ) );
    ?>

</div><!-- #comments -->
