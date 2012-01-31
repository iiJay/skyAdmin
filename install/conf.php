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

  $core['mysql']['host']     = '<host>';
  $core['mysql']['username'] = '<username>';
  $core['mysql']['password'] = '<password>';
  $core['mysql']['database'] = '<database>';

  $core['security']['hash']  = '<hash>';//jtHash secret hash.
  $core['mysql']['b_sql']    = 'backup_sql.sql';//Backup SQL File. Currently in Beta.
  $core['session']['time']   = '60 minutes';//Session timeout. For both $_SESSION and Database Storage usage.
  
  $core['theme']['name']     = 'simplicity';//skyAdmin Theme folder name under the "_themes" folder.

  define('DATABASE_IP_SESSION', false);//Only enable this if you have a static IP.
  define('SKYADMIN_BUILD', '2.5.0');//Your current skyAdmin Build.
  define('SKYADMIN_RETURN_ERROR', true);//You are recommended to enable this. Shows users "403" Alert or "404" not found errors.
  define('ENABLE_SKYADMIN_CRON_JOBS', true);//Enabling cron jobs used by skyAdmin. You can disable certain jobs in the panel.
  define('ENABLE_PANEL_JOBS', false);//Disable this only if you want Cron Jobs to be done when someone is successful in logging into the panel.
                                     //Enable this only if you want Cron Jobs to be done whenever the page refreshes.
  define('SKYADMIN_PREFIX', '<prefix>');//Prefix for database.
  define('jt_hash_secret', $core['security']['hash']);
  
  session_set_cookie_params(time()+3600, '/', $_SERVER['HTTP_HOST'], isset($_SERVER["HTTPS"]), true);

  require_once('jthash.enc.php');
    $hash = new jthash();
  require_once('jsqlapi.php');
  require_once('mysql.inc.php');
    $my   = new skyAdmin_Mysql();
  require_once('user.inc.php');
    $user = new skyAdmin_User();
  require_once('interface.ui.php');
    $ui   = new skyAdmin_Ui();
  require_once('resource.inc.php');
    $res  = new skyAdmin_Resource();
  require_once('template.class.php');
    $temp = new skyAdmin_Template($core['theme']['name']);
  require_once('func.inc.php');
  require_once('core.func.php');
  if(ENABLE_SKYADMIN_CRON_JOBS){
  	require_once('cron.class.php');
	  $cron = new skyAdmin_Cron();
  }
  
  set_error_handler('skyAdminError', E_ALL);
  if(isset($_SESSION['skyAdmin_id'])){
  	if(!$user->loggedIn){
  		session_destroy();
  	}
  }
?>