<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php');

$cat_id = $_GET['cat_id'] + 0; 
//print_r($cat_id);
$cat = new Catmodel(); 

$catinfo = $cat->find($cat_id); 
$catlist = $cat->select(); 
$catlist = $cat->getcattree($catlist); 
//print_r($catinfo); 

include(ROOT . 'hment/cateadit.html'); 



}







?>
