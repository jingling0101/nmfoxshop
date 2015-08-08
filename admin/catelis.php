<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;
//echo ROOT;


$catlist = new Catmodel();
$cattree=$catlist->select();
$cattree=$catlist->getcattree($cattree,0);
//print_r($cattree);

include(ROOT.'hment/catelis.html');


}











?>
