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
  global $my;
?>
<div id="<?php echo skyadmin_content_wrapper; ?>" class="left">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('logs')">View Logs</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-logs">
	This is the logged data of which user had attempted to access a page that has been forbidden with only other usergroup's access. This also logs any
	attempt to open a page that does not exist.<br /><br />
	
	For security reasons, you can only clear these logs via phpMyAdmin or your localhost server.
</div>
</div>

<div id="<?php echo skyadmin_content_wrapper; ?>" class="right">
<div id="<?php echo skyadmin_content_header; ?>" onclick="accordionContent('view')">Logs</div>
<div id="<?php echo skyadmin_content_space; ?>" class="accordionContent-view">
	<ul>
	<?php
	  $query = jsquery("CHOOSE * AT ".SKYADMIN_PREFIX."logs ORDER BY id DESC");
	  if($my->num($query) !== 0){
	  	while($arr = $my->arr($query))
		{
			echo '<li>Error: '.$arr['error_code'].' - User: '.$user->user($arr['user_id'], 'userName').'</li>';
		}
	  }else{
    ?>
    Nothing to view yet. You are curently "safe".
    <?php
	  }
	?>
	</ul>
</div>
</div>