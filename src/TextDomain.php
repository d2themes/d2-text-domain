<?php

namespace D2\Theme;

class TextDomain extends Component
{
    const DOMAIN = 'domain';
    const PATH   = 'path';

    public function init()
    {
        if ( array_key_exists( self::DOMAIN, $this->config ) ) {
            $load_function = $this->get_load_function();
            $path          = $this->get_path();
            $load_function( $this->config[ self::DOMAIN ], $path );
        }
    }

    /**
     * Return the appropriate load function.
     *
     * If this component is being used in a child theme, then we should
     * use load_child_theme_textdomain(), or if it's a standalone theme
     * then it should be load_theme_textdomain().
     *
     * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
     * @link https://developer.wordpress.org/reference/functions/load_child_theme_textdomain/
     *
     * @return string
     */
    protected function get_load_function(): string
    {
        return is_child_theme() ? 'load_child_theme_textdomain' : 'load_theme_textdomain';
    }

    /**
     * Return the path to language files.
     *
     * The default path for language files is /languages. If a different
     * path has been defined in config then we'll use that, otherwise fall
     * back to the default.
     *
     * @return string
     */
    protected function get_path(): string
    {
        return $this->config[self::PATH] ?? get_stylesheet_directory() . '/languages';
    }
}
