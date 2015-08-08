<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php');

//print_r($_POST);


$data = array(); 
if(empty($_POST['cat_name'])) { 
    exit('栏目名不能为空'); 
} 
$data['cat_name'] = $_POST['cat_name']; 
$data['parent_id'] = $_POST['parent_id'] + 0; 
$data['intro'] = $_POST['intro']; 
$cat_id = $_POST['cat_id'] + 0; 

$cat = new Catmodel();


// 查找新父栏目的家谱树 
$trees = $cat->getTree($data['parent_id']); 
// 判断自身是否在新父栏目的家谱树里面 
$flag = true; 
foreach($trees as $value) { 
    if($value['cat_id'] == $cat_id) { 
        $flag = false; 
        break; 
    } 
} 
if(!$flag) { 
    echo '父栏目选取错误'; 
    exit; 
} 


if($cat->update($data,$cat_id)){
	echo '修改成功';
} else {
	echo '修改失败';
}





}



?>
