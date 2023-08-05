<header class="c-header">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <a href="<?= get_home_url(); ?>" class="c-logo" title="Home">BrightByte Theme</a>
            </div>
            <div class="col-auto">
                <nav role="navigation" class="c-navigation">
                    <?php wp_nav_menu(array('container' => 'ul', 'menu_class' => false, 'theme_location' => 'primary_navigation')); ?>
                </nav>
            </div>
        </div>
    </div>
</header>