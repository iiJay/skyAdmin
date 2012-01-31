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
  if(!defined('BASEPATH'))die();
  	if(isset($_POST['uninstall'])){
  		echo '<div id="'.skyadmin_success_header.'">skyAdmin has been successfully uninstalled.</a>';
?>
<div id="<?php echo skyadmin_content_wrapper; ?>">
	<div id="<?php echo skyadmin_content_header; ?>">skyAdmin Uninstalled</div>
	<div id="<?php echo skyadmin_content_space; ?>">
		skyAdmin has been successfully uninstalled. You can now delete the MySQL Database and remove the directory that skyAdmin was installed.<br />
		Thank you for using skyAdmin.<br />
		<br />
		~ Jian Ting (Developer, JTprojects)
	</div>
</div>
<?php
		jsquery("GTG TABLE `".SKYADMIN_PREFIX."chat`, `".SKYADMIN_PREFIX."navigation`, `".SKYADMIN_PREFIX."pages`, `".SKYADMIN_PREFIX."sessions`, `".SKYADMIN_PREFIX."users`, `".SKYADMIN_PREFIX."user_groups`, ".SKYADMIN_PREFIX."site_settings, ".SKYADMIN_PREFIX."logs, ".SKYADMIN_PREFIX."crons");
  	}else{
?>
<div id="<?php echo skyadmin_content_wrapper; ?>">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('uninstall')">Uninstall skyAdmin</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-uninstall">
WARNING: ARE YOU SURE YOU WANT TO REALLY UNINSTALL SKYADMIN?
<form action="index?page=admin-Uninstall" method="POST">
	<input type="submit" name="uninstall" value="Uninstall skyAdmin" />
</form>
</div>
</div>
<?php
  	}
?>