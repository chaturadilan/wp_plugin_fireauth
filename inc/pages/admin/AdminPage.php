<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Pages\Admin;


use Inc\Base\BaseController;
use Inc\Callbacks\ManagerCallbacks;
use Inc\Utils\SettingsUtils;

class AdminPage extends BaseController {

    public $settings;
    public $pages = array();
    public $subpages = array();
    public $callbackManager;

    public function register() {
        $this->settings = new SettingsUtils();
        $this->callbackManager = new ManagerCallbacks();
        $this->setPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages($this->pages)->withSubPage('Dashboard')->addSubPages($this->subpages)->register();

    }

    public function setPages() {

        $this->pages = [
            [
                'page_title' => 'FireAuth',
                'menu_title' => 'FireAuth',
                'capability' => 'manage_options',
                'menu_slug' => 'fireauth_plugin',
                'callback' => function () {
                    return require_once($this->plugin_path . 'templates/admin/options-general.php');
                },
                'icon_url' => 'dashicons-image-filter',
                'position' => 110
            ]
        ];
    }

    public function setSettings() {
        $args = [
            [
                'option_group' => 'option_group_fireauth',
                'option_name' => 'txt_firebase_service_config_json'
            ],
            [
                'option_group' => 'option_group_fireauth',
                'option_name' => 'txt_firebase_config_json'
            ],
            [
                'option_group' => 'option_group_fireauth',
                'option_name' => 'chk_facebook',
                'callback' => array( $this->callbackManager, 'checkboxSanitize' )
            ],
            [
                'option_group' => 'option_group_fireauth',
                'option_name' => 'chk_google',
                'callback' => array( $this->callbackManager, 'checkboxSanitize' )
            ]

        ];
        $this->settings->setSettings($args);
    }

    public function setSections() {
        $args = [
            [
                'id' => 'section_firebase',
                'title' => 'Firebase Config',
                'callback' => function () {
                },
                'page' => 'firebase_plugin'
            ],
            [
                'id' => 'section_enabled',
                'title' => 'Enable Options',
                'callback' => function () {
                },
                'page' => 'firebase_plugin'
            ],
        ];
        $this->settings->setSections($args);
    }

    public function setFields() {
        $args = [
            [
                'id' => 'txt_firebase_service_config_json',
                'title' => 'Firebase Service Config JSON',
                'callback' => function () {
                    $value = esc_attr(get_option('txt_firebase_service_config_json'));
                    echo '<textarea class="large-text" rows="10" name="txt_firebase_service_config_json">'
                        . $value . '</textarea>';
                },
                'page' => 'firebase_plugin',
                'section' => 'section_firebase',
            ],
            [
                'id' => 'txt_firebase_config_json',
                'title' => 'Firebase Config JSON',
                'callback' => function () {
                    $value = esc_attr(get_option('txt_firebase_config_json'));
                    echo '<textarea class="large-text" rows="10" name="txt_firebase_config_json">'
                        . $value . '</textarea>';
                },
                'page' => 'firebase_plugin',
                'section' => 'section_firebase',
            ],
            [
                'id' => 'chk_facebook',
                'title' => 'Enable Facebook Login',
                'callback' => array( $this->callbackManager, 'checkboxField' ),
                'page' => 'firebase_plugin',
                'section' => 'section_enabled',
                'args' => array(
                    'label_for' => 'chk_facebook',
                    'class' => 'ui-toggle'
                )
            ],
            [
                'id' => 'chk_google',
                'title' => 'Enable Google Login',
                'callback' => array( $this->callbackManager, 'checkboxField' ),
                'page' => 'firebase_plugin',
                'section' => 'section_enabled',
                'args' => array(
                    'label_for' => 'chk_google',
                    'class' => 'ui-toggle'
                )
            ]

        ];
        $this->settings->setFields($args);
    }

}