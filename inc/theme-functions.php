<?php
/**
 * Kaxim Theme 辅助函数
 *
 * @package Kaxim
 */

/**
 * 计算文章阅读时间
 */
function kaxim_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = mb_strlen(strip_tags($content), 'UTF-8');
    // 中文阅读速度约 400-500 字/分钟
    $reading_time = max(1, ceil($word_count / 450));
    return sprintf(
        esc_html__('%d 分钟阅读', KAXIM_DOMAIN),
        $reading_time
    );
}

/**
 * 获取当前主题模式
 */
function kaxim_get_theme_mode() {
    return get_theme_mod('kaxim_theme_mode', 'default');
}

/**
 * 获取当前字体模式
 */
function kaxim_get_font_mode() {
    return get_theme_mod('kaxim_font_mode', 'sans');
}

/**
 * 输出页脚社交链接
 */
function kaxim_social_links() {
    $socials = array(
        'github'   => get_theme_mod('kaxim_github', ''),
        'twitter'  => get_theme_mod('kaxim_twitter', ''),
        'weibo'    => get_theme_mod('kaxim_weibo', ''),
    );

    $output = '';
    foreach ($socials as $name => $url) {
        if ($url) {
            $output .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer" class="social-link social-%s" aria-label="%s">%s</a>',
                esc_url($url),
                esc_attr($name),
                esc_attr(ucfirst($name)),
                esc_html(ucfirst($name))
            );
        }
    }

    if ($output) {
        echo '<div class="social-links">' . $output . '</div>';
    }
}

/**
 * 输出页脚附加信息
 */
function kaxim_footer_info() {
    $footer_text = get_theme_mod('kaxim_footer_text', '');
    $icp = get_theme_mod('kaxim_icp', '');

    if ($footer_text) {
        echo '<div class="footer-custom-text">' . wp_kses_post($footer_text) . '</div>';
    }

    if ($icp) {
        echo '<div class="footer-icp"><a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer">' . esc_html($icp) . '</a></div>';
    }
}
