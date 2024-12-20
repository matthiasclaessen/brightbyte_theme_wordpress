<?php

/**
 * Default AJAX filter function
 */

function brightbyte_default_ajax_filter(): void
{
    $array_taxonomies = [];
    $category = $_POST["category"];

    if (!empty($category) && $category !== "") {
        $array_taxonomies = array(
            'taxonomy' => 'tax-products-kind',
            'field' => 'term_id',
            'terms' => $category,
        );
    }

    $product_args = array(
        'post_type' => 'cpt-products',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'order' => 'ASC',
    );

    if (!empty($array_taxonomies)) {
        $product_args = array(
            'post_type' => 'cpt-products',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                $array_taxonomies,
            ),
        );
    }

    $wp_query = new WP_Query($product_args);

    // Create ACF Query
    $products = get_posts(array(
        'post_type' => 'cpt-products',
        'posts_per_page' => -1,
        'meta_key' => 'product_price',
        'orderby' => 'meta_value',
        'order' => 'DESC',
        'tax_query' => array(
            'relation' => 'AND',
            $array_taxonomies,
        )
    ));
    ?>

    <section class="c-products py-3">
        <div class="container">
            <?php if ($products) : ?>
                <div class="row" id="products">
                    <?php foreach ($products as $product) : ?>
                        <?php setup_postdata($product) ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="product">
                                <h2 class="product__name">
                                    <?= $product->product_name ?>
                                </h2>
                                <p class="product__description">
                                    <?= $product->product_description ?>
                                </p>
                                <small class="product__price">
                                    €<?= $product->product_price ?>
                                </small>
                                <div class="product__cta">
                                    <a href="#" class="btn"><?= __('Lees Meer', 'brightbyte'); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
    </section>

    <!--//   --><?php //while ($wp_query->have_posts()) : $wp_query->the_post();
    ?>
    <!--        <div class="col-md-6 col-lg-4">-->
    <!--            <div class="product">-->
    <!--                <div class="product__image">-->
    <!--                    --><?php //the_post_thumbnail('medium', array('class' => 'img-fluid'));
    ?>
    <!--                </div>-->
    <!--                <div class="product__content">-->
    <!--                    <small class="content__id">--><?php //the_ID();
    ?><!--</small>-->
    <!--                    <h2>--><?php //the_title();
    ?><!--</h2>-->
    <!--                    <small class="content__excerpt">-->
    <!--                        --><?php //the_excerpt();
    ?>
    <!--                    </small>-->
    <!--                    <div class="product__cta">-->
    <!--                        <a href="--><?php //the_permalink();
    ?><!--"-->
    <!--                           class="btn">--><?php //= __('Lees Meer', 'brightbyte');
    ?><!--</a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    --><?php //endwhile;
    ?>
    <!---->
    <!--    --><?php //wp_reset_query();
//
//    exit();
}

add_action('wp_ajax_brightbyte_default_ajax_filter', 'brightbyte_default_ajax_filter');
add_action('wp_ajax_nopriv_brightbyte_default_ajax_filter', 'brightbyte_default_ajax_filter');