<?php
/**
 * The template for displaying all single posts
 *
 * @package Kaxim
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class('single-post'); ?> id="post-<?php the_ID(); ?>">

    <h1 class="single-title"><?php the_title(); ?></h1>

    <div class="single-meta">
        <time datetime="<?php echo esc_attr(get_the_date(DATE_W3C)); ?>"><?php echo esc_html(get_the_date('Y-m-d')); ?></time>
        <span class="sep">&middot;</span>
        <?php
        $categories = get_the_category_list(', ');
        if ($categories) {
            echo '<span class="cat-links">' . wp_kses_post($categories) . '</span>';
            echo '<span class="sep">&middot;</span>';
        }
        ?>
        <span class="reading-time"><?php echo esc_html(kaxim_reading_time()); ?></span>
    </div>

    <div class="single-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('页面：', KAXIM_DOMAIN),
            'after'  => '</div>',
        ));
        ?>
    </div>

    <?php
    $tags_list = get_the_tag_list('', '');
    if ($tags_list) :
    ?>
        <div class="post-tags">
            <span class="tags-label"><?php esc_html_e('标签：', KAXIM_DOMAIN); ?></span>
            <?php echo wp_kses_post($tags_list); ?>
        </div>
    <?php endif; ?>

</article>

<!-- 上下篇导航 -->
<nav class="post-nav" aria-label="<?php esc_attr_e('文章导航', KAXIM_DOMAIN); ?>">
    <div class="prev">
        <?php previous_post_link('%link', '&laquo; %title'); ?>
    </div>
    <div class="next">
        <?php next_post_link('%link', '%title &raquo;'); ?>
    </div>
</nav>

<?php
    // 如果评论开放或有评论，显示评论
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

endwhile;
?>

<?php get_footer(); ?>
