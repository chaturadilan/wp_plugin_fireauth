<?php

/**
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */


namespace Fireauth\Inc\API;

use Fireauth\Inc\Base\BaseController;
use Fireauth\Inc\Base\Utils;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use WP_Error;

class FireAuthRestAPI extends BaseController
{

    public function auth($request)
    {
        header('Content-Type: text/html');
        $type = $request->get_param('type');

        if (!get_option('chk_facebook') && $type == "facebook") {
            return new WP_Error('facebook_not_enabled', 'Facebook login is not enabled', array('status' => 403));
        }
        if (!get_option('chk_google') && $type == "google") {
            return new WP_Error('google_not_enabled', 'Google login is not enabled', array('status' => 403));
        }

        $firebaseConfigs = json_decode(get_option('txt_firebase_config_json'));
        $siteUrl = get_site_url();
        $pluginUrl = $this->plugin_url;
        wp_enqueue_script('fireauth_firebase_app', $this->plugin_url . 'assets/js/firebase-app.js');
        wp_enqueue_script('fireauth_firebase_auth', $this->plugin_url . 'assets/js/firebase-auth.js');
        wp_add_inline_script('fireauth_firebase_auth', '
            var firebaseConfig = {
                apiKey: "' . $firebaseConfigs->apiKey . '",
                authDomain: "' . $firebaseConfigs->authDomain . '",
                projectId: "' . $firebaseConfigs->projectId . '",
                messagingSenderId: "' . $firebaseConfigs->messagingSenderId . '",
                appId: "' . $firebaseConfigs->appId . '",
            };
        
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);       
        ', 'after');


        switch ($type) {
            case 'google':
                wp_add_inline_script('fireauth_firebase_auth', '
                    var provider = new firebase.auth.GoogleAuthProvider();
                ', 'after');
                break;
            case 'facebook' :
                wp_add_inline_script('fireauth_firebase_auth', '
                    var provider = new firebase.auth.FacebookAuthProvider();
                ', 'after');
                break;
        }

        wp_add_inline_script('fireauth_firebase_auth', '
                firebase.auth().getRedirectResult().then(function (result) {
                if (result.credential == undefined) {
                    firebase.auth().signInWithRedirect(provider);
                } else {
        
                    firebase.auth().onAuthStateChanged((user) => {
                        if (user) {
                            var data = JSON.stringify({userId: user.uid});
                            var xhr = new XMLHttpRequest();
                            xhr.open(\'POST\', \'login\', true);
                            xhr.onload = function () {
                                window.location.replace("<?php echo $siteUrl ?>");
                            };
                            xhr.send(data);
                        } else {
                            firebase.auth().signInWithRedirect(provider);
                        }
                    });
        
                }
            }).catch(function (error) {
                var errorCode = error.code;
                var errorMessage = error.message;
                var email = error.email;
                var credential = error.credential;
            });
        ', 'after');

        wp_print_scripts();
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
