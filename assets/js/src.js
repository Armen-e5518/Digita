deviceWidth = 0;
$(document).ready(function () {

    window.deviceWidth = $(window).width();
    if (window.deviceWidth > 550) {
        $('.sidebar').show();
    } else {
        $('.sidebar').hide();
    }
    $(window).resize(function () {
        window.deviceWidth = $(window).width();
        if (window.deviceWidth > 550) {
            $('.sidebar').show();
        } else {
            $('.sidebar').hide();
        }
    })


    if ($('.active').attr('data-product') != window.location.pathname.split('/')[3]) {
        var menu = window.location.pathname.split('/')[3];
        $('.active').removeClass('active');
        $('[data-product = ' + menu + ']').addClass('active');
    }

    $("#menu-close").on('click ', function (e) {
        e.preventDefault();
        $(this).toggleClass("close-ic");
        $("#sidebar-wrapper").toggleClass("active");

        var selectedEffect = "drop";

        var options = {};
        if (selectedEffect === "scale") {
            options = {percent: 50};
        } else if (selectedEffect === "size") {
            options = {to: {width: 200, height: 60}};
        }
        $("#sidebar").toggle(selectedEffect, options, 300);
        $('#menu-ba').toggle(300);
    });

    $("#menu-ba").swipe({
        swipeLeft: function () {
            $('#menu-ba').toggle(300);
            var selectedEffect = "drop";

            var options = {};
            if (selectedEffect === "scale") {
                options = {percent: 50};
            } else if (selectedEffect === "size") {
                options = {to: {width: 200, height: 60}};
            }
            $("#sidebar").toggle(selectedEffect, options, 300);
            $('#menu-close').toggleClass("close-ic");
            $("#sidebar-wrapper").toggleClass("active");
        }
    });

    $('#send-email').click(function () {

        if ($('#email-container').hasClass('opend')) {

            $('#email-container').slideUp().removeClass('opend');
            $('#send-email').find('.cls-1').removeClass('cls-1').addClass('cls-2');
        } else {
            $('#send-email').find('.cls-2').addClass('cls-1').removeClass('cls-2');
            $('#email-container').slideDown().addClass('opend');
            $('#email-container').slideDown().addClass('opend');

            $('#selected').find('.cls-1').removeClass('cls-1').addClass('cls-2');
            $('#selected .cart-euro').removeClass('active');
            $('#cart-container').slideUp().removeClass('opend');

            $('#language-sel').find('.cls-1').addClass('cls-2').removeClass('cls-1');
            $('#lang-container').slideUp().removeClass('opend');
        }
    });

    $('#language-sel').click(function () {

        if ($('#lang-container').hasClass('opend')) {

            $('#lang-container').slideUp().removeClass('opend');
            $('#language-sel').find('.cls-1').removeClass('cls-1').addClass('cls-2');
        } else {
            $('#language-sel').find('.cls-2').addClass('cls-1').removeClass('cls-2');
            $('#lang-container').slideDown().addClass('opend');


            $('#selected').find('.cls-1').removeClass('cls-1').addClass('cls-2');
            $('#selected .cart-euro').removeClass('active');
            $('#cart-container').slideUp().removeClass('opend');

            $('#send-email').find('.cls-1').removeClass('cls-1').addClass('cls-2');
            $('#email-container').slideUp().removeClass('opend');
        }
    });

    $('#selected').click(function (e) {
        e.preventDefault();
        if ($('#cart-container .cart-item').length) {
            if ($('#cart-container').hasClass('opend')) {
                $('#cart-container').slideUp().removeClass('opend');
                $('#selected').find('.cls-1').removeClass('cls-1').addClass('cls-2');
                $('#selected .cart-euro').removeClass('active');
            } else {
                $('#selected .cart-euro').addClass('active');
                $('#cart-container').slideDown().addClass('opend');
                $('#selected').find('.cls-2').removeClass('cls-2').addClass('cls-1');

                $('#send-email').find('.cls-1').removeClass('cls-1').addClass('cls-2');
                $('#email-container').slideUp().removeClass('opend');

                $('#language-sel').find('.cls-1').removeClass('cls-1').addClass('cls-2');
                $('#lang-container').slideUp().removeClass('opend');
            }
        }
    })


    $('#subscribe').click(function () {
        subscribe();
    });
    $('#email-subscibtion').keypress(function (e) {
        if (e.keyCode == 13) {
            subscribe();
        }
    });

});

$(document).on('click ', "#menu-toggle", function (e) {

    e.preventDefault();
    $(this).toggleClass("close-ic");
    $("#sidebar-wrapper").toggleClass("active");

});


$(document).on("click ", "#menu-preview", function () {

    if ($('.dishes-list').hasClass('hide')) {
        var prew = 0;
        $('.dishes-list').removeClass('hide');
        $('.dishes-preview').addClass('hide');
        $('.menu-preview #svg_prew').removeClass('cls-1');
        $('.menu-preview .svg_prew').removeClass('cls-1');
        $('.menu-preview #svg_prew').addClass('cls-2');
        $('.menu-preview .svg_prew').addClass('cls-2');
    } else {
        var prew = 1;
        $('.dishes-preview').removeClass('hide');
        $('.dishes-list').addClass('hide');
        $('.menu-preview #svg_prew').removeClass('cls-2');
        $('.menu-preview .svg_prew').removeClass('cls-2');
        $('.menu-preview #svg_prew').addClass('cls-1');
        $('.menu-preview .svg_prew').addClass('cls-1');
    }
});

$(document).on("click ", "#selected", function () {
    $("#button").click();
});
