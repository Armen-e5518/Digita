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
<h1><?= $labels->edit; ?></h1>
<div class="n_backWrap">
    <a href="<?=site_url('/admin/menu/opensection/'.$section_id);?>" class="n_back"><i class="fa fa-long-arrow-left"></i><?=$labels->back; ?></a>
</div>
<?php if(isset($error_string) && !empty($error_string)): ?>
	<?=$error_string;?>
<?php endif; ?>   
<?php echo form_open_multipart("admin/{$mod}/edit/{$section_id}/{$id}/{$pid}", array('id' => 'FormData', 'class' => 'n_form')); ?>
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
				<?php if(isset($settings['status_show_in_menu']) && !empty($settings['status_show_in_menu'])){ ?> 
					<li>
						<p class="notes-block-title"><strong><?php echo form_label($labels->show_in_menu, 'show', array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<span class="select-span cf margin-left-0">
							<select id="show" name="show">
								<? foreach($settings['status_show_in_menu'] as $key => $val){ 
									$s ='';
									if(isset($obj->show) && $obj->show == $key){
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
				<?php if(isset($sections) && !empty($sections)){ ?>
					<li>
						<p class="notes-block-title"><strong><?php echo form_label($labels->section, 'section_id', array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<span class="select-span cf margin-left-0">
								<select id="section_id" name="section_id" <?=($id)?'disabled':'';?>>
									<?php foreach($sections as $key => $val):
										$s ='';
										if($section_id == $key){
											$s ='selected="selected"';
										}
									?>
										<option value="<?=$key?>" <?=$s?>><?=$val?></option>
									<?php endforeach; ?>
								</select>
								<? if($id){ ?><input type="hidden" name="section_id"  value="<?php echo (isset($obj->section_id)) ? $obj->section_id : $section_id; ?>"> <? } ?>
							</span>
						</div>
					</li>					
				<? } ?>							
				<?php if(isset($menum_drop_down) && !empty($menum_drop_down)) { ?>
					<li>
						<p class="notes-block-title"><strong><?php echo form_label($labels->parent_menus, 'pid', array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<span class="select-span cf margin-left-0">
								<?=$menum_drop_down?>
							</span>
						</div>    
					</li>
				<? } ?>		
				<?php if(isset($contents) && !empty($contents)){ ?>
					<li>
						<p class="notes-block-title"><strong><?php echo form_label($labels->content, 'cid', array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<span class="select-span cf margin-left-0">
								<select id="cid" name="cid">
									<option value="0">-<?=$labels->select;?>-</option>
									<?php foreach($contents as $key => $val):
										$s ='';
										if(isset($obj->cid) && $obj->cid == $key) {
											$s ='selected="selected"';
										}
									?>
										<option value="<?=$key?>" <?=$s?>><?=$val?></option>
									<?php endforeach; ?>
								</select>
							</span>
						</div>
					</li>					
				<? } ?>	
				<li>
					<p class="notes-block-title"><strong><?php echo form_label($labels->position, 'pos', array('class' => 'text')) ?></strong></p>
					<div class="main-title-block">
						<input type="text" name="pos" id="pos" value="<?php echo(isset($obj->pos)) ? $obj->pos : 1000; ?>" class="text" <?=($id)? 'disabled' : ''; ?> />
					</div> 
					<? if($id){ ?><input type="hidden" name="pos"  value="<?php echo (isset($obj->pos)) ? $obj->pos : 1000; ?>" class="text" /> <? } ?>
				</li>					
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
						<p class="notes-block-title"><strong><?php echo form_label("Meta title ($lang->uid)", 'meta_title_'. $lang->uid, array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<input type="text"
									name="meta_title_<?= $lang->uid; ?>"
									id="meta_title_<?= $lang->uid; ?>"
									value="<?= (isset($objML[$lang->uid]->meta_title)) ? $objML[$lang->uid]->meta_title : set_value("meta_title_$lang->uid"); ?>"
									class="text required" />
						</div>					
						
						<p class="notes-block-title"><strong><?php echo form_label($labels->meta_desc ."($lang->uid)", 'meta_desc_'. $lang->uid, array('class' => 'text')) ?></strong></p>
						<div class="main-title-block">
							<textarea name="meta_desc_<?= $lang->uid; ?>" id="meta_desc_<?= $lang->uid; ?>" class="text required"><?= (isset($objML[$lang->uid]->meta_desc)) ? $objML[$lang->uid]->meta_desc : set_value("meta_desc_$lang->uid"); ?></textarea>
						</div>	
						<div class="block_text">
							<p class="notes-block-title"><strong><?php echo form_label("Block Text ($lang->uid)*",'block_text_'.$lang->uid, array('class'=>'text')) ?></strong></p>
							<div class="main-title-block">
								<textarea name="block_text_<?= $lang->uid; ?>" id="block_text_<?= $lang->uid; ?>" class="editor"><?= (isset($objML[$lang->uid]->block_text)) ? $objML[$lang->uid]->block_text : set_value("block_texte_$lang->uid"); ?></textarea>
							</div>	
						</div>						
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
			<ul>	  
				<li>
					<p class="notes-block-title"><strong><?php echo form_label($labels->url ."*(<small>for external http:// or https://</small>)", 'url', array('class' => 'text')) ?></strong></p>
					<div class="main-title-block">
						<input type="text" name="url" id="url" value="<?php echo (isset($obj->url)) ? $obj->url : set_value("url"); ?>" class="text required"/>
					</div>
				</li>
			</ul>	  
			<div class="save cf"> 
				<button class="icon-but save_submit" type="submit"><i class="fa fa-check"></i><?php echo $labels->save;?></button>
			</div>
		</div>  
<?php echo form_close(); ?>