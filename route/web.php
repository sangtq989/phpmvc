<?php 
if (!defined('APP_PATH')) {
	die('cant access');
}
/**
 * 
 */
class Route
{
	public function home()
	{
		// echo "this is route-home";
		//dieu huong vao controller-home
		require 'application/controller/HomeController.php';
	}
	public function cart()
	{
		//  http://localhost/phpMVC/?c=cart
		echo "this is route cart";
	}
	public function login(){
		require 'application/controller/LoginController.php';
	}
	public function about(){
		require 'application/controller/AboutController.php';
	}
	public function contact(){
		require 'application/controller/ContactController.php';
	}
	public function admin(){
		require 'application/controller/AdminController.php';
	}
	public function __call($req,$res){
		echo 'Method khong ton tai';
	}
}
$route = new Route;
$c = $_GET['c'] ?? 'home';
$route->$c();