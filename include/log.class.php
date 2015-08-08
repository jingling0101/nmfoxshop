<?php
/***
file log.class.php

***/
defined('AICN')||exit('NOT Denied'); 

class Log{
	const LOGFILE ='curr.log';
	public static function Write($cont){
		$cont .="\r\n";
		$log=self::isBak();
		$fh=fopen($log, 'ab');
		fwrite($fh,$cont);
		fclose($fh);
	}
	public static function Bak(){
		$log=ROOT.'date/log/'.self::LOGFILE;
		$bak=ROOT.'date/log/'.date('ymd').mt_rand(10000,99999).'.bak';
		return rename($log, $bak);
	}
	public static function isBak(){
		$log=ROOT.'date/log/'.self::LOGFILE;
		if(!file_exists($log)){
			touch($log);
			return $log;
		}
//		clearstatcache(true,$log);  //清除缓存。
		$size=filesize($log);
		if ($size<=1024*1024) {
			return $log;
			# code...
		}
		if(!self::bak()){
			return $log ;
		}else {
			touch($log);
			return $log;
		}

	}
 
}









?>