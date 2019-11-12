<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\API;

use Inc\Base\BaseController;
use Inc\Base\Utils;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FireAuthRestAPI extends BaseController
{

    public function auth($request)
    {
        header('Content-Type: text/html');
        $type = $request->get_param('type');
        $firebaseConfigs = json_decode(get_option('txt_firebase_config_json'));
        $siteUrl = get_site_url();
        require_once($this->plugin_path . 'templates/api/auth.php');
        exit();
    }

    public function login($request)
    {
        header('Content-Type: text/html');
        $data = json_decode($request->get_body());

        $firebaseServiceConfigs = json_decode(get_option('txt_firebase_service_config_json'));
        $factory = (new Factory())
            ->withServiceAccount(ServiceAccount::fromJson(json_encode($firebaseServiceConfigs)));
        $auth = $factory->createAuth();

        $fbUser = $auth->getUser($data->userId);

        $user = get_user_by('email', $fbUser->email);
        if (!$user) {
            $user_id = wp_insert_user(['user_login' => Utils::generate_unique_username($fbUser->displayName),
                'user_pass' => wp_generate_password($length = 12, $include_standard_special_chars = false),
                'user_email' => $fbUser->email,
                'nickname' => $fbUser->displayName,
                'display_name' => $fbUser->displayName,
            ]);
            update_user_meta($user_id, 'firebaseID', $fbUser->uid);
            update_user_meta($user_id, 'firebaseProfile', $fbUser->providerData[0]->providerId);
            $user = get_user_by('email', $fbUser->email);
        }
        clean_user_cache($user->ID);
        wp_clear_auth_cookie();
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, true, false);
        update_user_caches($user);
        exit();
    }

    public function user_login($request)
    {
        $user = get_user_by('login', $_POST['username']);
        $isPasswordCorrect = wp_check_password($_POST['password'], $user->data->user_pass, $user->ID);
        if ($isPasswordCorrect) {
            clean_user_cache($user->ID);
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true, false);
            update_user_caches($user);
        }
        header("Location: " . get_site_url());
        exit();
    }

    public function user_register($request)
    {

        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $firebaseServiceConfigs = json_decode(get_option('txt_firebase_service_config_json'));
        $factory = (new Factory())
            ->withServiceAccount(ServiceAccount::fromJson(json_encode($firebaseServiceConfigs)));
        $auth = $factory->createAuth();
        $fbUser = $auth->createUserWithEmailAndPassword($email, $password);

        $user_id = wp_insert_user(['user_login' => $userName,
            'user_pass' => $password,
            'user_email' => $fbUser->email,
            'nickname' => $fbUser->displayName,
            'display_name' => $fbUser->displayName,
        ]);
        update_user_meta($user_id, 'firebaseID', $fbUser->uid);
        update_user_meta($user_id, 'firebaseProfile', $fbUser->providerData[0]->providerId);
        $user = get_user_by('email', $email);
        clean_user_cache($user->ID);
        wp_clear_auth_cookie();
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID, true, false);
        update_user_caches($user);


        header("Location: " . get_site_url());
        exit();
    }

}
