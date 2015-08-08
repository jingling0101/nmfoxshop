<?php
/***
file .php
***/
defined('AICN')||exit('NOT Denied'); 

class usermodel extends model{
	protected $table='muyi_user';
	protected $pk='user_id';

	protected $bgename = array('user_id','username',
		'qq','phonenumber','hmphnumber','email',
		'passwd','repassword','regtime','lastlogin');

	protected $_valid =array(
		array('username','1','用户名不能为空要在4-16字符内','require'),
		array('username','0','用户名必须在4-16字符内','length','4,16'),
		array('email','1','email非法','require'),
		array('passwd','1','password不能为空','require')
		);


		protected $_auto = array(
	
		array('regtime','function','time')

		);

		 public function compress_html($string) {
		 	$string = htmlspecialchars($string, ENT_QUOTES);
		    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
		    $string = preg_replace($regex,"",$string);
		    $string = str_replace("\rn", '', $string);  
		    $string = str_replace("\n", '', $string);  
		    $string = str_replace("\t", '', $string); 
		    $string = str_replace("$", '', $string);  
		    $string = str_replace(chr(13), '', $string); 
		    $string = str_replace(chr(32), '', $string); 
		    return $string;
		}
		   public function compress_emil($string) {
		   	$string = htmlspecialchars($string, ENT_QUOTES);
		    $regex = "/\/|\~|\!|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
		    $string = preg_replace($regex,"",$string);
		    $string = str_replace("\rn", '', $string);  
		    $string = str_replace("\n", '', $string);  
		    $string = str_replace("\t", '', $string); 
		    $string = str_replace("$", '', $string);  
		    $string = str_replace(chr(13), '', $string); 
		    $string = str_replace(chr(32), '', $string); 
		    return $string;
		}

    /*
        用户注册
    */
		public function reg($data){
			if ($data['passwd']){
				$data['passwd']=$this->encpasswd($data['passwd']);
				# code...
			}
			return $this->add($data);
		}

		protected function encpasswd($p){
			return md5(md5($p));
		}
    /*
    根据用户名查询用户信息
  */	
        public function checkmadin($username,$passwd=''){
	        	if($passwd==''){
				echo 'mima不对';
				sleep(2);
				exit;
			 }
			  
			 $pass=$this->encpasswd($passwd);
			 $sql=sprintf("select 1 from adminus where username ='%s' and passwd=aes_encrypt('%s','%s')",$username,
			 	$pass,$pass);
			 $result= $this->db->query($sql);
			 if ($result===FALSE) {
			 	sleep(3); 
			 	die("coult not query database");
			 }
			 if (mysqli_num_rows($result)===1) {
			 	$denlu['username']='jingling0101';
			 	$denlu['time']=time();
			 	sleep(1); 
			    $_SESSION=$denlu;
			    $sql=sprintf("update adminus set lastlogin='%s' where user_id=1",time());
			    $res= $this->db->query($sql);
			    return $denlu;		
			 }		    	
		}
     	
		public function checkuser($username,$passwd=''){
			 
			if($passwd==''){
			$sql= 'select count(*) from ' . $this->table . " where username = '" . $username . "'";
			return $this->db->getOne($sql);

		}else {
			   sleep(1);
			$sql = 'select user_id,username,email,passwd from ' . $this->table . " where 
			username= '". $username ."' " ."and passwd='".$this->encpasswd($passwd)."'";
			$denlu = $this->db->getRow($sql);
			if (empty($denlu)) {
				return false;
			}
			if ($denlu['passwd'] !== $this->encpasswd($passwd)) {
				return false;
			}else{
			unset($denlu['passwd']);
//			session_start();
			$denlu['time']=time();
			$_SESSION=$denlu;
//			return $denlu;
		        }
			}
		}
		
}


?>