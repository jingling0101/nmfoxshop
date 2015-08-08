<?php
/***
file .php
***/
define('AICN',true);
session_start();
require ('./include/init.php') ;


$cat_id = isset($_GET['cat_id'])?$_GET['cat_id']+0:1;
$page = isset($_GET['page'])?$_GET['page']+0:1;  

if ($page < 1) {
	$page = 1;
}
$goodsModel = new goodsmodel(); 
$total = $goodsModel->catGoodsCount($cat_id);
//每页取*条
$perpage = 12;
if ($page > ceil($total/$perpage)) {
	$page=1;
}
$offset = ($page-1)*$perpage;
$pagenow = new pagetool($total,$page,$perpage);
$pagecode = $pagenow->show(); 
$pageleft=$page-1;
$pageright=$page+1;
$cat = new catmodel();
$catgory = $cat->find($cat_id);
if (empty($catgory)) {
	header('location:index.php');
	exit;
}
/*
菜单 所有栏目
*/
$cats = $cat->select();
$cort = $cat->getcattree($cats,0,1);
//print_r($cort);
$nav = $cat->getTree($cat_id);
//print_r($nav);
$goods = $goodsModel->catGoods($cat_id,$offset,$perpage);
//print_r($goods);
include(ROOT.'view/front/cate.html');

?>