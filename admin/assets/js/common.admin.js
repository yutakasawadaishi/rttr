/* common.admin.js */
//
'use strict';

jQuery(function($) {

    //
    function launchRTTR() {
        var rttr = new RTTR_ADMIN();
        rttr.requestDom();
    }
    $(function() {
        launchRTTR();
    });

    //
    function launchHidden() {
        $(document).on('click', '.js-hidden-button', function() {
            $(this).siblings('.js-hidden-item').toggleClass('js-hidden-active');
            return false;
        });
    }
    $(function() {
        launchHidden();
    });

});