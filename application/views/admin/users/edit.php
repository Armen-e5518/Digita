<?
$pageTitle = "user " . ': ' . $labels->add;
$content_title = isset($objML[ADMIN_DEF_LANG]->title)?$objML[ADMIN_DEF_LANG]->title:'';
if($id){
    $pageTitle = $user[0]['username'] . ' : ' . $labels->edit;
}
?>
<div class="n_titleBl">
    <h1><?= $pageTitle; ?></h1>
    <? if($id){ ?>
        <a href="<?=site_url('/admin/'.$mod.'/blocks/'.$id.'/'.$pageNum);?>" class="n_add"><?php echo $labels->blocks .' '. $labels->list;?></a>
    <? } ?>
</div>
<div class="n_backWrap">
    <a href="<?=site_url('/admin/content');?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<?php if (isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?=$error_string ?></div>
<?php endif; ?>
<?php echo form_open_multipart("admin/users/edit/{$id}/{$pageNum}", array('id' => 'FormData', 'class' => 'n_form')) ?>
<div class="block-bordered enunciate category-block">
    <h3><span><?=($content_title)?$content_title:$labels->add?></span></h3>
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
            <li>
                <p class="notes-block-title"><strong><?php echo form_label($labels->restaurants, 'restaurants', array('class' => 'text')) ?></strong></p>
                <div class="main-title-block">
						<span class="select-span cf margin-left-0">
							<select id="restaurants" name="restaurants">
							<? foreach($restaurants as  $val){
                                $s ='';
                                if(isset($obj->restaurant_id) && $obj->restaurant_id == $val['id']){
                                    $s ='selected="selected"';
                                }
                                ?>
                                <option value="<?=$val['id']?>" <?=$s?>><?=$val['title']?></option>
                            <? } ?>
							</select>
						</span>
                </div>
            </li>
            <li>
                <p class="notes-block-title"><strong><?php echo form_label("username ",'username', array('class'=>'text')) ?></strong></p>
                <div class="main-title-block">
                    <input type="text" name="username"
                           id="username"
                           value="<?php echo (isset($obj->username))?$obj->username:set_value("title");?>"
                           class="text required"/>
                </div>
            </li>
            <li>
                <p class="notes-block-title"><strong><?php echo form_label("password ",'password', array('class'=>'text')) ?></strong></p>
                <div class="main-title-block">
                    <input type="text" name="password"
                           id="password"
                           value="<?php echo (isset($obj->password))?$obj->password:set_value("title");?>"
                           class="text required"/>
                </div>
            </li>
        <? } ?>
    </ul>

    <div class="save cf">
        <button class="icon-but save_submit" type="submit"><i class="fa fa-check"></i><?php echo $labels->save;?></button>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#container-1').tabs();
        $("#FormData").validate();
    });
</script>