/* rttr.admin.js */
//
'use strict';

//
var RTTR_ADMIN = function() {

    //
    var dataUrl = 'http://tautologii.com/rttr/admin/app/dom.php';

    //
    var config = {
        apiKey: '', // YOUR_API_KEY
        authDomain: 'myfirstfirebase-8a01a.firebaseapp.com',
        databaseURL: 'https://myfirstfirebase-8a01a.firebaseio.com',
        projectId: 'myfirstfirebase-8a01a',
        storageBucket: 'myfirstfirebase-8a01a.appspot.com',
        messagingSenderId: '796369966187'
    };
    firebase.initializeApp(config);

    //
    var userId = '';
    var ua = '';
    var ip = '';
    var remote = '';
    var date = '';
    var accesses = [];

    //
    this.requestDom = function() {
        firebase.database().ref('/users').on('child_changed', function(snapshot) {
            firebase.database().ref('/accesses').orderByChild('userId').equalTo(snapshot.val().userId).once('value', function(data) {
                userId = snapshot.val().userId;
                ua = snapshot.val().ua;
                ip = snapshot.val().ip;
                remote = snapshot.val().remote;
                date = snapshot.val().date;
                accesses = [];
                data.forEach(function(access) {
                    accesses.push({
                        'accessId': access.val().accessId,
                        'userId': access.val().userId,
                        'href': access.val().href,
                        'referrer': access.val().referrer,
                        'date': access.val().date,
                        'timestamp': access.val().timestamp
                    });
                });
                sendData();
            });
        });
    }

    //
    function sendData() {
        var data = {
            'userId': userId,
            'ua': ua,
            'ip': ip,
            'remote': remote,
            'date': date,
            'accesses': accesses
        }
        $.ajax({
            url: dataUrl,
            type: 'POST',
            data: data
        }).done(function(data) {
            var dom = $(data).hide();
            $('.js-items-container').prepend(dom);
            dom.fadeIn();
        });
    }
}
