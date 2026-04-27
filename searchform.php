<?php
/**
 * The search form template
 *
 * @package Kaxim
 */

?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field" class="screen-reader-text"><?php esc_html_e('搜索', KAXIM_DOMAIN); ?></label>
    <input type="search" id="search-field" class="search-field" placeholder="<?php echo esc_attr_x('搜索...', 'placeholder', KAXIM_DOMAIN); ?>" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x('搜索', 'submit button', KAXIM_DOMAIN); ?>" />
</form>
