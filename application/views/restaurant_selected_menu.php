<?php
function debug($arr)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
}

foreach ($menu_items as $item) {
    ?>

    <p><?= $item['title'] ?>----------------<?= $item['price'] . $item['currency'] ?></p>
    <?php if (!empty($item['compound'])) {
        echo "<p>(" . $item['compound'] . ")</p>";
    } ?>

    <?php
}
