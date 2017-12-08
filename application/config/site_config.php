<?php
/*
|--------------------------------------------------------------------------
| Western Congress Hotel
|--------------------------------------------------------------------------
*/
define('DEF_LANG','en');
define('DEF_STATUS_PUBLISHED',1);
define('DEF_STATUS_PENDING', 0);

$config = array();
$config['FileServerPath'] 			= $_SERVER["DOCUMENT_ROOT"].'/uploads/';
$config['viewsPath'] 				= APPPATH.'views/pages/';

$config['settings'] 				= array();
$config['settings']['FileServerPath'] 	= $_SERVER["DOCUMENT_ROOT"].'/uploads/';
$config['settings']['meta']	= array(
									'title'			=> 'CI Framework [title]',
									'description'	=> 'CI Framework [description]',
									'robots'		=> 'index, follow',
									'author'		=> 'e-Works web &amp; mobile development',
								);