<?php

function brightbyte_styles_and_scripts(): void
{
    // Include CSS File To Header With Cache Buster
    $cacheBuster = filemtime(get_template_directory() . '/build/css/main.css');
    wp_enqueue_style('main.css', get_template_directory_uri() . '/build/css/main.css', array(), $cacheBuster, null);

    // Remove default jQuery
    wp_deregister_script('jquery');

    // Remove Gutenberg Blocks CSS
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');

    // Include main.js File To Footer With Cache Buster
    $cacheBuster = filemtime(get_template_directory() . '/build/js/main.js');
    wp_enqueue_script('main', get_template_directory_uri() . '/build/js/main.js', array(), $cacheBuster, true);
}

add_action('wp_enqueue_scripts', 'brightbyte_styles_and_scripts');
