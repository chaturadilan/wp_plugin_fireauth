<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Base;

use Inc\Base\BaseController;

class Utils extends BaseController {

    public static function generate_unique_username($username)
    {
        $username = str_replace(' ', '', $username);
        $username = sanitize_title($username);
        static $i;
        if (null === $i) {
            $i = 1;
        } else {
            $i++;
        }
        if (!username_exists($username)) {
            return $username;
        }
        $new_username = sprintf('%s-%s', $username, $i);
        if (!username_exists($new_username)) {
            return $new_username;
        } else {
            return call_user_func(__FUNCTION__, $username);
        }
    }
}