jQuery(document).ready(function($) {


    if(!$("[name='chk_fireauth']").prop('checked')) {
        toggleDisableOptions(true);
    }

    $("[name='chk_fireauth']").bind('change', function(){
          toggleDisableOptions(!this.checked);
    });

    function toggleDisableOptions(disabled) {
        $("[name='chk_facebook']").attr("disabled", disabled);
        $("[name='chk_google']").attr("disabled", disabled);
    }

});