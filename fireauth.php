<?php
/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Version: 1.0
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */


if (!defined('ABSPATH')) die;

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

register_activation_hook(__FILE__, 'activate_fireauth');
register_deactivation_hook(__FILE__, 'deactivate_fireauth');

if (class_exists("Inc\\Init")) {
    Inc\Init::register_services();
}

function activate_fireauth() {
    ActivateDeactivateController::activate();
}

function deactivate_fireauth() {
    ActivateDeactivateController::deactivate();
}