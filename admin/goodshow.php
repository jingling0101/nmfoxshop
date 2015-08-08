<?php 

define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require('../include/init.php');

$goods_id=$_GET['goods_id']+0;
$good=new goodsmodel();
$gods=$good->find($goods_id);
//print_r($gods);

}

?>