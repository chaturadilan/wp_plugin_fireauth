<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Fireauth\Inc\Controllers;

use Fireauth\Inc\Base\BaseController;
use Fireauth\Inc\Widgets\LoginWidget;

class WidgetController extends BaseController
{

    public function register()
    {
       $loginWidget = new LoginWidget();
       $loginWidget->register($this->plugin_path, $this->plugin_url);
    }

}
