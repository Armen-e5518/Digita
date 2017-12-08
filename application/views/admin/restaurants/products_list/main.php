<div class="n_titleBl">
    <h1><?php echo "Products List" ?></h1>
    <a href="<?= site_url("admin/{$mod}/edit_product/{$section_id}/0/{$restaurants_menu_id}/{$pid}/{$pageNum}"); ?>" class="n_add">+ <?php echo $labels->add;?></a>
</div>
<div class="n_backWrap">
    <a href="<?=site_url("/admin/restaurants/restaurant_menu_edit/{$section_id}/{$restaurants_menu_id}/{$pid}");?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<? $this->load->view('admin/_blocks/status'); ?>
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
<?php if(isset($items) && !empty($items)) { ?>
    <ul class="table-style">
        <?php foreach ($items as $item) { ?>
            <li>
                <div class="WidthPercent80">
                    <div class="n_transparence n_hover">
                        <em><?php echo $item->title; ?></em>
                    </div>
                </div>
                <div class="WidthPercent20">
                    <div class="n_transparence">
                        <b class="options">
                            <a  href="<?= site_url("admin/{$mod}/product_toggle/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}/{$item->id}"); ?>" class="n_transparence n_valid_icon <?php if(isset($item->status) && $item->status>0) echo 'n_valid';?>">
                                <i class="fa fa-check-circle "></i>
                            </a>
                            <a title="<?php echo $labels->edit;?>" href="<?= site_url("admin/{$mod}/edit_product/{$section_id}/{$item->id}/{$restaurants_menu_id}/{$pid}/{$pageNum}"); ?>" class="edit_item">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <a title="<?php echo $labels->trash;?>" class="remove-btn delete" href="<?= site_url("admin/{$mod}/product_remove/{$section_id}/{$restaurants_menu_id}/{$pid}/{$pageNum}/{$item->id}"); ?>">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </b>
                    </div>
                </div>
            </li>
        <?php } ?>

    </ul>
    <div class="pager">
<!--        --><?php //echo ($pagination)?$pagination:''; ?>
    </div>
<?php } ?>