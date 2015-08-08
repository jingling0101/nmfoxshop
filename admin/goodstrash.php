<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

if(isset($_GET['act']) && $_GET['act']=='show'){
	$goods = new goodsmodel();
	$goodslist = $goods->gettrash();
	include(ROOT.'hment/goodstrashlist.html');

}   else {

	$goods_id= $_GET['goods_id'] + 0;

	$goods= new goodsmodel();
	if($goods->trash($goods_id)){
		echo '回收成功';
	} else {
		echo '失败';
	}

}

}















?>
