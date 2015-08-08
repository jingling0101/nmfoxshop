<?php
/***
file index.php
***/
define('AICN',true);
session_start();
if(isset($_SESSION['username'])&&$_SESSION['username']=='jingling0101'){
require ('../include/init.php') ;

$data=array();

$gds_id= $_POST['goods_id']+0; 
//print_r($gds_id);
//print_r($_POST);
if(isset($_GET['act']) && $_GET['act']=='xiangqi') {
	if ((!$_POST['goods_brief'])&&(!$_POST['description'])) {
				return false;
			} else {
				$data['goods_brief'] = $_POST['goods_brief'];
				$data['description'] = $_POST['description'];
			}

			$goodsdit= new goodsmodel();
			if($goodsdit->update($data,$gds_id)){
				echo '详情修改成功';
			} else {
				echo '详情修改失败';
			}


} else {
	if(empty($_POST['goods_name'])) { 
    exit('名不能为空'); 
} 

			$data['goods_name'] = $_POST['goods_name']; 
//			$data['brand_id'] = $_POST['brand_id']; 
			$data['cat_id'] = $_POST['cat_id']; 
			$data['shop_price'] = $_POST['shop_price'] + 0; 
			$data['market_price'] = $_POST['market_price'] + 0; 
			$data['goods_number'] = $_POST['goods_number'] + 0;
			$data['last_update'] = time();

//print_r($data);
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

		
		    $goodsdit= new goodsmodel();
			if($goodsdit->update($data,$gds_id)){
				echo '修改成功';
			} else {
				echo '修改失败';
			}


//			$uptool = new uptool();
//			$goods_img=$uptool->upfile('goods_img');

}




/***
if($goods_img){
	$thumb_img=$goods_img.'X400.jpg';
	$ori_img=$goods_img.'X200.jpg';
    $data['goods_img']=$goods_img;
    $data['thumb_img']=$thumb_img;
    $data['ori_img']=$ori_img;

}

if($goods_img){

	$ing_img = ROOT . $goods_img;
	$thumb_img=$uptool->img_scale($ing_img,0.5,'X400.jpg');
	$ori_img=$uptool->img_scale($ing_img,0.2,'X200.jpg');
	


}
***/





}


?>
