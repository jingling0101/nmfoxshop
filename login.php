<?php
/***
file .php
***/
session_start();
define('AICN',true);
require ('./include/init.php') ;
$remu = isset($_COOKIE['remuser'])?$_COOKIE['remuser']:'';
 if(isset($_POST['act'])&&$_POST['act'] == 'act_logi'){
 	if(!isset($_POST['username'])or($_POST['passwd']=='')){
 		$msg='请输入帐号密码';
        include('./view/front/login.html');
 		exit;
 	}
	$user = new usermodel();
	$_POST['username']=$user->compress_html($_POST['username']);
	$_POST['passwd']=$user->compress_html($_POST['passwd']);

	$u = $_POST['username'];
	$p = $_POST['passwd'];

	$row=$user->checkuser($u,$p);
	if(!isset($_SESSION['username'])or$_SESSION['username']==''){

		echo "3秒后重新登陆";
        echo "<meta http-equiv='refresh' content='3,url=login.php'/>";
		
		exit;
	}

	if(isset($_SESSION['username'])&&$_SESSION['username']!==''){
		  if(isset($_POST['remember'])) { 
            setcookie('remuser',$u,time()+3600); 

        } else { 
            setcookie('remuser','',0); 
        } 
 
    header('Location: index.php');
	exit; }	
}

 include('./view/front/login.html'); 


?>