<script type="text/javascript">
$(document).ready(function () {
	$("#FormData").validate();
});
</script>
<h1><?php echo $labels->profile_title;?></h1>
<div class="n_backWrap">
    <a href="<?php echo site_url('admin');?>" class="n_back"><i class="fa fa-long-arrow-left"></i> <?=$labels->back; ?></a>
</div>
<?php $this->load->view('admin/_blocks/status'); ?>
<?php if(isset($error_string) && !empty($error_string)) { echo $error_string; } ?>
<?php echo form_open('admin/admin/profile', 'id="FormData"') ?>
<div class="block-bordered">
    <h3><span><?php echo $labels->profile_info;?></span></h3>
    <?= form_error('mail') ?>
    <div class="title-cr cf">
        <label for="email"><?php echo $labels->profile_email;?></label>
        <input type="text" name="email" id="email" placeholder="<?php echo $labels->profile_email;?>"
               value="<?= (isset($userObj->email) && $userObj->email) ? $userObj->email : '' ?>"
               class="text"/>

    </div>
    
    <?= form_error('first_name') ?>
    <div class="title-cr cf">
        <label for="first_name"><?php echo $labels->profile_firstname;?></label>
        <input type="text" name="first_name" id="first_name" placeholder="<?php echo $labels->profile_firstname;?>"
               value="<?= (isset($userObj->first_name) && $userObj->first_name) ? $userObj->first_name : '' ?>"
               class="text"/>

    </div>
    
    <?= form_error('last_name') ?>
    <div class="title-cr cf">
        <label for="last_name"><?php echo $labels->profile_lastname;?></label>
        <input type="text" name="last_name" id="last_name" placeholder="<?php echo $labels->profile_lastname;?>"
               value="<?= (isset($userObj->last_name) && $userObj->last_name) ? $userObj->last_name : '' ?>"
               class="text"/>

    </div>
    <div class="leave_blank"><?php echo $labels->profile_leave_blank;?></div>
    <?= form_error('oldpass') ?>
    <div class="title-cr cf">
        <label for="oldpass"><?php echo $labels->profile_old_pass;?></label>
        <input type="password" name="oldpass" id="oldpass" placeholder="<?php echo $labels->profile_old_pass;?>" value="" class="text"/>
    </div>
    
    <?= form_error('pass') ?>
    <div class="title-cr cf">
        <label for="pass"><?php echo $labels->profile_new_pass;?></label>
        <input type="password" name="pass" id="pass" placeholder="<?php echo $labels->profile_new_pass;?>" value="" class="text"/>
    </div>
    <?= form_error('repass') ?>
    <div class="title-cr cf">
        <label for="repass"><?php echo $labels->profile_confirm_pass;?></label>
        <input type="password" name="repass" id="repass" placeholder="<?php echo $labels->profile_confirm_pass;?>" value="" class="text"/>
    </div>
</div>
<div class="align-center">
    <span class="input-icon-but"><i class="fa fa-refresh"></i><input type="submit" name="" value="<?php echo $labels->save_changes;?>"></span>
</div>
<?php form_close(); ?>