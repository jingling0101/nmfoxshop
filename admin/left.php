<?php
/***
file index.php
***/
session_start();
define('AICN',true);

if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

include(ROOT.'hment/left.html');
}













?>
