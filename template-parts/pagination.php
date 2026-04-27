<?php
/**
 * Template part for displaying pagination
 *
 * @package Kaxim
 */

if (!function_exists('kaxim_pagination_render')) :

function kaxim_pagination_render() {
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
    ));
}

endif;
