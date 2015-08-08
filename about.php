<?php
/***
file .php
***/
define('AICN',true);
require ('./include/init.php') ;
//include(ROOT.'view/front/about.html');

setcookie("name","lisi");
setcookie("school","MBA",time()+150);

if (!isset($_COOKIE['num'])) {
	$num=1;
	setcookie('num',$num+1);
} else {
	$num=$_COOKIE['num'];
	setcookie('num',$num + 1);
	
}

echo $num,'chifangwen';
print_r($_COOKIE);

$pizza = "piece1 piece2 piece3 piece4 piece5 piece6"; 
$pieces = explode(" ", $pizza); 
echo $pieces[0]; // piece1 
echo $pieces[1]; // piece2 

// 示例 2 
$data = "foo:*:1023:1000::/home/foo:/bin/sh"; 
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data); 
echo $user; // foo 
echo $pass; // * 

$zongzi = "1|2|3|4|5|6"; 
$zong = explode("|",$zongzi); 
print_r($zong); 
$zongo = implode(":",$zong); 
echo $zongo;

?>