<?php

/**
 * Gutenberg Blocks Setup
 */

$brightbyte_blocks = array(
    array(
        'name' => 'block-columns',
        'title' => 'Block Columns',
        'description' => 'A default columns block',
        'category' => 'brightbyte-blocks',
        'icon' => 'columns',
    ),
    array(
        'name' => 'block-cta',
        'title' => 'Block CTA',
        'description' => 'A default CTA block.',
        'category' => 'brightbyte-blocks',
        'icon' => 'megaphone'
    ),
    array(
        'name' => 'block-editor',
        'title' => 'Block Editor',
        'description' => 'A default editor block.',
        'category' => 'brightbyte-blocks',
        'icon' => 'edit',
    ),
    array(
        'name' => 'block-hero',
        'title' => 'Block Hero',
        'description' => 'A default hero block.',
        'category' => 'brightbyte-blocks',
        'icon' => 'align-full-width'
    ),
    array(
        'name' => 'block-image-text',
        'title' => 'Block Image Text',
        'description' => 'A default image text block.',
        'category' => 'brightbyte-blocks',
        'icon' => 'align-left',
    )
);

usort($brightbyte_blocks, function ($a, $b) {
    return $a['name'] <=> $b['name'];
});

/**
 * Create Custom Blocks
 */

function brightbyte_acf_init(): void
{
    if (function_exists('acf_register_block_type')) {
        global $brightbyte_blocks;
        if (is_array($brightbyte_blocks) || is_object($brightbyte_blocks)) {
            global $brightbyte_blocks;
            foreach ($brightbyte_blocks as $brightbyte_block) {
                acf_register_block_type(array(
                    'name' => $brightbyte_block['name'],
                    'title' => $brightbyte_block['title'],
                    'description' => $brightbyte_block['description'],
                    'keywords' => explode(' ', $brightbyte_block['description']),
                    'category' => $brightbyte_block['category'],
                    'render_callback' => 'brightbyte_block_render_callback',
                    'icon' => $brightbyte_block['icon'],
                    'mode' => 'edit',
                    'supports' => array('align', false),
                ));
            }
        }
    }
}

add_action('acf/init', 'brightbyte_acf_init');

/**
 * Create Custom Block Category
 */

function brightbyte_block_categories($categories, $post): array
{
    return array_merge(
        $categories,
        array(
            array(
                'title' => 'BrightByte Blocks',
                'slug' => 'brightbyte-blocks',
            ),
        )
    );
}

add_filter('block_categories', 'brightbyte_block_categories', 10, 2);

/**
 * Create Custom Block Render Callback
 */

function brightbyte_block_render_callback($block): void
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
    global $brightbyte_blocks;

    foreach ($brightbyte_blocks as $brightbyte_block) {
        $allowed_block_types[] = 'acf/' . $brightbyte_block['name'];
    }

    return $allowed_block_types;
}

add_filter('allowed_block_types', 'allow_block_types');
