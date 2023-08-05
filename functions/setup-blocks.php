<?php

/**
 * Gutenberg Blocks Setup
 */

$custom_blocks = array(
    array(
        'name' => 'block-columns',
        'title' => 'Block Columns',
        'description' => 'A default columns block',
        'category' => 'custom-blocks',
        'icon' => 'columns',
    ),
    array(
        'name' => 'block-cta',
        'title' => 'Block CTA',
        'description' => 'A default CTA block.',
        'category' => 'custom-blocks',
        'icon' => 'megaphone'
    ),
    array(
        'name' => 'block-editor',
        'title' => 'Block Editor',
        'description' => 'A default editor block.',
        'category' => 'custom-blocks',
        'icon' => 'edit',
    ),
    array(
        'name' => 'block-hero',
        'title' => 'Block Hero',
        'description' => 'A default hero block.',
        'category' => 'custom-blocks',
        'icon' => 'align-full-width'
    ),
    array(
        'name' => 'block-image-text',
        'title' => 'Block Image Text',
        'description' => 'A default image text block.',
        'category' => 'custom-blocks',
        'icon' => 'align-left',
    )
);

usort($custom_blocks, function ($a, $b) {
    return $a['name'] <=> $b['name'];
});

/**
 * Create Custom Blocks
 */

function custom_acf_init(): void
{
    if (function_exists('acf_register_block_type')) {
        global $custom_blocks;
        if (is_array($custom_blocks) || is_object($custom_blocks)) {
            global $custom_blocks;
            foreach ($custom_blocks as $custom_block) {
                acf_register_block_type(array(
                    'name' => $custom_block['name'],
                    'title' => $custom_block['title'],
                    'description' => $custom_block['description'],
                    'keywords' => explode(' ', $custom_block['description']),
                    'category' => $custom_block['category'],
                    'render_callback' => 'custom_block_render_callback',
                    'icon' => $custom_block['icon'],
                    'mode' => 'edit',
                    'supports' => array('align', false),
                ));
            }
        }
    }
}

add_action('acf/init', 'custom_acf_init');

/**
 * Create Custom Block Category
 */

function custom_block_categories($categories, $post): array
{
    return array_merge(
        $categories,
        array(
            array(
                'title' => 'Custom Blocks',
                'slug' => 'custom-blocks',
            ),
        )
    );
}

add_filter('block_categories', 'custom_block_categories', 10, 2);

/**
 * Create Custom Block Render Callback
 */

function custom_block_render_callback($block): void
{
    $name = str_replace('acf/', '', $block['name']);

    if (file_exists(get_theme_file_path("/templates/blocks/{$name}.php"))) {
        include(get_theme_file_path("/templates/blocks/{$name}.php"));
    }
}

/**
 * Enable Only Custom Blocks
 */

function allow_block_types($allowed_block_types): array
{
    $allowed_block_types = array();
    global $custom_blocks;

    foreach ($custom_blocks as $custom_block) {
        $allowed_block_types[] = 'acf/' . $custom_block['name'];
    }

    return $allowed_block_types;
}

add_filter('allowed_block_types', 'allow_block_types');
