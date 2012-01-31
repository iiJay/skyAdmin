<?php
   /*Copyright (C) 2011 by JTprojects (Jian Ting)

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
  if(!defined('BASEPATH')) die();
  include('../_construct/conf.php');
  if(isset($_POST['submit'])){
  	try {
  		//Admin Settings
       $a_username = clean($_POST['username']);
       $a_password = encrypt($_POST['password']);
	   $a_email    = clean($_POST['email']);
       $a_ip       = ip();
	   if(!$a_username or !$a_password or !$a_email){
		   throw new Exception('<div id="red">All fields are required!</div>');
	   }else{
		   $insert = mysql_query("INSERT INTO ".SKYADMIN_PREFIX."users VALUES (NULL, '$a_username', '$a_password', '$a_email', '1,2', '$a_ip')");
		   if(!$insert){
			   throw new Exception('<div id="red">skyAdmin could not insert required data.</div>');
		   }else{
			   touch('skyadmin_lock.lock');
			   echo '<strong>skyAdmin has been successfully installed!</strong><br />
			         If you wan\'t to re-install skyAdmin, please delete the <code>skyadmin_lock.lock</code> file in the <code>/install</code> folder.';
		   }
	   }
  	}catch(Exception $e){
  		echo $e->getMessage();
  	}
  }
?>
<form action="index.php?step=3" method="POST">
	Setting up Admin Account
  <hr size="1" />
  <label for="username">Admin Username</label><br />
  <input type="text" name="username" id="username" /><br /><br />
  <label for="password">Admin Password</label><br />
  <input type="password" name="password" id="password" /><br /><br />
  <label for="email">Admin Email</label><br />
  <input type="text" name="email" id="email" /><br /><br />
  <div align="center"><input type="submit" name="submit" value="Finish" /> the installation</div>
</form>
