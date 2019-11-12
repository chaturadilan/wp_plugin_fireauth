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

define( 'ASSETS_VERSION', '1.0.8' );

class EnqueueController extends BaseController {

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    }

    function admin_enqueue() {
        wp_enqueue_style('fireauth_admin_styles', $this->plugin_url .'assets/css/admin_styles.css', null,ASSETS_VERSION );
        wp_enqueue_script( 'fireauth_admin_scripts', $this->plugin_url . 'assets/js/admin_scripts.js', array('jquery'), ASSETS_VERSION, true);

        wp_enqueue_script( 'fireauth_admintabs', $this->plugin_url . 'assets/js/admin_tabs.js' );
    }

    function enqueue() {
        wp_enqueue_style('fireauth_styles', $this->plugin_url .'assets/css/styles.css', null,ASSETS_VERSION );
        wp_enqueue_script('fireauth_scripts', $this->plugin_url .'assets/js/scripts.js', array('jquery'), ASSETS_VERSION, true );
    }


}