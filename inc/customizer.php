<?php
/**
 * Kaxim Theme Customizer
 *
 * @package Kaxim
 */

/**
 * 注册 Customizer 设置
 */
function kaxim_customize_register($wp_customize) {

    // === 社交链接区域 ===
    $wp_customize->add_section('kaxim_social', array(
        'title'       => esc_html__('社交链接', KAXIM_DOMAIN),
        'description' => esc_html__('设置社交媒体链接，留空则不显示', KAXIM_DOMAIN),
        'priority'    => 35,
    ));

    // GitHub
    $wp_customize->add_setting('kaxim_github', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('kaxim_github', array(
        'label'   => esc_html__('GitHub', KAXIM_DOMAIN),
        'section' => 'kaxim_social',
        'type'    => 'url',
    ));

    // Twitter / X
    $wp_customize->add_setting('kaxim_twitter', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('kaxim_twitter', array(
        'label'   => esc_html__('Twitter / X', KAXIM_DOMAIN),
        'section' => 'kaxim_social',
        'type'    => 'url',
    ));

    // 微博
    $wp_customize->add_setting('kaxim_weibo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('kaxim_weibo', array(
        'label'   => esc_html__('微博', KAXIM_DOMAIN),
        'section' => 'kaxim_social',
        'type'    => 'url',
    ));

    // === 页脚设置 ===
    $wp_customize->add_section('kaxim_footer', array(
        'title'    => esc_html__('页脚设置', KAXIM_DOMAIN),
        'priority' => 40,
    ));

    // 页脚自定义文本
    $wp_customize->add_setting('kaxim_footer_text', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('kaxim_footer_text', array(
        'label'       => esc_html__('页脚附加文本', KAXIM_DOMAIN),
        'description' => esc_html__('支持 HTML，显示在版权信息下方', KAXIM_DOMAIN),
        'section'     => 'kaxim_footer',
        'type'        => 'textarea',
    ));

    // 备案号
    $wp_customize->add_setting('kaxim_icp', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ));
    $wp_customize->add_control('kaxim_icp', array(
        'label'   => esc_html__('ICP 备案号', KAXIM_DOMAIN),
        'section' => 'kaxim_footer',
        'type'    => 'text',
    ));
}
add_action('customize_register', 'kaxim_customize_register');

/**
 * Customizer 预览 JS
 */
function kaxim_customize_preview_js() {
    wp_enqueue_script('kaxim-customizer', get_template_directory_uri() . '/static/js/customizer.js', array('customize-preview'), KAXIM_VERSION, true);
}
add_action('customize_preview_init', 'kaxim_customize_preview_js');
