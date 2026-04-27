<?php
/**
 * Custom template tags for Kaxim theme
 *
 * @package Kaxim
 */

if (!function_exists('kaxim_posted_on')) :
    /**
     * 输出文章发布日期 HTML
     */
    function kaxim_posted_on() {
        $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date('Y-m-d'))
        );
        echo $time_string;
    }
endif;

if (!function_exists('kaxim_posted_by')) :
    /**
     * 输出文章作者 HTML
     */
    function kaxim_posted_by() {
        echo '<span class="byline"><span class="author vcard"><a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" rel="author">' . esc_html(get_the_author()) . '</a></span></span>';
    }
endif;

if (!function_exists('kaxim_entry_footer')) :
    /**
     * 输出文章底部元信息（标签、编辑链接）
     */
    function kaxim_entry_footer() {
        // 标签
        if ('post' === get_post_type()) {
            $tags_list = get_the_tag_list('', '');
            if ($tags_list) {
                echo '<div class="post-tags">' . wp_kses_post($tags_list) . '</div>';
            }
        }

        // 编辑链接
        edit_post_link(
            sprintf(
                esc_html__('编辑 %s', KAXIM_DOMAIN),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

if (!function_exists('kaxim_post_thumbnail')) :
    /**
     * 输出文章缩略图 HTML
     */
    function kaxim_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
        ?>
            <div class="post-thumbnail">
                <?php the_post_thumbnail('large'); ?>
            </div>
        <?php else : ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php the_post_thumbnail('medium', array('alt' => the_title_attribute(array('echo' => false)))); ?>
            </a>
        <?php
        endif;
    }
endif;
