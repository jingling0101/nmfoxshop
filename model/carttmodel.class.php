<?php
/***
file .php
***/
//defined('AICN')||exit('NOT Denied'); 

session_start();
class carttool{
	private static $ins=null;
	private $items=array();
//	public $sing=0;

	final protected function __construct(){
//	  $this->sing=mt_rand(1,1000);		
	}
	final protected function __clone(){		
	}

	protected static function getIns(){
		if(!(self::$ins instanceof self)){
			self::$ins = new self();
		}
		return self::$ins;
	}


	public static function getcart(){
		if(!isset($_SESSION['cart'])||!($_SESSION['cart'] instanceof self)){
			$_SESSION['cart'] = self::getIns();
		}
		return $_SESSION['cart'];
	}

	public function additem($id,$god_name,$price,$num=1){

		if($this->hasitem($id)){
			$this->incnum($id,$num);
			return $this->items;
		}

		$item=array();
		$item['god_name']=$god_name;
		$item['price']=$price;
		$item['num']=$num;
		$this->items["$id"]=$item;

	}

	public function modnum($id,$num=1){
		if(!$this->hasitem($id)){
			return false;
		}
		$this->items["$id"]['num']=$num;
	}

	public function incnum($id,$num=1){
		if($this->hasitem($id)){
			return $this->items["$id"]['num'] += $num;
		}
	}

	public function decnum($id,$num=1){
		if($this->hasitem($id)){
			$this->items["$id"]['num'] -= $num;
		}
		if($this->items["$id"]['num'] < 1){
			$this->delitem($id);
		}
	}

	public function hasitem($id){
		return array_key_exists($id,$this->items);
	}

	public function delitem($id){
		unset($this->items["$id"]);
	}

	public function getcnt(){
		return count($this->items);
	}

	public function getnum(){
		if($this->getcnt() == 0){
			return 0;
		}
		$sum=0;
		foreach($this->items as $item){
			$sum +=$item['num'];
			return $sum;
		}
	}

	public function getprice(){
		if($this->getcnt()==0){
			return 0;
		}
		$price=0.0;
		foreach($this->items as $item){
			$price += $item['num']*$item['price'];
		}
		return $price;
	}

	public function allgods(){
		return $this->items;
	}

	public function clear(){
		$this->items=array();
	}



}

/***
$uscart=carttool::getcart();

if(!isset($uscart)){
	echo '';
}



if(isset($_GET['test'])&&$_GET['test']=='add'){
	$uscart->additem(1,'haha',23,1);
	echo 'OK';
} else if(isset($_GET['test'])&&$_GET['test']=='meinv'){
	$uscart->additem(2,'meinu',100,1);
}
else if(isset($_GET['test'])&&$_GET['test']=='clear'){
	$uscart->clear();
}else if(isset($_GET['test'])&&$_GET['test']=='show'){
	print_r($uscart->allgods());
	echo $uscart->getprice();
}
else {
	print_r($uscart);
}
***/





?>