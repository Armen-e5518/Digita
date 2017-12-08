<? if (empty($table_flag)): ?>
    <title><?php $restaurant[0]['title'] ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>-->
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/css/style.css"/>
    <?php if ($this->isMobileDevice): ?>
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url() ?>assets/css/mobile.css"/>
    <?php endif; ?>
    <link rel="stylesheet" type="text/css" media="screen"
          href="<?php echo base_url() ?>assets/css/font-awesome.min.css"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/js/swiper/dist/css/swiper.min.css">

    <link type="text/css" rel="stylesheet"
          href="/assets/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css"/>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/assets/js/malihu-custom-scrollbar-plugin-master/js/minified/jquery-1.11.0.min.js"><\/script>')</script>
    <script src="/assets/js/malihu-custom-scrollbar-plugin-master/js/uncompressed/jquery.mCustomScrollbar.js"></script>

    <script src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>
    <script src="<?php echo base_url() ?>assets/js/src.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.accordion.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.touchSwipe.min.js"></script>
    <link rel="stylesheet" href="/assets/js/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.css">

    <script>
        labelMessages = {
            successfully_subscribed: "<?= translate('successfully_subscribed') ?>",
            invalid_email: "<?= translate('invalid_email') ?>",
            required_field: "<?= translate('required_field') ?>",
        }
    </script>

<?php endif; ?>
