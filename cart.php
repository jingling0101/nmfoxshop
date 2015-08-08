<?php
/***
file .php
***/
define('AICN',true);
require ('./include/init.php') ;



$act=isset($_GET['car'])?$_GET['car']:'buy';
$uscart=carttool::getcart();

if(!isset($uscart)){
	echo '';
}

$goods = new goodsmodel();

if($act=='buy'){
	$goods_id=isset($_POST['goods_id'])?$_POST['goods_id']+0:0;

	$num=isset($_GET['num'])?$_GET['num']+0:1;

    
	if($goods_id){
		$gods=$goods->find($goods_id);
		
		if(!empty($gods)){
			//print_r($gods);

			if($gods['is_delete']==1 || $gods['is_sale']==0){
				$msg ='此商品已下架不能购买';
				include(ROOT.'view/front/msg.html');
				exit;
			}
			
				
			$uscart->additem($goods_id,$gods['goods_name'],$gods['shop_price'],$num);
			$items=$uscart->all();
			print_r($items);
			if($items[$goods_id]['num'] > $gods['goods_number']){
				$uscart->decnum($goods_id,$num);
				$msg ='此商品库存不足';
				include(ROOT.'view/front/msg.html');
				exit;
			}

		 }
		

	}

unset($_POST['goods_id']);
unset($goods_id);
	
	$cartc=array();
	$cartc=$uscart->all();
	$zgprice=$uscart->getprice();

	include(ROOT.'view/front/cart.html');
}
if($act=='clear'){
	$uscart->clear();
	$msg='已清空';
	include(ROOT.'view/front/msg.html');
}




?>