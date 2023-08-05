<?php

/**
 * Add base.php File
 */

function brightbyte_template_path()
{
    return Custom_Wrapping::$main_template;
}

function brightbyte_template_base(): string
{
    return Custom_Wrapping::$base;
}

class Custom_Wrapping
{
    static $main_template;

    static string $base;

    static function wrap($template): string
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
