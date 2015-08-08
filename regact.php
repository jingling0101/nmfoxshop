<?php
/***
file .php
if($user->reg($data)) { 
   $msg = '用户注册成功';
   echo $msg; 
} else { 
   $msg = '用户注册失败'; 
   echo $msg;
} 
    <?php sleep(2);header('Location: register.php');?>
***/
define('AICN',true);
require ('./include/init.php') ;


  $user = new usermodel();
  $_POST['username']=$user->compress_html($_POST['username']);
  $_POST['qq']=$user->compress_html($_POST['qq']);
  $_POST['phonenumber']=$user->compress_html($_POST['phonenumber']);
  $_POST['email']=$user->compress_emil($_POST['email']);
  $_POST['passwd']=$user->compress_html($_POST['passwd']);


if(!$user->_validate($_POST)) {  // 自动检验 
    $msg = implode('<br />',$user->getErr());
 //   echo $msg;      
    include(ROOT . 'view/front/msg.html'); 
    exit; 
} 
// 检验用户名是否已存在 
if($user->checkuser($_POST['username'])) { 
    $msg = '用户名已存在'; 
    include(ROOT . 'view/front/msg.html'); 
    exit; 
} 
if ($_POST['passwd']!==$_POST['repasswd']) {
   $msg = '两次密码不一样';
   include(ROOT . 'view/front/msg.html');
   exit;
}
$data = $user->_autofill($_POST);  // 自动填充 
$data = $user->_facade($data);  // 自动过滤 

if($user->reg($data)) { 
   $msg = '用户注册成功';
  include(ROOT . 'view/front/msg.html'); 
  exit;  
} else { 
   $msg = '用户注册失败'; 
  include(ROOT . 'view/front/msg.html'); 
  exit;  
} 






?>