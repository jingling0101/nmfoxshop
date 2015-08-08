<?php
/***
file index.php
***/
defined('AICN')||exit('NOT Denied'); 



class uptool{
    protected $allowExt = 'jpg,jpeg,gif,bmp,png';
    protected $maxSize = 2;
 //   protected $file = NULL;
    protected $errno = 0;
    protected $error = array( 
        0=>'无错', 
        1=>'上传文件超出系统限制', 
        2=>'上传文件大小超出网页表单页面', 
        3=>'文件只有部分被上传', 
        4=>'没有文件被上传', 
        6=>'找不到临时文件夹', 
        7=>'文件写入失败', 
        8=>'不允许的文件后缀', 
        9=>'文件大小超出的类的允许范围', 
        10=>'创建目录失败', 
        11=>'移动失败' 
);


     public function upfile($key){
        if(!isset($_FILES[$key])){
            return false;
        }
        $f = $_FILES[$key];


        // 检验上传有没有成功 
        if($f['error']) { 
            $this->errno = $f['error']; 
            return false; 
        } 


        $ext = $this->getExt($f['name']);

        if(!$this->isAllowExt($ext)){
            $this->errno = 8;
            return false;
        }

        if(!$this->ismaxSize($f['size'])){
            $this->errno = 9;
            return false;
        }

        $dir=$this->mk_dir();

        if ($dir==false) {
            $this->errno = 10;
            return false;          
        }


        $newname = $this->ranName().$f['name'];
        $dir = $dir . '/' . $newname;

        if(!move_uploaded_file($f['tmp_name'], $dir)){
            $this->errno = 11;
            return false;
        } 

       
        return str_replace(ROOT,'',$dir);




    }

    public function getErr() { 
        return $this->error[$this->errno]; 
    } 

    public function setExt($exts) { 
        $this->allowExt = $exts; 
    } 
    
    public function setSize($num) { 
        $this->maxSize = $num; 
    } 


    protected function getExt($file){
        $tmp = explode('.',$file);
        return end($tmp);
    }

 //   protected function setExt($file){}


    protected function isAllowExt($ext){
        return in_array(strtolower($ext),(explode(',',$this->allowExt)));

    }

    protected function ismaxSize($size){
        return $size <= $this->maxSize*1024*1024;

    }

    protected function mk_dir(){
        $dir = ROOT . 'prsimages/'.date('Ym');
        if(is_dir($dir)|| mkdir($dir,0777,true)){
            return $dir;
        } else {
            return false;
        }
    }

    protected function ranName($length=6){
        $str='abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ3456789';
        return substr(str_shuffle($str),0,$length) ;
//        
    }


    public function img_scale($imagename,$percent,$nname){
            

            list($width, $height) = getimagesize($imagename);
            $newwidth = $width * $percent;
            $newheight = $height * $percent;
            $thumb = imagecreatetruecolor($newwidth, $newheight);
            $source = imagecreatefromjpeg($imagename);
            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            $path =$imagename.$nname;
 //       print_r($path);
//         imagejpeg($thumb);
            imagejpeg($thumb,$path);

            ImageDestroy($thumb);
        

        }





}





?>