/* rttr.client.js */
//
'use strict';

//
jQuery(function() {

    //
    var dataUrl = 'http://tautologii.com/rttr/client/client.php';
    var expires = 30;

    //
    var userId;
    var created = false;

    //
    init();

    //
    function init() {
        userId = getCookie('RTTR_USER_ID');
        if (!userId) {
            userId = getUuId();
            created = true;
        }
        setCookie('RTTR_USER_ID', userId, expires);
        sendData();
    }

    //
    function sendData() {
        var data = {
            'userId': userId,
            'href': location.href,
            'referrer': document.referrer,
            'created': created
        }
        $.ajax({
            url: dataUrl,
            type: 'POST',
            data: data
        });
    }

    //
    function setCookie(key, value, day) {
        var date = new Date();
        date.setTime(date.getTime() + 1000 * 3600 * 24 * day);
        document.cookie = key + '=' + value + '; path=/;  expires=' + date.toUTCString();
    }

    function getCookie(key) {
        var r = null;
        var c = key + '=';
        var allCookies = document.cookie;
        var position = allCookies.indexOf(c);
        if (position != -1) {
            var startIndex = position + c.length;
            var endIndex = allCookies.indexOf(';', startIndex);
            if (endIndex == -1) {
                endIndex = allCookies.length;
            }
            r = decodeURIComponent(allCookies.substring(startIndex, endIndex));
        }
        return r;
    }

    function getUuId() {
        var uuid = '',
            i, random;
        for (i = 0; i < 32; i++) {
            random = Math.random() * 16 | 0;

            if (i == 8 || i == 12 || i == 16 || i == 20) {
                uuid += '-'
            }
            uuid += (i == 12 ? 4 : (i == 16 ? (random & 3 | 8) : random)).toString(16);
        }
        return uuid;
    }
});