<?php

/**
 * Default AJAX filter function
 */

function brightbyte_default_ajax_filter(): void
{
    $array_taxonomies = [];
    $kind = $_POST["select_kind"];

    var_dump($kind);

    if (!empty($kind)) {
        $array_taxonomies = array(
            'taxonomy' => 'kind',
            'field' => 'term_id',
            'terms' => $kind,
            'operator' => 'IN'
        );
    }

    $args_options = array(
        'post_type' => 'cpt-products',
        'posts_per_page' => -1,
        'tax_query' => array(
            'relation' => 'AND',
            $array_taxonomies,
        ),
    );

    $wp_query = new WP_Query($args_options);

    while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
        <div class="col-sm-6 col-lg-4">
            <div class="c-news__item">
                <h2 class="item__title"><?php the_title(); ?></h2>
                <?php the_excerpt() ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?= __('Lees artikel', 'brightbyte'); ?></a>
            </div>
        </div>
    <?php endwhile; ?>
    <?php wp_reset_query();
    exit();
}

add_action('wp_ajax_brightbyte_default_ajax_filter', 'brightbyte_default_ajax_filter');
add_action('wp_ajax_nopriv_brightbyte_default_ajax_filter', 'brightbyte_default_ajax_filter');