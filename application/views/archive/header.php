<?php $this->load->view('dynamic_css') ?>

<div class="header">
    <div class="left">
        <a id="menu-close" href="javascript:void(0)" class="menu" data-toggle=".container">
            <div class="menu-btn"></div>
        </a>
        <a href="javascript:void(0)">
            <img class="logo"
                 src="<?php echo base_url() ?><?php echo $restaurant[0]['logo_img'] ?>">
        </a>

    </div>
    <?php if ($page == "home"): ?>
        <h1 class="title"><?php echo $restaurant[0]['title'] ?></h1>
    <?php elseif ($page == "menu"): ?>

        <h1 class="title">
            <a href="javascript:viod(0)" class="prev-menu" id="swipe-prev-menu"></a>
            <span id="menu_title">
             <?= isset($restaurant[0]['title']) ? $restaurant[0]['title'] : '' ?></span>
            <a href="javascript:viod(0)" class="next-menu" id="swipe-next-menu"></a></h1>
    <?php else: ?>

        <h1 class="title">Your Order</h1>

    <?php endif; ?>
    <div class="right">
        <span>
            <img src="/assets/images/gift.svg" alt="">
        </span>
        <a id="selected" class="fav menu-preview" href="<?php echo base_url() . "selected/index"; ?>">
            <span class="product_num">
                <?php if (isset($productsCount)) {
                    echo(array_sum($productsCount) > 0 ? array_sum($productsCount) : '');
                } ?>

            </span>

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 preserveAspectRatio="xMidYMid" width="48.75" height="29.25" viewBox="0 0 55 48">
                <defs>

                </defs>
                <path id="svg_fav"
                      d="M50.557,4.456 C47.677,1.597 43.864,0.035 39.795,0.035 C35.726,0.035 31.902,1.609 29.022,4.468 L27.517,5.961 L25.990,4.445 C23.110,1.586 19.274,-0.000 15.205,-0.000 C11.147,-0.000 7.323,1.574 4.454,4.421 C1.575,7.280 -0.011,11.077 0.001,15.116 C0.001,19.156 1.598,22.941 4.478,25.800 L26.375,47.537 C26.678,47.838 27.086,48.000 27.482,48.000 C27.879,48.000 28.287,47.850 28.590,47.549 L50.533,25.846 C53.413,22.987 54.999,19.191 54.999,15.151 C55.011,11.112 53.437,7.315 50.557,4.456 ZM48.318,23.635 L27.482,44.238 L6.693,23.601 C4.408,21.332 3.149,18.323 3.149,15.116 C3.149,11.910 4.396,8.901 6.682,6.644 C8.956,4.387 11.987,3.137 15.205,3.137 C18.434,3.137 21.478,4.387 23.763,6.655 L26.398,9.271 C27.016,9.885 28.007,9.885 28.625,9.271 L31.237,6.679 C33.522,4.410 36.565,3.160 39.783,3.160 C43.001,3.160 46.033,4.410 48.318,6.667 C50.603,8.936 51.851,11.945 51.851,15.151 C51.862,18.357 50.603,21.367 48.318,23.635 Z"
                      class="<?= (isset($productsCount) && array_sum($productsCount) ? 'cls-1' : 'cls-2') ?>"/>
            </svg>
        </a>
        <?php $this->load->view('cart') ?>
    </div>

</div>
				