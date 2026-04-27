<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Kaxim
 */

?>

<section class="no-results not-found">
    <h1 class="page-title"><?php esc_html_e('没有找到内容', KAXIM_DOMAIN); ?></h1>

    <div class="page-content">
        <?php if (is_search()) : ?>
            <p><?php esc_html_e('抱歉，没有找到与您搜索匹配的内容。请尝试其他关键词。', KAXIM_DOMAIN); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php esc_html_e('似乎没有找到您要的内容。请尝试搜索。', KAXIM_DOMAIN); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>
