/**
 * Kaxim Theme Customizer Live Preview
 *
 * @package Kaxim
 */

(function ($) {
    'use strict';

    // 社交链接
    wp.customize('kaxim_github', function (value) {
        value.bind(function (newVal) {
            var link = $('.social-github');
            if (newVal) {
                if (link.length) {
                    link.attr('href', newVal);
                }
            } else {
                link.remove();
            }
        });
    });

    wp.customize('kaxim_twitter', function (value) {
        value.bind(function (newVal) {
            var link = $('.social-twitter');
            if (newVal) {
                if (link.length) {
                    link.attr('href', newVal);
                }
            } else {
                link.remove();
            }
        });
    });

    wp.customize('kaxim_weibo', function (value) {
        value.bind(function (newVal) {
            var link = $('.social-weibo');
            if (newVal) {
                if (link.length) {
                    link.attr('href', newVal);
                }
            } else {
                link.remove();
            }
        });
    });

    // 页脚文本
    wp.customize('kaxim_footer_text', function (value) {
        value.bind(function (newVal) {
            var el = $('.footer-custom-text');
            if (newVal) {
                if (el.length) {
                    el.html(newVal);
                } else {
                    $('.site-credit').after('<div class="footer-custom-text">' + newVal + '</div>');
                }
            } else {
                el.remove();
            }
        });
    });

    // ICP 备案号
    wp.customize('kaxim_icp', function (value) {
        value.bind(function (newVal) {
            var el = $('.footer-icp');
            if (newVal) {
                if (el.length) {
                    el.html('<a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer">' + newVal + '</a>');
                } else {
                    $('.site-credit').after('<div class="footer-icp"><a href="https://beian.miit.gov.cn/" target="_blank" rel="noopener noreferrer">' + newVal + '</a></div>');
                }
            } else {
                el.remove();
            }
        });
    });

})(jQuery);
