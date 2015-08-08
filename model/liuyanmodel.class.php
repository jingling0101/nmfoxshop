<?php
/***
file .php
***/

defined('AICN')||exit('NOT Denied'); 
class liuyanmodel extends model{
	protected $table='liuyan';
	protected $pk='id';


	public function getliuyan(){
		$sql = 'select uliuname,content,add_time from liuyan where is_delete = 0';
		return $this->db->getAll($sql);
	}

	public function gettrash(){
		$sql = 'select uliuname,content,add_time from liuyan where is_delete = 1';
		return $this->db->getAll($sql);
	}


	 public function getNew($n=15) {
	    $sql = 'select uliuname,content,add_time from ' . $this->table . ' order by add_time DESC limit 15';

	    return $this->db->getAll($sql);
    }




}












?>