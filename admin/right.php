<?php
/***
file index.php
***/
session_start();
define('AICN',true);

if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;
//echo ROOT;
include(ROOT.'hment/right.html');

}












?>