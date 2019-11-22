# Fireauth - Firebase Wordpress Plugin

Fireauth is a plugin that enables Firebase authentication in Wordpress

#### Features

* Facebook Authentication
* Google Authentication

#### Working on Progress
 * Email Authentication
 
### Steps to configure Fireauth
1. Create Firebase App on Firebase
2. Enable Facebook and Google Authentication in Firebase
3. Create a new Web Application in Firebase
4. Get the Firebase SDK snippet JSON. Fii in the values
```javascript
{
    "apiKey": "<API_KEY>",
    "authDomain": "<AUTH_DOMAIN>",
    "progjectId": "<PROJECT_ID>",
    "messagingSenderId": "<MESSAGE_SENDER_ID>",
    "appId": "<APP_ID>"
  }
```    
5. Go to FireAuth Settings
6. Copy the above JSON to *Firebase Config JSON* field
7. Go to Fireabase service account tab
8. Generate a new private key for the app
9. Copy the JSON inside the private key to *Firebase Service Config JSON* field
10. Enable Facebook Login and Google Login in the plugin settings
11. Add Fireauth Login Widget to your website from Widgets
12. That's All


#### About the Developer - Chatura Dilan Perera
Visit : https://www.dilan.me

#### License
GNU GENERAL PUBLIC LICENSE