
<?php

defined('AICN')||exit('NOT Denied'); 

class model{ 
    protected $table = NULL; // 是model所控制的表 
    protected $db = NULL; // 是引入的mysql对象 
    protected $pk = ''; 
    protected $bgename=array();
    protected $_auto =array();
    protected $_valid=array();
    protected $error = array(); 


    public function __construct() { 
        $this->db = mysql::getIns(); 
    } 

    public function table($table) { 
        $this->table = $table; 
    } 

    public function _facade($array=array()){
        $data=array();
        foreach($array as $k=>$v){
            if(in_array($k, $this->bgename)){
                $data[$k]=$v;
            }
        }
                  return $data;
    }

    public function _autofill($data){
        foreach($this->_auto as $k => $v){
            if(!array_key_exists($v[0], $data)){
                switch ($v[1]){
                    case 'value':
                    $data[$v[0]]=$v[2];
                    break;
                    case 'function':
                    $data[$v[0]] = call_user_func($v[2]);
                    break;
                }
               
            }
        } 

        return $data;
    }
    /* 
        格式 $this->_valid = array( 
                    array('验证的字段名',0/1/2(验证场景),'报错提示','require/in(某几种情况)/between(范围)/length(某个范围)','参数') 
        ); 
        array('goods_name',1,'必须有商品名','requird'), 
        array('cat_id',1,'栏目id必须是整型值','number'), 
        array('is_new',0,'in_new只能是0或1','in','0,1') ,
        array('goods_breif',2,'商品简介就在10到100字符','length','10,100') );
    */ 


        public function _validate($data) { 
            if(empty($this->_valid)) { 
                return true; 
            } 
            $this->error = array(); 
            foreach($this->_valid as $k=>$v) { 
                switch($v[1]) { 
                    case 1: 
                        if(!isset($data[$v[0]])) { 
                            $this->error[] = $v[2];
  //                          echo '没有商品名'; 
                            return false; 
                        } 
                         
                        if(!isset($v[4])) { 
                            $v[4] = ''; 
                        } 
                        if(!$this->check($data[$v[0]],$v[3],$v[4])) { 
                            $this->error[] = $v[2]; 
                            return false; 
                        } 
                       break; 
                    case 0: 
                        if(isset($data[$v[0]])) { 
                            if(!$this->check($data[$v[0]],$v[3],$v[4])) { 
                                $this->error[] = $v[2]; 
                                return false; 
                            } 
                        } 
                        break; 
                    case 2: 
                        if(isset($data[$v[0]]) && !empty($data[$v[0]])) { 
                            if(!$this->check($data[$v[0]],$v[3],$v[4])) { 
                                $this->error[] = $v[2]; 
                                return false; 
                            } 
                        } 
            } 
        } 
        return true; 
    }


    public function getErr(){
        return $this->error;
    }

    public function check($value,$rule='',$parm=''){
        switch ($rule) {
            case 'require':
                return !empty($value);

            case 'number':
                return is_numeric($value);

             case 'in':
                $tmp =explode(',',$parm);
                return in_array($value, $tmp);
  
             case 'between':
                list($min,$max)=explode(',', $parm);
                return $value >= $min && $value <= $max;

             case 'length':
                list($min,$max)=explode(',', $parm);
                return strlen($value) >= $min && strlen($value) <= $max;

             case 'email':
                return (filter_var($value,FILTER_VALIDATE_EMAIL) !==false);   
  


          default:
              return false;

         }
    }

    public function add($data){
    	return $this->db->autoExecute($this->table,$data);
     }


    public function delete($id){
    	$sql= 'delete from ' . $this->table .' where '. $this->pk . ' = ' .$id ;
    	if($this->db->query($sql)){
    		return $this->db->affected_rows();
    	} else {
    		return false;
    	}
    }

    public function update($data,$id){
    	$rs=$this->db->autoExecute($this->table,$data,'update',' where ' . $this->pk .' = ' .
         $id);
    		if($rs){
    		return $this->db->affected_rows();
    	} else {
    		return false;
    	}
    }

    public function select(){
    	$sql = 'select * from ' . $this->table ;
    	return $this->db->getAll($sql);
    }

    public function find($id){
	$sql = 'select * from ' . $this->table .' where '. $this->pk .' = ' . $id ;
	return $this->db->getRow($sql);
    }



}


?>