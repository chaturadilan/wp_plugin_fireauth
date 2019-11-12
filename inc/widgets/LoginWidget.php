<?php


/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Widgets;

use Mustache_Engine;

class LoginWidget extends \WP_Widget
{

    private $widget_ID;
    private $widget_name;
    public $widget_options = array();
    public $control_options = array();
    private $plugin_path;
    private $plugin_url;

    function __construct() {
        $this->widget_ID = 'fireauth_login_widget';
        $this->widget_name = 'Fireauth Login Widget';
        $this->widget_options = array(
            'classname' => $this->widget_ID,
            'description' => $this->widget_name,
            'customize_selective_refresh' => true,
        );
        $this->control_options = array(
            'width' => 400,
            'height' => 350,
        );
    }


    public function register($plugin_path, $plugin_url)
    {
        $this->plugin_path = $plugin_path;
        $this->plugin_url = $plugin_url;
        parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );
        add_action( 'widgets_init', array( $this, 'initWidget' ) );
    }

    public function initWidget()
    {
        register_widget( $this );
    }

    public function widget( $args, $instance ) {
        $m = new Mustache_Engine();
        echo $m->render(file_get_contents($this->plugin_path . 'templates/widgets/login.mustache'),
            ['site_url' => get_site_url(), 'plugin_url' => $this->plugin_url]);
    }


}