<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Fireauth\Inc;

final class Init {

    static function get_services() {
        return [
            \Fireauth\Inc\Pages\Admin\AdminPage::class,
            \Fireauth\Inc\Controllers\EnqueueController::class,
            \Fireauth\Inc\Base\SettingLinks::class,
            \Fireauth\Inc\Controllers\RestAPIController::class,
            \Fireauth\Inc\Controllers\WidgetController::class
        ];
    }

    static function register_services() {
        foreach (self::get_services() as $class) {
            $service = new $class();
            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }
}