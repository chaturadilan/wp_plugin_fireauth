<div class="wrap">
    <h1>Fire Auth Plugin</h1>
    <?php settings_errors(); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Manage Settings</a></li>
        <li><a href="#tab-2">About</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">

            <form method="post" action="options.php">
                <?php
                settings_fields( 'option_group_fireauth' );
                do_settings_sections( 'firebase_plugin' );
                submit_button();
                ?>
            </form>

        </div>

        <div id="tab-2" class="tab-pane">
            <h3>About</h3>
            This Fireauth plugin was developed by Chatura Dilan Perera Please contact me @ dilan@dilan.me. If you need any support
        </div>
    </div>
</div>