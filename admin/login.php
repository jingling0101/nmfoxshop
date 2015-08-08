<?php
/***
file login.php
***/
session_start();
define('AICN',true);
require ('../include/init.php') ;
 if(isset($_POST['act'])&&$_POST['act'] == 'act_logi'){
 	if(!isset($_POST['username'])or($_POST['passwd']=='')){
 	    echo "请输入帐号密码3秒后重新登陆";
        echo "<meta http-equiv='refresh' content='3,url=login.php'/>";
 		//echo'请输入帐号密码';
 		//header('Location: login.php');
 		exit;
 	}
	$user = new usermodel();
	$_POST['username']=$user->compress_html($_POST['username']);
	$_POST['passwd']=$user->compress_html($_POST['passwd']);
	$u = $_POST['username'];
	$p = $_POST['passwd'];
	$row=$user->checkmadin($u,$p);

    if(!isset($_SESSION['username'])or$_SESSION['username']==''){
		echo "3秒后重新登陆";
        echo "<meta http-equiv='refresh' content='3,url=login.php'/>";
		exit;
	}
	
   header('Location: index.php');
	exit; 	
}
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>Document</title>
 </head>
 <body>
<!-- mimain --><div style="width:260px;height:200px;margin:100px auto;border:1px solid #EEE;padding:10px 10px;"> <!-- div denglu -->       
	<div class="denglu"> <label for="exampleInputusername1">请输入帐号密码</label> 
	 <form role="form" action="login.php" method="post"><br />  <div class="form-group">
		    <label for="exampleInputusername1">Username</label> 	
		    <input type="username" class="form-control" name="username" id="username" value=" "placeholder="请填写用户名">							    
		  </div><br /> <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" class="form-control" name="passwd" id="exampleInputPassword1" placeholder="请输入密码">
		  </div>
		  <div class="form-group"> <p class="help-block"> 管.理.后.台</p> </div>									 
		  <input type="hidden" value="act_logi" name="act" />
		  <button type="submit" class="btn btn-default">登陆</button>
	</form>	</div><!-- end div denglu --> </div>    <!-- end mimain -->
</body>
</html>