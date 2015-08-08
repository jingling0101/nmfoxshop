<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

/***
$data = array ();
$data['goods_name']= trim($_POST['goods_name']);
//$data['goods_id']= trim($_POST['goods_id']);
$data['goods_sn']= ($_POST['goods_sn']);
***/

$data=array();
if(empty($_POST['goods_name'])||empty($_POST['goods_sn'])) { 
    exit('名字货号不能为空'); 
}
if(empty($_POST['goods_brief'])||empty($_POST['description'])) { 
    exit('详情不能为空'); 
}  

$goods = new goodsmodel();
$_POST['goods_weight'] *= $_POST['weight_unit'];
$data = array ();
$data =$goods->_facade($_POST);
$data =$goods->_autofill($data);

//print_r($data);
if ($goods->_validate($data)) {
	echo '数据不合法<br />';
	echo implode(',',$goods->getErr);
	exit;
	# code...
}

//print_r($_FILES);

if ($_FILES['goods_img']['name']!=='') {

$uptool = new uptool();
$goods_imgarr = array();
$thumb_imgarr = array();
		foreach($_FILES as $k=> $v){
			$goods_img=$uptool->upfile($k);
				$goods_imgarr[]=$goods_img;	
		}

		if(is_array($goods_imgarr)) {
			foreach ($goods_imgarr as $key => $value) {
				if(($goods_imgarr[$key])==''){
					unset($goods_imgarr[$key]);
					continue;		
				}
				 $data['goods_img'.$key]=$value;				
			}
			if ($goods_imgarr[0]!=='') {
						$ing_img = ROOT . $goods_imgarr[0];
			$twoh_img=$uptool->img_scale($ing_img,0.2,'X200.jpg');
			$data['smatu_img1']= str_replace(ROOT,'',$twoh_img);
				}	

		}

		//print_r($goods_imgarr);
		foreach ($goods_imgarr as $key => $value) {				   
			    $data['thumb_img'.$key]=$value.'X400.jpg';	
			    $ing_img = ROOT . ($goods_imgarr[$key]);
			    $thumb_img=$uptool->img_scale($ing_img,0.5,'X400.jpg');
				$thum_imgbarr[] = str_replace(ROOT,'',$thumb_img);
				
		}
}

$goodsq = new goodsmodel();
$goodsxq=array();
$goodsxq['goods_brief']=$_POST['goods_brief'];
$goodsxq['description']=$_POST['description'];

//print_r($data);
//print_r($goodsxq); 

if ($goods->add($data) && $goodsq->add($goodsxq)) {
	    echo 'OK ';
	    exit;
}else {
    echo 'shibai';
    exit;
}


}
?>
