#FireAuth Wordpress Plugin

Fireauth is a plugin that enables Firebase authentication in Wordpress

### Description

Fireauth is a plugin that enables Firebase authentication in Wordpress. It is an open source plugin.

#### Features

* Facebook Authentication
* Google Authentication

#### Working in Progress
 * Email Authentication
 
#### About the Developers
 Chatura Dilan Perera : https://www.dilan.me
 
 
 ###Installation
 
  1. Upload the plugin (unzipped) into /wp-content/plugins/.
  2. Activate the plugin under the “Plugins” menu.
  
 ### Steps to configure Fireauth
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