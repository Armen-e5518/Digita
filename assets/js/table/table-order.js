function sendTableNumber(bill) {
    if (_Table_index && _Restaurant_id) {
        $.ajax({
            type: "POST",
            url: '/home/send_table_number',
            data: {
                tableNumber: _Table_index,
                restaurant_id: _Restaurant_id,
                bill: bill
            },
            dataType: 'json',
            success: function (data) {
                if (data) {
                    IconsHide()
                }
            }
        });
    }
}

function IconsHide() {
    $('.choice-to-do').hide();
    $('.timer').show();
    var timer = 10;
    var inte = setInterval(function () {
        $('.timer').html(--timer);
        if (timer == 0) {
            clearInterval(inte);
            $('.choice-to-do').show();
            $('.timer').hide();
        }
    }, 1000)
}