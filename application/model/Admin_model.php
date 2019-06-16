<?php 
namespace App\Model;

require 'application/config/database.php';
use App\config\Database;
//su dung pdo
use \PDO;
class AdminModel extends Database {

	public function __construct(){

		//goi construct lop cha de lay ra bien ket noi
		parent::__construct();
		//bren duoi se la logic cua lop con
		
	}
	public function getAllDataInfoAdminByPage($start,$rows,$keyword=''){
		$data = [];
		$keyword = "%".$keyword."%";
		$sql = "SELECT * FROM admin AS a WHERE a.username LIKE :user OR a.email LIKE :email LIMIT :start,:rows";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':user',$keyword,PDO::PARAM_STR);
			$stmt->bindParam(':email',$keyword,PDO::PARAM_STR);
			$stmt->bindParam(':start',$start,PDO::PARAM_INT);
			$stmt->bindParam(':rows',$rows,PDO::PARAM_INT);

			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;

	}
	public function checkUsernameAndEmailExist($user,$email){
		//kiem tra co trong he thong hay chua
		$checkFlag= false;
		$sql = "SELECT * FROM admin AS a WHERE a.username = :username AND a.email = :email LIMIT 1";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':username',$user,PDO::PARAM_STR);
			$stmt->bindParam(':email',$email,PDO::PARAM_STR);
			if ($stmt->execute()) {
				
				if ($stmt->rowCount()>0) {
					$checkFlag = true;
				}
			}
			//ngat ket noi
			$stmt->closeCursor();
		}
		return $checkFlag;
	}
	public function insertDataAdmin($user,$pass,$email,$role,$phone,$address){
		$flagAdd = false;
		$status = 1;
		$created_at = date('Y-m-d H:i:s');
		$updated_at = null;

		$sql = "INSERT INTO admin (username,password,email,role,status,phone,address,created_at,updated_at) VALUES (:username,:password,:email,:role,:status,:phone,:address,:created_at,:updated_at)";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':username',$user,PDO::PARAM_STR);
			$stmt->bindParam(':password',$pass,PDO::PARAM_STR);
			$stmt->bindParam(':email',$email,PDO::PARAM_STR);
			$stmt->bindParam(':role',$role,PDO::PARAM_INT);
			$stmt->bindParam(':status',$status,PDO::PARAM_INT);
			$stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
			$stmt->bindParam(':address',$address,PDO::PARAM_STR);
			$stmt->bindParam(':created_at',$created_at,PDO::PARAM_STR);
			$stmt->bindParam(':updated_at',$updated_at,PDO::PARAM_STR);
			if ($stmt->execute()) {
				$flagAdd = true;
			}
			$stmt->closeCursor();

		}


		return $flagAdd;

	}
	public function deleteDataAdmin($id){
		$sql = "DELETE FROM admin WHERE id=:id";
		$stmt = $this->db->prepare($sql);
		$flagAdd = false;
		if ($stmt) {
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flagAdd = true;
			}
			$stmt->closeCursor();
		}
		return $flagAdd;
	}
	public function getInfoDataById($id){
		$data = [];
		$sql = "SELECT * FROM admin AS a WHERE a.id = :id";
		$stmt = $this->db->prepare($sql);
		
		if ($stmt) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}

			}
			$stmt->closeCursor();
			# code...
		}
		
		return $data;
	}

	public function getAllDataInfoAdmin($keyword=''){
		$data = [];
		$keyword = "%".$keyword."%";
		$sql = "SELECT * FROM admin AS a WHERE a.username LIKE :user OR a.email LIKE :email ";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':user',$keyword,PDO::PARAM_STR);
			$stmt->bindParam(':email',$keyword,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
			}
			$stmt->closeCursor();
		}
		return $data;
	}
	public function checkEditUserEmailAdmin($user,$email,$id){
		$flagEdit = false;
		$sql = "SELECT * FROM admin AS a WHERE a.username = :username AND a.email = :email AND a.id <> :id";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':username',$user,PDO::PARAM_STR);
			$stmt->bindParam(':email',$email,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$flagEdit = true;
				}
			}
			$stmt->closeCursor();
		}
		return $flagEdit;
	}
	public function updateDataAdminById($username,$password,$email,$phone,$role,$address,$status,$id){
		$flagUpdate = false;
		$updated_at = date('Y-m-d H:i:s');
		$sql = "UPDATE admin AS a SET a.username= :username, a.password = :password, a.email = :email, a.role= :role, a.status= :status, a.phone= :phone, a.address= :address, a.updated_at = :updated_at WHERE a.id = :id";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam(':username',$username,PDO::PARAM_STR);
			$stmt->bindParam(':password',$password,PDO::PARAM_STR);
			$stmt->bindParam(':email',$email,PDO::PARAM_STR);
			$stmt->bindParam(':role',$role,PDO::PARAM_INT);
			$stmt->bindParam(':status',$status,PDO::PARAM_INT);
			$stmt->bindParam(':phone',$phone,PDO::PARAM_STR);
			$stmt->bindParam(':address',$address,PDO::PARAM_STR);
			$stmt->bindParam(':updated_at',$updated_at,PDO::PARAM_STR);
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			if ($stmt->execute()) {
				$flagUpdate = true;
			}
			$stmt->closeCursor();
		}
		return $flagUpdate;

	}
}