<?
$pageTitle = 'Advertisement: ' . $labels->add;
$content_title = isset($objML[ADMIN_DEF_LANG]->title) ? $objML[ADMIN_DEF_LANG]->title : '';
if ($id) {
    $pageTitle = 'Advertisement' . ' &raquo; ' . $content_title . ' : ' . $labels->edit;
}
?>
<div class="n_titleBl">
    <h1><?= $pageTitle; ?></h1>
</div>
<div class="n_backWrap">
    <a href="<?= site_url('/admin/advertisement'); ?>" class="n_back"><i
                class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<?php if (isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?= $error_string ?></div>
<?php endif; ?>
<?php echo form_open_multipart("admin/{$mod}/edit/{$id}/{$pageNum}", array('id' => 'FormData', 'class' => 'n_form')) ?>
<div class="block-bordered enunciate category-block">
    <h3><span><?= ($content_title) ? $content_title : $labels->add ?></span></h3>
    <ul>
        <?php if (isset($settings['status']) && !empty($settings['status'])) { ?>
            <li>
                <p class="notes-block-title">
                    <strong><?php echo form_label($labels->status, 'status', array('class' => 'text')) ?></strong></p>
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
            <li>

                <?php if (isset($resto_menus) && !empty($resto_menus)): ?>
                    <?php $objMenus = isset($obj->restaurants_id) ? explode(',', $obj->restaurants_id) : array(); ?>
                    <ul>
                        <?php foreach ($resto_menus as $restaurant): ?>
                            <li class="resto-list">
                                <div class="resto-list-left">
                                    <input type="checkbox" name="all_restaurants" class="all_restaurants">
                                </div>
                                <div class="resto-list-right">
                                    <?= $restaurant->title ?>
                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                </div>
                                <div class="clr"></div>
                                <div class="resto-list-menu" style="display: none;">
                                    <?php if (isset($restaurant->menu_list) && !empty($restaurant->menu_list)) { ?>
                                        <?php foreach ($restaurant->menu_list as $menu_list): ?>
                                            <div class="resto-list-menu-item">
                                                <?php if (isset($menu_list->submenus) && !empty($menu_list->submenus)) { ?>
                                                    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                                <?php } else { ?>
                                                    <input type="checkbox" name="restaurants_menu_item[]"
                                                        <?= (in_array($menu_list->id, $objMenus) ? 'checked="checked"' : '') ?>
                                                           class="restaurants_menu_item" value="<?= $menu_list->id ?>">
                                                <?php } ?>
                                                <span class="resto-list-menu-item-title"><?= $menu_list->title ?></span>
                                                <div class="clr"></div>
                                                <?php if (isset($menu_list->submenus) && !empty($menu_list->submenus)) { ?>
                                                    <div class="resto-list-menu-sub" style="display: none;">
                                                        <?php foreach ($menu_list->submenus as $submenu): ?>
                                                            <div class="resto-list-menu-sub-item">

                                                                <input type="checkbox" name="restaurants_menu_item[]"
                                                                       class="restaurants_menu_item"
                                                                    <?= (in_array($submenu->id, $objMenus) ? 'checked="checked"' : '') ?>
                                                                       value="<?= $submenu->id ?>">

                                                                <span class="resto-list-menu-sub-item-title"><?= $submenu->title ?></span>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        <div class="clr"></div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php } else { ?>
                                        <h3>Menus are empty</h3>
                                    <?php } ?>
                                </div>
                                <div class="clr"></div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </li>
        <? } ?>
        <li>
            <div class="main-title-block">
                <div class="img_box cover_img_show_box">
                    <?php if (isset($obj->banner_img) && !empty($obj->banner_img)): ?>
                        <div class="certificates_image">
                            <div data-id="<?= $id ?>" data-tbl="<?= $mod ?>" data-row="banner_img"
                                 data-img="<?= $obj->banner_img ?>" class="delete_icon_first image"
                                 title="Delete"></div>
                            <img alt="slider image" src="/uploads/<?= $mod . '/' . $obj->banner_img; ?>" width="250"/>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ac clear"><br/></div>
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
                <p class="notes-block-title">
                    <strong><?php echo form_label("Body ($lang->uid)*", 'body_' . $lang->uid, array('class' => 'text')) ?></strong>
                </p>
                <div class="main-title-block">
                    <textarea name="body_<?= $lang->uid; ?>" id="body_<?= $lang->uid; ?>"
                              class="editor required"><?= (isset($objML[$lang->uid]->body)) ? $objML[$lang->uid]->body : ''; ?></textarea>
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
        $('#check_all').on('click', function () {

            $('.restaurant').prop('checked', false);

        });

        $('.restaurant').on('click', function () {

            $('#check_all').prop('checked', false);

        });
        $('#container-1').tabs();
        $("#FormData").validate();


        $('.resto-list-right > i').click(function () {
            if ($(this).hasClass('fa-plus-square-o')) {
                $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                $(this).closest('li.resto-list').find('.resto-list-menu').slideDown();
            } else {
                $(this).addClass('fa-plus-square-o').removeClass('fa-minus-square-o');
                $(this).closest('li.resto-list').find('.resto-list-menu').slideUp();
            }
        });

        $('.resto-list-menu-item i').click(function () {
            if ($(this).hasClass('fa-plus-square-o')) {
                $(this).removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
                $(this).closest('div.resto-list-menu-item').find('.resto-list-menu-sub').slideDown();
            } else {
                $(this).addClass('fa-plus-square-o').removeClass('fa-minus-square-o');
                $(this).closest('div.resto-list-menu-item').find('.resto-list-menu-sub').slideUp();
            }
        });

        $('.all_restaurants').change(function () {
            if ($(this).prop('checked')) {
                $(".resto-list .restaurants_menu_item").prop('checked', true)
            } else {
                $(".resto-list .restaurants_menu_item").prop('checked', false)
            }
        });


        $(".resto-list").each(function (i, v) {
            if (
                $(this).find(".resto-list-menu input[type='checkbox']:not(:checked)").length == 0 &&
                $(this).find(".resto-list-menu input[type='checkbox']").length
            ) {
                $(this).find('.all_restaurants').prop('checked',true);
            }
//        $(".resto-list-menu input[type='checkbox']").each(function (i,v) {

        });


    });
</script>