<?php
/**
 * The footer for Kaxim theme
 *
 * @package Kaxim
 */

?>
    </main><!-- .site-main -->

    <footer class="site-footer" role="contentinfo">

        <!-- 主题切换器 -->
        <div class="theme-switcher">
            <div class="switcher-group">
                <span class="label"><?php esc_html_e('主题', KAXIM_DOMAIN); ?>:</span>
                <button class="switcher-btn theme-btn active" data-theme-value="default"><?php esc_html_e('默认', KAXIM_DOMAIN); ?></button>
                <span class="switcher-sep">|</span>
                <button class="switcher-btn theme-btn" data-theme-value="eyecare"><?php esc_html_e('护眼', KAXIM_DOMAIN); ?></button>
                <span class="switcher-sep">|</span>
                <button class="switcher-btn theme-btn" data-theme-value="night"><?php esc_html_e('夜晚', KAXIM_DOMAIN); ?></button>
            </div>
        </div>

        <!-- 版权信息 -->
        <div class="site-credit">
            &copy; <?php echo esc_html(date('Y')); ?>
            <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a>
            <span class="credit-sep">&nbsp;·&nbsp;</span>
            <span class="credit-design">Design By <a href="https://kaxim.wang/" target="_blank" rel="noopener noreferrer">Kaxim</a> & AI</span>
        </div>

    </footer>

</div><!-- .site-container -->

<?php wp_footer(); ?>
</body>
</html>
