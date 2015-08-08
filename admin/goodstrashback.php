<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;


    $goods_id=$_GET['goods_id']+0;  
	$goods = new goodsmodel();
	$goodslist = $goods->trashbk($goods_id);
	include(ROOT.'hment/goodstrashlist.html');

}















?>
