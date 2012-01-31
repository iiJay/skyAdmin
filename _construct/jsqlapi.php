<?php
  /*
   * jSQL API for altering MySQL Queries.
   * For documentation, please read our blog.
   * Created by Jian Ting and Jay
   * ONLY COMPATIBLE WITH MYSQL
   * Example code:
   * CHOOSE * AT `users` FIND `username` = 'admin' AND `password` = 'password'
   * Please leave this header intact for legal use. And, do NOT change anything in this header.
   */
  if (!defined('BASEPATH'))exit('Failed Hax0r');
  class jsql {
  	public $build   = '1.0.0';
	private $switch = true;//Turning this file on or off. true = on || false = off
  	public function __construct(){
  		if(!$this->switch){
  			die();
  		}
  	}
	public function queries($type){
		if($type == "replace"){
			$arr = array(
                         'SELECT',
                         'FROM',
                         'DROP',
                         'INSERT',
                         'ALTER',
                         'UPDATE',
                         'DELETE',
                         'WHERE',
                         'SET',
                         'TRUNCATE'
                         );
			return $arr;
		}elseif($type == "keywords"){
			$arr = array(
                         'CHOOSE',
                         'AT',
                         'GTG',
                         'FILL',
                         'CONVERT',
                         'RENEW',
                         'KILL',
                         'FIND',
                         'MAKE',
                         'REMOVEALL'
                         );
		   return $arr;
		}
	}
	public function replace($string){
		$string = str_replace($this->queries('keywords'), $this->queries('replace'), $string);
		return $string;
	}
	public function query($string){
		$string = $this->replace($string);
		return mysql_query($string);
	}
  }
  $jsql = new jsql;
  function jsquery($string){//Used to execute MySQL Code
    global $jsql;
	return $jsql->query($string);
  }
?>