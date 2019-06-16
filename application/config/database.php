<?php 
namespace App\Config;

if(!defined('APP_PATH')){
	die('Khong the truy cap');
}

use \PDO;

class Database {
	protected $db;

	public function __construct(){

		$this->db = $this->connection();

	}
	public function __destruct(){

		$this->db = null;

	}

	private function connection(){
		try {
		    $dbh = new PDO('mysql:host=localhost;dbname=lphp1811e;charset=utf8', 'root', '');
		    // giup hien thi sai cu phap sql
			$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		    return $dbh;
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

}