<?php 
namespace App\Controller;
require 'application/controller/Controller.php';
use App\Controller\Controller;


if (!defined('APP_PATH')) {
	die('cant access');
}
/**
 * 
 */
class ContactController extends Controller
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
		$data['contact'] = 'sangtq';
		$this->loadView('application/view/contact/index_view',$data);

		//load footer 
		$this->loadFooter();
	}
}
$contact = new ContactController;
$m = $_GET['m'] ?? 'index';
$contact->$m();