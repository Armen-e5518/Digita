<div class="n_titleBl">
    <h1><?=$menu['name'].' &raquo; '. 'Menu ' . $labels->list;?></h1>
    <a href="<?=site_url('/admin/restaurants/restaurant_menu_edit/'. $id .'/0');?>" class="n_add">+ <?php echo $labels->add;?></a>
</div>
<div class="n_backWrap">
    <a href="<?=site_url("/admin/restaurants/edit/{$id}/{$pageNum}");?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?= $labels->back; ?></a>
</div>
<div class="clr">
    <? $this->load->view('admin/_blocks/status'); ?>
</div>
<ul class="table-style-head">
    <li>
        <div class="WidthPercent71">
            <div class="<?= isset($order_key) && $order_key == 'Status_' ? 'active-order-col' : '' ?>">
                <a href="javascript:void(0);" class="for-list-ordering">
                    <strong><?php echo $labels->title;?>
                        <?php if (isset($order_key) && $order_key == 'Status_') { ?>
                            <?php if ($order_type && $order_type == 'asc') { ?>
                                <i class="fa fa-long-arrow-down"></i>
                            <?php } else { ?>
                                <i class="fa fa-long-arrow-up"></i>
                            <?php } ?>
                        <?php } ?>
                    </strong>
                </a>
            </div>
        </div>

        <div class="WidthPercent19">
            <div><a href="javascript:void(0);"><strong>Quick Actions</strong></a></div>
        </div>
    </li>
</ul>
<?php if (isset($items) && !empty($items)) { ?>
    <ul class="table-style">
        <?php foreach ($items as $item) { ?>

            <li>

                <div class="WidthPercent71">
                    <div class="n_transparence n_hover">
                        <em><?php echo anchor(site_url('admin/menu/opensection/'.$item->id),$item->title); ?></em>
                    </div>
                </div>
                <div class="WidthPercent10">
                    <div class="n_transparence n_valid_icon <?php if(isset($item->status) && $item->status>0) echo 'n_valid';?>">
                        <i class="fa fa-check-circle "></i>
                    </div>
                </div>
                <div class="WidthPercent19">
                    <div class="n_transparence">
                        <b class="options">
                            <a title="<?php echo $labels->edit;?>" href="<?= site_url("admin/{$mod}/editsection/{$item->id}/{$pageNum}"); ?>" class="edit_item">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </b>
                    </div>
                </div>
            </li>
        <?php } ?>

    </ul>
<?php } ?>
<?php
if($menu['html']){
    echo $menu['html'];
    ?>
    <div style='text-align:center;'>
        <input type='hidden' class="section_id" value="<?=$id;?>" />
<?php if(mb_strlen($menu['html']) > 83):?>
        <span class="icon-but save_restaurant_menu"><i class="fa fa-refresh"></i> <?=$labels->confirm_the_changes;?></span>
<?php endif;?>
    </div>
    <?php
}
?>