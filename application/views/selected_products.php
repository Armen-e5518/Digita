<div class="content" id="selected-products">


    <div class="menu-dishes">
        <h2 class="title"><?php echo $order[0]['value']; ?></h2>
        <div class="dishes-list" id="dishes-list">
            <ul>
                <?php if ($products): $price = "0"; ?>
                    <?php foreach ($products as $product): ?>
                        <?php $price += ($product['price'] * (isset($productsCount[$product['uid']]) ? intval($productsCount[$product['uid']]) : 1)) ?>
                        <div class="product_row">
                            <a href="javascript:void(0);"
                               data-id="product_<?php echo $product['uid'] ?>" class="preview_li">

                                <li class="selected_product chosen">

                                    <span id="price_product_<?php echo $product['uid'] ?>">&euro; <?php echo $product['price'] ?></span>
                                    <em>
                                        <?php echo $product['title'] ?>
                                        <span class="prod_count"><?= isset($productsCount[$product['uid']]) ? '(' . $productsCount[$product['uid']] . ')' : '' ?></span>
                                    </em>
                                    <sub><?php if ($product['compound'] && $product['compound'] != 'null')
                                            echo $product['compound']; ?> </sub>
                                </li>

                            </a>
                            <a href="javascript:void(0)" class="remove-product"
                               data-id="product_<?php echo $product['uid'] ?>">
                                <i class="fa fa-times remove" aria-hidden="true"></i>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php if (!empty($empty_page)): ?>
                <h2 style="direction: ltr;<?php if (!empty($products)) {
                    echo 'display:none';
                } ?>" class="empty_order"><?php echo $empty_page[0]['value']; ?></h2>
            <?php endif; ?>
            <hr class="product_hr" style="<?php if (empty($products)) {
                echo 'display:none';
            } ?>">
            <div id="reset_order">
                <div class="order-total-right">
                     <span>
                         <?php if (isset($price)) {
                             echo $total[0]['value'];
                         } ?>
                     </span>
                    <strong>
                        <?php if (isset($price)) {
                            echo ' &euro; ' . "<i id = 'product_total_price'>" . $price . "</i>";
                        } ?>
                    </strong>
                </div>
                <div class="order-total">
                    <?php if (isset($price)): ?>
                        <a onclick="resetOrder(this)"
                           href="javascript:void(0)"><?php echo $reset_order[0]['value'] ?></a>
                        <!--                       href="--><?php //echo base_url() ?><!--selected/reset">--><?php //echo $reset_order[0]['value'] ?><!--</a>-->
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="dishes-preview hide" id="dishes-preview">
            <ul>
                <?php if ($products): ?>
                    <?php foreach ($products as $product): ?>

                        <a href="javascript:void(0);"
                           data-id="product_<?php echo $product['uid'] ?>" class="list_li">
                            <li class="selected_product chosen selected_preview">
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
                                    <strong id="price_product_<?php echo $product['uid'] ?>">&euro; <?php echo $product['price'] ?>
                                        <span class="prod_count"><?= isset($productsCount[$product['uid']]) ? '(' . $productsCount[$product['uid']] . ')' : '' ?></span>
                                    </strong>
                                </div>
                            </li>
                        </a>
                        <a href="javascript:void(0)" class="remove-product"
                           data-id="product_<?php echo $product['uid'] ?>">
                            <i class="fa fa-times remove" aria-hidden="true"></i>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
            <?php if (!empty($empty_page)): ?>
                <h2 style="direction: ltr; <?php if (!empty($products)) {
                    echo 'display:none';
                } ?>" class="empty_order"><?php echo $empty_page[0]['value']; ?></h2>
            <?php endif; ?>
            <hr class="product_hr">
            <div id="reset_order_prew">

                <div class="order-total-right">
                     <span>
                    <?php if (isset($price)) {
                        echo $total[0]['value'];
                    } ?>
                    </span>
                    <strong>
                        <?php if (isset($price)) {
                            echo ' &euro; ' . "<i id = 'product_total_price_prew'>" . $price . "</i>";
                        } ?>
                    </strong>
                </div>

                <div class="order-total">
                    <?php if (isset($price)): ?>
                        <a onclick="resetOrder(this)"
                           href="javascript:void(0)"><?php echo $reset_order[0]['value']; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <?php if (isset($advertisement['body']) && !empty($advertisement)): ?>
        <?php $menuIds = isset($advertisement['restaurants_id']) ? explode(',', $advertisement['restaurants_id']) : array(); ?>
        <div class="menu-ad">
            <div class="ad-holder">
                <?php echo $advertisement['body']; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>

<a href="javascript:void(0);" class="menu-ba" id="menu-ba">

</a>
<div class="sidebar" id="sidebar">
    <div class="content">
        <ul class="left-nav-menu restaurant_menu">
            <?php echo $menu ?>
        </ul>
    </div>
</div>
</div>
<input type="hidden" value='<?php if (!empty($products_num)) {
    echo $products_num;
} else {
    echo "0";
} ?>' name="selected_items_num" id="selected_items_num" style="display:none">
</div>


<script>

    $.cookie('dcjq-accordion', '', -1);



</script>
