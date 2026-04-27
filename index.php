<?php
/**
 * The main template file
 *
 * @package Kaxim
 */

get_header();
?>

<?php if (is_home() && !is_front_page()) : ?>
    <header class="page-header">
        <h1 class="page-title"><?php single_post_title(); ?></h1>
    </header>
<?php endif; ?>

<?php if (have_posts()) : ?>

    <ul class="post-list">
    <?php while (have_posts()) : the_post(); ?>
        <li <?php post_class('post-item'); ?>>
            <?php get_template_part('template-parts/content', get_post_format()); ?>
        </li>
    <?php endwhile; ?>
    </ul>

    <?php kaxim_pagination(); ?>

<?php else : ?>

    <?php get_template_part('template-parts/content', 'none'); ?>

<?php endif; ?>

<?php get_footer(); ?>
