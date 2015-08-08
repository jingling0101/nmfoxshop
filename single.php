<?php
/***
file .php
***/
define('AICN',true);
session_start();
require ('./include/init.php') ;

$goods_id=$_GET['goods_id']+0;
$good=new goodsmodel();
$gods=$good->findsingle($goods_id);
print_r($gods);
$godsxq=$good->findsinglexq($goods_id);
//print_r($godsxq);
if(empty($gods)) {  
  //  header('location: index.php');  
    exit;  
}  
//$cat = new Catmodel();  
//$nav = $cat->getTree($gods['cat_id']);  
include(ROOT.'view/front/single.html');

?>