<h1><?php echo $labels->pls_login ?></h1>
<?php if(isset($msg) && !empty($msg)){ ?>
    <div class="error_validation"><?php echo $labels->$msg; ?></div>
<?php } ?>
<?php echo form_open('admin/admin/login');?>
	<div class="login-form">
		<p>

			<label for="login" class="label-text"><?php echo $labels->login; ?></label>
			<input type="text" class="input-text" name="login" id="login" value="" />
            <?= isset($invalid_username_password)?$invalid_username_password:'' ?>
			<?php echo form_error('login'); ?>
		</p>
		<p>
			<label for="password" class="label-text"><?php echo  $labels->password ?></label>
			<input type="password" class="input-text" name="password" id="password" value="" />
			<?php echo form_error('password'); ?>
		</p>
		<input type="submit" id="submit_form" value="<?php echo  $labels->connect ?>" name="submit" />
	</div>
<?php echo form_close();?>