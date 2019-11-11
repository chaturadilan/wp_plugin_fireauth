<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc;

final class Init {

    static function get_services() {
        return [
            Pages\Admin\AdminPage::class,
            Base\Enqueue::class,
            Base\SettingLinks::class,
            API\RestAPIController::class,
            Services\FireAuthService::class
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