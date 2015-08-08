<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;
$cat= new Catmodel();
$catlist=$cat->select();
$catlist=$cat->getcattree($catlist);

include(ROOT.'/hment/cateadd.html');



}










?>
