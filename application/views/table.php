<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Le Rabassier restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/table/styles.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/table/reset.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet">


</head>
<body style="background:URL( <?= base_url().$background_image?>)">
<div class="wrapper">
    <div class="container">
        <a href="#" class="logo">
            <img src="<?php echo base_url().$logo_img ?>" alt="Le Rabassier restaurant">
        </a>
        <div class="table-no">TABLE # <?= $table_index ?></div>
        <div class="choice-to-do">
            <div>
                <a href="#" onclick="sendTableNumber(0)" class="le-garson"></a>
                <span>Le gar&ccedil;on</span>
            </div>
            <div>
                <a href="#" onclick="sendTableNumber(1)" class="my-bill-please"></a>
                <span>My bill, please</span>
            </div>
        </div>
        <div class="timer"></div>
        <div class="copyright">Powered by <a href="http://www.digitalmenu.be/" target="_blank">www.digitalmenu.be</a>
        </div>
    </div>
</div>
<script>
    var _Table_index = <?=$table_index?>;
    var _Restaurant_id = <?=$restaurant_id?>;
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/table/table-order.js"></script>
</body>
</html>