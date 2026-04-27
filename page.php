<?php
/**
 * The template for displaying all pages
 *
 * @package Kaxim
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
    <h1 class="single-title"><?php the_title(); ?></h1>
    <div class="single-content">
        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('页面：', KAXIM_DOMAIN),
            'after'  => '</div>',
        ));
        ?>
    </div>
</article>

<?php
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
endwhile;
?>

<?php get_footer(); ?>
