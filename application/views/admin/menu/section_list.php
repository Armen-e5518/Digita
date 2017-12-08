<div class="n_titleBl">
    <h1><?=$labels->$mod .' &raquo; '. $labels->sections .' '. $labels->list;?></h1>   
</div>    
<? $this->load->view('admin/_blocks/status'); ?>
<ul class="table-style-head">
    <li>
        <div class="WidthPercent73">
            <div><strong><?php echo $labels->title;?></strong></div>
        </div>
        <div class="WidthPercent8">
            <div><strong><?=$labels->status?></strong></div>
        </div>
        <div class="WidthPercent19">
            <div><strong><?=$labels->quick_actions?></strong></div>
        </div>
    </li>
 </ul>
<?php if (isset($items) && !empty($items)) { ?>
    <ul class="table-style">
        <?php foreach ($items as $item) { ?>       
            <li>                
                <div class="WidthPercent73">
                    <div class="n_transparence n_hover">
                        <em><?php echo anchor(site_url('admin/menu/opensection/'.$item->id),$item->title); ?></em>
                    </div>
                </div>
                <div class="WidthPercent8">
                    <div class="n_transparence n_valid_icon <?php if(isset($item->status) && $item->status>0) echo 'n_valid';?>">
                        <i class="fa fa-check-circle "></i>
                    </div>
                </div>
                <div class="WidthPercent19">
                    <div class="n_transparence">
                        <b class="options">
                            <a title="<?php echo $labels->edit;?>" href="<?= site_url("admin/{$mod}/opensection/{$item->id}/{$pageNum}"); ?>" class="edit_item">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </b>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php } ?>