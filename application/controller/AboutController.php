<?php 
namespace App\Controller;
require 'application/controller/Controller.php';
use App\Controller\Controller;

if (!defined('APP_PATH')) {
	die('cant access');
}
class AboutController extends Controller
{
	function index(){
			$header = [
			'title'=>'This is about',
			'content'=>''
		];
		$this->loadHeader($header);

		//load navbar
		$this->loadNav();

		//load view
		$data = [];
		$data['age'] = 20;
		$this->loadView('application/view/about/index_view',$data);

		//load footer 
		$this->loadFooter();
	}
}
$about = new AboutController;
$m = $_GET['m'] ?? 'index';
$about->$m();