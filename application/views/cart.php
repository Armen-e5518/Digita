<div id="lang-container" style="display: none;" class="cart-container">
    <div id="lang-items">
        <?php if (isset($lang_array) && !empty($lang_array)): ?>
            <?php foreach ($lang_array as $lang_array_item): ?>
                <?php if ($this->_lang != $lang_array_item->uid) { ?>
                    <a class="lang-item" href="/<?= $this->uri->segment(1) ?>/<?= $this->uri->segment(2) ?>?lang=<?= $lang_array_item->uid ?>"><?= $lang_array_item->title ?></a>
                <?php } ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
