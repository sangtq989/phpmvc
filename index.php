<?php 
session_start();
//dasdafsrgfad

if (file_exists('route/web.php')) {
	define('APP_PATH', 'index.php');
	require_once 'application/helper/common_helper.php';	
	require 'route/web.php';
}else{
	die('Website dang bao tri');
}
//them comment

if(1 <3 )
echo "ong day toi android nho"

