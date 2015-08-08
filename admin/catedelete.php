<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

$cat_id = $_GET['cat_id']+0;

$cat= new Catmodel();



$sons = $cat->getSon($cat_id);

if(!empty($sons)){
	exit('有子档目不可以删除');
}else if($cat->delete($cat_id)){ 
	echo '删除成功';
}else { 
	echo '删除失败';
}



}












?>
