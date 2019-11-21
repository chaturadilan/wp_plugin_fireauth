<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Fireauth\Inc\Callbacks;

use Fireauth\Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
    public function checkboxSanitize( $input )
    {
        return ( isset($input) ? true : false );
    }

    public function textboxSanitize( $input )
    {
        return $input;
    }

    public function adminSectionManager()
    {
        echo 'Manage the Sections and Features of this Plugin by activating the checkboxes from the following list.';
    }
    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $checkbox = get_option( $name );
        echo '<input type="checkbox" name="' . $name . '" value="1" class="' . $classes . '" ' . ($checkbox ? 'checked' : '') . '>';
    }

    public function textboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $value = esc_attr(get_option($name));
        echo '<input type="text" name="' . $name . '" value="'. $value . '" class="' . $classes  . '">';
    }
}