<? if (empty($table_flag)): ?>
    <?php $this->load->view('dynamic_css') ?>

    <div class="header">
        <div class="left">
            <a id="menu-close" href="javascript:void(0)" class="menu" data-toggle=".container">
                <div class="menu-btn"></div>
            </a>
            <a href="javascript:void(0)">
                <img class="logo"
                     src="<?php echo base_url() ?><?php echo $restaurant[0]['logo_img'] ?>">
            </a>

        </div>

        <div class="right">
            <a class="fav menu-preview" id="icon-bell" href="javascript:void(0)">
                <svg width="48.75" height="40" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 525.153 525.153" style="enable-background:new 0 0 525.153 525.153;"
                     xml:space="preserve">
                <path class="cls-1" d="M139.165,51.421l-35.776-35.864C43.413,61.202,3.742,132.185,0,212.402h50.174
                    C53.916,145.992,88.051,87.766,139.165,51.421z M474.979,212.402h50.174c-3.742-80.217-43.413-151.2-103.586-196.845
                    l-35.863,35.864C437.102,87.766,471.237,145.992,474.979,212.402z M425.592,224.984c0-77-53.391-141.463-125.424-158.487V49.408
                    c0-20.787-16.761-37.614-37.592-37.614s-37.592,16.827-37.592,37.614v17.089C152.951,83.521,99.56,148.005,99.56,224.984v137.918
                    l-50.152,50.108v25.076h426.336v-25.076l-50.152-50.108C425.592,362.902,425.592,224.984,425.592,224.984z M262.576,513.358
                    c3.523,0,6.761-0.219,10.065-1.007c16.236-3.238,29.824-14.529,36.06-29.627c2.516-5.952,4.048-12.494,4.048-19.54H212.402
                    C212.402,490.777,234.984,513.358,262.576,513.358z"/>
            </svg>
            </a>
            <a class="fav menu-preview" id="language-sel" href="javascript:void(0)">
                <img src="/assets/images/flags/<?= $this->_lang ?>.svg" alt="">
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </a>
            <?php $this->load->view('cart') ?>
        </div>

    </div>
<?php endif; ?>