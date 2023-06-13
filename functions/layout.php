<?php

/**
 * Add base.php File
 */

function custom_template_path()
{
    return Custom_Wrapping::$main_template;
}

function custom_template_base()
{
    return Custom_Wrapping::$base;
}

class Custom_Wrapping
{
    static $main_template;

    static $base;

    static function wrap($template)
    {
        self::$main_template = $template;
        self::$base = substr(basename(self::$main_template), 0, -4);
        if ('index' === self::$base)
            self::$base = false;
        $templates = array('base.php');
        if (self::$base)
            array_unshift($templates, sprintf('base-%s.php', self::$base));

        return locate_template($templates);
    }
}

add_filter('template_include', array('Custom_Wrapping', 'wrap'), 99);
