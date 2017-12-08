<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');
// define
define('ADMIN_DEF_LANG', 'en');
define('STATUS_PUBLISHED', 1);
define('STATUS_PENDING', 0);

//settings
$config  = array();
$config['settings']['FileServerPath'] 		= $_SERVER["DOCUMENT_ROOT"].'/uploads/';
$config['settings']['status'] 				= array('1'=>'yes', '0' =>'no');
$config['settings']['status_show_in_menu'] 	= array(
													'1' => 'yes',
													'0' => 'no'
												);
$config['settings']['contentPerPage']		= 10;
$config['settings']['contentNumLinks']		= 5;

//News sections
$config['settings']['newsPerPage']			= 10;
$config['settings']['newsNumLinks']			= 5;

$config['settings']['SettingsStripTagsIds']			= array(1,2,3,4,5,6,7,11,12,13,14,15);
$config['settings']['MenuNotRemovedIds']			= array(1000,1001,166679,166683);
$config['settings']['HealthcareNotRemovedIds']		= array(1,2,3,4,5);
$config['settings']['ContentNotRemovedIds']			= array(1,2,3,4,5,6,30);
$config['settings']['QrUrl'] = 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&choe=UTF-8&chl=';