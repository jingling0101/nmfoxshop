<?php
/***
file init.php

***/
//echo dirname(__DIR__);
	defined('AICN')||exit('NOT Denied'); 
	define('ROOT',str_replace('\\','/',dirname(__DIR__)).'/') ;
	define('DEBUG', true);
//echo ROOT;

require(ROOT.'include/libbase.php');

function __autoload($class) { 
    if(strtolower(substr($class,-5)) == 'model') { 
    	require(ROOT . 'model/' . $class . '.class.php'); 
       
    } else if(strtolower(substr($class,-4)) == 'tool'){
    	require (ROOT . 'tool/' . $class . '.class.php');
    }

    else { 
        require(ROOT . 'include/' . $class . '.class.php'); 
    } 
}
//		error_reporting(0);

	if (DEBUG) {
		error_reporting(E_ALL);
		
	}else {
		error_reporting(0);
	}

	$_GET=_addslashes($_GET);
	$_POST=_addslashes($_POST);
	$_COOKIE=_addslashes($_COOKIE);
	
if(isset($_SESSION['time'])&&(time()-$_SESSION['time']>1800)){
	session_unset(); 
    session_destroy();
	header('Location: index.php');
}

?>