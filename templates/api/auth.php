<body>
<script src="<?php echo $this->plugin_url . 'assets/js/firebase-app.js' ?>"></script>
<script src="<?php echo $this->plugin_url . 'assets/js/firebase-auth.js' ?>"></script>


<script>
    var firebaseConfig = {
        apiKey: "<?php echo $firebaseConfigs->apiKey; ?>",
        authDomain: "<?php echo $firebaseConfigs->authDomain; ?>",
        projectId: "<?php echo $firebaseConfigs->projectId; ?>",
        messagingSenderId: "<?php echo $firebaseConfigs->messagingSenderId; ?>",
        appId: "<?php echo $firebaseConfigs->appId; ?>",
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    <?php switch($type):
    case 'google': ?>
    var provider = new firebase.auth.GoogleAuthProvider();
    <?php break; ?>
    <?php case 'facebook': ?>
    var provider = new firebase.auth.FacebookAuthProvider();
    <?php break; ?>
    <?php endswitch; ?>

    firebase.auth().getRedirectResult().then(function (result) {
        if (result.credential == undefined) {
            firebase.auth().signInWithRedirect(provider);
        } else {

            firebase.auth().onAuthStateChanged((user) => {
                if (user) {
                    var data = JSON.stringify({userId: user.uid});
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'login', true);
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

</script>

</body>