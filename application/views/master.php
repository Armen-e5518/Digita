<?php if (empty($table_flag)): ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php $this->load->view("head"); ?>
    </head>
    <body>
    <div class="wrap">
        <div data-role="page" class="main <?php if ($page == 'menu' || $page == 'order') {
            echo "inner-main";
        } ?>">
            <?php $this->load->view("header", $this->pageData); ?>
            <?php if (file_exists(VIEWPATH . $current_view . '.php')) {
                $this->load->view($current_view, $this->pageData);

            } ?>
        </div>
        <script>
            (function () {
                $(".restaurant_menu").dcAccordion();

            })();
        </script>
    </body>
    </html>
<?php else: ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php $this->load->view("head"); ?>
    </head>
    <body>
    <div class="wrap">
        <div data-role="page" class="main">
            <?php $this->load->view("header", $this->pageData); ?>
            <?php if (file_exists(VIEWPATH . $current_view . '.php')) {
                $this->load->view($current_view, $this->pageData);
            } ?>
        </div>
    </div>
    </body>
    </html>
<?php endif; ?>