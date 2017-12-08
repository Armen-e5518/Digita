<div>
    <div class="swiper-container">
        <div class="swiper-wrapper">

            <div class="content swiper-slide main" id="slide-id-0">
                <div class="menu-dishes">
                    <h2 class="title home_content_title_color"><?php echo $restaurant[0]['title'] ?></h2>
                    <?php echo $restaurant[0]['text'] ?>
                </div>
            </div>

            <?php if (!empty($products)): ?>
                <?php foreach ($products as $menu_items): ?>

                    <div class="content swiper-slide" id="slide-id-<?= $menu_items['id'] ?>">
                        <div class="menu-dishes">
                            <h2 class="title"
                                data-id="<? echo $menu_items['id'] ?>"><?php if ($target_menu) {
                                    echo $menu_items['title'];
                                } else {
                                    echo $menu_items['title'];
                                } ?>
                                <div class="clearfix"></div>
                            </h2>

                            <div class="dishes-list" id="dishes-list">
                                <ul>
                                    <?php if ($menu_items['products']): ?>
                                        <?php foreach ($menu_items['products'] as $product): ?>

                                            <li data-id="product_<?php echo $product['uid'] ?>"
                                                onclick="getItemInfo(<?php echo $product['id'] ?>)"
                                                id="product_<?php echo $product['uid'] ?>"
                                                class="select_list_li <?= isset($productsCount[$product['uid']]) ? 'chosen' : '' ?>">
                                                <em title="<?php echo $product['title'] ?>">
                                                    <span class="menu-item-title"><?php echo $product['title'] ?></span>
                                                    <span class="menu-item-price">&euro; <?php echo $product['price'] ?></span>
                                                </em>
                                                <div class="clear"></div>
                                            </li>


                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <?php if (empty($menu_items) && !empty($empty_page)): ?>
                                    <h2 style="direction: ltr;"><?php echo $empty_page[0]['value']; ?></h2>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endForeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<script src="/assets/js/swiper/dist/js/swiper.min.js"></script>
<script>

    addCountDown = 0;
    addCountDownTime = 60 * 10;
    menuLisForAdv = <?= json_encode(isset($menuLisForAdv) ? $menuLisForAdv : array()); ?>;

    $(document).ready(function () {
        swiper = new Swiper('.swiper-container', {
            paginationClickable: true,
            nextButton: '#swipe-next-menu',
            prevButton: '#swipe-prev-menu',
            stopPropagation: false,
            onInit: function (swiper) {
                swiper.slideTo(+$('#slide-id-<?= $sliderIndex ?>').index());
            },
            onSlideChangeEnd: function (swiper) {

                var title = $('.swiper-slide').eq(swiper.activeIndex).find('.title').text();
                var id = $('.swiper-slide').eq(swiper.activeIndex).attr('id').split('-')[2];
                $('.restaurant_menu a').removeClass('active');
                $(".restaurant_menu a[data-id='" + id + "']").addClass('active');


            }, onSlideNextEnd: function (swiper) {
                var title = $('.swiper-slide').eq(swiper.activeIndex).find('.title').text();
                var id = $('.swiper-slide').eq(swiper.activeIndex).attr('id').split('-')[2];

                if ($(".restaurant_menu a[data-id='" + id + "']").closest('li').hasClass('has-child')) {
                    swiper.slideTo(swiper.activeIndex + 1);
                }
            }, onSlidePrevEnd: function (swiper) {
                var title = $('.swiper-slide').eq(swiper.activeIndex).find('.title').text();
                var id = $('.swiper-slide').eq(swiper.activeIndex).attr('id').split('-')[2];

                if ($(".restaurant_menu a[data-id='" + id + "']").closest('li').hasClass('has-child')) {
                    swiper.slideTo(swiper.activeIndex - 1);
                }
            }

        });


        $('#icon-bell,.bottom-right-btn').click(function (e) {

            var html = '<div class="table-number-container">' +
                '<h3 class="h3-t-number"><?= translate('plase_write_table_number') ?></h3>' +
                '<div class="call-svg"></div>' +
                '<input type="number" id="table_number">' +
                '<input type="button" value="<?= translate('call') ?>" onclick="sendTableNumber()">' +
                '</div>';

            var bell = $('#icon-bell svg').clone();
            $('#popup-container .popup-content .popup-inner-content').html(html);
            $('.call-svg').html(bell);
            openPopup(true);
        })
    })


    function openPopup(bell) {
        if (bell) {
            popupCenter();
        } else {
            $('#popup-container .popup-content').css({
                "top": "5vh"
            });
        }
        $('#popup-container').fadeIn(500);
        if (bell) {
            $('#popup-container .popup-content').addClass('gray-popup');

        } else {
            $('#popup-container .popup-content').removeClass('gray-popup');

        }
    }

    function closePopup() {
        $('#popup-container').fadeOut(100);
    }

    function popupCenter() {
        popupContainer = $('#popup-container .popup-content');
        popupW = $(window).width();
        popupH = $(window).height();
        popupContainerW = popupContainer.width();
        popupContainerH = popupContainer.height();

        $('#popup-container .popup-content').css({
//            "left": ((popupW / 2) - (popupContainerW / 2) - 20) + "px",
            "top": ((((popupH - popupContainerH ) / 2 ) ) - 100) + "px"
        });
    }


    function getItemInfo(itemId) {
        $.ajax({
            type: "GET",
            url: "/home/get_item_info/" + itemId,
            dataType: 'html',
            success: function (data) {
                $('#popup-container .popup-content .popup-inner-content').html(data),
                    setTimeout(function () {
//                        popupCenter();
                    }, 400), openPopup();


            }
        })
    }

    function sendTableNumber() {
        var tableNumber = $('#table_number');
        if ($.trim(tableNumber.val()).length == 0) {
            tableNumber.addClass('err-border');

        } else if (isNaN(tableNumber.val())) {
            tableNumber.addClass('err-border');
        } else {
            tableNumber.removeClass('err-border');
            $.ajax({
                type: "POST",
                url: '/home/send_table_number',
                data: {tableNumber: tableNumber.val(), restaurant_id:<?= $restaurant_id ?>},
                dataType: 'json',
                success: function (data) {
                    if (!data.error) {
                        closePopup();
                    } else {

                    }
                }
            });
        }
    }

    $(document).ready(function () {

        $(window).resize(function () {
//            popupCenter();
        })
        $('.has-child > a').each(function (i, v) {
            var id = $(v).attr('data-id');
            $('#slide-id-' + id).html('');
        });
    })

    $(document).on('click', '.left-nav-menu.restaurant_menu a', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('dcjq-parent')) {
            menuIndex = +$('#slide-id-' + $(this).attr('data-id')).index();
            swiper.slideTo(menuIndex);
        }
    });

    $(document).on('click', 'img.logo', function (e) {
        e.preventDefault();
        swiper.slideTo(0);
    });

    $.cookie('dcjq-accordion', '', -1);

</script>
<div class="sidebar default-skin" id="sidebar">
    <div class="content">
        <ul class="left-nav-menu restaurant_menu">
            <?php echo $menu ?>
        </ul>
    </div>
</div>
</div>
<form action="<?php echo base_url() ?>selected/index" method="post">
    <input type="hidden" value='<?php if (!empty($products_num)) {
        echo $products_num;
    } else {
        echo "0";
    } ?>' name="selected_items_num" id="selected_items_num" style="display:none">
    <input type="text" id="slide_num" value="0">
</form>

</div>

<!--<div class="bottom-right-btn">-->
<!--    <svg width="48.75" height="40" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"-->
<!--         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"-->
<!--         viewBox="0 0 525.153 525.153" style="enable-background:new 0 0 525.153 525.153;" xml:space="preserve">-->
<!--                <path class="cls-1" d="M139.165,51.421l-35.776-35.864C43.413,61.202,3.742,132.185,0,212.402h50.174-->
<!--                    C53.916,145.992,88.051,87.766,139.165,51.421z M474.979,212.402h50.174c-3.742-80.217-43.413-151.2-103.586-196.845-->
<!--                    l-35.863,35.864C437.102,87.766,471.237,145.992,474.979,212.402z M425.592,224.984c0-77-53.391-141.463-125.424-158.487V49.408-->
<!--                    c0-20.787-16.761-37.614-37.592-37.614s-37.592,16.827-37.592,37.614v17.089C152.951,83.521,99.56,148.005,99.56,224.984v137.918-->
<!--                    l-50.152,50.108v25.076h426.336v-25.076l-50.152-50.108C425.592,362.902,425.592,224.984,425.592,224.984z M262.576,513.358-->
<!--                    c3.523,0,6.761-0.219,10.065-1.007c16.236-3.238,29.824-14.529,36.06-29.627c2.516-5.952,4.048-12.494,4.048-19.54H212.402-->
<!--                    C212.402,490.777,234.984,513.358,262.576,513.358z"/>-->
<!--            </svg>-->
<!--</div>-->

<div id="popup-container">
    <div class="popup-freez" onclick="closePopup()"></div>
    <div class="popup-content">
        <i class="fa fa-times popup-close" onclick="closePopup()"></i>
        <div class="popup-inner-content">

        </div>
    </div>
</div>

<script type="text/javascript">
    <?php if(!$this->isMobileDevice): ?>

    $(window).load(function () {
        $("#sidebar").mCustomScrollbar({
            scrollInertia: 100,
            updateOnContentResize: true
        });
        $(".dishes-list,.dishes-preview").mCustomScrollbar(
            {
                scrollInertia: 100,
                updateOnContentResize: true
            }
        );
        $(".menu-ad").mCustomScrollbar({
            scrollInertia: 100,
            updateOnContentResize: false
        });
    });
    <?php endif; ?>

    $('.swiper-slide').swipe({
        swipeRight: function (event, direction, distance, duration, fingerCount) {
        },
        swipeLeft: function (event, direction, distance, duration, fingerCount) {
        }
    });


</script>