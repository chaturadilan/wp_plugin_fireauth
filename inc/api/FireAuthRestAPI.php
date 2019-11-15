<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */


namespace Inc\API;

use Inc\Base\BaseController;
use Inc\Base\Utils;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use WP_Error;

class FireAuthRestAPI extends BaseController
{

    public function auth($request)
    {
        header('Content-Type: text/html');
        $type = $request->get_param('type');

        if(!get_option('chk_facebook') && $type == "facebook") {
            return new WP_Error( 'facebook_not_enabled', 'Facebook login is not enabled', array( 'status' => 403 ));
        }
        if(!get_option('chk_google') && $type == "google") {
            return new WP_Error( 'google_not_enabled', 'Google login is not enabled', array( 'status' => 403 ));
        }

        $firebaseConfigs = json_decode(get_option('txt_firebase_config_json'));
        $siteUrl = get_site_url();
        $pluginUrl = $this->plugin_url;
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
}
