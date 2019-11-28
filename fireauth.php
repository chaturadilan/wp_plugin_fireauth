<?php
/**
 * Plugin Name: FireAuth Plugin
 * Description: Plugin Firebase Authentication.
 * Version: 1.3.3
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

if (!defined('ABSPATH')) die;

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}


if (class_exists("Fireauth\\Inc\\Init")) {
    Fireauth\Inc\Init::register_services();
}

function activate_fireauth() {
    \Fireauth\Inc\Controllers\ActivateDeactivateController::activate();
}

function deactivate_fireauth() {
    \Fireauth\Inc\Controllers\ActivateDeactivateController::deactivate();
}