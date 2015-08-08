<?php
/***
file .php
***/
define('AICN',true);
require ('./include/init.php') ;
session_start();
session_unset(); 
session_destroy();
echo '退出成功';
header('Location: index.php');

?>