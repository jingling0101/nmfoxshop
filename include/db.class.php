<?php
/***
file db.class.php

***/
defined('AICN')||exit('NOT Denied'); 
abstract class db{

	public abstract function connect($h,$u,$p);
	public abstract function query($sql);
	public abstract function getAll($sql);
	public abstract function getRow($sql);
	public abstract function getOne($sql);
	public abstract function autoExecute($table,$arr,$mode='insert',$where='where 1 limit 1');
//	autoExecute('table',array('uername' =>'zhangshan','email'=>'zs@163.com'),'insert');)
}



?>