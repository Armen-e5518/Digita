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

                                <a id="menu-preview" class="menu-preview"
                                   data-id="<?php if ($prew = $this->session->userdata('prew')) {
                                       echo $prew['prew'];
                                   } else {
                                       echo 0;
                                   } ?>" href="javascript:void(0);">

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         preserveAspectRatio="xMidYMid" width="30" height="20"
                                         viewBox="0 0 65 39">
                                        <defs>
                                        </defs>
                                        <path id="svg_prew"
                                              d="M64.541,20.898 C64.408,21.082 61.118,25.492 55.532,29.916 C52.229,32.528 48.793,34.616 45.330,36.125 C40.925,38.029 36.467,39.000 32.062,39.000 C20.944,39.000 10.330,32.949 0.525,20.990 C-0.152,20.150 -0.178,18.968 0.459,18.102 C0.591,17.918 3.882,13.508 9.468,9.084 C12.771,6.471 16.207,4.384 19.670,2.875 C24.075,0.971 28.533,-0.000 32.938,-0.000 C44.056,-0.000 54.657,6.065 64.475,18.010 C65.151,18.850 65.178,20.032 64.541,20.898 ZM32.924,4.739 C24.433,4.739 17.163,9.071 12.546,12.707 C9.255,15.306 6.801,17.918 5.461,19.480 C13.952,29.299 22.894,34.274 32.062,34.274 C40.553,34.274 47.824,29.942 52.441,26.306 C55.731,23.720 58.186,21.095 59.526,19.533 C51.035,9.714 42.092,4.739 32.924,4.739 ZM32.487,30.586 C26.304,30.586 21.289,25.611 21.289,19.507 C21.289,13.403 26.304,8.427 32.487,8.427 C33.800,8.427 34.875,9.491 34.875,10.790 C34.875,12.090 33.800,13.153 32.487,13.153 C28.944,13.153 26.065,16.002 26.065,19.507 C26.065,23.011 28.944,25.860 32.487,25.860 C36.029,25.860 38.908,23.011 38.908,19.507 C38.908,18.207 39.983,17.144 41.296,17.144 C42.610,17.144 43.685,18.207 43.685,19.507 C43.685,25.611 38.669,30.586 32.487,30.586 Z"
                                              class="cls-2"/>
                                    </svg>
                                </a>
                                <div class="clearfix"></div>
                            </h2>

                            <div class="dishes-list" id="dishes-list">
                                <ul>
                                    <?php if ($menu_items['products']): ?>
                                        <?php foreach ($menu_items['products'] as $product): ?>

                                            <li data-id="product_<?php echo $product['uid'] ?>"
                                                id="product_<?php echo $product['uid'] ?>"
                                                class="select_list_li <?= isset($productsCount[$product['uid']]) ? 'chosen' : '' ?>">
                                                <span>&euro; <?php echo $product['price'] ?></span>
                                                <em title="<?php echo $product['title'] ?>"><?php echo $product['title'] ?>
                                                    <span class="prod_count"><?= isset($productsCount[$product['uid']]) ? '(' . $productsCount[$product['uid']] . ')' : '' ?></span>
                                                </em>
                                                <?php if (isset($product['compound']) && $product['compound'] != 'null' && strlen(trim($product['compound']))): ?>
                                                    <sub><?= $product['compound']; ?></sub>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <?php if (empty($menu_items) && !empty($empty_page)): ?>
                                    <h2 style="direction: ltr;"><?php echo $empty_page[0]['value']; ?></h2>
                                <?php endif; ?>
                            </div>
                            <div class="dishes-preview hide" id="dishes-preview">
                                <ul>
                                    <?php if ($menu_items['products']): ?>
                                        <?php foreach ($menu_items['products'] as $product): ?>

                                            <li data-id="product_<?php echo $product['uid'] ?>"
                                                id="product_preview_<?php echo $product['uid'] ?>"
                                                class="select_preview_li <?= isset($productsCount[$product['uid']]) ? 'chosen' : '' ?>">
                                                <div>
                                                    <img class="product_img" src="<?php
                                                    if (!empty($product['item_image'])) {
                                                        echo base_url() . $product['item_image'];
                                                    } else {
                                                        echo base_url() . 'uploads/no_image.jpg';
                                                    }
                                                    ?>" alt="">
                                                    <span><?php echo $product['title'] ?></span>
                                                    <sub> <?php if ($product['compound'] && $product['compound'] != 'null') echo "(" . $product['compound'] . ")"; ?> </sub>
                                                    <strong>&euro; <?php echo $product['price'] ?>
                                                        <span class="prod_count"><?= isset($productsCount[$product['uid']]) ? '(' . $productsCount[$product['uid']] . ')' : '' ?></span>
                                                    </strong>
                                                </div>
                                            </li>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </ul>
                                <?php if (empty($menu_items['products']) && !empty($empty_page)): ?>
                                    <h2 style="direction: ltr;"><?php echo $empty_page[0]['value']; ?></h2>
                                <?php endif; ?>
                            </div>


                            <?php if (isset($advertisement) && !empty($advertisement)): ?>
                                <?php if ($adv = getAdv($menu_items['id'], $advertisement)): ?>
                                    <div class="menu-ad-inner">

                                        <span class="close-ad" onclick="closeAdd(this)">
                                            <svg width="25" version="1.1" xmlns="http://www.w3.org/2000/svg" height="25"
                                                 viewBox="0 0 64 64" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 enable-background="new 0 0 64 64">
                                                <path fill="#1D1D1B" class="close-add-svg"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59   c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59   c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0   L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z"/>
                                            </svg>
                                        </span>
                                        <div class="menu-ad">
                                            <div class="ad-holder">
                                                <?php echo $adv; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

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
                $('#menu_title').text(title);


                if (!menuLisForAdv[swiper.activeIndex]) {
                    $('.swiper-slide').eq(swiper.activeIndex).find('.menu-ad-inner').fadeIn(300);
                    menuLisForAdv[swiper.activeIndex] = addCountDownTime;
                }

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
    })

    setInterval(function () {
        for (row in menuLisForAdv) {
            if (menuLisForAdv[row]) {
                menuLisForAdv[row]--;
            }
        }
    }, 1000)


    $(document).ready(function () {
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

    function closeAdd(e) {
        $(e).closest('.menu-ad-inner').fadeOut(300);
    }


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

<script type="text/javascript">
    $(window).load(function () {
        $("#sidebar").mCustomScrollbar({
            updateOnContentResize: true
        });
        $(".dishes-list,.dishes-preview").mCustomScrollbar(
            {
                updateOnContentResize: true
            }
        );
        $(".menu-ad").mCustomScrollbar({
            updateOnContentResize: false
        });
    });

    $('.swiper-slide').swipe({
        swipeRight: function (event, direction, distance, duration, fingerCount) {
            console.log('TouchSwipe Right');

        },
        swipeLeft: function (event, direction, distance, duration, fingerCount) {
            console.log('TouchSwipe Right');

        }
    });


</script>


<?php
function getAdv($menuID, $advertisement)
{
    $body = '';
    $counter = 0;
    while (!strlen($body)) {

        $adv = $advertisement[array_rand($advertisement, 1)];
        $menuIds = isset($adv['restaurants_id']) ? explode(',', $adv['restaurants_id']) : array();
        if (in_array($menuID, $menuIds)) {
            $body = $adv['body'];
            break;
        }
        if (++$counter > 100) {
            break;
        }
    }

    return $body;
}

?>
