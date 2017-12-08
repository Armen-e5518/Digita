<script type="text/javascript">
    function checkSlug(lang) {
        var title = $("#title_" + lang).val();
        var tbl = "<?= $mod ?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo site_url("admin/ajax/chackslug");?>',
            data: {title: title, tbl: tbl, id: <?= $id ?>},
            success: function (msg) {
                <? if (isset($id) && !$id): ?>
                if (lang == 'en') {
                    $("#url").val(msg);
                }
                <? endif; ?>
            }
        });
    }
</script>
<?
$pageTitle = $labels->$mod . ' : ' . $labels->add;
$content_title = isset($objML[ADMIN_DEF_LANG]->title) ? $objML[ADMIN_DEF_LANG]->title : '';
if ($id) {
    $pageTitle = $labels->$mod . ' &raquo; ' . $content_title . ' : ' . $labels->edit;
}
?>
<div class="n_titleBl">
    <h1><?= $pageTitle; ?></h1>
    <? if ($id) { ?>
        <a href="<?= site_url('/admin/' . $mod . '/restaurant_menu/' . $id . '/' . $pageNum); ?>"
           class="n_add"><?php echo 'restaurant menu' . ' ' . $labels->list; ?></a>
    <? } ?>
</div>
<div class="n_backWrap">
    <?php $user = $this->session->userdata('user'); ?>
    <?php if ($user->userrole == 'admin') { ?>
        <a href="<?= site_url('/admin/restaurants'); ?>" class="n_back"><i
                    class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
    <?php } ?>
</div>
<?php if (isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?= $error_string ?></div>
<?php endif; ?>
<script src="<?php echo base_url() ?>assets/js/jscolor.js"></script>
<?php echo form_open_multipart("admin/{$mod}/edit/{$id}/{$pageNum}", array('id' => 'FormData', 'class' => 'n_form')) ?>
<div class="block-bordered enunciate category-block">
    <h3><span><?= ($content_title) ? $content_title : $labels->add ?></span></h3>
    <ul>
        <li><a href="<?= site_url('admin/qr_codes?count=5&id='.$id); ?>">QR iages</a></li>
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
        <? } ?>

        <li style="display: none">
            <p class="notes-block-title">
                <strong><?php echo form_label("Url ", 'url', array('class' => 'text')) ?></strong></p>
            <div class="main-title-block">
                <input type="hidden" name="url"
                       id="url"
                       value="<?php echo (isset($obj->url)) ? $obj->url : set_value("url"); ?>"
                       class="text required"/>
                <?php if (isset($obj->url)): ?>
                    <strong style="font-size: 16px;color: #0000ef"><?= site_url($obj->url) ?></strong>
                <?php endif; ?>
            </div>
        </li>

        <li>
            <?php foreach ($langArr as $lang) : ?>
                <div id="fragment-<?php echo $lang->uid; ?>" class="tabs-container">
                    <p class="notes-block-title">
                        <strong><?php echo form_label("Title ($lang->uid)*", 'title_' . $lang->uid, array('class' => 'text')) ?></strong>
                    </p>
                    <div class="main-title-block">
                        <input type="text" name="title_<?php echo $lang->uid; ?>"
                               id="title_<?php echo $lang->uid; ?>"
                               value="<?php echo (isset($objML[$lang->uid]->title)) ? $objML[$lang->uid]->title : set_value("title_$lang->uid"); ?>"
                               class="text required" onkeyup="checkSlug('<?php echo $lang->uid; ?>')"/>
                    </div>
                </div>
            <?php endforeach; ?>
        </li>

        <li>
            <p class="notes-block-title">
                <strong><?php echo form_label("Logo Image", 'img', array('class' => 'text')) ?></strong></p>
            <div class="main-title-block">
					<span class="select-span cf margin-left-0">
						<input type="file" name="logo_img" id="logo_img" class="text"
                               onchange="ReaderImageDisplay(this.files, 'cover_img_show_box', 100)"/>
					</span>
                <div class="img_box cover_img_show_box">
                    <?php if (isset($obj->logo_img) && !empty($obj->logo_img)): ?>
                        <div class="certificates_image">
                            <div data-id="<?= $id ?>" data-tbl="<?= $mod ?>" data-row="logo_img"
                                 data-img="<?= $obj->logo_img ?>" class="delete_icon_first image" title="Delete"></div>
                            <img alt="slider image" src="<?php if (!empty($obj->logo_img)) {
                                echo base_url() . "$obj->logo_img";
                            } ?>" width="100"/>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ac clear"><br/></div>
        </li>
        <li>
            <p class="notes-block-title">
                <strong><?php echo form_label("background image", 'img', array('class' => 'text')) ?></strong></p>
            <div class="main-title-block">
                    <span class="select-span cf margin-left-0">
						<input type="file" name="background_image" id="background_image" class="text"
                               onchange="ReaderImageDisplay(this.files, 'cover_img_show_box_background', 250)"/>
					</span>
                <div class="img_box cover_img_show_box_background">
                    <?php if (isset($obj->background_image) && !empty($obj->background_image)): ?>
                        <div class="certificates_image">
                            <div data-id="<?= $id ?>" data-tbl="<?= $mod ?>" data-row="background_image"
                                 data-img="<?= $obj->background_image ?>" class="delete_icon_first image"
                                 title="Delete">
                            </div>
                            <img alt="slider image" src="<?php if (!empty($obj->background_image)) {
                                echo base_url() . "$obj->background_image";
                            } ?>"
                                 width="250"/>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ac clear"><br/></div>
        </li>
        <li>
            <p class="notes-block-title">
                <strong><?php echo form_label("username ", 'username', array('class' => 'text')) ?></strong></p>
            <div class="main-title-block">
                <input type="text" name="username"
                       id="username"
                       value="<?php echo (isset($obj->username)) ? $obj->username : set_value("title"); ?>"
                       class="text required"/>
            </div>
        </li>

        <li>
            <p class="notes-block-title"><strong><?php
                    if ($id) {

                        echo form_label('change password ', 'password', array('class' => 'text'));
                    } else {

                        echo form_label('password', 'password', array('class' => 'text'));
                    }
                    ?></strong></p>
            <div class="main-title-block">
                <input type="text" name="password"
                       id="password"
                       value=""
                       class="text <?php if (!$id) {
                           echo 'required';
                       } ?> "/>
            </div>
        </li>

    </ul>
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
</script>