<div class="n_titleBl">
    <h1><?php echo $labels->labels . ' ' . $labels->list; ?></h1>


    <div class="search-block">
        <form action="/admin/labels/index/0/" method="post" onsubmit="return checkSearchBLock(this)" id="search-block">
            <a href="/admin/labels/index/0">
                <button type="button">Reset</button>
            </a>
            <input type="text" id="q" value="<?= isset($q) && $q ? $q : '' ?>">
            <button type="submit">Search</button>
        </form>
        </span>
    </div>
    <? $this->load->view('admin/_blocks/status'); ?>
    <ul class="table-style-head">
        <li>
            <div class="WidthPercent60">
                <div><strong><?php echo $labels->text; ?></strong></div>
            </div>
            <div class="WidthPercent20">
                <div><strong><?php echo $labels->key; ?></strong></div>
            </div>
            <div class="WidthPercent10">
                <div><strong><?= $labels->type; ?></strong></div>
            </div>
            <div class="WidthPercent10">
                <div><strong><?= $labels->quick_actions; ?></strong></div>
            </div>
        </li>
    </ul>
    <?php if (isset($items) && !empty($items)) { ?>
        <ul class="table-style">
            <?php foreach ($items as $item) { ?>
                <li>
                    <div class="WidthPercent60">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->text; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent20">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->key; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent10">
                        <div class="n_transparence n_hover">
                            <em><?php echo $item->type; ?></em>
                        </div>
                    </div>
                    <div class="WidthPercent10">
                        <div class="n_transparence">
                            <b class="options">
                                <a title="<?php echo $labels->edit; ?>"
                                   href="<?= site_url("admin/{$mod}/edit/{$item->id}/{$pageNum}"); ?>"
                                   class="edit_item">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </b>
                        </div>
                    </div>
                </li>
            <?php } ?>

        </ul>
        <div class="pager">
            <?php echo ($pagination) ? $pagination : ''; ?>
        </div>
    <?php } ?>

    <script type="text/javascript">
        function checkSearchBLock(e) {

            var q = $('#q').val();
            if ($.trim(q).length) {
                $('#search-block').attr('action', $('#search-block').attr('action') + q);
                return true;
            } else {
                return false;
            }
        }
    </script>
    