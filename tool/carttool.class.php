<?php
/***
file index.php
***/
//defined('AICN')||exit('NOT Denied'); 

session_start();
class carttool {
    private static $ins = null;
    private $items = array();

    protected function __construct(){
        $this->sign = mt_rand(1,1000);
    }
    protected function __clone(){   
    }

    protected static function getIns(){
        if(!(self::$ins instanceof self)){
            self::$ins = new self();
        }
        return self::$ins;
    }
    public static function getcart(){
       if (!isset($_SESSION['cart']) || !($_SESSION['cart'] instanceof self)){
        $_SESSION['cart'] = self::getIns();
       }
       return $_SESSION['cart'];
    }

     /* 
    添加商品 
    param int $id 商品主键 
    param string $name 商品名称 
    param float $price 商品价格 
    param int $num 购物数量 
    */ 

    public function additem($id,$name,$price,$num=1){
        if (($num<0)or($num>1000)){
            exit;
        }
        if($this->hasitem($id)){
            $this->incnum($id,$num);
            return;
        }

        $item=array();
        $item['name']=$name;
        $item['price']=$price;
        $item['num']=$num;

        $this->items[$id]=$item;
        //self::$items[$id]=$item;
    }

    public function modnum($id,$num=1){
        if(!$this->hasitem($id)){
            return false;
        }
        $this->items[$id]['num'] = $num;
    }

    public function incnum($id,$num=1){
        if($this->hasitem($id)){
            $this->items[$id]['num'] += $num;
        }
    }

    public function decnum($id,$num=1){
        if($this->hasitem($id)){
            $this->items[$id]['num'] -= $num;
        }
        if($this->items[$id]['num'] < 1){
            $this->delitem($id);
        }
    }


    public function hasitem($id){
        return array_key_exists($id, $this->items);
    }

    public function delitem($id){
        unset($this->items[$id]);
    }

    public function getcnt(){
        return count($this->items);
    }

    public function getnum(){
        if($this->getcnt() == 0){
            return 0;
        }
        $sum = 0;
        foreach($this->items as $item){
            $sum += $item['num'];
        }
        return $sum;
    }

    public function getprice(){
        if($this->getcnt() == 0){
            return 0;
        }
        $price = 0.0;
         foreach($this->items as $item){
            $price += $item['num'] * $item['price'];
        }
        return $price;
    }

    public function all(){
        return $this->items;
    }

    public function clear(){
        $this->items = array();
    }



}

/***
$cart =carttool::getcart();

if(isset($_GET['test'])&& $_GET['test']=='add'){
$cart->additem(1,'w8',23,1);
echo 'add OK';
}else if(isset($_GET['test'])&& $_GET['test']=='add2'){
$cart->additem(2,'mr',13,1);
echo 'add OK';
}else if(isset($_GET['test'])&&$_GET['test']=='clear'){
    $cart->clear();
}else if(isset($_GET['test'])&&$_GET['test']=='del'){
    $cart->decnum(1);
}else if(isset($_GET['test'])&&$_GET['test']=='jia'){
    $cart->incnum(1);
}else if(isset($_GET['test'])&&$_GET['test']=='show'){
    print_r($cart->getprice());
}else {
    print_r($cart);
}



$cart =carttool::getcart();

if(isset($_GET['test'])&& $_GET['test']=='add'){
$cart->additem(1,'w8',23.4,1);
echo 'add OK';
}else if(isset($_GET['test'])&& $_GET['test']=='add2'){
$cart->additem(2,'mr',13.4,1);
echo 'add OK';
}else if(isset($_GET['test'])&&$_GET['test']=='clear'){
    $cart->clear();
}else if(isset($_GET['test'])&&$_GET['test']=='del'){
    $cart->decnum(1);
}else if(isset($_GET['test'])&&$_GET['test']=='show'){
    print_r($cart->getprice());
}else {
    print_r($cart);
}


//print_r(carttool::getcart());
***/


?>