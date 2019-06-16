<?php 
namespace App\Controller;

if (!defined('APP_PATH')) {
	die('cant acess');
}
class Controller{
	protected function loadHeader(){
		$title = $header['title']??'';
		$content = $header['content']??'';
		require 'application/view/common/header_view.php';
	}
	protected function loadNav(){
		require 'application/view/common/nav_view.php';
	}
	protected function loadView($path,$data=[]){
		extract($data);
		require $path.'.php';
	}
	protected function loadFooter(){
		require 'application/view/common/footer_view.php';
	}

}