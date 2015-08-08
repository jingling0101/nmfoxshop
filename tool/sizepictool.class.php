<?php
/***
file index.php
***/
defined('AICN')||exit('NOT Denied'); 

public function img_scale($imagename,$percent=0.5){
			

			list($width, $height) = getimagesize($imagename);
			$newwidth = $width * $percent;
			$newheight = $height * $percent;
			$thumb = imagecreatetruecolor($newwidth, $newheight);
			$source = imagecreatefromjpeg($imagename);
			imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
			$path = '../suo/' .date('his',time()).'.jpg';

			imagejpeg($thumb);
			imagejpeg($thumb,$path);

			ImageDestroy($thumb);
		

		}






?>