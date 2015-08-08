<?php
/***
file .php
***/
defined('AICN')||exit('NOT Denied'); 

class Catmodel extends model{
	protected $table='muyi_category';
	protected $pk='cat_id';


	public function getcattree($arr,$id=0,$lev=0){ 
		$tree = array();
		if(is_array($arr)){
		foreach ($arr as $value) {
			if($value['parent_id'] == $id){
				$value['lev']=$lev;
			$tree[]=$value;
			$tree = array_merge ($tree,$this->getcattree($arr,$value['cat_id'],$lev+1));

		}}
		
		}
		return $tree;
	}

	public function getSon($id){
		$sql='select cat_id,cat_name,parent_id from ' .$this->table . ' where parent_id =' . $id;
	    return $this->db->getAll($sql);
	}

	public function getTree($id=0){
		$tree = array();
		$cats = $this->select();
		while($id>0){
		foreach($cats as $value){
			if($value['cat_id']==$id){
				$tree[] = $value;
				$id=$value['parent_id'];
				break;
			}
		}
	    }
	 return array_reverse($tree);
	}



}












?>