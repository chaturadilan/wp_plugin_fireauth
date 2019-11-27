=== Fireauth Wordpress Plugin ===
Contributors: bcdilan
Donate link: https://www.dilan.me
Tags: firebase, auth, social
Requires at least: 4.6
Tested up to: 5.3
Stable tag: 1.3.2
Requires PHP: 7.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Fireauth is a plugin that enables Firebase authentication in Wordpress

== Description ==

Fireauth is a plugin that enables Firebase authentication in Wordpress. It is an open source plugin.
You can get the source from Github: https://github.com/chaturadilan/wp_plugin_fireauth

#### Features

* Facebook Authentication
* Google Authentication

#### Working in Progress
 * Email Authentication
 
#### About the Developers
Chatura Dilan Perera : https://www.dilan.me
 
== Installation ==

 1. Upload the plugin (unzipped) into /wp-content/plugins/.
 2. Activate the plugin under the “Plugins” menu.
 
#### Steps to configure Fireauth
1. Create Firebase App on Firebase.
2. Enable Facebook and Google Authentication in Firebase.
3. Create a new Web Application in Firebase.
4. Get the Firebase SDK snippet JSON. Fii in the values.
```javascript
{
    "apiKey": "<API_KEY>",
    "authDomain": "<AUTH_DOMAIN>",
    "progjectId": "<PROJECT_ID>",
    "messagingSenderId": "<MESSAGE_SENDER_ID>",
    "appId": "<APP_ID>"
  }
```    
5. Go to FireAuth Settings.
6. Copy the above JSON to *Firebase Config JSON* field.
7. Go to Fireabase service account tab.
8. Generate a new private key for the app.
9. Copy the JSON inside the private key to *Firebase Service Config JSON* field.
10. Enable Facebook Login and Google Login in the plugin settings.
11. Add Fireauth Login Widget to your website from Widgets.
12. Login with Facebook and Google.

== Frequently Asked Questions ==

= Where to contact adding more features to this plugin =

Please visit and contact the author of the plugin

== Screenshots ==

1. Fireauth Wordpress Plugin Configurations
1. Fireauth Login Widget

== Changelog ==

= 1.3.2 =
* Fixing bugs

= 1.3.0 =
* Adding icons, readme changes

= 1.3.0 =
* Releasing the first stable version of the plugin