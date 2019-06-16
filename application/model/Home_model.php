<?php 
namespace App\Model;

require 'application/config/database.php';
use App\config\Database;
//su dung pdo
use \PDO;
class HomeModel extends Database {

	public function __construct(){

		//goi construct lop cha de lay ra bien ket noi
		parent::__construct();
		//bren duoi se la logic cua lop con
		
	}
	public function getDataByCondition($id =3){

		$data = [];
		$sql = "SELECT a.price_room FROM prices AS a 
				INNER JOIN types AS b ON a.id = b.price_id 
				INNER JOIN rooms AS c ON b.id = c.type_id 
				INNER JOIN customers AS d ON c.id =d.room_id 
				WHERE d.id = :id";
		$stmt = $this->db->prepare($sql);
		if ($stmt){
			//vi co tham so truyen vao nen can kiem tra
			$stmt->bindParam(':id',$id,PDO::PARAM_INT);
			//co bn tham so thi can bay nhieu lan kiem tra
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
				}				
			}
			///ngat ket noi de viet nhung ham tiep theo
			$stmt->closeCursor();

		}
		return $data;

	}

	public function getDataByCondition2($limit,$row){
		//lay ra 3 dong du lieu tu dong so 2 trong bang room va sap sep lai du lieu theo id giam dan
		$data = [];
		$sql = "SELECT `id`, `name_room`, `type_id`, `status_room`, `description`, `avatars`, `created_at`, `updated_at` FROM `rooms` WHERE id>2 ORDER BY id DESC LIMIT :limited,:row";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			///khjong co loi
			///thuc hien excute
			$stmt->bindParam(':limited',$limit,PDO::PARAM_INT);
			$stmt->bindParam(':row',$row,PDO::PARAM_INT);
			if ($stmt->execute()) {
				//thanh cong
				//kiem tra bang co dong du lieu nao ko 
				//neu co thi lay ve
				if ($stmt->rowCount()>0) {
					//do du lieu ra mang
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					///PDO::FECTCH_ASSOC tra ve mang khong tuan tu voi key la ten cac truong
				}
			}
			//ngat ket noi
			$stmt->closeCursor();

		}
		return $data;	


	}
	public function getDataByCondition3($keyword){
		//lay ra 3 dong du lieu tu dong so 2 trong bang room va sap sep lai du lieu theo id giam dan
		$data = [];
		$key ="%{$keyword}%";
		$sql = "SELECT * FROM customers AS a WHERE a.name_customer LIKE :name OR a.phone LIKE :phone";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam('name',$key,PDO::PARAM_STR);
			$stmt->bindParam('phone',$key,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {

					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
				
			}
			$stmt->closeCursor();

		}
		return $data;
	}

	public function getDataByCondition4($start,$stop){
		$data = [];
		$sql = "SELECT * FROM `bookings` WHERE booking_date BETWEEN CAST(:start AS DATE) AND CAST(:to AS DATE)";
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			$stmt->bindParam('start',$start,PDO::PARAM_STR);
			$stmt->bindParam('to',$stop,PDO::PARAM_STR);
			if ($stmt->execute()) {
				if ($stmt->rowCount()>0) {

					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				}
				
			}
			$stmt->closeCursor();

		}
		return $data;


	}

	public function getAllDataNameTable($nameTable='admin'){

		//lay du lieu thu table price trong database
		//viet theo pdo
		$data = [];		//mang rong doi san de lay du lieu
		//1:khai bao cau lenh sql
		$sql = "SELECT * FROM {$nameTable}";
		//2:su dung ham prepare de thuc thi kiem tra cau lenh sql
		$stmt = $this->db->prepare($sql);
		if ($stmt) {
			///khjong co loi
			///thuc hien excute
			if ($stmt->execute()) {
				//thanh cong
				//kiem tra bang co dong du lieu nao ko 
				//neu co thi lay ve
				if ($stmt->rowCount()>0) {
					//do du lieu ra mang
					$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
					///PDO::FECTCH_ASSOC tra ve mang khong tuan tu voi key la ten cac truong
				}
			}
			//ngat ket noi
			$stmt->closeCursor();

		}
		return $data;	

	}

	public function getDallData(){
		return [
			[
				'msv' => 113,
				'name'=>'NVA',
				'email'=>'test@gmail.com',
				'address'=> 'Ha noi',
				'money' => 1000,
			],
			[
				'msv' => 114,
				'name'=>'NVA',
				'email'=>'test1@gmail.com',
				'address'=> 'daNang',
				'money' => 2000,
			],
			[
				'msv' => 115,
				'name'=>'NVA',
				'email'=>'test2@gmail.com',
				'address'=> 'HaiPhong',
				'money' => 3000,
			],
		];
	}
}