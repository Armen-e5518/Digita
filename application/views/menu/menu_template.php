<li class="<?= isset($category['childs']) ? 'has-child' : '' ?>">
    <a data-id="<?= $category['id'] ?>"
       href="<?php echo base_url() ?>menu/<? echo $category['id'] ?>/<?= $index ?>/<?= (isset($slug) ? $slug : '') ?>"
       data-product="<?php echo $category['id']; ?>">

        <?php if (mb_strlen($category['title']) > 20) {
            echo substr($category['title'], 0, 20) . '...';
        } else {
            echo $category['title'];
        } ?>
    </a>
    <?php if (isset($category['childs'])): ?>
        <ul class="left-nav-menu">
            <?php echo $this->categories_to_string($category['childs'], (isset($slug) ? $slug : '')); ?>
        </ul>
    <?php endif; ?>
</li>