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
  	  //Site Settings
	  $s_name   = clean($_POST['siteName']);
      $s_author = clean($_POST['siteAuthor']);
	  $s_desc   = clean($_POST['siteDesc']);
	  $s_key    = clean($_POST['siteKey']);
	  if(!$s_name or !$s_author or !$s_desc or !$s_key){
		  throw new Exception('<div id="red">All fields are required!</div>');
	  }else{
		  $insert = mysql_query("INSERT INTO ".SKYADMIN_PREFIX."site_settings VALUES ('1', '$s_name', '$s_desc', '$s_author', '$s_key')");
		  if(!$insert){
			  throw new Exception('<div id="red">skyAdmin could not insert required data.</div>');
		  }else{
			  header('Location: index.php?step=3');
		  }
	  }
  	}catch(Exception $e){
  		echo $e->getMessage();
  	}
  }
?>
<form action="index.php?step=2" method="POST">
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
  <div align="center"><input type="submit" name="submit" value="Continue" /> to step 3</div>
</form>
