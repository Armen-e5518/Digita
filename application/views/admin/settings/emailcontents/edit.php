<script type="text/javascript">
$(document).ready(function() {
	$('#container-1').tabs();
	$("#FormData").validate();
});
</script>
<h1><?= $labels->edit; ?></h1>
<div class="n_backWrap">
    <a href="<?=site_url('admin/settings');?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<?php if(isset($error_string) && !empty($error_string)): ?>
    <div class="error"><?=$error_string ?></div>
<?php endif; ?>
<?php echo form_open_multipart(current_url(), array('id' => 'FormData', 'class' => 'n_form')) ?>
	<div class="block-bordered enunciate category-block">		
		<h3><span><?=$labels->email_contents?></span></h3>
		<ul>
<? /*
			<li>
				<p class="notes-block-title"><strong><?=form_label('Setting key', 'setting_key', array('class' => 'text'));?></strong></p>
				<div class="main-title-block"><?=(isset($obj->setting_key)) ? $obj->setting_key : ''; ?></div>
			</li>	
*/ ?>			
			<li>
				<p class="notes-block-title"><strong><?php echo form_label("Name*", 'name', array('class'=>'text')) ?></strong></p>
				<div class="main-title-block">
					<input type="text" name="name" id="name" value="<?=(isset($obj->name)) ? $obj->name : set_value("name");?>" class="text required" />
				</div>	
				<p class="notes-block-title"><strong><?php echo form_label("Email from*", 'email', array('class'=>'text')) ?></strong></p>
				<div class="main-title-block">
					<input type="text" name="email" id="email" value="<?=(isset($obj->email)) ? $obj->email : set_value("email");?>" class="text required" />
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
					<p class="notes-block-title"><strong><?=form_label("Setting Keys", 'setting_keys', array('class' => 'text'))?></strong></p>
					<div class="main-title-block">
						<span style="color: #848484">
							<? if(isset($obj->setting_key)){ ?>
								<? if($obj->setting_key == 'FORGOT_PASSWORD'){ ?>
									<span><span style="color: #000;line-height: 20px">&nbsp;(User Name keyword)</span>&nbsp;-&nbsp;%%USERNAME%%</span><br/>
									<span><span style="color: #000;line-height: 20px">&nbsp;(New Password keyword)</span>&nbsp;-&nbsp;%%PASSWORD%%</span><br/>
								<? } ?>							
								<? if($obj->setting_key == 'MEMBER_REGISTRATION'){ ?>
									<span><span style="color: #000;line-height: 20px">&nbsp;(E-mail keyword)</span>&nbsp;-&nbsp;%%EMAIL%%</span><br/>
									<span><span style="color: #000;line-height: 20px">&nbsp;(User Name keyword)</span>&nbsp;-&nbsp;%%USERNAME%%</span><br/>
									<span><span style="color: #000;line-height: 20px">&nbsp;(Password keyword)</span>&nbsp;-&nbsp;%%PASSWORD%%</span><br/>
								<? }
							} ?>
						</span>
					</div>					
					<p class="notes-block-title"><strong><?php echo form_label("Title ($lang->uid)*",'title_'.$lang->uid, array('class'=>'text')) ?></strong></p>
					<div class="main-title-block">
						<input type="text" name="title_<?php echo $lang->uid; ?>"
						   id="title_<?php echo $lang->uid; ?>"
						   value="<?php echo (isset($objML[$lang->uid]->title)) ? $objML[$lang->uid]->title : set_value("title_$lang->uid"); ?>"
						   class="text required" />
					</div>					
					<p class="notes-block-title"><strong><?=form_label("Subject ($lang->uid)*", 'subject_' . $lang->uid, array('class' => 'text')) ?></strong></p>
					<div class="main-title-block">
						<input type="text" 
							name="subject_<?= $lang->uid; ?>"
						    id="subject_<?= $lang->uid; ?>"
						    value="<?= (isset($objML[$lang->uid]->subject)) ? $objML[$lang->uid]->subject : ''; ?>"
						    class="text required"/>
					</div>					
					<p class="notes-block-title"><strong><?php echo form_label("Text ($lang->uid)*",'text_'.$lang->uid, array('class'=>'text')) ?></strong></p>
					<div class="main-title-block">
						<textarea name="text_<?= $lang->uid; ?>" id="text_<?= $lang->uid; ?>" class="editor"><?= (isset($objML[$lang->uid]->text)) ? $objML[$lang->uid]->text : ''; ?></textarea>
					</div>						
				</div>
			<?php } ?>
		</div>		
		<div class="save cf"> 
			<span class="icon-but save_submit"><i class="fa fa-check"></i><?php echo $labels->save;?></span>
		</div>
	</div>  
<?php echo form_close(); exit;?>