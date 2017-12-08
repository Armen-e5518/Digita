<?php
$menu_items = array();
$sub_items = array();
$menu_items[]['link'] = 'restaurants';
//	$menu_items[]['link'] = 'advertisement';
//	$menu_items[]['link'] = 'subscribers';
$menu_items[]['link'] = 'order_table_numbers';
$menu_items[]['link'] = 'labels';
$menu_items[]['link'] = 'settings';

$is_active_sub = $this->uri->segment(3);
?>

<?php if ($session = $this->session->userdata('user')): ?>
    <?php if ($session->userrole == 'admin'): ?>

        <div id="menu_row">
            <ul class="left-menu">
                <?php foreach ($menu_items as $mitem): ?>
                    <?php if ($mitem['link'] == 'order_table_numbers') {
                        continue;
                    } ?>
                    <li>
                        <?php
                        $url = site_url("admin/" . $mitem['link']);
                        if ($mitem['link'] == 'other') {
                            $url = '#';
                        }
                        ?>
                        <a href="<?= ($url); ?>" <?php if (isset($is_active) && ($is_active == $mitem['link'])) print 'class="n_active"'; ?>>
                            <i class="fa fa-files-o"></i><?= $labels->$mitem['link']; ?>
                        </a>
                        <?php if (isset($sub_items[$mitem['link']]) && !empty($sub_items[$mitem['link']])): ?>
                            <ul style='margin-left:20px;'>
                                <?php foreach ($sub_items[$mitem['link']] as $subitem) :
                                    $sub_url = site_url("admin/" . $subitem); ?>
                                    <li>
                                        <a href="<?= $sub_url; ?>" <?php if (isset($is_active) && isset($is_active_sub) && strpos($sub_url, $is_active_sub)) print 'class="n_active"'; ?>><i
                                                    class="fa fa-files-o"></i><?= $labels->$subitem; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
<?php endif; ?>