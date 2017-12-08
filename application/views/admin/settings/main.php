<script type="text/javascript" src="<?=site_url('assets/admin/js/jquery.cookie.js')?>"></script>	
<script>
$(function() {
	$('#tabs').tabs({
		active: ($.cookies.get('ui-tabs')) ? $.cookies.get('ui-tabs') : 0,
		beforeActivate : function(e, ui) { 
			var tabName = ui.newPanel.selector;
				var tabName =  tabName.split("#tabs-");
				var tabIndex = tabName[1] - 1
				$.cookies.set('ui-tabs', tabIndex);
		},
		// select: function(event, ui) { 
			// lastTab = ui.index; 
			// console.log(lastTab);
		// } 
	});
});
</script>
<div class="n_titleBl">
    <h1><?=$labels->$mod?></h1>
</div>    
<? $this->load->view('admin/_blocks/status');?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1" class="click_tab" id="1">Words</a></li>
	</ul>
	<div id="tabs-1">
		<ul class="table-style-head">
			<li>
				<div class="WidthPercent80">
					<div><strong><?php echo $labels->title;?></strong></div>
				</div>				
				<div class="WidthPercent20">
					<div><strong><?=$labels->quick_actions;?></strong></div>
				</div>
			</li>
		</ul>
		<? if(isset($items[2]) && !empty($items[2])){ ?>
			<ul class="table-style">
			<? foreach($items[2] as $item){ ?>
				<li>                
					<div class="WidthPercent80">
						<div class="n_transparence">
						<?=$item->name;?>
						</div>
					</div>						
					<div class="WidthPercent20">
						<div class="n_transparence">
							<b class="options">
								<a href="<?= site_url("admin/{$mod}/toggle/{$item->id}"); ?>" class="n_transparence n_valid_icon <?php if(isset($item->status) && $item->status>0) echo 'n_valid';?>"><i class="fa fa-check-circle "></i></a>
								<a title="<?php echo $labels->edit;?>" href="<?= site_url("admin/{$mod}/edit/{$item->id}"); ?>" class="edit_item"><i class="fa fa-pencil"></i></a>
							</b>
						</div>
					</div>
				</li>
			<? }  ?>
			</ul>
		<?	} ?>		
	</div>
</div>