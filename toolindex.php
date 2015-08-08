<?php
/***
file index.php
***/
session_start();
define('AICN',true);

if(isset($_SESSION['username'])&&$_SESSION['username']=='jinglingcos'){
	require ('./include/init.php') ;
$goods = new goodsmodel();
//$newlist = $goods->getgoodshow();
//print_r($newlist);
// 栏目下的商品
$bar_id = 3;
$barlist = $goods->catGoods($bar_id);
//print_r($barlist);
// 栏目下的商品
ob_start();
include(ROOT.'view/front/indexpro.html');
if (file_put_contents(ROOT.'view/front/indexs.html', ob_get_clean())) {
	echo '缓存更新ok';
	exit;
}else{
	header('Location: login.php');
	exit; 
}

}

?>