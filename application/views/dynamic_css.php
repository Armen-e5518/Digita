<style>


    /*site images*/
    /*background image*/

    <?php if($page == 'home'):?>
    .main {
        background: #000 url(<?php echo base_url() . $restaurant[0]['background_image']?>);
        background-size: cover;
    }

    <?php endif;?>

    #slide-id-0 {
        background: #000 url(<?php echo base_url() . $restaurant[0]['background_image']?>);
        background-size: cover;
    }

    /*site link color*/
    .main .content p a {
        color: #<?php echo $restaurant[0]['site_link']?>;
        text-decoration: none;
    }

    #email-container,
    #lang-container,
    #cart-container {
        border-color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    .main .header {
        display: table;
        width: 100%;
        background: #<?php echo $restaurant[0]['header']?>;
        color: #fff;
    }

    .header .right #selected .product_num {
        background: #<?php echo $restaurant[0]['header']?>;
    }

    .swiper-container .swiper-wrapper #slide-id-0 .menu-dishes .home_content_title_color,
    .home_content_title_color {
        color: #<?php echo $restaurant[0]['home_content_title_color']?> !important;
    }

    #cart-container,
    #cart-container .cart-item .cart-item-left,
    #cart-container .cart-item strong {
        background: #<?php echo $restaurant[0]['header']?>;
    }

    #icon-bell{
        fill: #<?php echo $restaurant[0]['header_icons']?> !important;
    }
    .table-number-container input[type="button"]{
        background: #<?php echo $restaurant[0]['header_icons']?> !important;
    }
    .product_num {
        color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    #slide-id-0 p,
    .main > .content > p {
        color: #<?php echo $restaurant[0]['site_text']?>;
    }

    /*home page title color*/
    .header .title {
        margin: 0;
        font-family: SFCompactDisplay-Ultralight;
        font-size: 3.45vw;
        color: #<?php echo $restaurant[0]['heading_title']?>;
    }

    /*title color*/
    .content .menu-dishes .title {
        margin-bottom: 3vh;
        font-family: Trirong-Regular;
        font-size: 4.5vw;
        font-weight: normal;
        color: #<?php echo $restaurant[0]['product_menu_heading_title']?>;
        text-transform: uppercase;
        line-height: 4vw;
    }
    #language-sel i.fa{
        color: #<?php echo $restaurant[0]['heading_title']?>;
    }

    .cls-1 {
        fill: #<?php echo $restaurant[0]['header_icons']?> !important;
        fill-rule: evenodd;
    }

    .cls-2 {

        fill: #4d4d4d;
        fill-rule: evenodd;
    }
    .close-add-svg{
        fill: #<?php echo $restaurant[0]['header_icons']?> !important;
    }

    /*menu burger color*/
    #menu-close .menu-btn:after,
    #menu-close .menu-btn:before {
        background-color: #<?php echo $restaurant[0]['header_icons']?> !important;
    }

    #email-container input[type='text'] {
        border: solid 1px #<?php echo $restaurant[0]['header_icons']?> !important;
    }

    #subscribe {
        border: solid 1px #<?php echo $restaurant[0]['product_menu_active']?>;
    !important;
        color: #<?php echo $restaurant[0]['product_menu_active']?>;
    !important;
    }

    #selected .cart-euro {
        color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    .error-msg {
        color: #<?php echo $restaurant[0]['product_menu_active']?>;
    !important;
    }

    #email-container input {
        border: solid 1px #<?php echo $restaurant[0]['product_menu_active']?>;
    !important;
    }

    #email-subscibtion {
        color: #<?php echo $restaurant[0]['header_icons']?> !important;
    }

    #menu-close .menu-btn {
        position: relative;
        width: 24px;
        height: 4px;
        background-color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    /*menu scrolling color*/
    .menu-dishes .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    .menu-ad .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    .menu-dishes .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    .dishes-preview .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    .sidebar .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #<?php echo $restaurant[0]['header_icons']?> !important;
        -webkit-box-shadow: inset 0 0 6px rgba(63, 63, 63, .5) !important;
    }

    /*menu link color*/
    .sidebar .left-nav-menu {
        color: #<?php echo $restaurant[0]['menu_link']?>;
    }

    /*menu active link color*/
    .sidebar .left-nav-menu:hover {
        /*padding-left: 20px;*/
        color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    .sidebar .left-nav-menu a:hover {
        color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    /*header prew and next color*/
    .main .header .title > a {
        color: #<?php echo $restaurant[0]['header_icons']?>;
        text-decoration: none;
    }

    .select_list_li {
        color: #<?php echo $restaurant[0]['product_menu']?>;
    }

    /*menu active color*/
    #cart-container .cart-item,
    #cart-container .cart-data,
    #cart-container .cart-data #cart-reset a,
    #lang-container #lang-items a,
    .dishes-list ul li.chosen {
        color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    #cart-container .cart-item .cart-between-tots {
        border-color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    .selected_list_li {

        color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    .sidebar .left-nav-menu a.active,
    .active {

        padding-left: 20px;
        color: #<?php echo $restaurant[0]['menu_link_active']?> !important;
        /*line-height: 3vw;*/
    }

    .dishes-list ul li sub {
        font-family: Trirong-Italic;
        color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    #reset_order,
    #reset_order_prew,
    #reset_order {
        color: #<?php echo $restaurant[0]['header_icons']?>
    }

    .product_row {
        position: relative;
    }

    .dishes-list ul li.chosen, .dishes-list ul li {
        /*width: 93%;*/
    }

    .product_row .remove-product {
        float: left;
        position: absolute;
        left: -15px;
        top: 0px;
    }

    .dishes-list ul li a.remove-product {
        position: absolute;
        left: -15px;
        z-index: 10000;
        text-decoration: none;
        font-size: 20px;
        font-weight: bold;
        color: #<?php echo $restaurant[0]['header_icons']?>;
        top: -3px;
    }

    .dishes-list ul li.chosen:before {
        border-bottom-color: #<?php echo $restaurant[0]['product_menu_active']?>;
    }

    .ad-holder{
        color: #<?php echo $restaurant[0]['heading_title']?>;
    }

    .scroll-bar .thumb,
    ::-webkit-scrollbar-thumb {
        -webkit-border-radius: 10px;
        border-radius: 10px;
        background: #<?php echo $restaurant[0]['header_icons']?> !important;
        -webkit-box-shadow: inset 0 0 6px rgba(63, 63, 63, .5) !important;
    }

    .remove {
        color: #<?php echo $restaurant[0]['header_icons']?>;
    }

    .dishes-preview ul li > div sub {
        display: block;
        height: 14px;
        font-family: Trirong-Italic;
        color: #<?php echo $restaurant[0]['product_menu_active']?>;
        line-height: 15px;
    }
</style>