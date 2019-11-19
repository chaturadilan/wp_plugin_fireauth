<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Fireauth\Inc\Controllers;

use Fireauth\Inc\Base\BaseController;



class EnqueueController extends BaseController
{

    var $asset_version = '1.0.12';

    function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
    }

    function admin_enqueue()
    {
        wp_enqueue_style('fireauth_admin_styles', $this->plugin_url . 'assets/css/admin_styles.css', null, $this->asset_version);
        wp_enqueue_script('fireauth_admin_scripts', $this->plugin_url . 'assets/js/admin_scripts.js', array('jquery'), $this->asset_version, true);

        wp_enqueue_script('fireauth_admintabs', $this->plugin_url . 'assets/js/admin_tabs.js');

        wp_register_style('fireauth_dashicons', $this->plugin_url . 'assets/icos/css/fire.css');
        wp_enqueue_style('fireauth_dashicons');
    }

    function enqueue()
    {
        wp_enqueue_style('fireauth_styles', $this->plugin_url . 'assets/css/styles.css', null, $this->asset_version);
        wp_enqueue_script('fireauth_scripts', $this->plugin_url . 'assets/js/scripts.js', array('jquery'), $this->asset_version, true);
    }


}