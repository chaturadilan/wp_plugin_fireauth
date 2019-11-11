<?php

/**
 * Plugin Name: FireAuth Plugin
 * Plugin URI: http://www.dilan.me
 * Description: Plugin Firebase Authentication.
 * Author: Chatura Dilan
 * Author URI: http://www.dilan.me
 */

namespace Inc\Services;

use Inc\Base\BaseController;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FireAuthService extends BaseController
{

    private $auth;
    private $profile;
    private $password;

    public function register()
    {
        add_action('user_register', array($this, 'registerNewUser'));
        add_action('profile_update', array($this, 'profileUpdate'));
        add_action('after_password_reset', array($this, 'afterPasswordReset'));
        add_filter('random_password', array($this, 'generatedPasswordChanged'));

        $firebaseServiceConfigs = json_decode(get_option('txt_firebase_service_config_json'));
        $factory = (new Factory())
            ->withServiceAccount(ServiceAccount::fromJson(json_encode($firebaseServiceConfigs)));
        $this->auth = $factory->createAuth();
    }

    public function registerNewUser($userId)
    {
        $user = get_user_by('ID', $userId);
        try {
            $fbUser = $this->auth->createUserWithEmailAndPassword($user->data->user_email, $this->password);
            $this->password = "";
            update_user_meta($user->ID, 'firebaseID', $fbUser->uid);
            update_user_meta($user->ID, 'firebaseProfile', 'email');
        } catch (\Exception $ex) {
            //already registered
        }

    }

    function profileUpdate($userId)
    {
        $user = get_user_by('ID', $userId);
        $fbUserId = get_user_meta($user->ID, 'firebaseID', true);
        $this->auth->changeUserPassword($fbUserId, $_POST['pass1']);
    }

    function afterPasswordReset($user)
    {
        $fbUserId = get_user_meta($user->ID, 'firebaseID', true);
        $this->auth->changeUserPassword($fbUserId, $_POST['pass1']);
    }

    function generatedPasswordChanged($password) {
        $this->$password = $password;
    }


}
