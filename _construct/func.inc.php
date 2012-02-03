<?php
  /*
   Copyright (C) 2011 by JTprojects (Jian Ting)

   Permission is hereby granted, free of charge, to any person obtaining a copy
   of this software and associated documentation files (the "Software"), to deal
   in the Software without restriction, including without limitation the rights
   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
   copies of the Software, and to permit persons to whom the Software is
   furnished to do so, subject to the following conditions:

   The above copyright notice and this permission notice shall be included in
   all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
   THE SOFTWARE.
   */
  if (!defined('BASEPATH'))exit('Failed Hax0r');
  
  /*
   * Clean inputs.
   * Escapes SQL Injections
   * Changing " to &quote; 
   * Remove all possible PHP functions from string by removing ();
   * Returns $string
   */
  function clean($string){
    global $my;
    $string = $my->escape(htmlspecialchars(trim($string), ENT_QUOTES));
	if(strpos($string, '();') === false){
		$string = $string;
	}else{
		if(!strpos($string, array('<pre>', '</pre>', '<code>', '</code>'))){
			$string = $string;
		}else{
			$string = str_replace('();', '', $string);
		}
	}
	return $string;
  }
  
  /*
   * Clean inputs and encrypt it.
   * Does what clean() does.
   * But returns as an encrypted string.
   * Returns $string 
   */
  function encrypt($string){
    global $hash;
    $string = clean($string);
    $string = $hash->encode($string);
    return $string;
  }
  
  /*
   * Installation functions. Only used during installation. You can delete these functions after installation. 
   */
  function iclean($string){
    $string = htmlspecialchars(trim($string), ENT_QUOTES);
	if(strpos($string, '();') === false){
		$string .= $string;
	}else{
		$string .= str_replace('();', '', $string);
	}
	return $string;
  }
  function iencrypt($string){
    global $hash;
    $string = iclean($string);
    $string = $hash->encode($string);
    return $string;
  }
  
  /*
   * Get IP from visitor. 
   * Returns $string
   */
  function ip(){
    $ip = '';
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
      $ip .= $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
      $ip .= $_SERVER['REMOTE_ADDR'];
    }
    return trim($ip);
  }
  
  /*
   * Removing backslashes "\" from contents
   */
  function cleanOutput($string){
    $string = stripslashes($string);
    $string = preg_replace("/[\\\]/", "", $string);
    return $string;
  }
  
  /*
   * Check of Email is valid
   * Return true if valid
   * Return false if non-valid
   */
  function validEmail($email){
  	if(preg_match("/^[^@]*@[^@]*\.[^@]*$/", $email)){
  		return true;
  	}else{
  		return false;
  	}
  }
?>