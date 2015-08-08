<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;
//print_r($_POST);

$data = array();
if (empty($_POST['cat_name'])) {
	exit ('栏名不能为空');
	# code...
} 
$data['cat_name']=$_POST['cat_name'];
$data['parent_id']=$_POST['parent_id'];
$data['intro']=$_POST['intro'];

require (ROOT.'model/catmodel.class.php') ;


$catadd= new Catmodel();

if($catadd->add($data)){ 
	echo '添加成功';
}else { 
	echo '添加失败';
}

}

?>
