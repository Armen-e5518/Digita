
<!DOCTYPE html>
<html>
<head>
    <meta name="robots" content="noindex, nofollow">
    <link rel="stylesheet" href="/assets/admin/css/style.css">
</head>
<body style="background:#f8f8f8;">
<div class="wrapper">
    <div id="container" class="cf">
        <div id="content">
            <h1><?php echo ""; ?></h1>
            <?php if(isset($error_string) && !empty($error_string)){ ?>
                <div class="error_validation"><?php echo $error_string ?></div>
            <?php } ?>
            <h1>Please log in to your restaurant account</h1>
            <form action="<?php echo base_url();?>login/login" method="post" accept-charset="utf-8">
                <div class="login-form">
                    <p>
                        <label for="login" class="label-text">Login</label>
                        <input type="text" class="input-text" name="username" id="login" value="" />
                    </p>
                    <p>
                        <label for="password" class="label-text">Password</label>
                        <input type="password" class="input-text" name="password" id="password" value="" />
                    </p>
                    <input type="submit" id="submit_form" value="Login" name="submit" />
                </div>
            </form>        </div>
    </div>
</div>
<footer id="footer"></footer>
</body>
</html>