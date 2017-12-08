<?php if($this->session->userdata('edit') == 1){ $this->session->unset_userdata('edit'); ?>
	<div class="success edit">Has been edited</div>
<?php } ?>
<?php if($this->session->userdata('remove') == 1){ $this->session->unset_userdata('remove'); ?>
	<div class="success">Has been removed</div>
<?php } ?>
<?php if($this->session->userdata('cache_created') == 1){ $this->session->unset_userdata('cache_created'); ?>
	<div class="success edit">Cache has been created</div>
<?php } ?>

<?php if($this->session->userdata('CategoriesGroupsCacheCreat') == 1){ $this->session->unset_userdata('CategoriesGroupsCacheCreat'); ?>
	<div class="success edit">Categories & Groups cache has been created</div>
<?php } ?>
<?php if($this->session->userdata('CategoriesGroupsRemove') == 1){ $this->session->unset_userdata('CategoriesGroupsRemove'); ?>
	<div class="success edit">Categories & Groups cache has been removed</div>
<?php } ?>
<?php if($this->session->userdata('TourCacheCreat') == 1){ $this->session->unset_userdata('TourCacheCreat'); ?>
	<div class="success edit">Tour cache has been created</div>
<?php } ?>
<?php if($this->session->userdata('TourCacheRemove') == 1){ $this->session->unset_userdata('TourCacheRemove'); ?>
	<div class="success edit">Tour cache has been removed</div>
<?php } ?>