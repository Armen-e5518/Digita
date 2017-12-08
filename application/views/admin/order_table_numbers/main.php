<script type="text/javascript">
    setInterval(function () {
        location.reload();
    }, (10 * 1000));
    window.scrollTo(0, document.body.scrollHeight);
    document.body.scrollTop = document.body.scrollHeight;
    $(document).ready(function () {
        $('.o-active').each(function () {
            var time = $(this).find('.o-time').html();
            var d1 = new Date(time);
            var d2 = new Date()
            var diff = Math.abs(d1 - d2);
            if ((diff - 32336283) / 1000 > 60) {
                $(this).addClass('active-time')
            }
        })
    });
</script>

<style>
    body {
        background-image: none !important;;
    }

    .active-time {
        background-color: #eccccc !important;
    }

    li.active-time > div > div {
        background-color: #eccccc !important;
    }

    #container {
        width: 98% !important;
    }

    #left {
        margin-right: 30px !important;
        /*position: absolute;*/
        height: 100% !important;
        background-color: #f1f1f1;
        top: 43px;
    }

    #left, #content, .t-left, .t-right {
        float: left !important;
    }

    #container {
        position: relative;
        display: flex !important;
    }

    .t-right .table-style, .t-left .table-style {
        height: 400px !important;
        overflow: auto !important;
    }

    .t-left, .t-right {
        width: 45%;

    }

    .t-right {
        margin-left: 20px;
    }

    #content {
        width: 100% !important;
    }

    .n_titleBl {
        text-align: center;
    }

    .fa-trash-o {
        color: #ce5f5f;
    }
</style>

<div class="t-left">
    <div class="n_titleBl">
        <h1>Garcon</h1>
        <img class="img-garcon" src="<?= base_url() ?>images/le-garcon-icon.png" alt="">
    </div>
    <? $this->load->view('admin/_blocks/status'); ?>
    <ul class="table-style-head">
        <li>
            <div class="WidthPercent20">
                <div><strong><?php echo $labels->table_number; ?></strong></div>
            </div>
            <div class="WidthPercent30">
                <div><strong><?php echo $labels->date; ?></strong></div>
            </div>

            <div class="WidthPercent30">
                <div><strong><?php echo $labels->approve_date; ?></strong></div>
            </div>
            <div class="WidthPercent20">
                <div><strong><?= $labels->quick_actions; ?></strong></div>
            </div>
        </li>
    </ul>
    <?php if (!empty($garcon_new) || !empty($garcon_o) ) { ?>
        <ul class="table-style">
            <?php foreach ($garcon_new as $item): ?>
                <li class="no-action <?= ($item->status == 0) ? 'o-active' : '' ?> ">
                    <div class="WidthPercent20">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->table_number; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <em class="o-time">
                                <?php
								$first = reset($garcon_group[$item->group_id]);
								$last = end($garcon_group[$item->group_id]);
								if($first == $last)
								{
									echo date(' H:i:s', $first);
								}
								else
								{
									echo date(' H:i:s', $first);
									echo ' - ';
									echo date(' H:i:s', $last);
								}
								?>

								<?php
								echo (count($garcon_group[$item->group_id])>1)
									? ' (' . count($garcon_group[$item->group_id]) . ')'
									: '';

								?>
                            </em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <?php if (isset($item->push_date) && $item->push_date) { ?>
                                <em><?php echo date(' H:i:s', $item->push_date); ?></em>
                            <?php } else { ?>
                                <em>--</em>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="WidthPercent20">
                        <div class="n_transparence">
                            <b class="options">
                                <?php if ($item->status == 0): ?>
                                    <button title="Confirm" class="confirm-m" type="button"
                                            data-table-id="<?= $item->id; ?>"
                                            data-table-number="<?= $item->table_number; ?>"
											data-group_id="<?= $item->group_id; ?>"
                                    >
                                        <i class="fa fa-check"></i>
                                    </button>
                                <?php endif; ?>
                                <a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
                                   href="<?= site_url("admin/{$mod}/remove/{$item->id}/{$pageNum}"); ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </b>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php foreach ($garcon_o as $item): ?>
                <li class="no-action <?= ($item->status == 0) ? 'o-active' : '' ?> ">
                    <div class="WidthPercent20">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->table_number; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <em class="o-time">
								<?php
								$first = reset($garcon_0_group[$item->group_id]);
								$last = end($garcon_0_group[$item->group_id]);
								if($first == $last)
								{
									echo date(' H:i:s', $first);
								}
								else
								{
									echo date(' H:i:s', $first);
									echo ' - ';
									echo date(' H:i:s', $last);
								}
								?>
                                <?= !empty($item->count && $item->count > 1) ? ' (' . $item->count . ')' : '' ?>
                            </em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <?php if (isset($item->push_date) && $item->push_date) { ?>
                                <em><?php echo date(' H:i:s', $item->push_date); ?></em>
                            <?php } else { ?>
                                <em>--</em>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="WidthPercent20">
                        <div class="n_transparence">
                            <b class="options">
                                <?php if ($item->status == 0): ?>
                                    <button title="Confirm" class="confirm-m" type="button"
                                            data-table-id="<?= $item->id; ?>"
                                            data-table-number="<?= $item->table_number; ?>"
											data-group_id="<?= $item->group_id; ?>"
                                    >
                                        <i class="fa fa-check"></i>
                                    </button>
                                <?php endif; ?>
								<?php /* ?>
								<a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
								   href="<?= site_url("admin/{$mod}/remove/{$item->table_number}/{$pageNum}/1"); ?>">
									<i class="fa fa-trash-o"></i>
								</a>

								<a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
								   href="<?= site_url("admin/{$mod}/remove/{$item->id}/{$pageNum}"); ?>">
									<i class="fa fa-trash-o"></i>
								</a>
 								<?php */ ?>
								<?php
								$bill_status = 0;
								$table_number =  $item->count > 1 ? $item->table_number : 0;
								?>
								<a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
								   href="<?= site_url("admin/{$mod}/remove_new/{$item->id}/{$bill_status}/{$table_number}/{$pageNum}"); ?>">
									<i class="fa fa-trash-o"></i>
								</a>
                            </b>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="pager">
            <?php echo ($pagination) ? $pagination : ''; ?>
        </div>
    <?php } ?>
</div>

<div class="t-right">
    <div class="n_titleBl">
        <h1>Bill</h1>
        <img class="img-bill" src="<?= base_url() ?>images/my-bill-please-icon.png" alt="">
    </div>
    <? $this->load->view('admin/_blocks/status'); ?>
    <ul class="table-style-head">
        <li>
            <div class="WidthPercent20">
                <div><strong><?php echo $labels->table_number; ?></strong></div>
            </div>
            <div class="WidthPercent30">
                <div><strong><?php echo $labels->date; ?></strong></div>
            </div>

            <div class="WidthPercent30">
                <div><strong><?php echo $labels->approve_date; ?></strong></div>
            </div>
            <div class="WidthPercent20">
                <div><strong><?= $labels->quick_actions; ?></strong></div>
            </div>
        </li>
    </ul>
    <?php if (!empty($bill_new) || !empty($bill_o)) { ?>
        <ul class="table-style">
            <?php foreach ($bill_new as $item): ?>
                <li class="no-action <?= ($item->status == 0) ? 'o-active' : '' ?> ">
                    <div class="WidthPercent20">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->table_number; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <em class="o-time">
								<?php
								$first = reset($bill_group[$item->group_id]);
								$last = end($bill_group[$item->group_id]);
								if($first == $last)
								{
									echo date(' H:i:s', $first);
								}
								else
								{
									echo date(' H:i:s', $first);
									echo ' - ';
									echo date(' H:i:s', $last);
								}
								?>
								<?php
								echo (count($bill_group[$item->group_id])>1)
									? ' (' . count($bill_group[$item->group_id]) . ')'
									: '';

								?>
                             </em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <?php if (isset($item->push_date) && $item->push_date) { ?>
                                <em><?php echo date(' H:i:s', $item->push_date); ?></em>
                            <?php } else { ?>
                                <em>--</em>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="WidthPercent20">
                        <div class="n_transparence">
                            <b class="options">
                                <?php if ($item->status == 0): ?>
                                    <button title="Confirm" class="confirm-m" type="button"
                                            data-table-id="<?= $item->id; ?>"
                                            data-table-number="<?= $item->table_number; ?>"
                                            data-group_id="<?= $item->group_id; ?>"
                                    >
                                        <i class="fa fa-check"></i>
                                    </button>
                                <?php endif; ?>
                                <a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
                                   href="<?= site_url("admin/{$mod}/remove/{$item->id}/{$pageNum}"); ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </b>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php foreach ($bill_o as $item): ?>
                <li class="no-action <?= ($item->status == 0) ? 'o-active' : '' ?> ">
                    <div class="WidthPercent20">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->table_number; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <em class="o-time">
								<?php
								$first = reset($bill_0_group[$item->group_id]);
								$last = end($bill_0_group[$item->group_id]);
								if($first == $last)
								{
									echo date(' H:i:s', $first);
								}
								else
								{
									echo date(' H:i:s', $first);
									echo ' - ';
									echo date(' H:i:s', $last);
								}
								?>
                                <?= !empty($item->count && $item->count > 1) ? ' (' . $item->count . ')' : '' ?>
                            </em>
                        </div>
                    </div>
                    <div class="WidthPercent30">
                        <div class="n_transparence n_hover">
                            <?php if (isset($item->push_date) && $item->push_date) { ?>
                                <em><?php echo date(' H:i:s', $item->push_date); ?></em>
                            <?php } else { ?>
                                <em>--</em>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="WidthPercent20">
                        <div class="n_transparence">
                            <b class="options">
                                <?php if ($item->status == 0): ?>
                                    <button title="Confirm" class="confirm-m" type="button"
                                            data-table-id="<?= $item->id; ?>"
                                            data-table-number="<?= $item->table_number; ?>"
											data-group_id="<?= $item->group_id; ?>"
                                    >
                                        <i class="fa fa-check"></i>
                                    </button>
                                <?php endif; ?>
								<?php /* ?>
								<a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
								   href="<?= site_url("admin/{$mod}/remove/{$item->table_number}/{$pageNum}/1"); ?>">
									<i class="fa fa-trash-o"></i>
								</a>
								<?php */ ?>
								<?php
								//out($item->count);
								$bill_status = 1;
								$table_number =  $item->count > 1 ? $item->table_number : 0;
								?>
								<a title="<?php echo $labels->trash; ?>" class="remove-btn delete"
								   href="<?= site_url("admin/{$mod}/remove_new/{$item->id}/{$bill_status}/{$table_number}/{$pageNum}"); ?>">
									<i class="fa fa-trash-o"></i>
								</a>
                            </b>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="pager">
            <?php echo ($pagination) ? $pagination : ''; ?>
        </div>
    <?php } ?>
</div>
