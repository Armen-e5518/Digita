<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('admin/head'); ?>
</head>
<body class="<?= (!empty($this->userData->userrole) && $this->userData->userrole == 'admin') ? '' : 'rol-user'; ?>">

<div class="wrapper">
    <header id="header">
        <div class="top-head">
            <div class="main-head">
                <div class="center-960-10 cf">
                    <div class="n_logo">
                        <a href="<?php echo site_url('admin'); ?>">
                            <img src="<?php echo site_url('assets/admin/images/logo.png') ?>" width="100">
                        </a>
                    </div>
                    <?php if (!isset($is_login_page)) { ?>
                        <div class="links">
                            <a class="logout" href="<?php echo site_url('admin/admin/logout'); ?>"><i
                                        class="fa fa-lock"></i><?php echo $labels->logout; ?></a>
                            <?php $user = $this->session->userdata('user'); ?>
                            <?php if ($user->userrole == 'admin') { ?>
                                <a class="prof" href="<?php echo site_url('admin/admin/profile'); ?>">

                                    <i class="fa fa-user"></i>
                                    <?php
                                    $user = $this->session->userdata('user');
                                    if (isset($user->first_name)) echo $user->first_name . ' ';
                                    if (isset($user->last_name)) echo $user->last_name;
                                    ?>
                                </a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="center-960-10 cf"></div>
        </div>
    </header>
    <div id="container" class="cf">
        <?php if (!isset($is_login_page)) { ?>
            <div id="left">
                <?php $this->load->view("admin/menu", $this->pageData); ?>
            </div>
        <?php } ?>
        <div id="content">
            <?php $this->load->view($current_view, $this->pageData); ?>
        </div>
    </div>
</div>
<?php $this->load->view("admin/footer1", $this->pageData); ?>
</body>
</html>