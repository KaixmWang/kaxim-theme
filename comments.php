<?php
/**
 * The template for displaying comments
 *
 * @package Kaxim
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
            printf(
                esc_html(_n('%s 条评论', '%s 条评论', $comment_count, KAXIM_DOMAIN)),
                esc_html(number_format_i18n($comment_count))
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 40,
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => '&laquo; ' . esc_html__('较旧评论', KAXIM_DOMAIN),
            'next_text' => esc_html__('较新评论', KAXIM_DOMAIN) . ' &raquo;',
        ));
        ?>

    <?php endif; ?>

    <?php
    // 如果评论已关闭
    if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
        <p class="no-comments"><?php esc_html_e('评论已关闭。', KAXIM_DOMAIN); ?></p>
    <?php endif; ?>

    <?php comment_form(array(
        'title_reply'          => esc_html__('发表评论', KAXIM_DOMAIN),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after'    => '</h3>',
        'comment_notes_before' => '',
        'label_submit'         => esc_html__('提交评论', KAXIM_DOMAIN),
        'class_submit'         => 'submit',
    )); ?>

</div>
