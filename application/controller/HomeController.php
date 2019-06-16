<?php 
namespace App\Controller;



if (!defined('APP_PATH')) {
	die('cant access');
}

require 'application/controller/Controller.php';
require 'application/model/Home_model.php';

use App\Controller\Controller;
use App\Model\HomeModel;


class HomeController extends Controller
{
	private $db;
	public function __construct(){
		$this->db = new HomeModel;
	}
	function index(){
		//test
		$today = date('Y-m-d');
		$week = date('Y-m-d',strtotime('-1week'));
		$db = $this->db->getDallData();
		$dataPrice = $this->db->getAllDataNameTable('rooms');
		$priceRoom = $this->db->getDataByCondition(3);
		$room = $this->db->getDataByCondition2(2,4);
		$person = $this->db->getDataByCondition3('Van A');
		$booking = $this->db->getDataByCondition4($week,$today );

	

	
		$data['name']='admin';
		$data['info']=$dataPrice;
		


		//load header
		$header = [
			'title'=>'This is home',
			'content'=>''
		];
		$this->loadHeader($header);

		//load navbar
		$this->loadNav();

		//load view
		
		
		$this->loadView('application/view/home/index_view',$data);

		//load footer 
		$this->loadFooter();
	}
}
$home = new HomeController;
$m = $_GET['m'] ?? 'index';
$home->$m();