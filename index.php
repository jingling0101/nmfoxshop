<?php
/***
file index.php
***/
define('AICN',true);
session_start();
require('./include/init.php') ;

include(ROOT.'view/front/index.html');

?>