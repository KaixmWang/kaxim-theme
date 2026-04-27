<?php
/**
 * The header for Kaxim theme
 *
 * @package Kaxim
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('跳转到内容', KAXIM_DOMAIN); ?></a>

<div class="site-container">

    <header class="site-header" role="banner">
        <?php if (has_custom_logo()) : ?>
            <div class="site-logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else : ?>
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </a>
            </h1>
        <?php endif; ?>

        <?php
        $description = get_bloginfo('description', 'display');
        if ($description || is_customize_preview()) :
        ?>
            <p class="site-description"><?php echo esc_html($description); ?></p>
        <?php endif; ?>
    </header>

    <nav class="site-nav" role="navigation" aria-label="<?php esc_attr_e('主导航', KAXIM_DOMAIN); ?>">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e('打开菜单', KAXIM_DOMAIN); ?>">
            <span class="menu-icon">&#9776;</span>
        </button>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'menu_id'        => 'primary-menu',
            'menu_class'     => 'nav-list',
            'container'      => false,
            'fallback_cb'    => function() {
                echo '<ul class="nav-list">';
                echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('首页', KAXIM_DOMAIN) . '</a></li>';
                echo '</ul>';
            },
        ));
        ?>
    </nav>

    <main id="main-content" class="site-main" role="main">
