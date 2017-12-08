<script type="text/javascript">
    $(document).ready(function () {
        $('#container-1').tabs();
        $("#FormData").validate();
    });
    function checkSlug(lang) {
        var title = $("#title_" + lang).val();
        var tbl = "<?= $mod ?>";
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: '<?php echo site_url("admin/ajax/chackslug");?>',
            data: { title: title, tbl: tbl, id: <?= $id ?>},
            success: function (msg) {
                <? if(isset($id) && !$id): ?>
                if (lang == 'en') {
                    $("#url").val(msg);
                }
                <? endif; ?>
            }
        });
    }
</script>

<h1><?php
    if(isset($objML[$langArr[0]->uid]->title)){
     echo  $labels->edit . " Restaurant Menu: " . $objML[$langArr[0]->uid]->title;
    }else{
       echo "Create New Restaurant Menu";
    }
    ?></h1>

<? if($id && $menu_list){ ?>
    <a href="<?=site_url('/admin/'.$mod.'/products_list/'.$section_id . '/' . $id . '/' . $pid  . '/' .$pageNum);?>" class="n_add"><?php echo 'Manage Products';?></a>
<? } ?>
<div class="n_backWrap">
    <a href="<?=site_url('/admin/restaurants/restaurant_menu/'.$section_id . '/' . $pageNum);?>" class="n_back"><i class="fa fa-long-arrow-left"></i><?=$labels->back; ?></a>
</div>
<?php if(isset($error_string) && !empty($error_string)): ?>
    <?=$error_string;?>
<?php endif; ?>
<?php echo form_open_multipart("admin/restaurants/restaurant_menu_edit/{$section_id}/{$id}/{$pid}", array('id' => 'FormData', 'class' => 'n_form')); ?>
<div class="block-bordered enunciate category-block">
    <h3><span>Menu</span></h3>
    <ul>
        <?php if(isset($settings['status']) && !empty($settings['status'])){ ?>
            <li>
                <p class="notes-block-title"><strong><?php echo form_label($labels->status, 'status', array('class' => 'text')) ?></strong></p>
                <div class="main-title-block">
							<span class="select-span cf margin-left-0">
								<select id="status" name="status">
								<? foreach($settings['status'] as $key => $val){
                                    $s ='';
                                    if(isset($obj->status) && $obj->status == $key){
                                        $s ='selected="selected"';
                                    }
                                    ?>
                                    <option value="<?=$key?>" <?=$s?>><?=$labels->$val?></option>
                                <? } ?>
								</select>
							</span>
                </div>
            </li>
        <? } ?>

        <?php if(isset($menum_drop_down) && !empty($menum_drop_down)) { ?>
            <li <?php if($id){echo"style = 'display:none'";}?>>
                <p class="notes-block-title"><strong><?php echo form_label($labels->parent_menus, 'pid', array('class' => 'text')) ?></strong></p>
                <div class="main-title-block">
							<span class="select-span cf margin-left-0">
								<?=$menum_drop_down?>
							</span>
                </div>
            </li>

        <? } ?>

        <li style = "display:none">
            <p class="notes-block-title"><strong><?php echo form_label($labels->position, 'pos', array('class' => 'text')) ?></strong></p>
            <div class="main-title-block">
                <input type="text" name="pos" id="pos" value="<?php echo(isset($obj->pos)) ? $obj->pos : 1000; ?>" class="text" <?=($id)? 'disabled' : ''; ?> />
            </div>
            <? if($id){ ?><input type="hidden" name="pos"  value="<?php echo (isset($obj->pos)) ? $obj->pos : 1000; ?>" class="text" /> <? } ?>
        </li>
            </div>

    </ul>
    <br/>
    <div id="container-1">
        <ul class="tabs-nav">
            <?php foreach ($langArr as $lang) { ?>
                <li><a href="#fragment-<?php echo $lang->uid; ?>"><span><?php echo $lang->title; ?></span></a></li>
            <?php } ?>
        </ul>
        <?php foreach ($langArr as $lang) { ?>
            <div id="fragment-<?php echo $lang->uid; ?>" class="tabs-container">
                <p class="notes-block-title"><strong><?php echo form_label("Title ($lang->uid)*", 'title_' . $lang->uid, array('class' => 'text')) ?></strong></p>
                <div class="main-title-block">
                    <input type="text"
                           name="title_<?php echo $lang->uid; ?>"
                           id="title_<?php echo $lang->uid; ?>"
                           value="<?php echo (isset($objML[$lang->uid]->title)) ? $objML[$lang->uid]->title : set_value("title_$lang->uid"); ?>"
                           onkeyup="checkSlug('<?php echo $lang->uid; ?>')"
                           class="text required"/>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="ac clear"></div>
    <div class="save cf">
        <button class="icon-but save_submit" type="submit"><i class="fa fa-check"></i><?php echo $labels->save;?></button>
    </div>
</div>
<?php echo form_close(); ?>