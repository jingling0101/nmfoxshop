<?php
/***
file lib.base.php
***/
defined('AICN')||exit('NOT Denied'); 
//$arr=array('a"b',array("c'd",array('e"f')));

function _addslashes($arr){
	foreach ($arr as $key => $value) {
		if(is_string($value)){
			$arr[$key]=addslashes($value);
		}else if (is_array($value)) {
			$arr[$key]=_addslashes($value);
			# code...
		}
		# code...
	}
	
	return $arr;

}

//print_r(_addslashes($arr));




?>