<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Controllers;

use Inc\API\FireAuthRestAPI;
use WP_REST_Controller;
use WP_REST_Server;

class RestAPIController extends WP_REST_Controller
{

    public $restAPI;

    public function register()
    {
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function __construct()
    {
        $this->restAPI = new FireAuthRestAPI();
        $this->namespace = 'fireauth/v1';
    }

    public function register_routes()
    {

        register_rest_route($this->namespace, '/' . 'auth', [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this->restAPI, 'auth'),
                'args' => array(
                    'type' => array(
                        'required' => true,
                        'validate_callback' => function($param) {
                            return in_array($param, ['google', 'facebook', 'email']);
                        }
                    ),
                ),
                'permission_callback' => array($this, 'permissions_check'),
            ]
        ]);

        register_rest_route($this->namespace, '/' . 'login', [
            [
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => array($this->restAPI, 'login'),
                'permission_callback' => array($this, 'permissions_check'),
            ]
        ]);

        register_rest_route($this->namespace, '/' . 'user_login', [
            [
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => array($this->restAPI, 'user_login'),
                'permission_callback' => array($this, 'permissions_check'),
            ]
        ]);

        register_rest_route($this->namespace, '/' . 'user_register', [
            [
                'methods' => WP_REST_Server::CREATABLE,
                'callback' => array($this->restAPI, 'user_register'),
                'permission_callback' => array($this, 'permissions_check'),
            ]
        ]);


    }

    public function permissions_check($request)
    {
        return true;
    }

}