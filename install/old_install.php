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
  if(file_exists('skyadmin_lock.lock')){
  	die('<font style="font-family:Tahoma;font-size:11px;text-align:center;">skyAdmin is already installed.<br />
  	                                                                        Wan\'t to re-install? Please delete the
  	                                                                        <code>skyadmin_lock.lock</code> file.
  	                                                                        </font>');
  }
  define('BASEPATH', 'Installation');
  include('../_construct/jthash.enc.php');
    $hash = new jthash();
  include('../_construct/func.inc.php');
?>
<html dir="ltr" lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Installation - skyAdmin</title>
<style>
body {
  background: #f9f6e1;
  margin: 0;
}
#logo {
  width: 500px;
  height: auto;
  margin: 0 auto;
  margin-top: 10px;
  font-family: Arial;
  font-size: 35px;
  color: #393939;
  text-align: center;
  text-shadow: 1px 1px 0px #dcdcdc;
}
#content {
  background: #fff;
  width: 480px;
  height: auto;
  margin: 0 auto;
  font-family: Helvetica;
  font-size: 11px;
  padding: 10px;
  color: #393939;
  margin-top: 10px;
  text-shadow: 1px 1px 0px #ededed;
  border: 1px solid #ededed;
  webkit-border-radius: 5px;
  moz-border-radius: 5px;
  border-radius: 5px;
}
#footer {
  width: 500px;
  height: auto;
  font-family: Helvetica;
  font-size: 11px;
  color: #393939;
  margin: 0 auto;
  text-align: center;
  text-shadow: 1px 1px 0px #ededed;
}
#footer a, #footer a:link, #footer a:hover, #footer a:visited {
  font-family: Helvetica;font-weight: bold;color: #393939;
  text-decoration: none;
}
</style>
</head>

<body>
  <div id="logo">skyAdmin Installation</div>

<?php
  if(isset($_POST['install'])){
    try {
       $secure_hash  = rand(1, 100000);
       define('jt_hash_secret', $secure_hash);
       //SQL Settings
       $sql_username = iclean($_POST['m_username']);
       $sql_password = iclean($_POST['m_password']);
       $sql_database = iclean($_POST['m_database']);
       $sql_host     = iclean($_POST['m_host']);
	   $sql_prefix   = iclean($_POST['m_prefix']);
       //Admin Settings
       $a_username   = iclean($_POST['username']);
       $a_password   = iencrypt($_POST['password']);
       $a_ip         = ip();
	   //Site Settings
	   $s_name     = iclean($_POST['siteName']);
       $s_author   = iclean($_POST['siteAuthor']);
	   $s_desc     = iclean($_POST['siteDesc']);
	   $s_key      = iclean($_POST['siteKey']);
       if(!$sql_username or !$sql_password or !$sql_database or !$sql_host or !$a_username or !$a_password or !$s_name or !$s_author or !$s_desc or !$s_key){
         throw new exception('All fields are required!');
       }elseif(!$conn = @mysql_connect($sql_host, $sql_username, $sql_password)){
         throw new exception('skyAdmin could not connect to the MySQL Server.');
       }elseif(!@mysql_select_db($sql_database, $conn)){
         throw new exception('skyAdmin could not connect to the MySQL Database');
       }else{
         $config = file_get_contents('conf.php');
         $config = str_replace('<host>', $sql_host, $config);
         $config = str_replace('<username>', $sql_username, $config);
         $config = str_replace('<password>', $sql_password, $config);
         $config = str_replace('<database>', $sql_database, $config);
         $config = str_replace('<hash>', $secure_hash, $config);
		 $config = str_replace('<prefix>', $sql_prefix, $config);
         file_put_contents('../_construct/conf.php', $config);
		 $sql_s = file_get_contents('statement.sql');
		 $sql_s = str_replace('<prefix>', $sql_prefix, $sql_s);
		 touch('delete_sql.sql');
		 file_put_contents('delete_sql.sql', $sql_s);
         $sql    = file('delete_sql.sql');
         foreach($sql as $sql_line){
           //echo $sql_line.'<br />';
           mysql_query($sql_line);
         }
         mysql_query("INSERT INTO ".$sql_prefix."users VALUES (NULL, '$a_username', '$a_password', 'email', '1,2', '$a_ip')");
		 mysql_query("INSERT INTO ".$sql_prefix."site_settings VALUES ('1', '$s_name', '$s_desc', '$s_author', '$s_key')");
		 unlink('delete_sql.sql');
		 touch('skyadmin_lock.lock');
?>
<div id="content">
Successfully installed <strong>skyAdmin</strong>!<br />
If you wan't to re-install skyAdmin, please delete the <code>skyadmin_lock.lock</code> file in the <code>/install</code> folder.
</div>
<?php
       }
    }catch(exception $e){
      echo $e->getMessage();
    }
  }
?>
<div id="content">
<form action="" method="POST">
  MySQL Settings
  <hr size="1" />
  <label for="m_username">MySQL Username</label><br />
  <input type="text" name="m_username" id="m_username" /><br /><br />
  <label for="m_password">MySQL Password</label><br />
  <input type="text" name="m_password" id="m_password" /><br /><br />
  <label for="m_database">MySQL Database</label><br />
  <input type="text" name="m_database" id="m_database" /><br /><br />
  <label for="m_host">MySQL Host (e.g. localhost)</label><br />
  <input type="text" name="m_host" id="m_host" /><br /><br />
  <label for="m_prefix">SQL Prefix (Do not change if you don't know what it does.)</label><br /><br />
  <input type="text" name="m_prefix" id="m_prefix" value="sky_" /><br /><br />
  Setting up Admin Account
  <hr size="1" />
  <label for="username">Admin Username</label><br />
  <input type="text" name="username" id="username" /><br /><br />
  <label for="password">Admin Password</label><br />
  <input type="password" name="password" id="password" /><br /><br />
  Setting up Site Settings
  <hr size="1" />
  <label for="siteName">Site Name</label><br />
  <input type="text" name="siteName" id="siteName" /><br /><br />
  <label for="siteAuthor">Site Author</label><br />
  <input type="text" name="siteAuthor" id="siteAuthor" /><br /><br />
  <label for="siteDesc">Site Description</label><br />
  <input type="text" name="siteDesc" id="siteDesc" /><br /><br />
  <label for="siteKey">Site Keywords (e.g. comedy, fun, jokes)</label><br />
  <input type="text" name="siteKey" id="siteKey" /><br /><br />
  
  
  <input type="submit" name="install" value="Install" />
</form>
  </div>
  <div id="footer">
    &copy; skyAdmin by <a href="http://jtprojects.me/">Jian Ting</a> (JTprojects)
  </div>
</body>
</html>
