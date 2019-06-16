<?php
namespace App\Controller;
if (!defined('APP_PATH')) {
	die ('cant acess');
}
class LoginController{
	public function handle(){
		if (isset($_POST['btnLogin'])) {
			echo "<pre>";
			print_r($_POST);
			# code...
		}
	}
}
$login = new LoginController;
$m = $_GET['m'] ?? "index";
$login->$m();