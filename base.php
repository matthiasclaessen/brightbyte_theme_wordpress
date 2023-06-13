<!doctype html>
<html class="no-js" lang="<?php bloginfo('language'); ?>">

<head>
    <meta charset="utf-8">
    <?php if (!defined('WPSEO_VERSION')) : ?>
        <title><?php bloginfo('name') ?></title>
        <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php endif; ?>
    <meta name="author" content="<?php bloginfo('name') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Font(s) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
          rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body <?php body_class('custom-theme'); ?>>
<?php get_template_part('templates/core/header'); ?>
<main role="main">
    <?php include custom_template_path(); ?>
</main>
<?php get_template_part('templates/core/footer'); ?>
<?php wp_footer(); ?>
<div class="hidden">

</div>
</body>

</html>