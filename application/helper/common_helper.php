<?php 

function validateAddDataAdmin($user,$pass,$email,$phone,$role){
	$errors =[];
	$errors['username'] = (empty($user) || strlen($user) > 40) ? 'Vui long nhap dung dinh dang username va ko qua 40 ki tu' : '';
	$errors['password'] = (empty($pass) || strlen($pass) > 40) ? 'Vui long nhap dung dinh dang password va ko qua 40 ki tu' : '';
	$errors['email'] = (filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($email) < 40) ? '' : 'Vui long nhap dung dinh dang email' ;
	$errors['phone'] = (empty($user) || strlen($user) > 20) ? 'Vui long nhap dung dinh dang sdt va ko qua 40 ki tu' : '';
	$errors['role'] = empty($role) ? 'vui long chon role cho tk': '';


	return $errors;
}

function validateUpdateDataAdmin($username,$email){
	
	

}
function createLink($data = []){

	//tao duong link phan trang
	/*
	data = [   
			'c' => 'admin',
			'm' => 'index'
			'keyword' => ' asd'
			'page' => 1	
	]
	xay dung 1 duong link phan trang dua tren thong so
	index.php?c=admin&m=index&page=1
	*/
	$link = "";
	foreach ($data as $key => $val) {
		$link .= (empty($link))? "?{$key}=${val}":"&{$key}=${val}";
	}
	return "index.php".$link;
}
function panigation($link,$totalRecord,$currentPage,$rows,$keyword = ''){
	//index.php?c=admin&m=index&page={page}&keyword=
	//1. tinh tong so trang trong 1 page
	$totalPage = ceil($totalRecord/$rows);
	//2. xac dinh lai pham vi cua current page
	if ($currentPage<1) {
		$currentPage = 1 ;
		
	}elseif ($currentPage>$totalPage) {
		$currentPage = $totalPage;

	}
	//3.tinh start 
	$start =($currentPage - 1) * $rows;
	//4.tao template html phan trang - su dung component panigation cua boostrap de phan trang
	$html='';
	$html.="<nav>";
	$html .="<ul class='pagination'>";
	if ($currentPage > 1 && $currentPage <= $totalPage) {
		//hien nut prev
		$html.="<li class='page-item'>";
		$html.="<a class='page-link' href='".str_replace('{page}',($currentPage-1),$link)."'>Previous</a>";
		$html.="</li>";
	}
	//tao vong lap hien thi so trang 
	for ($i=1; $i <= $totalPage ; $i++) { 
		if ($i==$currentPage) {
			$html.="<li class='page-item active'>";
			$html.= "<a class='page-link'>".$currentPage."</a>";
			$html.="</li>";
		}else{
			//trang khac
			$html.="<li class='page-item'>";
			$html.= "<a class='page-link' href='".str_replace('{page}',$i,$link)."'>".$i."</a>";
			$html.="</li>";
		}
	}
	//nut next 
	if ($currentPage<$totalPage && $currentPage >=1) {
		$html.="<li class='page-item'>";
		$html.="<a class='page-link' href='".str_replace('{page}',($currentPage+1),$link)."'>Next</a>";
		$html.="</li>";
	}
	$html .="</ul>";
	$html .="</nav>";
	return [
		'start' => $start,
		'limit' => $rows,
		'keyword' => $keyword,
		'panigation' => $html,
	];

}