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
  define('BASEPATH', 'New Build');
  if (!defined('BASEPATH'))exit('Failed Hax0r');
  include('../conf.php');
  /*
   * Consruct Upgrade Cron
   * Only compatible to skyAdmin above 2.5.0
   */
  setCron('SKYADMIN_SITE', 'http://skyadmin.jtpapi.com/');
  setCron('SKYADMIN_UPGRADE', 'http://api.skyadmin.jtpapi.com/upgrade/');
  setCron('BUILD_URL', SKYADMIN_UPGRADE.SKYADMIN_BUILD.'/');
  if(!siteExists(SKYADMIN_SITE)){
  	return false;
  }elseif(SKYADMIN_BUILD <= '2.5.0'){
  	return false;
  }else{
  	
	/*
	 * For full upgrade, you will have to download and implement the files manually.
	 * This system may only be able to upgrade once. Unless we throw in some extra stuff in the server >:D
	 */
	$confPhp       = BUILD_URL.'conf.txt';
	$coreFunc      = BUILD_URL.'core.func.txt';
	$funcInc       = BUILD_URL.'func.inc.txt';
	$cronClass     = BUILD_URL.'cron.class.txt';
	$interfaceUi   = BUILD_URL.'interface.ui.txt';
	$mysqlInc      = BUILD_URL.'mysql.inc.txt';
	$userInc       = BUILD_URL.'user.inc.txt';
	$resourceInc   = BUILD_URL.'resource.inc.txt';
	$additionalSql = BUILD_URL.'addtional_sql.txt';
	
	/*
	 * Current Files
	 */
	$oCoreFunc     = file_get_contents('core.func.php');
	$oFuncInc      = file_get_contents('func.inc.php');
	$oFuncInc      = file_get_contents('func.inc.php');
	$oCronClass    = file_get_contents('cron.class.php');
	$oInterfaceUi  = file_get_contents('interface.ui.php');
	$oMysqlInc     = file_get_contents('mysql.inc.php');
	$oUserInc      = file_get_contents('user.inc.php');
	$oResourceInc  = file_get_contents('resource.inc.php');
	
	/*
	 * Now for the real magic!
	 */
	
	if(siteExists($additionalSql)){
		$sql = file($additionalSql);
		foreach($sql as $sql_line){
			mysql_query($sql_line);
		}
	}
	if(siteExists($confPhp)){
		$newConf  = '';
		$newConf .= file_get_contents($confPhp);
		$newConf .= str_replace('<host>', $core['mysql']['host'], $newConf);
		$newConf .= str_replace('<username>', $core['mysql']['username'], $newConf);
		$newConf .= str_replace('<password>', $core['mysql']['password'], $newConf);
		$newConf .= str_replace('<database>', $core['mysql']['database'], $newConf);
		$newConf .= str_replace('<hash>', $core['security']['hash'], $newConf);
		$newConf .= str_replace('<prefix>', PREFIX, $newConf);
		file_put_contents('conf.php', $newConf);
	}
	if(siteExists($coreFunc)){
		$newCoreFunc = file_get_contents($coreFunc);
		if($oCoreFunc == $newCoreFunc){
			return false;
		}
		file_put_contents('core.func.php', $newCoreFunc);
	}
	if(siteExists($funcInc)){
		$newFuncInc = file_get_contents($funcInc);
		if($oFuncInc == $newFuncInc){
			return false;
		}
		file_put_contents('func.inc.php', $newFuncInc);
	}
	if(siteExists($cronClass)){
		$newCronClass = file_get_contents($cronClass);
		if($oCronClass == $newCronClass){
			return false;
		}
		file_put_contents('cron.class.php', $newCronClass);
	}
	if(siteExists($interfaceUi)){
		$newInterfaceUi = file_get_contents($interfaceUi);
		if($oInterfaceUi == $newInterfaceUi){
			return false;
		}
		file_put_contents('interface.ui.php', $newInterfaceUi);
	}
	if(siteExists($mysqlInc)){
		$newMysqlInc = file_get_contents($mysqlInc);
		if($oMysqlInc == $newMysqlInc){
			return false;
		}
		file_put_contents('mysql.inc.php', $newMysqlInc);
	}
	if(siteExists($userInc)){
		$newUserInc = file_get_contents($userInc);
		if($oUserInc == $newUserInc){
			return false;
		}
		file_put_contents('user.inc.php', $newUserInc);
	}
	if(siteExists($resourceInc)){
		$newResourceInc = file_get_contents($resourceInc);
		if($oResourceInc == $newResourceInc){
			return false;
		}
		file_put_contents('resource.inc.php', $newResourceInc);
	}
	
  }
?>