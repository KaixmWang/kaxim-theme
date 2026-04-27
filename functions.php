<?php
/**
 * Kaxim Theme — 主题函数
 *
 * @package Kaxim
 * @version 2.0.0
 */

if (!defined('KAXIM_VERSION')) {
    define('KAXIM_VERSION', '2.0.0');
}

if (!defined('KAXIM_DOMAIN')) {
    define('KAXIM_DOMAIN', 'kaxim');
}

/**
 * 主题设置
 */
function kaxim_setup() {
    // 标题标签
    add_theme_support('title-tag');

    // 自动 Feed 链接
    add_theme_support('automatic-feed-links');

    // 文章缩略图
    add_theme_support('post-thumbnails');

    // HTML5 标记
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));

    // 自定义 Logo
    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // 自定义背景
    add_theme_support('custom-background', array(
        'default-color' => 'FFFFFF',
    ));

    // 内容宽度
    if (!isset($content_width)) {
        $content_width = 720;
    }

    // 注册导航菜单
    register_nav_menus(array(
        'primary' => esc_html__('主导航', KAXIM_DOMAIN),
    ));

    // 加载翻译文件
    load_theme_textdomain(KAXIM_DOMAIN, get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'kaxim_setup');

/**
 * 加载脚本和样式
 */
function kaxim_scripts() {
    // 主样式表
    wp_enqueue_style('kaxim-style', get_stylesheet_uri(), array(), KAXIM_VERSION);

    // 主脚本
    wp_enqueue_script('kaxim-main', get_template_directory_uri() . '/static/js/main.js', array(), KAXIM_VERSION, true);

    // 传递数据给 JS
    wp_localize_script('kaxim-main', 'kaximData', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'themeUrl' => get_template_directory_uri(),
        'nonce'    => wp_create_nonce('kaxim_nonce'),
    ));

    // 评论回复脚本
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'kaxim_scripts');

/**
 * 注册侧边栏/小工具区域
 */
function kaxim_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('页脚小工具', KAXIM_DOMAIN),
        'id'            => 'footer-sidebar',
        'description'   => esc_html__('显示在页脚区域的小工具', KAXIM_DOMAIN),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'kaxim_widgets_init');

/**
 * 自定义摘录长度
 */
function kaxim_excerpt_length($length) {
    return 120;
}
add_filter('excerpt_length', 'kaxim_excerpt_length');

/**
 * 自定义摘取省略号
 */
function kaxim_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'kaxim_excerpt_more');

/**
 * 移除 WordPress 默认的 emoji 脚本（性能优化）
 */
function kaxim_disable_emoji() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'kaxim_disable_emoji');

/**
 * 移除 WordPress 默认嵌入脚本（性能优化）
 */
function kaxim_disable_embed() {
    wp_deregister_script('wp-embed');
}
add_action('wp_footer', 'kaxim_disable_embed');

/**
 * 移除 WordPress 版本号（安全措施）
 */
function kaxim_remove_version() {
    return '';
}
add_filter('the_generator', 'kaxim_remove_version');

/**
 * 自定义分页导航
 */
function kaxim_pagination() {
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'class'     => 'pagination',
    ));
}

/**
 * 文章元信息输出
 */
function kaxim_post_meta() {
    $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
    $time_string = sprintf(
        $time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date('Y-m-d'))
    );

    $categories = get_the_category_list(', ');

    echo '<div class="post-meta">';
    echo $time_string;

    if ($categories) {
        echo '<span class="sep">&middot;</span>';
        echo '<span class="cat-links">' . wp_kses_post($categories) . '</span>';
    }

    echo '</div>';
}

/**
 * 内联关键 JS：主题切换（防闪烁）
 * 必须在 <head> 中加载，避免页面闪烁
 */
function kaxim_inline_head_script() {
    ?>
    <script>
    (function(){
        var allowed_themes = ['default', 'eyecare', 'night'];
        var t = localStorage.getItem('kaxim-theme');
        if (t && allowed_themes.indexOf(t) !== -1) document.documentElement.setAttribute('data-theme', t);
    })();
    </script>
    <?php
}
add_action('wp_head', 'kaxim_inline_head_script', 1);

/**
 * 加载功能模块
 */
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/theme-functions.php';
