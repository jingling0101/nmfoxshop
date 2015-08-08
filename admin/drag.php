<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

include(ROOT.'view/admin/templates/drag.html');


}











?>
