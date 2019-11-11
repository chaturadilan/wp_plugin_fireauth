<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Base;

define( 'ASSETS_VERSION', '1.0.4' );

class Enqueue extends BaseController {

    function register() {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue() {
        wp_enqueue_style('fireauth_styles', $this->plugin_url .'assets/css/styles.css', null,ASSETS_VERSION );
        wp_enqueue_script( 'fireauth_scripts', $this->plugin_url . 'assets/js/scripts.js', array('jquery'), ASSETS_VERSION, true);

        wp_enqueue_script( 'fireauth_admintabs', $this->plugin_url . 'assets/js/admin_tabs.js' );
    }
}