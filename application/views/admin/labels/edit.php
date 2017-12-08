<?
$pageTitle = $labels->$mod . ' : ' . $labels->add;
$content_title = isset($objML[ADMIN_DEF_LANG]->title) ? $objML[ADMIN_DEF_LANG]->title : '';
if ($id) {
    $pageTitle = $labels->$mod . ' &raquo; ' . $content_title . ' : ' . $labels->edit;
}
?>
<div class="n_titleBl">
    <h1><?= $pageTitle; ?></h1>
</div>
<div class="n_backWrap">
    <a href="<?= site_url("/admin/{$mod}"); ?>" class="n_back"><i
                class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<?php if (isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?= $error_string ?></div>
<?php endif; ?>
<?php if (isset($label_exist_msg) && !empty($label_exist_msg)): ?>
    <div class="error"><?= $label_exist_msg ?></div>
<?php endif; ?>
<?php echo form_open_multipart("admin/{$mod}/edit/{$id}/{$pageNum}", array('id' => 'FormData', 'class' => 'n_form')) ?>
<div class="block-bordered enunciate category-block">
    <h3><span><?= ($content_title) ? $content_title : $labels->add ?></span></h3>
    <ul>
        <li>
            <p class="notes-block-title">
                <strong><?php echo form_label($labels->key, 'pos', array('class' => 'text')) ?><?php echo $id ? ':' : ''; ?></strong>
                <span><?php echo (isset($obj->key)) && $id ? $obj->key : ''; ?></span></p>
            <div class="main-title-block">
                <?php if ($id) { ?>
                    <input type="hidden" name="key" id="key" value="<?php echo (isset($obj->key)) ? $obj->key : ''; ?>"
                           class="text"/>
                <?php } else { ?>
                    <input type="text" name="key" id="key" value="<?php echo (isset($obj->key)) ? $obj->key : ''; ?>"
                           class="text"/>
                <?php } ?>
            </div>
            <? if ($id) { ?><input type="hidden" name="pos"
                                   value="<?php echo (isset($obj->pos)) ? $obj->pos : 1000; ?>" class="text" /> <? } ?>
        </li>

        <li>
            <p class="notes-block-title">
                <strong><?php echo form_label($labels->type, 'type', array('class' => 'text')) ?><?php echo $id ? ':' : ''; ?></strong>
                <span><?php echo (isset($obj->type)) && $id ? $obj->type : ''; ?></span></p>
            <div class="main-title-block">
                <?php if ($id) { ?>
                    <input type="hidden" name="type" id="type"
                           value="<?php echo (isset($obj->type)) ? $obj->type : ''; ?>"
                           class="text"/>
                <?php } else { ?>
                    <span class="select-span cf margin-left-0">
                        <select name="type" id="type">
                            <option value="label" <?= (isset($obj->type) && $obj->type == 'label' ? 'selected' : '') ?>>Label</option>
                            <option value="content" <?= (isset($obj->type) && $obj->type == 'content' ? 'selected' : '') ?>>Content</option>
                        </select>
                    </span>
                <?php } ?>
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
                    <strong><?php echo form_label("Text ($lang->uid)*", 'text_' . $lang->uid, array('class' => 'text')) ?></strong>
                </p>
                <div class="main-title-block">
                    <textarea name="text_<?= $lang->uid; ?>" id="text_<?= $lang->uid; ?>"
                              class="label-text <?= isset($obj->type) && $obj->type == 'content' ? 'editor' : '' ?>"><?= (isset($objML[$lang->uid]->text)) ? $objML[$lang->uid]->text : ''; ?></textarea>
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

    $('#type').change(function () {
        if ($(this).val() == 'content') {


            $('.label-text').addClass('editor');
            init_tinymce();
        } else {
            $('.label-text').removeClass('editor');
            tinymce.remove();
        }
    })
</script>