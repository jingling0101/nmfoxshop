<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

$page = isset($_GET['page'])?$_GET['page']+0:1;  
if ($page < 1) {
	$page = 1;
}
$goods = new goodsmodel();
$total = $goods->catGoodsCount(1);
//每页取*条
$perpage = 15;

if ($page > ceil($total/$perpage)) {
	$page=1;
}
$offset = ($page-1)*$perpage;
$pagenow = new pagetool($total,$page,$perpage);
$pagecode = $pagenow->show(); 
$pageleft=$page-1;
$pageright=$page+1;

/*
菜单 所有栏目
*/

$goodslist = $goods->catGoods(0,$offset,$perpage);
//print_r($goodslist);
include(ROOT.'hment/goodslist.html');
}

?>
