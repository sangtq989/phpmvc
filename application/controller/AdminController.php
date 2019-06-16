<?php
namespace App\Controller;



if (!defined('APP_PATH')) {
	die('cant access');
}

require 'application/controller/Controller.php';
require 'application/model/Admin_model.php';


use App\Controller\Controller;
use App\Model\AdminModel;

class AdminController extends Controller{
	private $db;
	function __construct()
	{
		$this->db = new AdminModel;
	}


	public function index(){
		//load header
		$keyword = $_GET['keyword'] ?? '';
		$keyword = strip_tags($keyword);
		$page = $_GET['page'] ?? '';
		$page = (is_numeric($page)&&$page>0)? $page :1 ;
		$header = [
			'title'=>'This is home',
			'content'=>''
		];
		$links = [
			'c'=>'admin',
			'm'=>'index',
			'page'=> '{page}',
			'keyword'=>$keyword,
		];
		$strlink = createLink($links);
		// echo $strlink;
	
		//$data['infoAdmins'] =$this->db->getAllDataInfoAdmin($keyword);
		$infoAdmins =$this->db->getAllDataInfoAdmin($keyword);
		$totalRecord = count($infoAdmins);

		$arrPanigation = panigation($strlink,$totalRecord,$page,2,$keyword);
		
		// print_r($arrPanigation);
		$data['infoAdmins'] = $this->db->getAllDataInfoAdminByPage($arrPanigation['start'],$arrPanigation['limit'],$arrPanigation['keyword']);
		$data['keyword'] = $keyword;
		$data['panigation']=$arrPanigation['panigation'];
		// echo "<pre>";
		// print_r($data);
		$this->loadHeader($header);

		//load navbar
		$this->loadNav();

		//load view
		
		
		$this->loadView('application/view/admin/index_view',$data);

		//load footer 
		$this->loadFooter();
	}
	public function add(){

		$data = [];
		$data['errorAddData'] = $_SESSION['errorsAdd'] ?? [];
		//load header
		$header = [
			'title'=>'This is home',
			'content'=>''
		];
		$this->loadHeader($header);

		//load navbar
		$this->loadNav();

		//load view
		
		$this->loadView('application/view/admin/add_view',$data);
		// print_r($data);

		

		//load footer 
		$this->loadFooter();
	}
	public function handleAdd(){
		if (isset($_POST['btnSubmit'])) {
			$username = $_POST['username'] ?? '';
			$username = strip_tags($username);

			$password = $_POST['password'] ?? '';
			$password = strip_tags($password);

			$email = $_POST['email']?? '';
			$email = strip_tags($email);

			$phone = $_POST['phone']?? '';
			$phone = strip_tags($phone);

			$role = $_POST['role']?? '';
			$role  =is_numeric($role) ? $role : '';

			$address = $_POST['address'] ?? '';

			$errorAdd = validateAddDataAdmin($username,$password,$email,$phone,$role);

			// echo "<pre>";
			// print_r($errorAdd);

			$flagCheck = true;
			foreach ($errorAdd as $key => $value) {
				if (!empty($value)) {
					$flagCheck = false;
					break;
				}
			}
			// 
			if ($flagCheck) {
				//hop le
				//neu ton tai session loi thi xoa
				if (isset($_SESSION['errorsAdd'])) {
					unset($_SESSION['errorsAdd']);
					# code...
				}
				$checkAdd = $this->db->checkUsernameAndEmailExist($username,$email);
				if ($checkAdd) {
					//da co tai khoan
					header("Location: ?c=admin&m=add&state=fail");
				}
				else{
					//them
					$add = $this->db->insertDataAdmin($username,$password,$email,$role,$phone,$address);
					header("Location: ?c=admin");
				}
			}
			else{
				//nhap sai
				//gan loi vao session
				$_SESSION['errorsAdd']=$errorAdd;
				header("Location: ?c=admin&m=add&state=err");
			}

		}
	}
	public function edit(){
		$id = $_GET['id'] ?? '';
		$id = is_numeric($id) ? $id : 0;
		echo $id;
		//lay thong tin theo id
		$data = [];
		$data['editErr']	=	$_SESSION['editErr'];
		print_r($data);
		$infoAdmins = $this->db->getInfoDataById($id);
		$data['info'] = $infoAdmins;
		$header = [
			'title'=>'This is admin',
			'content'=>''
		];
		$this->loadHeader($header);

		//load navbar
		$this->loadNav();
		if ($infoAdmins) {
			$this->loadView('application/view/admin/edit_view',$data);	
			
			

		}else{
			$this->loadView('application/view/admin/notfoun_view');	
		}
	
		$this->loadFooter();

	}
	public function delete(){
		if (isset($_POST['btnDelete'])) {
			$id= $_POST['idAdmin'] ?? '';
			$id= is_numeric($id) ? $id : 0;
			echo $id;
			$delete = $this->db->deleteDataAdmin($id);
				if ($delete) {
					 header("Location: ?c=admin");
				}else {
					 header("Location: ?c=admin&state=fail");
				}
			}		
		}

	public function handleEdit(){
		if (isset($_POST['btnSubmit'])) {
			$username = $_POST['username'] ?? '';
			$username = strip_tags($username);

			$password = $_POST['password'] ?? '';
			$password = strip_tags($password);

			$email = $_POST['email']?? '';
			$email = strip_tags($email);

			$phone = $_POST['phone']?? '';
			$phone = strip_tags($phone);

			$role = $_POST['role']?? '';
			$role  =is_numeric($role) ? $role : '';

			$address = $_POST['address'] ?? '';

			$status = $_POST['status'] ?? '';
			$status  =is_numeric($status) ? $status : '';

			$id = $_GET['id'] ?? '';
			$id =is_numeric($id) ? $id : '';
			echo $id;

			//validate
			$editErr = validateAddDataAdmin($username,$password,$email,$phone,$role);
			
			//ve lam
			$flagCheck = true;
			foreach ($editErr as $key => $value) {
				if (!empty($value)) {
					$flagCheck = false;
					break;
				}
			}
			// if ($flagCheck) {
			// 	//hop le
			// 	//neu ton tai session loi thi xoa
			// 	if (isset($_SESSION['editErr'])) {
			// 		unset($_SESSION['editErr']);
			// 		# code...
			// 	}
				$checkEdit = $this->db->checkEditUserEmailAdmin($username,$password,$id);
				//tra ve true false

				if ($checkEdit) {
					echo "co";
					
					header("Location: ?c=admin&m=edit&state=err".$id);
					// khong cho phep
				}else{
					
					$update = $this->db->updateDataAdminById($username,$password,$email,$phone,$role,$address,$status,$id);
					if ($update) {
						header("Location:?c=admin&state=success");
					}else{

						header("Location:?c=admin&m=edit&state=fail".$id);
					}
				}
			// }else{
			// 		//nhap sai
			// 		//gan loi vao session
			// 		$_SESSION['editErr']=$editErr;
			// 		header("Location: ?c=admin&m=edit&state=err");
			// 	}
			//kiem tra nguoi dung update thay doi user name da ton tai tron db chua
			//neu da ton tai thi ko cho sua
			// $checkEdit = $this->db->checkEditUserEmailAdmin($username,$password,$id);
			//tra ve true false

			// if ($checkEdit) {
			// 	echo "co";
			// 	header("Location: ?c=admin&m=edit&state=err".$id);
			// 	// khong cho phep
			// }else{
				
			// 	$update = $this->db->updateDataAdminById($username,$password,$email,$phone,$role,$address,$status,$id);
			// 	if ($update) {
			// 		header("Location:?c=admin&state=success");
			// 	}else{

			// 		header("Location:?c=admin&m=edit&state=fail".$id);
			// 	}
			// //cho phep
				
			// }
		}
	}

}

$admin = new AdminController;
$m = $_GET['m'] ?? 'index';
$admin->$m();
