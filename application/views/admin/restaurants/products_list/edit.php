<?
$pageTitle = $labels->$mod . ' : ' . $labels->add;
$content_title = isset($objML[ADMIN_DEF_LANG]->title) ? $objML[ADMIN_DEF_LANG]->title : '';
if ($id) {
    $pageTitle = 'Product &raquo; ' . $content_title . ' : ' . $labels->edit;
} else {

    $pageTitle = "Create New Product";
}
?>
    <div class="n_titleBl">
        <h1><?= $pageTitle; ?></h1>
    </div>
    <div class="n_backWrap">
        <a href="<?= site_url("/admin/restaurants/products_list/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}/"); ?>"
           class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
    </div>
<?php if (isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?= $error_string ?></div>
<?php endif; ?>
<?php echo form_open_multipart("admin/{$mod}/edit_product/{$section_id}/{$id}/{$restaurants_menu_id}/{$pid}/{$pageNum}", array('id' => 'FormData', 'class' => 'n_form')) ?>
    <div class="block-bordered enunciate category-block">
        <h3><span><?= ($content_title) ? $content_title : $labels->add ?></span></h3>
        <ul>
            <?php if (isset($settings['status']) && !empty($settings['status'])) { ?>
                <li>
                    <p class="notes-block-title">
                        <strong><?php echo form_label($labels->status, 'status', array('class' => 'text')) ?></strong>
                    </p>
                    <div class="main-title-block">
						<span class="select-span cf margin-left-0">
							<select id="status" name="status">
							<? foreach ($settings['status'] as $key => $val) {
                                $s = '';
                                if (isset($obj->status) && $obj->status == $key) {
                                    $s = 'selected="selected"';
                                }
                                ?>
                                <option value="<?= $key ?>" <?= $s ?>><?= $labels->$val ?></option>
                            <? } ?>
							</select>
						</span>
                    </div>
                </li>
            <? } ?>
            <li>

                <p class="notes-block-price"><strong><?php echo form_label("Position") ?></strong></p>
                <div class="main-price-block">
                    <input type="text" name="pos"
                           id="pos"
                           value="<?php echo (isset($obj->pos)) ? $obj->pos : 0; ?>"
                           class="text required"/>
                </div>
            </li>

            <li>

                <p class="notes-block-price"><strong><?php echo form_label("Menu section") ?></strong></p>
                <div class="main-price-block">
                    <span class="select-span cf margin-left-0">
                    <select name="restaurants_menu_id" id="restaurants_menu_id">
                        <?php if (isset($restaurantMenuList) && !empty($restaurantMenuList)): ?>
                            <?php foreach ($restaurantMenuList as $restaurantMenuListItem): ?>
                                <option
                                        value="<?= $restaurantMenuListItem->id ?>"
                                    <?= isset($restaurants_menu_id) && $restaurants_menu_id == $restaurantMenuListItem->id ? 'selected="selected"' : '' ?>
                                ><?= $restaurantMenuListItem->title ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    </span>
                </div>
            </li>
            <li>
                <p class="notes-block-title">
                    <strong><?php echo form_label("Item Image", 'Item Image', array('class' => 'text')) ?></strong></p>
                <div class="main-title-block">
					<span class="select-span cf margin-left-0">
						<input type="file" name="userfile" id="logo_img" class="text"
                               onchange="ReaderImageDisplay(this.files, 'cover_img_show_box', 250)"/>
					</span>
                    <div class="img_box cover_img_show_box">
                        <?php if (isset($obj->item_image) && !empty($obj->item_image)): ?>
                            <div class="certificates_image">
                                <div data-id="<?= $id ?>" data-tbl="<?= $mod ?>" data-row="item_image"
                                     data-img="<?= $obj->item_image ?>" class="delete_icon_first image"
                                     title="Delete"></div>
                                <img alt="slider image" src="<?php echo base_url() . $obj->item_image ?>" width="250"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ac clear"><br/></div>
            </li>
            <li>
                <p class="notes-block-price"><strong><?php echo form_label("Price") ?></strong></p>
                <div class="main-price-block">
                    <input type="text" name="price"
                           id="price"
                           value="<?php echo (isset($objML['en']->price)) ? $objML['en']->price : set_value("price"); ?>"
                           class="text required"/>
                </div>
            </li>
        </ul>
        <div class="ac clear"><br/></div>
        <div id="container-1">
            <ul class="tabs-nav">
                <?php foreach ($langArr as $lang) { ?>
                    <li>
                        <a href="#fragment-<?php echo $lang->uid; ?>"><span><?php echo $lang->title; ?></span></a>
                    </li>
                <?php } ?>
            </ul>
            <?php foreach ($langArr as $lang) { ?>
                <div id="fragment-<?php echo $lang->uid; ?>" class="tabs-container">
                    <p class="notes-block-title">
                        <strong><?php echo form_label("Title ($lang->uid)*", 'title_' . $lang->uid, array('class' => 'text')) ?></strong>
                    </p>
                    <div class="main-title-block">
                        <input type="text" name="title_<?php echo $lang->uid; ?>"
                               id="title_<?php echo $lang->uid; ?>"
                               value="<?php echo (isset($objML[$lang->uid]->title)) ? $objML[$lang->uid]->title : set_value("title_$lang->uid"); ?>"
                               class="text required"/>
                    </div>
                    <p class="notes-block-compound">
                        <strong><?php echo form_label("Compound ($lang->uid)*", 'title_' . $lang->uid, array('class' => 'text')) ?></strong>
                    </p>
                    <div class="main-title-block">
                        <input type="text" name="compound_<?php echo $lang->uid; ?>"
                               id="title_<?php echo $lang->uid; ?>"
                               value="<?php echo (isset($objML[$lang->uid]->title)) ? $objML[$lang->uid]->compound : set_value("compound_$lang->uid"); ?>"
                               class="text"/>
                    </div>
                    <p class="notes-block-compound">
                        <strong><?php echo form_label("Descritption ($lang->uid)*", 'title_' . $lang->uid, array('class' => 'text')) ?></strong>
                    </p>
                    <div class="main-title-block">
                        <textarea
                                name="desc_<?php echo $lang->uid; ?>"
                                id="desc_<?php echo $lang->uid; ?>"
                                class="editor"
                        ><?php echo (isset($objML[$lang->uid]->desc)) ? $objML[$lang->uid]->desc : set_value("desc_$lang->uid"); ?></textarea>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="save cf">
            <button class="icon-but save_submit" type="submit"><i class="fa fa-check"></i><?php echo $labels->save; ?>
            </button>
        </div>
    </div>
<?php echo form_close(); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#container-1').tabs();
            $("#FormData").validate();
        });
    </script><?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11.01.2017
 * Time: 17:53
 */