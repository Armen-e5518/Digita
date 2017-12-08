<div class="product-item-conteiner">

    <div class="left">
        <?php if (isset($item->item_image) && $item->item_image) { ?>
            <img src="<?= site_url($item->item_image) ?>" alt="">
        <?php } else { ?>
            <img src="<?= site_url("assets/images/no_image.jpg") ?>" alt="">
        <?php } ?>
    </div>
    <div class="right">

        <h3><?= isset($item->title) ? $item->title : ''; ?></h3>
        <strong><?= translate('price') ?>:</strong>&nbsp;<em>&euro;&nbsp;<?= isset($item->price) ? $item->price : ''; ?></em>
        <p><?= isset($item->compound) ? $item->compound : ''; ?></p>

        <?= isset($item->desc) ? $item->desc : ''; ?>
    </div>

</div>