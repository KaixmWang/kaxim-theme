<?php
/**
 * 404 template
 *
 * @package Kaxim
 */

get_header();
?>

<section class="error-404 not-found">
    <h1>404</h1>
    <p><?php esc_html_e('抱歉，您访问的页面不存在。', KAXIM_DOMAIN); ?></p>
    <?php get_search_form(); ?>
    <p><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('&laquo; 返回首页', KAXIM_DOMAIN); ?></a></p>
</section>

<?php get_footer(); ?>
