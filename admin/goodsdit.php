<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

$gds_id=$_GET['goods_id']+0;
//print_r($gds_id);

$good= new goodsmodel();
$g=array();
$g=$good->findsingle($gds_id);
$xq=$good->findsinglexq($gds_id);

//print_r($g);
//print_r($xq);

$cat= new Catmodel();
$catlist=$cat->select();
$catlist=$cat->getcattree($catlist);

//print_r($catlist);
include(ROOT.'hment/goodsdit.html');

}





?>
