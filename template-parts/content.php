<?php
/**
 * Template part for displaying post content in lists
 *
 * @package Kaxim
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <h2 class="post-title">
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h2>

    <?php kaxim_post_meta(); ?>

    <?php if (has_excerpt()) : ?>
        <div class="post-excerpt">
            <?php the_excerpt(); ?>
        </div>
    <?php else : ?>
        <div class="post-excerpt">
            <?php echo esc_html(wp_trim_words(get_the_content(), 80, '...')); ?>
        </div>
    <?php endif; ?>

</article>
