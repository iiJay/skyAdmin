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
   * Get site details from database.
   * Returns string
   */
  function skySite($value){
  	global $my;
	$query = jsquery("CHOOSE * FROM ".SKYADMIN_PREFIX."site_settings WHERE id = '1'");
	$arr   = $my->arr($query);
	switch($value){
		case "name":
			return $arr['site_name'];
			break;
		case "author":
			return $arr['site_author'];
			break;
		case "keywords":
			return $arr['site_keywords'];
			break;
		case "description":
			return $arr['site_description'];
			break;
		default:
			return 'undefined';
			break;
	}
  }
  
  /*
   * skyAdmin Error Handler
   */
  function skyAdminError($number, $string, $file, $line, $context){
	header('Location: error?system=error&no='.$number.'&str='.$string.'&file='.$file.'&line='.$line.'&context='.$context);
	die();
  }
  
  /*
   * Cron Stuff
   */
  function cronExists($path){
  	if(file_exists($path)){
  		return true;
  	}else{
  		return false;
  	}
  }
  function setCron($definition, $value){
	return define($definition, $value);
  }
  function idCron($num){
  	if($num == "1"){
  		return 'Enabled';
  	}else{
  		return 'Disabled';
  	}
  }
  
  /*
   * Checks if site exists.
   * Returns true if exist.
   * Returns false if not exist.
   */
  function siteExists($site){
  	$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
    $ch    = curl_init();
    curl_setopt($ch, CURLOPT_URL, $site);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 3);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $page     = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if($httpcode >= 200 && $httpcode < 300){
      return true;
    }else{
      return false;
    }
  }
  
  /*
   * Get something between a string.
   * Returns $string;
   */
  function getBetween($content, $start, $end){
  	$r = explode($start, $content);
	if(isset($r[1])){
		$r = explode($end, $r[1]);
		return $r[0];
	}else{
		return '';
	}
  }
?>