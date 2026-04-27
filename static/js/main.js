/**
 * Kaxim Theme — 主脚本
 *
 * 功能：
 * 1. 主题切换（默认/护眼/夜晚）
 * 2. 移动端菜单
 * 3. 页面加载动画
 * 4. 滚动淡入动画
 *
 * @package Kaxim
 * @version 2.0.2
 */

(function () {
    'use strict';

    // ============================================
    // 页面加载动画
    // ============================================
    const PageLoader = {
        init: function () {
            document.body.classList.add('is-loading');

            window.addEventListener('load', function () {
                setTimeout(function () {
                    document.body.classList.remove('is-loading');
                }, 100);
            });
        }
    };

    // ============================================
    // 滚动淡入动画
    // ============================================
    const ScrollAnimation = {
        elements: null,
        observer: null,

        init: function () {
            this.elements = document.querySelectorAll('.post-item');

            if (!this.elements.length) return;

            // 使用 Intersection Observer 检测元素是否进入视口
            if ('IntersectionObserver' in window) {
                this.setupObserver();
            } else {
                // 降级处理：直接显示所有元素
                this.elements.forEach(function (el) {
                    el.classList.add('is-visible');
                });
            }
        },

        setupObserver: function () {
            var self = this;

            this.observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        self.observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            this.elements.forEach(function (el) {
                self.observer.observe(el);
            });
        }
    };

    // ============================================
    // 主题切换
    // ============================================
    const ThemeSwitcher = {
        storageKey: 'kaxim-theme',
        buttons: null,

        init: function () {
            this.buttons = document.querySelectorAll('.theme-btn');
            if (!this.buttons.length) return;

            // 根据存储的状态设置激活按钮
            var saved = localStorage.getItem(this.storageKey) || 'default';
            this.setActive(saved);

            // 绑定点击事件
            var self = this;
            this.buttons.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    var value = this.getAttribute('data-theme-value');
                    self.setTheme(value);
                });
            });
        },

        setTheme: function (value) {
            if (value === 'default') {
                document.documentElement.removeAttribute('data-theme');
                localStorage.removeItem(this.storageKey);
            } else {
                document.documentElement.setAttribute('data-theme', value);
                localStorage.setItem(this.storageKey, value);
            }
            this.setActive(value);
        },

        setActive: function (value) {
            this.buttons.forEach(function (btn) {
                var btnValue = btn.getAttribute('data-theme-value');
                if (btnValue === value) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
        }
    };

    // ============================================
    // 移动端菜单
    // ============================================
    const MobileMenu = {
        toggle: null,
        menu: null,
        isOpen: false,

        init: function () {
            this.toggle = document.querySelector('.menu-toggle');
            this.menu = document.querySelector('.site-nav ul');

            if (!this.toggle || !this.menu) return;

            var self = this;
            this.toggle.addEventListener('click', function () {
                self.toggleMenu();
            });

            // 点击外部关闭菜单
            document.addEventListener('click', function (e) {
                if (self.isOpen && !self.toggle.contains(e.target) && !self.menu.contains(e.target)) {
                    self.closeMenu();
                }
            });

            // ESC 关闭菜单
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && self.isOpen) {
                    self.closeMenu();
                }
            });

            // 桌面端始终显示菜单
            this.handleResize();
            window.addEventListener('resize', this.handleResize.bind(this));
        },

        toggleMenu: function () {
            if (this.isOpen) {
                this.closeMenu();
            } else {
                this.openMenu();
            }
        },

        openMenu: function () {
            this.menu.style.display = 'flex';
            this.toggle.setAttribute('aria-expanded', 'true');
            this.isOpen = true;
        },

        closeMenu: function () {
            this.menu.style.display = '';
            this.toggle.setAttribute('aria-expanded', 'false');
            this.isOpen = false;
        },

        handleResize: function () {
            if (window.innerWidth >= 768) {
                this.menu.style.display = '';
                this.toggle.style.display = 'none';
                this.isOpen = false;
            } else {
                this.toggle.style.display = 'none';
                this.menu.style.display = 'flex';
                this.isOpen = false;
            }
        }
    };

    // ============================================
    // 图片懒加载增强
    // ============================================
    const LazyLoad = {
        init: function () {
            // 为没有 loading 属性的图片添加懒加载
            var images = document.querySelectorAll('.single-content img:not([loading])');
            images.forEach(function (img) {
                if (!kaximIsInViewport(img)) {
                    img.setAttribute('loading', 'lazy');
                }
            });
        }
    };

    function kaximIsInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // ============================================
    // 外部链接新窗口打开
    // ============================================
    const ExternalLinks = {
        init: function () {
            var links = document.querySelectorAll('.single-content a[href^="http"]');
            links.forEach(function (link) {
                if (link.hostname !== window.location.hostname) {
                    link.setAttribute('target', '_blank');
                    link.setAttribute('rel', 'noopener noreferrer');
                }
            });
        }
    };

    // ============================================
    // 初始化
    // ============================================
    function init() {
        PageLoader.init();
        ScrollAnimation.init();
        ThemeSwitcher.init();
        MobileMenu.init();
        LazyLoad.init();
        ExternalLinks.init();
    }

    // DOM 就绪
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
