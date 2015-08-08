<?php
/***
file .php
***/

defined('AICN')||exit('NOT Denied'); 
class goodsmodel extends model{
	protected $table='muyi_goods';
	protected $pk='goods_id';

	protected $bgename=array('cat_id','brand_id','goods_name',
		'shop_price','market_price','goods_number','click_count',
		'goods_weight','thumb_img0','goods_img0','smatu_img1','is_sale','
	 is_delete',' is_best',' is_new',' is_hot',
	 'add_time','last_update');

	protected $_auto = array(
		array('is_hot','value',0),
		array('is_new','value',0),
		array('is_best','value',0),
		array('add_time','function','time')

		);
	protected $_valid = array( 

        array('goods_name',1,'必须有商品名','requird'), 
        array('cat_id',1,'栏目id必须是整型值','number'), 
        array('is_new',0,'in_new只能是0或1','in','0,1'), 
        array('goods_breif',2,'商品简介就在10到100字符','length','10,100')
        ) ;

	public function trash($id){
		return $this->update(array('is_delete'=>1),$id);
	}

	public function trashbk($id){
		return $this->update(array('is_delete'=>0),$id);
	}

	public function getgoods(){
		$sql = 'select goods_id,cat_id,goods_sn,goods_name,shop_price,market_price,goods_number,thumb_img0,smatu_img1 from '. $this->table .' where is_delete = 0 ;';
		return $this->db->getAll($sql);
	}

    public function getgoodstw(){
        $sql = 'select goods_id,cat_id,goods_sn,goods_name,shop_price,market_price,goods_number,thumb_img0,smatu_img1 from '. $this->table .' where is_delete = 0 ;';
        return $this->db->getAll($sql);
    }

	public function gettrash(){
		$sql = 'select goods_id,cat_id,goods_sn,goods_name,shop_price,market_price,goods_number,thumb_img0,smatu_img1 from '. $this->table .' where is_delete = 1 ;';
		return $this->db->getAll($sql);
	}

    public function getgoodshow(){
        $sql = 'select goods_id,cat_id,brand_id,goods_name,shop_price,market_price,goods_number,thumb_img0,smatu_img1 from '. $this->table .' where is_delete = 0 ';
        return $this->db->getAll($sql);
    }

    public function findsin($id){
    $sql = 'select goods_id,cat_id,brand_id,goods_name,shop_price,market_price,goods_number,thumb_img0,smatu_img1 from ' . $this->table .' where '. $this->pk .' = ' . $id ;
    return $this->db->getRow($sql);
    }


     public function findsingle($id){
    $sql = 'select goods_id,cat_id,brand_id,goods_name,shop_price,market_price,goods_number,goods_img0,goods_img1,goods_img2,goods_img3,
        goods_img4,thumb_img0,thumb_img1,thumb_img2,thumb_img3,thumb_img4 from ' . $this->table .' where '. $this->pk .' = ' . $id ;
    return $this->db->getRow($sql);
    }
         public function findsinglexq($id){
    $sql = 'select goods_id,goods_brief,description,wireless_desc from muyi_goodsq where '. $this->pk .' = ' . $id;
    return $this->db->getRow($sql);
    }


			 public function getNew($n=8) {
        $sql = 'select goods_id,goods_name,shop_price,thumb_img0,smatu_img1 from ' . $this->table . ' order by add_time limit 8';

        return $this->db->getAll($sql);
	    }



	    public function catGoods($cat_id,$offset=0,$limit=8) {
        $category = new Catmodel();
        $cats = $category->select(); // 取出所有的栏目来
        $sons = $category->getCatTree($cats,$cat_id);  // 取出给定栏目的子孙栏目
        
        $sub = array($cat_id);

        if(!empty($sons)) { // 没有子孙栏目
            foreach($sons as $v) {
                $sub[] = $v['cat_id'];
            }
        }

        $in = implode(',',$sub);

        $sql = 'select goods_id,goods_name,shop_price,market_price,thumb_img0,smatu_img1 from ' . $this->table . ' where cat_id in (' . $in . ') order by add_time limit ' . $offset . ',' . $limit;

        return $this->db->getAll($sql);
    }

    public function catGoodsCount($cat_id) {
         $category = new Catmodel();
        $cats = $category->select(); // 取出所有的栏目来
        $sons = $category->getCatTree($cats,$cat_id);  // 取出给定栏目的子孙栏目
        
        $sub = array($cat_id);

        if(!empty($sons)) { // 没有子孙栏目
            foreach($sons as $v) {
                $sub[] = $v['cat_id'];
            }
        }

        $in = implode(',',$sub);

        $sql = 'select count(*) from '. $this->table .' where cat_id in (' . $in . ')';
        return $this->db->getOne($sql);
    }

    /*
        获取购物中商品的详细信息
        params array $items 购物车中的商品数组
        return 商品数组的详细信息
    */

    public function getCartGoods($items) {
        foreach($items as $k=>$v) {  // 循环购物车中的商品,每循环一个,到数据查一下对应的详细信息

            $sql = 'select goods_id,goods_name,thumb_img,shop_price,market_price from ' . $this->table . ' where goods_id =' . $k;

            $row = $this->db->getRow($sql);

            $items[$k]['thumb_img'] = $row['thumb_img'];
            $items[$k]['market_price'] = $row['market_price'];
        
        }

        return $items;
       
    }


}












?>
