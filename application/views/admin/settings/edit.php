<script type="text/javascript">
	$(document).ready(function() {
		$("#FormData").validate();	
	});
</script>
<h1><?= $labels->settings .' '. $labels->edit; ?></h1>
<div class="n_backWrap">
    <a href="<?=site_url('/admin/'.$mod);?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<? if (isset($error_string) && !empty($error_string)){
	echo $error_string;
}
?>
<?php echo form_open_multipart("admin/{$mod}/edit/{$id}", array('id' => 'FormData', 'class' => 'n_form')) ?>
	<div class="block-bordered enunciate category-block">		
		<h3><span><?=$labels->$mod?></span></h3>
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
			<input type="hidden" name='id' value="<?=(isset($obj->id)) ? $obj->id :'';?>" class="text">
			<li>
				<p class="notes-block-title"><strong><label for="name" class="text"><?=$labels->name?></label></strong></p>
				<div class="main-title-block">
					<input type="text" name="name" value="<?=(isset($obj->name)) ? $obj->name : '';?>" class="text">
				</div> 
			</li> 			
			<li>
				<p class="notes-block-title"><strong><label for="value" class="text"><?=$labels->value?></label></strong></p>
				<div class="main-title-block">
					<? 	
						$SettingsStripTagsIds = $this->settings['SettingsStripTagsIds'];
						if(in_array($id, $SettingsStripTagsIds)){
						?>
							<input type="text" name="value" id="value" class="text" value="<?=(isset($obj->value)) ? $obj->value : set_value("value"); ?>" >
						<?
						} else {
						?>
							<textarea 
								name="value" 
								id="value" 
								class="editor text">
								<?= (isset($obj->value)) ? $obj->value : set_value("value"); ?>
							</textarea>
						<?						
						}
					?>						
				</div> 
			</li>
		</ul>	
		<div class="save cf"> 
			<button class="icon-but save_submit" type="submit"><i class="fa fa-check"></i><?php echo $labels->save;?></button>
		</div>
	</div>  
<?php echo form_close(); ?>
