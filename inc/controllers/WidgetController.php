<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Controllers;

use Inc\Base\BaseController;
use Inc\Widgets\LoginWidget;

class WidgetController extends BaseController
{

    public function register()
    {
       $loginWidget = new LoginWidget();
       $loginWidget->register($this->plugin_path, $this->plugin_url);
    }

}
