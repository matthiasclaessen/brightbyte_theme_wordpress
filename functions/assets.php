<?php

function brightbyte_styles_and_scripts(): void
{
    // Include CSS file to header with cache buster
    $cacheBuster = filemtime(get_template_directory() . '/build/css/main.css');
    wp_enqueue_style('main', get_template_directory_uri() . '/build/css/main.css', array(), $cacheBuster, null);

    // Remove default jQuery
    wp_deregister_script('jquery');

    // Remove Gutenberg Blocks CSS
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    // Add PHP vars to main.js
    $vars = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'templateurl' => get_stylesheet_directory_uri(),
        'siteurl' => get_site_url()
    );

    wp_register_script('main-php-vars', '', null, null, array('in_footer' => true, 'strategy' => 'defer'));
    wp_enqueue_script('main-php-vars');

    wp_localize_script('main-php-vars', 'vars', $vars);

    // Include most recent version of jQuery
    wp_enqueue_script('jquery', '/wp-includes/js/jquery/jquery.js', false, get_bloginfo('version'), array('in_footer' => true, 'strategy' => 'defer'));

    // Include main.js file to footer with cache buster
    $cacheBuster = filemtime(get_template_directory() . '/build/js/main.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/build/js/main.js', array(), $cacheBuster, array('in_footer' => true, 'strategy' => 'defer'));
}

add_action('wp_enqueue_scripts', 'brightbyte_styles_and_scripts');
