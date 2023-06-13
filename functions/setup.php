<?php

/**
 * Theme Setup
 */

add_action('after_setup_theme', function () {
    register_nav_menus([
        'primary_navigation' => 'Primary Navigation',
        'secondary_navigation' => 'Secondary Navigation',
        'footer_navigation' => 'Footer Navigation',
        'legal_navigation' => 'Legal Navigation'
    ]);

    add_theme_support('post-thumbnails');
    add_post_type_support('page', 'excerpt');
    remove_theme_support('core-block-patterns');
});
