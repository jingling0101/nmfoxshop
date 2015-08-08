<?php
/***
file config.class.php

***/
defined('AICN')||exit('NOT Denied'); 
//define('ROOT',str_replace('\\','/',dirname(__DIR__)).'/') ;
class conf {
    protected static $ins = null;
    protected $data = array();
        
    final protected function __construct() {

        // 一次性把配置文件信息,读过来,赋给data属性,
        // 这样以后就不再管配置文件了.
        // 再要配置的值是,直接从 data属性找
        include(ROOT . 'include/configinc.php');
        $this->data = $_CFG;
    }

    final protected function __clone() {
    }


    public static function getIns() {
        if(self::$ins instanceof self) {
            return self::$ins;
        } else {
            self::$ins = new self();
            return self::$ins;
        } 
    }


    // 用魔术方法,读取data内的信息
    public function __get($key) {
        if(array_key_exists($key,$this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }


    // 用魔术方法,在运行期,动态增加或改变配置选项
    public function __set($key,$value) {
        $this->data[$key] = $value;
    }
}


$conf = conf::getIns();

//var_dump($conf);

/***
测试
改动态地址



$conf=conf::getIns();
var_dump($conf);
echo $conf->host;
echo $conf->user;
echo $conf->pwd;
$conf=conf::getIns();
var_dump($conf);
***/
//$conf->template_dir='D:/wamp/www/sc/smrty';
//echo $conf->template_dir;

/***

$conf=conf::getIns();
$conf->template_dir='D:/wamp/www/sc/smrty';
echo $conf->template_dir;
***/
?>