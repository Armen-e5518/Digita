setInterval(function () {
    location.reload();
}, (10 * 60 * 1000));

if (__Admin == 'User') {
    var orderNotificationAudio = new Audio('/assets/admin/audio/expect-good-news.mp3');

    var intrevalTime = 5000;
    $(document).ready(function () {
        setInterval(function () {
            checkTableNumbers()
        }, intrevalTime);
    });


    function checkTableNumbers() {
        $.ajax({
            type: "POST",
            url: '/admin/admin/check_table_numbers',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                if (data.length > 0) {
                    $.each(data, function (i, v) {
                        notifyMe(v.table_number, v);
                        if (i == data.length - 1) {
                            checkIsNew();
//                                $('#applyButton').attr('data-table-id', v.id);
                            $('#applyButton').attr('data-table-number', v.table_number);
                            $('#table-number').html(v.table_number)
                        }
                    })
                }
            }
        })
    }

    function notifyMe(table_number, val) {
        var img = '';
        var notification;
        if (val.bill_status == 1) {
            img = s_url + 'images/my-bill-please-icon.png'
        } else {
            img = s_url + 'images/le-garcon-icon.png'
        }
        var options = {
            body: 'New table number',
            tag: 'table-number' + table_number,
            icon: img
        };
        if (!("Notification" in window)) {
            alert("This browser does not support desktop notification");
        } else if (Notification.permission === "granted") {
            console.log('999');
            notification = new Notification("Table number " + table_number, options);
        }
        else if (Notification.permission == 'denied') {
            Notification.requestPermission(function (permission) {
                if (permission === "granted") {
                    console.log('666');
                    notification = new Notification("Table number " + table_number, options);
                }
            });
        }
        if (notification) {
            notification.onclick = function (event) {
                event.preventDefault();
                var win = window.open('/admin/order_table_numbers', '_self');
                win.focus();
            }
        } else {
            console.log('Nooo ')
        }

    }


    isOpendPopup = false;

    function checkIsNew() {
        orderNotificationAudio.play();
    }


    $('.confirm-m').click(function (event) {
        event.preventDefault();
        var table_number = $(this).attr('data-table-number');
//            var table_id = $(this).attr('data-table-id');
        $.ajax({
            type: 'GET',
            url: '/admin/admin/allow_table_numbers/' + __restaurant_id + '/' + table_number,
            success: function (data) {
                var win = window.open('/admin/order_table_numbers', '_self');
                win.focus();
                notification.close(notification);
            }
        })
    })
}