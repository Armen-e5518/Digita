<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
      integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<div class="container">
    <form action="">
        <div class="row">
            <div class="col-md-4">
                <input type="number" value="<?= $count ?>" name="count" placeholder="count QR codes">
                <input type="hidden" value="<?= !empty($restaurant_id) ? $restaurant_id : null ?>" name="id">
            </div>
            <div class="col-md-4">
                <input type="submit" value="Submit">
            </div>
            <div class="col-md-4">
                <input type="button" id='save-pdf' value="Download PDF">
            </div>
        </div>
    </form>
    <?php if (!empty($qrs)): ?>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <tr class="success">
                        <th>QR</th>
                        <th>URL</th>
                    </tr>
                    <?php foreach ($qrs as $k => $qr): ?>
                        <tr>
                            <th><img class="qr-img" data-index= <?= $k ?> src="<?= $qr->qr ?>" alt=""></th>
                            <th><a target="_blank" href="<?= $qr->url ?>"><?= $qr->url ?></a></th>
                        </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    <?php endif; ?>
</div>
